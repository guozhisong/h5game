<?php

class CommonController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
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
				'actions'=>array('index','view','create','update','admin','delete'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Games',
            array(
                'criteria' => array(
                    'condition' => ' `from`=2 ',
                    'order' => 'id desc ',//piao_num desc
                ),
                'pagination' => array('pageSize' => 10,),
            )
        );
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
            'pages'=>$dataProvider->getPagination()
        ));
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Games;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$model->from = 1;
		if(isset($_POST['Games']))
		{ 
		    $model->attributes=$_POST['Games'];
		    $imgsArr = array();
		    for($i = 1; $i <= 5; $i++){
		    
		        $newfile = $this->getUploadFile('Games[imgs'.$i.']');
// 		        var_dump($newfile);
		        if($newfile) {
		            $imgsArr[] = $newfile['big'];
		        }
		    }
// 		    var_dump($imgsArr);exit;
		    if($imgsArr){
		        $model->game_picture = json_encode($imgsArr);
		    }else{
		        $model->game_picture = '';
		    } 
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Games']))
		{
		    $game_picture = $model->game_picture;
		    $model->attributes=$_POST['Games'];
            $imgsArr = array();
            for($i = 1; $i <= 5; $i++){
                
                $newfile = $this->getUploadFile('Games[imgs'.$i.']');
//                 var_dump($newfile);
                if($newfile) {
                    $imgsArr[] = $newfile['big'];
                }
            }
//             var_dump($imgsArr);exit;
		    if($imgsArr){
		        $model->game_picture = json_encode($imgsArr);
		    }else{
		        $model->game_picture = $game_picture;
		    }
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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
		$model=Games::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Games $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='games-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
// 	public function getUploadFile($model, $name){
// 	    if(!empty($_FILES['Items']['tmp_name'][$name]))
// 	    {
// 	        $filename = 'uploads/images_'.time().'_'.rand(111, 999).'.jpg';
// 	        $file = CUploadedFile::getInstance($model,$name);
// 	        $finalFileName = Yii::app()->basePath.'/../'.$filename;
// 	        $file->saveAs($finalFileName);
// 	        return $filename;
// 	    }
// 	    return "";
// 	}
}
