<?php

class LibaoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/admin';

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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view','create','update','admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	    set_time_limit(0);
		$model=new Libao;
		$model->createon = date("Y-m-d H:i:s"); 
		if(isset($_POST['Libao']))
		{ 
			$model->attributes=$_POST['Libao'];
			if($model->save()){
			//导入礼包excel
    			if(!empty($_FILES['Libao']['tmp_name']['excel']))
    			{
    			    $file = CUploadedFile::getInstance($model,'excel');
    			    $finalFileName = Yii::app()->basePath.'/runtime/upload_'.time().'.xls';
    			    $file->saveAs($finalFileName); 
    			    include_once  Yii::app()->basePath.'/extensions/phpexcel/PHPExcel/IOFactory.php';

                    try {
                        $extension = strtolower( pathinfo($_FILES['Libao']['name']['excel'], PATHINFO_EXTENSION) );
                        if ($extension =='xlsx') {
                            $objReader = new PHPExcel_Reader_Excel2007();
                        } else if ($extension =='xls') {
                            $objReader = new PHPExcel_Reader_Excel5();
                        } else if ($extension=='csv') {
                            $objReader = new PHPExcel_Reader_CSV();
                            //默认输入字符集
                            $objReader->setInputEncoding('GBK');
                            //默认的分隔符
                            $objReader->setDelimiter(',');
                        }
                        //载入文件
                        $objPHPExcel = $objReader->load($finalFileName);
//                        $objWorksheet = $objPHPExcel->getSheet(0);
//    			        $highestRow = $objWorksheet->getHighestRow();
//    			        $highestColumn = $objWorksheet->getHighestColumn();
    			        $objWorksheet = $objPHPExcel->getActiveSheet();
    			        $highestRow = $objWorksheet->getHighestRow();
    			        $highestColumn = $objWorksheet->getHighestColumn();
    			        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                        for ($row = 1;$row <= $highestRow;$row++)
                        {
                            $strs=array();
                            for ($col = 0;$col < $highestColumnIndex;$col++)
                            {
                                 $strs[$col] =$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                            }
                            $key = trim($strs[0]);
                            $libaoKey = new LibaoDetail();
                            $libaoKey->key = $key;
                            $libaoKey->libaoid = $model->id;
                            $libaoKey->userid = 0;
                            $libaoKey->save();
                        }
                    }catch (Exception $e){
                         echo $e->getMessage();exit;
                    }
    			} 
		    }
		    $this->redirect('index');
		} 
		$this->render('create',array('model'=>$model));
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
	 * Lists all models.
	 */
	public function actionIndex()
	{ 
		 $dataProvider=new CActiveDataProvider('Libao',
	        array(
	            'criteria' => array(
	                'condition' => ' 1 ',
	                'order' => 'id desc ',//piao_num desc
	            ),
	            'pagination' => array('pageSize' => 30,),
	        )
	    );
	    $this->render('index',array(
	        'dataProvider'=>$dataProvider,
	        'pages'=>$dataProvider->getPagination()
	    )); 
	}

	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Libao the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Libao::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Libao $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='libao-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
