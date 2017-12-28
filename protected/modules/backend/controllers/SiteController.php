<?php

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class SiteController extends Controller
{

    public $layout='//layouts/admin2';
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

    /**
     * 游戏列表
     */
    public function actionIndex()
    {
        $this->checkLogin();
        $games = Games::model()->findAll();
        $this->render('index', array('games'=>$games));
    }

    public function actionLogin()
    {
        if(Yii::app()->session['admin_user']){
            $this->redirect(array('games/index'));
        }
        $error = [];
        if (Yii::app()->request->isPostRequest) {
            $name = $_POST['AdminLoginForm']['name'];
            $password = $_POST['AdminLoginForm']['password'];
            if($name == '' || $password == ''){
                $error[0] = '信息不全';
            }else{
                $exists = CpAdmin::model()->find('name=:name', array(':name'=>$name));
                if($exists){
                    if(md5($password) == $exists->password){
                        if (strtolower($this->createAction('captcha')->getVerifyCode()) != $_POST['AdminLoginForm']['verifyCode']) {
                            $error[3] = '验证码错误';
                        } else {
                            Yii::app()->session['admin_user']=$name;
                            Yii::app()->session['admin_id']=$exists->id;
                            $this->redirect(array('games/index'));
                        }
                    }else{
                        $error[1] = '密码不正确';
                    }
                }else{
                    $error[2] = '用户名不存在';
                }
            }
        }

        $this->layout='//layouts/adminlogin';
        $this->render('login', array(
            'errors' => $error
        ));
    }

    public function actionLogout(){
//        Yii::app()->user->logout();
        unset(Yii::app()->session['admin_user']);
        unset(Yii::app()->session['admin_id']);
        $this->redirect(array('login'));
    }

    public function checkLogin(){
        if(!Yii::app()->session['admin_user']){
            $this->redirect(array('login'));
            exit;
        }
    }



}
