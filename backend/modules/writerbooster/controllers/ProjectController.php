<?php

namespace backend\modules\writerbooster\controllers;

use Yii;
use backend\modules\writerbooster\models\Project;
use backend\modules\writerbooster\models\ProjectContent;
use backend\modules\writerbooster\models\ProjectPara;
use backend\modules\writerbooster\models\ProjectSearch;
use backend\modules\writerbooster\models\CollaSearch;
use backend\modules\writerbooster\models\Collaboration;
use backend\modules\writerbooster\models\Template;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\db\Expression;
/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionColla()
    {
        $searchModel = new CollaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('collaboration', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	
	
	public function actionListView()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list_view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewProject($id)
    {
        return $this->render('view_project', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post())) {
			$transaction = Yii::$app->db->beginTransaction();
			$model->user_id = Yii::$app->user->identity->id;
			try {
				if($model->save()){
					$colla = new Collaboration;
					$colla->project_id = $model->id;
					$colla->user_id = Yii::$app->user->identity->id;
					$colla->is_owner = 1;
					$colla->created_at = new Expression('NOW()');
					$colla->proj_start = time();
					$colla->proj_end = time();
					if($colla->save()){
						$transaction->commit();
					}
				}
				
				
				
			}
			catch (Exception $e) 
			{
				$transaction->rollBack();
				Yii::$app->session->addFlash('error', $e->getMessage());
			}

			
			
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model->scenario = 'project';

        if ($model->load(Yii::$app->request->post())) {
			
			if($model->save()){
				Yii::$app->session->addFlash('success', "Data Updated");
				return $this->redirect(['update', 'id' => $model->id]);
			}else{
				$model->flashError();
			}
			
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
	
	public function actionTemplate($id = null)
    {
		$items = [];
		if($id){
			$items = Template::find()->where(['cat_id' => $id])->all();
		}
		
        return $this->render('template', [
			'cat' => $id,
			'items' => $items
        ]);
    }
	
	public function actionProcessTemplate($id)
    {
		$transaction = Yii::$app->db->beginTransaction();
        try {
			$template = Template::findOne($id);
			$project = new Project;
			$project->user_id = Yii::$app->user->identity->id;
			$project->title = $template->tem_name;
			$project->description = $template->category->cat_name;
			$project->save();
			
			$tem_content = $template->contents;
			if($tem_content){
				
				foreach($tem_content as $tc){
					if($tc->ct_parent == 0){
						$con = new ProjectContent;
						$con->project_id = $project->id;
						$con->ct_parent = 0;
						$con->ct_text = $tc->ct_text;
						$con->ct_desc = $tc->ct_desc;
						$con->ct_type = $tc->ct_type;
						$con->created_by = Yii::$app->user->identity->id;
						$con->created_at = new Expression('NOW()');
						$con->updated_at = new Expression('NOW()');
						$con->save();
							if($tc->ct_type == 2){
								$para = new ProjectPara;
								$para->content_id = $con->id;
								$para->para_text = $tc->para->para_text;
								$para->created_at = new Expression('NOW()');
								$para->updated_at = new Expression('NOW()');
								if(!$para->save()){
									$para->flashError();
									
								}
							}
						$parent = $con->id;
						$children = $tc->children;
						if($children){
							foreach($children as $child){
								$con = new ProjectContent;
								$con->project_id = $project->id;
								$con->ct_parent = $parent;
								$con->ct_text = $child->ct_text;
								$con->ct_desc = $child->ct_desc;
								$con->ct_type = $child->ct_type;
								$con->created_by = Yii::$app->user->identity->id;
								$con->created_at = new Expression('NOW()');
								$con->updated_at = new Expression('NOW()');
								$con->save();
									if($child->ct_type == 2){
										$para = new ProjectPara;
										$para->content_id = $con->id;
										$para->para_text = $child->para->para_text;
										$para->created_at = new Expression('NOW()');
										$para->updated_at = new Expression('NOW()');
										if(!$para->save()){
											$para->flashError();
											
										}
									}
							}
						}
					}
					
					
				}
			}
			
            
            $transaction->commit();
			return $this->redirect(['structure', 'id' =>$project->id]);
            
        }
        catch (Exception $e) 
        {
            $transaction->rollBack();
            Yii::$app->session->addFlash('error', $e->getMessage());
        }



		
    }
	

	
	public function actionCounter($id)
    {
		$this->layout = 'counter';
		
        $model = $this->findModel($id);
		
        return $this->render('counter', [
            'model' => $model,
        ]);
		
    }
	
	public function actionReport($id){
		$model = $this->findModel($id);
		return $this->render('report', [
			'model' => $model,
        ]);
	}
	
	public function actionReportColla($id){
		$model = $this->findModel($id);
		return $this->render('report-colla', [
			'model' => $model,
        ]);
	}
	
	public function actionViewColla($id){
		$model = $this->findModel($id);
		$colla = new Collaboration;
		 if ($colla->load(Yii::$app->request->post())) {
			$colla->project_id = $model->id;
			$colla->created_at = new Expression('NOW()');
			$colla->proj_start = time();
			$colla->proj_end = time();
			if($colla->save()){
				Yii::$app->session->addFlash('success', "Data Updated");
				return $this->redirect(['view-colla', 'id' => $model->id]);
			}
        }
		return $this->render('view_colla', [
			'model' => $model,
			'colla' => $colla
        ]);
	}
	
	public function actionViewCollaColla($id){
		$model = $this->findModel($id);
		return $this->render('view_colla_colla', [
			'model' => $model,
        ]);
	}
	
	public function actionStructure($id)
    {
        $model = $this->findModel($id);
		$colla = new Collaboration;
		
       
		
        return $this->render('structure', [
            'model' => $model,
			'colla' => $colla
        ]);
		
    }
	
	public function actionFulltext($id)
    {
        $model = $this->findModel($id);
		
        return $this->render('fulltext', [
            'model' => $model,
        ]);
		
    }
	
	public function actionFulltextColla($id)
    {
        $model = $this->findModel($id);
		
        return $this->render('fulltext-colla', [
            'model' => $model,
        ]);
		
    }
	
	public function actionStructureColla($id)
    {
        $model = $this->findModel($id);
		
        return $this->render('structure-colla', [
            'model' => $model
        ]);
		
    }
	
	public function actionAddHeading($id){
		
	}
	
	public function actionWrite($id)
    {
        $model = $this->findModel($id);
		$model->scenario = 'content';
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->session->addFlash('success', "Data Updated");
            return $this->redirect(['write', 'id' => $model->id]);
        }
		
        return $this->render('write', [
            'model' => $model,
        ]);
		
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		ProjectContent::deleteAll(['project_id' => $id]);
		Collaboration::deleteAll(['project_id' => $id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionDeleteColla($id)
    {
        $colla = $this->findColla($id);
		$colla->delete();
		$project = $colla->project->id;

        return $this->redirect(['structure', 'id'=>$project]);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	protected function findColla($id)
    {
        if (($model = Collaboration::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionUpdatePomo($id, $dur)
	{
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		
		if (Yii::$app->request->isAjax) {
			
			$model = Collaboration::findOne(['user_id' => Yii::$app->user->identity->id, 'project_id' => $id]);
			
			$current = $model->pomo_count;
			$model->pomo_count = $current + 1;
			$end = $model->proj_end;
			$model->proj_end = $end + $dur;
		
			if($model->save()){
				return [
				'hasil' => 1,
				];
			}else{
				return [
				'hasil' => $model->getErrors(),
				];
			}
			
			
		} 
		
	}
}
