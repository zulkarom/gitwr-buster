<?php

namespace backend\modules\writerbooster\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "project_colla".
 *
 * @property int $id
 * @property int $project_id
 * @property int $user_id
 * @property string $created_at
 *
 * @property Project $project
 * @property User $user
 */
class Collaboration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_colla';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'user_id', 'created_at', 'proj_start', 'proj_end'], 'required'],
			
            [['project_id', 'user_id', 'is_owner', 'proj_start', 'proj_end', 'pomo_count'], 'integer'],
			
            [['created_at'], 'safe'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
