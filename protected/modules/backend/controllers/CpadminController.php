<?php

class CpadminController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public $layout='//layouts/admin2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view','create','update','admin','delete','upload'),
                'expression'=>array($this,'isNormalAdmin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate()
    {
        $uid = Yii::app()->session['admin_id'];
        $model = $this->loadModel($uid);
        if(isset($_POST['CpAdmin']))
        {
            $model->attributes = $_POST['CpAdmin'];
            $model->updated_at = time();
            $model->password = md5($model->password);

            if($model->save())
                $this->redirect(array('games/index'));
        }
        $model->password = '';
        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Games the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=CpAdmin::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }


}