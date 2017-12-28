<?php

class GameController extends Controller
{
  public $layout='//layouts/page';

  public $logincss=true;

	public function actionLogin(){
    if(!Yii::app()->session['user_id']){
        Yii::app()->session['backto'] = $_GET['appid'];
    }
    $user = Users::model()->findByPk(Yii::app()->session['user_id']);
    $this->doLogin($user);
	}

  private function doLogin($user){
    if(!isset($_GET['appid']) || !$_GET['appid'])
      exit('参数错误');

    $this->checkLogin();


    $game = Games::model()->findByAttributes(array('appid'=>$_GET['appid']));
    if(!$game || $game->status == 3)   exit('游戏不存在');

    if(!$game->enter) exit('抱歉，无法进入游戏');

    $user_id = Yii::app()->session['user_id'];

    $userGame = new UserGame();
    $userGame->gameid = $game->id;
    $userGame->userid = $user_id;
    $userGame->save();

    $hot = GamesHots::model()->findByAttributes(array('gameid'=>$game->id));
    if($hot){
        $hot->hots += rand(1, 9);
        $hot->save();
    }else{
        $hot = new GamesHots();
        $hot->gameid = $game->id;
        $hot->hots =  rand(1, 9);
        $hot->save();
    }

    /****预留第三方接入平台（酌情需要下面的变量）*****/
    if($func = $game->plat_form){
      if (method_exists($this,$func)) {
        $this->$func();
        exit;
      } else {
        exit('第三方登陆接入中...');
      }
    }
    /***预留第三方接入平台 end*****/


    $uid = 'cpd'.($user->id * 2 -2);
    $time = time();
    $sign = md5($game->appid.$uid.$time.$game->appkey);

    $params = "source=91yxq&appid=$game->appid&uid=$uid&time=$time&sign=$sign&gid=$game->game_id";
    header("Location: $game->enter?$params");
  }

  function checkLogin(){
      if(!Yii::app()->session['user_login']){
          $this->redirect(array('user/login'));exit;
      }
  }

}
