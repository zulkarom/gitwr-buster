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
			
            [['user_id', 'status', 'pomodoro', 'pomo_long_break', 'default_session'], 'integer'],
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
        return $this->hasMany(ProjectContent::className(), ['project_id' => 'id'])->where(['ct_parent' => 0, 'ct_active' => 1]);
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
				$header->id = $con->id;
				$header->type = $con->ct_type;
				$header->text = $con->ct_text;
				$header->action = 'update';
				$header->numbering = $i.'.';
				$content2 = array();
				if($con->children){
					
					$ii= 1;
					foreach($con->children as $ch1){
						$header2 = new \stdClass();
						$header2->id = $ch1->id;
						$header2->type = $ch1->ct_type;
						$header2->text = $ch1->ct_text;
						if($ch1->ct_type == 1){
							$header2->action = 'update';
							$header2->numbering = $i . '.' .$ii;
						}else{
							$header2->action = 'update-para';
							$header2->numbering = '# ';
						}
						
						$header2->margin = 20;
						$content3 = array();
						if($ch1->children){
							
							
							$iii= 1;
							foreach($ch1->children as $ch2){
								$header3 = new \stdClass();
								$header3->type = $ch2->ct_type;
								$header3->id = $ch2->id;
								$header3->text = $ch2->ct_text;
								if($ch2->ct_type == 1){
									$header3->action = 'update';
									$header3->numbering = $i.'.'. $ii . '.' . $iii;
								}else{
									$header3->action = 'update-para';
									$header3->numbering = '# ';
								}
								
								$header3->margin = 40;
								$content4 = array();
								if($ch2->children){
									foreach($ch2->children as $ch3){
										$para = new \stdClass();
										$para->id = $ch3->id;
										$para->type = $ch3->ct_type;
										$para->text = $ch3->ct_text;
										$para->action = 'update-para';
										$para->margin = 60;
										$para->numbering = '# ';
										$content4[] = $para;
									}
									
								}
								$header3->children = $content4;
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
	
	public function getChildrenLoop($parent){
	/* 	$content = array();
		if($parent->children){
			
			$header = new \stdClass();
			$iii= 1;
			foreach($parent->children as $child){
				$header->text = $child->ct_text;
				$header->numbering = $i.'.'. $ii . '.' . $iii;
				$header->margin = 40;
				$content[] = $header;
			$iii++;
			}
		
		}
		return $content; */
	}
	
	public function countHead(){
		$result = ProjectContent::find()
		->where(['project_id' => $this->id, 'ct_type' => 1, 'ct_active' => 1])
		->count();
		
		if($result){
			return $result;
		}else{
			return 0;
		}
	}
	
	public function countPara(){
		$result = ProjectContent::find()
		->where(['project_id' => $this->id, 'ct_type' => 2, 'ct_active' => 1])
		->count();
		
		if($result){
			return $result;
		}else{
			return 0;
		}
	}
	
	public function getArrayHeading(){
		$array = array();
		$array[0] = 'No Parent';
		if($this->structure){
			foreach($this->structure as $con){
				if($con->type == 1){
					$array[$con->id] = $con->numbering . ' ' . $con->text;
				}
				if($con->children){
					foreach($con->children as $ch1){
						if($ch1->type == 1){
							$array[$ch1->id] = $ch1->numbering . ' ' . $ch1->text;
						}
						
	
					}
				}
			}
		
		}
		return $array;
	}
	
	public function getArrayHeadingPara(){
		$array = array();
		if($this->structure){
			foreach($this->structure as $con){
				if($con->type == 1){
					$array[$con->id] = $con->numbering . ' ' . $con->text;
				}
				if($con->children){
					foreach($con->children as $ch1){
						if($ch1->type == 1){
							$array[$ch1->id] = $ch1->numbering . ' ' . $ch1->text;
						}
						if($ch1->children){
							foreach($ch1->children as $ch2){
								if($ch2->type == 1){
									$array[$ch2->id] = $ch2->numbering . ' ' . $ch2->text;
								}
								
			
							}
						}
	
					}
				}
			}
		
		}
		return $array;
	}
	
	public function getProjDuration(){
		$start = strtotime($this->created_at);
		$end = strtotime($this->project_duration);
		$second = $end - $start;
		$hour = 0;
		$minute = 0;
		
		
		if ($second >= 60)
		{
		  $minute = (int)($second / 60);
		  $second = fmod($second,60);
		}
		
		if ($minute >= 60)
		{
		  $hour = (int)($minute / 60);
		  $minute = fmod($minute,60);
		  
		}
		
		$second = strlen($second) == 2 ? $second : '0' . $second;
		$minute = strlen($minute) == 2 ? $minute : '0' . $minute;
		$hour = strlen($hour) >= 2 ? $hour : '0' . $hour;
		
		return $hour . ':' .$minute . ':' . $second;
	}
	
	public function getCollaborations()
    {
        return $this->hasMany(Collaboration::className(), ['project_id' => 'id']);
    }

}
