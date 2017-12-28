<?php

class HoutaiController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public $layout='//layouts/admin';
    public function actions(){
		return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha'=>array(
 						'class'=>'MyCaptchaAction',
						'backColor'=>0xFFFFFF,
						'maxLength'=>'4',    
						'minLength'=>'4',    
						'height'=>'25',
						'width'=>'60',
						'testLimit' => 999
				),
		);
	}
	
	public function actionLogin()
	{
        if(Yii::app()->session['super_admin']){
            $this->redirect(array('cgames/index', 'from' => 1, 'status' => 0));
        }
	    $model=new AdminLoginForm();
	    if(isset($_POST['AdminLoginForm']))
	    {
	        $model->attributes=$_POST['AdminLoginForm'];
	        if($model->validate() && $model->validateVerifyCode($this->createAction('captcha')->getVerifyCode()) && $model->login()){
	            Yii::app()->session['super_admin'] = $_POST['AdminLoginForm']['username'];
	            $this->redirect(array('cgames/index', 'from' => 1, 'status' => 0));exit;
	        }
	    }
	    $this->layout='//layouts/adminlogin';
	    $this->render('login', array('model'=>$model));
	}
	
	public function actionLogout(){
//	    Yii::app()->user->logout();
	    unset(Yii::app()->session['super_admin']);
	    $this->redirect(array('login'));
	}
	
	public function checkLogin(){
	    if(!Yii::app()->session['super_admin']){
	        $this->redirect(array('login'));
	        exit;
	    }
	}
    
	/**
	 * 游戏列表
	 */
	public function actionIndex()
	{
	    $this->checkLogin();
	    $games = Games::model()->findAll();
		$this->render('index', array('games'=>$games));
	} 
	
	/**
	 * 首页排版
	 */
	public function actionHome(){
	    $this->checkLogin();
	    $this->render('home');
	}
	
	public function actionTuijian($id){
	    $this->checkLogin();
	    $tuijian = Conf::model()->findByPk($id);
	    if(!$tuijian){
	        $tuijian = new Conf();
	        $tuijian->id = $id;
	        $tuijian->content = '';
	        $tuijian->save();
	    }
	    if(isset($_POST['content'])){
	        $content = trim($_POST['content']);
            $sql = "select id from games where find_in_set(id,'".$content."') AND status!=1 AND `from`=1";
            $Games = Yii::app()->db->createCommand($sql)->queryAll();
            $tuijian->content = $content;
            if (!empty($Games)) {
                $Games = implode(',', array_column($Games, 'id'));
                echo "<script>alert('".$Games." 未审核通过')</script>";
            }else{
                $tuijian->save();
            }
	    }
	    $this->render('tuijian', array('tuijian'=>$tuijian));
	}  
}