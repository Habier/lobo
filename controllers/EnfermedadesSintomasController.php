<?php

namespace app\controllers;

use app\models\Enfermedades;
use app\models\EnfermedadesSintomas;
use app\models\EnfermedadesSintomasSearch;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * EnfermedadesSintomasController implements the CRUD actions for EnfermedadesSintomas model.
 */
class EnfermedadesSintomasController extends ControllerControlAccess
{
    /**
     * Lists all EnfermedadesSintomas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EnfermedadesSintomasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Agrega un sintoma a una enfermedad
     * @param  int $enfermedad_id id de la enfermedad
     * @return mixed                Devuelve la vista
     */

    public function actionAgregarSintomas($enfermedad_id)
    {
        $model = Enfermedades::findOne($enfermedad_id);

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single EnfermedadesSintomas model.
     * @param int $enfermedad_id
     * @param int $sintoma_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($enfermedad_id, $sintoma_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($enfermedad_id, $sintoma_id),
        ]);
    }

    /**
     * Creates a new EnfermedadesSintomas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EnfermedadesSintomas([
            'enfermedad_id' => Yii::$app->request->post('list'),
            'sintoma_id' => Yii::$app->request->post('item'),
        ]);
        //dd($model->validate());
        if (!$model->save()) {
            throw new \Exception('No se ha ppodido agregar el sintoma a la enfermedad', 1);
        }
    }

    /**
     * Updates an existing EnfermedadesSintomas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $enfermedad_id
     * @param int $sintoma_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($enfermedad_id, $sintoma_id)
    {
        $model = $this->findModel($enfermedad_id, $sintoma_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'enfermedad_id' => $model->enfermedad_id, 'sintoma_id' => $model->sintoma_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EnfermedadesSintomas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        extract(Yii::$app->request->post());
        $this->findModel($list, $item)->delete();
    }

    /**
     * Finds the EnfermedadesSintomas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $enfermedad_id
     * @param int $sintoma_id
     * @return EnfermedadesSintomas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($enfermedad_id, $sintoma_id)
    {
        if (($model = EnfermedadesSintomas::findOne(['enfermedad_id' => $enfermedad_id, 'sintoma_id' => $sintoma_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
