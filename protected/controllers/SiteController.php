<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		echo 'en';
	}
	
	/**
	 * 从白鹭导入游戏到游戏库
	 */
	public function actionLoading(){
	    echo "loading";
	    $list = $this->getGamelist();
	    if($list->code == 0){
	        $games = $list->game_list;
	        foreach ($games as $game){
	            $gameId = $game->gameId;
	            $gamesExsits = Games::model()->findByAttributes(array('game_egret_id'=>$gameId));
	            if(!$gamesExsits){
	                $newGame = New Games();
	                $newGame->desc = $game->desc;
	                $newGame->game_picture = json_encode($game->game_picture);
	                $newGame->game_egret_id = $gameId;
	                $newGame->icon = $game->icon;
	                $newGame->name = $game->name;
	                $newGame->short_desc = $game->shortDesc;
	                $newGame->type = $game->type;
	                $newGame->from = 1;
	                $newGame->save();
	            }
	        }
	    }
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}