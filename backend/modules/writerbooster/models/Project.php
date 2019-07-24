<?php

namespace backend\modules\writerbooster\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property int $status
 * @property string $project_duration
 * @property int $pomodoro
 * @property string $pomo_duration
 * @property int $pomo_long_break
 * @property string $short_break
 * @property string $long_break
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
			
			[['content'], 'required', 'on' => 'content'],
			
            [['user_id', 'status', 'pomodoro', 'pomo_long_break'], 'integer'],
            [['description'], 'string'],
            [['project_duration', 'pomo_duration', 'short_break', 'long_break'], 'safe'],
            [['title'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'project_duration' => 'Project Duration',
            'pomodoro' => 'Pomodoro',
            'pomo_duration' => 'Pomodoro Duration',
            'pomo_long_break' => 'Long Break After #Pomodoro ',
            'short_break' => 'Short Break',
            'long_break' => 'Long Break',
        ];
    }
	
	public function getMainContents()
    {
        return $this->hasMany(ProjectContent::className(), ['project_id' => 'id'])->where(['ct_parent' => 0]);
    }

	
	public function flashError(){
		if($this->getErrors()){
			foreach($this->getErrors() as $error){
				if($error){
					foreach($error as $e){
						Yii::$app->session->addFlash('error', $e);
					}
				}
			}
		}

	}
	
	public function getStructure(){
		
		$content = array();
		if($this->mainContents){
			$i = 1;
			foreach($this->mainContents as $con){
				$header = new \stdClass();
				$header->text = $con->ct_text;
				$header->numbering = $i;
				$content2 = array();
				if($con->children){
					
					$ii= 1;
					foreach($con->children as $ch1){
						$header2 = new \stdClass();
						$header2->text = $ch1->ct_text;
						$header2->numbering = $i . '.' .$ii;
						$header2->margin = 20;
						$content3 = array();
						if($ch1->children){
							
							$header3 = new \stdClass();
							$iii= 1;
							foreach($ch1->children as $ch2){
								$header3->text = $ch2->ct_text;
								$header3->numbering = $i.'.'. $ii . '.' . $iii;
								$header3->margin = 40;
								$content3[] = $header3;
							$iii++;
							}
						
						}
						$header2->children = $content3;
						$content2[] = $header2;
					$ii++;
					}
				
				}
				$header->children = $content2;
				$content[] = $header;
			$i++;
			}
			
		}
		return $content;
	}
}
