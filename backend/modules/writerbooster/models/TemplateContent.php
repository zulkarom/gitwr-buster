<?php

namespace backend\modules\writerbooster\models;

use Yii;

/**
 * This is the model class for table "template_content".
 *
 * @property int $id
 * @property int $template_id
 * @property int $ct_parent
 * @property string $ct_text
 * @property string $ct_desc
 * @property int $ct_type 1=header, 2= para
 * @property int $ct_order
 * @property int $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property int $ct_active
 */
class TemplateContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'template_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_id', 'ct_parent'], 'required'],
            [['template_id', 'ct_parent', 'ct_type', 'ct_order', 'created_by', 'ct_active'], 'integer'],
            [['ct_text', 'ct_desc'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'template_id' => 'Template ID',
            'ct_parent' => 'Ct Parent',
            'ct_text' => 'Ct Text',
            'ct_desc' => 'Ct Desc',
            'ct_type' => 'Ct Type',
            'ct_order' => 'Ct Order',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ct_active' => 'Ct Active',
        ];
    }
	
	public function getPara(){
        return $this->hasOne(TemplatePara::className(), ['tem_content_id' => 'id']);

	}
	
	public function getChildren(){
		 return $this->hasMany(TemplateContent::className(), ['ct_parent' => 'id'])->where(['ct_active' => 1])->orderBy('ct_order ASC');
	}
}
