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
            [['content_id', 'para_text', 'created_at', 'updated_at'], 'required'],
			
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
            'para_text' => 'Paragraph Text',
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
	
	public function getComments()
    {
        return $this->hasMany(ParaComment::className(), ['para_id' => 'id'])->orderBy('created_at ASC');
    }
	
	
	
	public function getCommentsHtml()
    {
		$html = '';
		// - '.$com->commentTime .'
        if($this->comments){
			$html .= '<table class="table table-stripped">';
			foreach($this->comments as $com){
				$html .= '<tr><td>
				<i style="font-size:12px"><strong>'.$com->user->fullname .'</strong></i>';
				$class = 'block-comment';
				$close='';
				if($com->user_id == Yii::$app->user->identity->id){
					$close= '<a href="javascript:void(0)" id="close-'.$com->id.'" class="close">&times;</a>';
					$class = 'block-comment-my';
				}
				
				$html .= '<div class="'.$class.'">'. $com->comment_text;
				
				
				$html .= $close;
				
				$html .= '</div></td></tr>';
			}
			$html .= '</table>';
			
		}else{
			$html .= 'No comment so far';
		}
		
	return $html;
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
