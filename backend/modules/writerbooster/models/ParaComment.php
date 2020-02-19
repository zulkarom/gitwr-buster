<?php

namespace backend\modules\writerbooster\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "para_comment".
 *
 * @property int $id
 * @property int $para_id
 * @property int $user_id
 * @property string $comment_text
 * @property string $created_at
 *
 * @property ProjectPara $para
 * @property User $user
 */
class ParaComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'para_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['para_id', 'user_id', 'comment_text', 'created_at'], 'required'],
			
            [['para_id', 'user_id'], 'integer'],
			
            [['comment_text'], 'string'],
            [['created_at'], 'safe'],
            [['para_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectPara::className(), 'targetAttribute' => ['para_id' => 'id']],
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
            'para_id' => 'Para ID',
            'user_id' => 'User ID',
            'comment_text' => 'Comment Text',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPara()
    {
        return $this->hasOne(ProjectPara::className(), ['id' => 'para_id']);
    }
	
	

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
	
	public function getCommentTime()
	{

		$time = time() - $this->created_at; // to get the time since that moment
		$time = ($time<1)? 1 : $time;
		$tokens = array (
			31536000 => 'year',
			//2592000 => 'month',
			//604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
		);

		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'') . ' ago';
		}

	}
}
