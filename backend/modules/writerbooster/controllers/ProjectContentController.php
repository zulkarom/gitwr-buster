<?php

namespace backend\modules\writerbooster\controllers;

use Yii;
use backend\modules\writerbooster\models\ProjectContent;
use backend\modules\writerbooster\models\ProjectPara;
use backend\modules\writerbooster\models\Project;
use backend\modules\writerbooster\models\ParaComment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\db\Expression;
/**
 * ProjectContentController implements the CRUD actions for ProjectContent model.
 */
class ProjectContentController extends Controller
{
    /**
     * @inheritdoc   
	*/
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    

    /**
     * Lists all ProjectContent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ProjectContent::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectContent model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProjectContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($project_id)
    {
        $model = new ProjectContent();
		
		$project = $this->findProject($project_id);

        if ($model->load(Yii::$app->request->post())) {
			$model->project_id = $project_id;
			$model->ct_type = 1;
			$model->created_at = new Expression('NOW()');
			$model->created_by = Yii::$app->user->identity->id;
			$model->updated_at = new Expression('NOW()');
			if($model->save()){
				Yii::$app->session->addFlash('success', "Data Updated");
				 return $this->redirect(['/apps/project/structure/', 'id' => $project_id]);
			}else{
				$model->flashError();
			}
           
        }

        return $this->render('create', [
            'model' => $model,
			'project' => $project
        ]);
    }
	
	public function actionCreatePara($project_id)
    {
        $model = new ProjectContent();
		$para = new ProjectPara;
		$project = $this->findProject($project_id);

        if ($model->load(Yii::$app->request->post()) && $para->load(Yii::$app->request->post())) {
			$transaction = Yii::$app->db->beginTransaction();
			try {
				$model->project_id = $project_id;
				$model->ct_type = 2;
				$model->created_at = new Expression('NOW()');
				$model->created_by = Yii::$app->user->identity->id;
				$model->updated_at = new Expression('NOW()');
				if($model->save()){
					$para->content_id = $model->id;
					$para->created_at = new Expression('NOW()');
					$para->updated_at = new Expression('NOW()');
					$para->save();
					Yii::$app->session->addFlash('success', "Data Updated");
					 
				}else{
					$model->flashError();
				}
				
				$transaction->commit();
				return $this->redirect(['/apps/project-content/update-para/', 'id' => $model->id, 'project_id' => $project_id]);
			}
			catch (Exception $e) 
			{
				$transaction->rollBack();
				Yii::$app->session->addFlash('error', $e->getMessage());
			}

			
           
        }

        return $this->render('create-para', [
            'model' => $model,
			'para' => $para,
			'project' => $project
        ]);
    }

    /**
     * Updates an existing ProjectContent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $project_id)
    {
        $model = $this->findModel($id);
		$project = $this->findProject($project_id);

        if ($model->load(Yii::$app->request->post())) {
			$model->save();
            return $this->redirect(['/apps/project/structure/', 'id' => $project_id]);
        }

        return $this->render('update', [
            'model' => $model,
			'project' => $project,
        ]);
    }
	
	public function actionUpdateColla($id, $project_id)
    {
        $model = $this->findModel($id);
		$project = $this->findProject($project_id);

        if ($model->load(Yii::$app->request->post())) {
			$model->save();
            return $this->redirect(['/apps/project/structure-colla/', 'id' => $project_id]);
        }

        return $this->render('update-colla', [
            'model' => $model,
			'project' => $project,
        ]);
    }
	
	public function actionUpdatePara($id, $project_id)
    {
        $model = $this->findModel($id);
		$para = $model->para;
		$project = $this->findProject($project_id);

        if ($model->load(Yii::$app->request->post()) && $para->load(Yii::$app->request->post())) {
			$transaction = Yii::$app->db->beginTransaction();
			try {
				$model->updated_at = new Expression('NOW()');
				if($model->save()){
					$para->updated_at = new Expression('NOW()');
					$para->save();
					Yii::$app->session->addFlash('success', "Data Updated");
					 
				}else{
					$model->flashError();
				}
				
				$transaction->commit();
				return $this->redirect(['/apps/project-content/update-para/', 'id' => $model->id, 'project_id' => $project_id]);
			}
			catch (Exception $e) 
			{
				$transaction->rollBack();
				Yii::$app->session->addFlash('error', $e->getMessage());
			}

			
           
        }

        return $this->render('update-para', [
            'model' => $model,
			'project' => $project,
			'para' => $para
        ]);
    }
	
	public function actionUpdateParaColla($id, $project_id)
    {
        $model = $this->findModel($id);
		$para = $model->para;
		$project = $this->findProject($project_id);
		$comment = new ParaComment;

        if ($model->load(Yii::$app->request->post()) && $para->load(Yii::$app->request->post())) {
			$transaction = Yii::$app->db->beginTransaction();
			try {
				$model->updated_at = new Expression('NOW()');
				if($model->save()){
					$para->updated_at = new Expression('NOW()');
					$para->save();
					Yii::$app->session->addFlash('success', "Data Updated");
					 
				}else{
					$model->flashError();
				}
				
				$transaction->commit();
				return $this->redirect(['/apps/project-content/update-para-colla/', 'id' => $model->id, 'project_id' => $project_id]);
			}
			catch (Exception $e) 
			{
				$transaction->rollBack();
				Yii::$app->session->addFlash('error', $e->getMessage());
			}

			
           
        }
		
		if($comment->load(Yii::$app->request->post())){
			$comment->para_id = $para->id;
			$comment->user_id = Yii::$app->user->identity->id;
			$comment->created_at = new Expression('NOW()');
			$comment->save();
		}

        return $this->render('update-para-colla', [
            'model' => $model,
			'project' => $project,
			'para' => $para,
			'comment' => $comment
        ]);
    }

    /**
     * Deletes an existing ProjectContent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($project_id, $id)
    {
        $model = $this->findModel($id);
		$model->ct_active = 0;
		$model->save();

        return $this->redirect(['/apps/project/structure/', 'id' => $project_id]);
    }

    /**
     * Finds the ProjectContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectContent::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	protected function findProject($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	protected function findPara($id)
    {
        if (($model = ProjectPara::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionComment(){
		 \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		  $data = Yii::$app->request->post();
		  $text = $data['comment_text'];
		  $id = $data['para'];
		  $com = new ParaComment;
		  $com->para_id = $id;
		  $com->created_at = time();
		  $com->comment_text = $text;
		  $com->user_id = Yii::$app->user->identity->id;
		  if($com->save()){
			  $para = $this->findPara($id);
			  $comments = $para->comments;
			  return [
				'hasil' => $para->commentsHtml,
			];
		  }else{
			  return [
				'hasil' => $com->getErrors(),
			];
		  }
		  
		  
		  
		 
	}
	
	public function actionDeleteComment(){
		 \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		  $data = Yii::$app->request->post();
		  $id = $data['comment'];
		  $para = $data['para'];
		  $com = ParaComment::findOne($id);
		  if($com->delete()){
			  $para = $this->findPara($para);
			  $comments = $para->comments;
			  return [
				'hasil' => $para->commentsHtml,
			];
		  }else{
			  return [
				'hasil' => $com->getErrors(),
			];
		  }
		  
		  
		  
		 
	}
	
	
}
