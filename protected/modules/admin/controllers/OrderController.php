<?php

class OrderController extends Controller
{
    /**
     * Declares class-based actions.
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
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view','create','update','againpay','alreadypay','delete','upload'),
                'expression'=>array($this,'isSuperAdmin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    
	/**
	 * 游戏列表
	 */
	public function actionIndex()
	{
        $where = "WHERE p.`status`=2 AND p.appid!='' ";
        if (!empty($_GET['out_trade_no'])) {
            $where .= "AND p.out_trade_no='".$_GET['out_trade_no']."' ";
        }
        if (!empty($_GET['user_login'])) {
            $where .= "AND u.user_login='".$_GET['user_login']."' ";
        }
        $sql = 'SELECT COUNT(*) FROM pay p LEFT JOIN users u ON p.user_id=u.id LEFT JOIN games g ON p.appid=g.appid ' . $where;
        $count = Yii::app()->db->createCommand($sql)->queryScalar();

        $sql = 'SELECT p.out_trade_no, p.org_amount, p.discount, p.amount, p.goods_name, p.payed_time, u.user_login, g.name FROM pay p LEFT JOIN users u ON p.user_id=u.id LEFT JOIN games g ON p.appid=g.appid ' . $where;
        $dataProvider = new CSqlDataProvider($sql, array(
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'payed_time',
                ),
                'defaultOrder' => array (
                    'payed_time' => true
                )
            ),
            'pagination' => array(
                'pageSize' => 30
            )
        ));
//        var_dump($dataProvider->getData());die;
        $arr = array_column($dataProvider->getData(), 'amount');
        $this->render('index',array(
            'totalMoney'=>array_sum($arr),
            'dataProvider'=>$dataProvider,
            'pages'=>$dataProvider->getPagination()
        ));
	}

	/**
	 * 游戏列表
	 */
	public function actionCreate()
	{
        $model = new CpAdmin();
        $model->created_at = time();
        $model->updated_at = time();
        if(isset($_POST['CpAdmin']))
        {
            $model->attributes = $_POST['CpAdmin'];
            $model->password = md5($model->password);

            if($model->save()) {
                $this->redirect(array('index'));
            }
        }

        $this->render('create',array('model'=>$model));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        if(isset($_POST['CpAdmin']))
        {
            $model->attributes = $_POST['CpAdmin'];
            $model->updated_at = time();
            $model->password = md5($model->password);

            if($model->save())
                $this->redirect(array('index'));
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

    public function actionAgainpay()
    {
        if (!empty($_GET['out_trade_no'])) {
            $sql = "SELECT user_orderid FROM pay WHERE out_trade_no='".$_GET['out_trade_no']."' AND status=2";
            $result = Yii::app()->db->createCommand($sql)->queryScalar();
            if (!$result) {
                echo "<script>alert('该订单未支付成功')</script>";
            } else {
                $sql = "SELECT url, para, cnt, error_msg FROM send_notify_log WHERE out_trade_no='".$result."' ORDER BY add_time DESC";
                $result2 = Yii::app()->db->createCommand($sql)->queryRow();
                if ($result2['error_msg'] == 'success') {
                    echo "<script>alert('该订单游戏道具已发')</script>";
                } else {
                    Yii::app()->db->createCommand()->insert('send_notify',
                        array(
                            'url' => $result2['url'],
                            'param' => $result2['para'],
                            'cnt' => 1,
                        )
                    );
                }
            }

            $this->redirect(array('alreadypay'));
        }

        $this->render('againpay');
    }

    public function actionAlreadypay()
    {
        $where = "WHERE l.error_msg='success' ";
        //我方订单号
        if (!empty($_GET['out_trade_no'])) {
            $where .= "AND p.out_trade_no='".$_GET['out_trade_no']."' ";
        }
        //对方订单号
        if (!empty($_GET['user_orderid'])) {
            $where .= "AND l.out_trade_no='".$_GET['user_orderid']."' ";
        }
        $sql = 'SELECT COUNT(*) FROM send_notify_log l LEFT JOIN pay p ON l.out_trade_no=p.user_orderid ' . $where;
        $count = Yii::app()->db->createCommand($sql)->queryScalar();

        $sql = 'SELECT p.out_trade_no, p.user_orderid, p.org_amount, p.discount, p.amount, p.goods_name, p.payed_time FROM send_notify_log l LEFT JOIN pay p ON l.out_trade_no=p.user_orderid ' . $where;
        $dataProvider = new CSqlDataProvider($sql, array(
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'payed_time',
                ),
                'defaultOrder' => array (
                    'payed_time' => true
                )
            ),
            'pagination' => array(
                'pageSize' => 30
            )
        ));
//        var_dump($dataProvider->getData());die;
        $arr = array_column($dataProvider->getData(), 'amount');
        $this->render('alreadypay',array(
            'totalMoney'=>array_sum($arr),
            'dataProvider'=>$dataProvider,
            'pages'=>$dataProvider->getPagination()
        ));
    }

}