<?php

namespace backend\modules\writerbooster\models;

use Yii;

/**
 * This is the model class for table "template_item".
 *
 * @property int $id
 * @property int $cat_id
 * @property string $item_name
 * @property int $item_order
 */
class Template extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cat_id', 'item_name', 'item_order'], 'required'],
            [['id', 'cat_id', 'item_order'], 'integer'],
            [['item_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_id' => 'Cat ID',
            'item_name' => 'Item Name',
            'item_order' => 'Item Order',
        ];
    }
	
	public function getCategory(){
		return $this->hasOne(TemplateCat::className(), ['id' => 'cat_id']);
	}
	
	public function getContents()
    {
        return $this->hasMany(TemplateContent::className(), ['template_id' => 'id']);
    }

}
