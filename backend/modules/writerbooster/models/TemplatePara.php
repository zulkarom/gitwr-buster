<?php

namespace backend\modules\writerbooster\models;

use Yii;

/**
 * This is the model class for table "template_para".
 *
 * @property int $id
 * @property int $tem_content_id
 * @property string $para_desc
 * @property string $para_text
 * @property string $created_at
 * @property string $updated_at
 */
class TemplatePara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'template_para';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tem_content_id'], 'required'],
            [['tem_content_id'], 'integer'],
            [['para_desc', 'para_text'], 'string'],
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
            'tem_content_id' => 'Tem Content ID',
            'para_desc' => 'Para Desc',
            'para_text' => 'Para Text',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
