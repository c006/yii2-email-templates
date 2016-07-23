<?php

namespace c006\email\controllers;

use c006\core\assets\CoreHelper;
use c006\email\assets\ImageHelper;
use c006\email\models\Files;
use c006\email\models\search\Files as FilesSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * FilesController implements the CRUD actions for Files model.
 */
class FilesController extends Controller
{

    function init()
    {
        if (CoreHelper::checkLogin() && CoreHelper::isGuest()) {
            return $this->redirect('/user');
        }
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Files models.
     * @return mixed
     */
    public function actionIndex()
    {
//        print_r($_SERVER); exit;

        $searchModel = new FilesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Files model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Files model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Files();

        if (isset($_POST['Files'])) {

            $image = new ImageHelper();

            $file = $_FILES['Files']['name']['file'];
            $suffix = ImageHelper::getFileExtension($file);
            $model->name = $_POST['Files']['name'];
            $model->file = preg_replace('/[\s|\.]+/', '-', microtime(FALSE)) . '.' . $suffix;

            $model->template_id = $_POST['Files']['template_id'];
            if ($model->validate() && $model->save()) {

                $image->saveImage($model->file, $_FILES['Files']['tmp_name']['file']);
            } else {
                print_r($model->getErrors());
                exit;
            }

            return $this->redirect(['index', 'id' => $model->id, 'Files[template_id]' => $model->template_id]);
        } else {

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Files model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $file = $model->file;
        if ($model->load(Yii::$app->request->post())) {

            if (isset($_FILES['Files'])) {
                $image = new ImageHelper();
                $file = $_FILES['Files']['name']['file'];
                $suffix = ImageHelper::getFileExtension($file);
                $model->file = preg_replace('/[\s|\.]+/', '-', microtime(FALSE)) . '.' . $suffix;
                $image->saveImage($model->file, $_FILES['Files']['tmp_name']['file']);
            } else {
                $model->file = $file;
            }

            $model->save();

            return $this->redirect(['index', 'id' => $model->id, 'Files[template_id]' => $model->template_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Files model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $image = new ImageHelper();
        $image->deleteFile($model->file);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Files model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Files the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Files::findOne($id)) !== NULL) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
