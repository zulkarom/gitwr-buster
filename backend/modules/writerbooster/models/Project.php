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
}
