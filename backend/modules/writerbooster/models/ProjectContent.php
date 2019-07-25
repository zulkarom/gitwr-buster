<?php

namespace backend\modules\writerbooster\models;

use Yii;

/**
 * This is the model class for table "project_content".
 *
 * @property int $id
 * @property int $project_id
 * @property int $ct_parent
 * @property string $ct_text
 * @property int $ct_type 1=header, 2= para
 * @property int $ct_order
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Project $project
 */
class ProjectContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'ct_parent', 'ct_text', 'ct_type', 'created_at', 'updated_at'], 'required'],
			
			
            [['project_id', 'ct_parent', 'ct_type', 'ct_order'], 'integer'],
			
            [['ct_text', 'ct_desc'], 'string'],
			
            [['created_at', 'updated_at'], 'safe'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project',
            'ct_parent' => 'Parent',
            'ct_text' => 'Focus Statement',
			'ct_desc' => 'Description',
            'ct_type' => 'Ct Type',
            'ct_order' => 'Ct Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
	
	public function getChildren(){
		 return $this->hasMany(ProjectContent::className(), ['ct_parent' => 'id'])->orderBy('ct_order ASC');
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
