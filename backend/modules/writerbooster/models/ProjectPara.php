<?php

namespace backend\modules\writerbooster\models;

use Yii;

/**
 * This is the model class for table "project_para".
 *
 * @property int $id
 * @property int $content_id
 * @property string $para_desc
 * @property string $para_text
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ProjectContent $content
 */
class ProjectPara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_para';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_id', 'para_desc', 'para_text', 'created_at', 'updated_at'], 'required'],
            [['content_id'], 'integer'],
            [['para_desc', 'para_text'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['content_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectContent::className(), 'targetAttribute' => ['content_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_id' => 'Content ID',
            'para_desc' => 'Para Desc',
            'para_text' => 'Para Text',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContent()
    {
        return $this->hasOne(ProjectContent::className(), ['id' => 'content_id']);
    }
}
