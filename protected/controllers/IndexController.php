<?php

class IndexController extends Controller
{
    public $layout='//layouts/page';

	public function actionIndex()
	{
        $this->pageTitle = ($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台_h5游戏在线玩_手机网页游戏|大全|排行榜';
	    $this->keywords = 'h5游戏大全,手机网页游戏,最新h5游戏,好玩的h5游戏,手机微游戏,h5网游';
	    $this->description = ($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台,h5手游频道提供最新最好玩的html5在线网游,html5手机游戏,多人在线游戏等信息,h5手游,好玩的h5网游。找h5微游戏,h5游戏大全,h5游戏排行榜就上'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台。';
	    $home = Home::model()->findByPk(1);

	    $mygames = array();
	    if(Yii::app()->session['user_id']){
	        $user_id = Yii::app()->session['user_id'];
    	    $sql = "select distinct gameid from user_game where userid = $user_id order by id desc";
    	    $userGames = Yii::app()->db->createCommand($sql)->queryAll();
    	    $gameids = array();
    	    foreach ($userGames as $usergame){
    	        $gameids[] = $usergame['gameid'];
    	    }
    	    $mygames = Games::model()->findAllByAttributes(array('id'=>$gameids));
	    }

	    $confWyou = Conf::model()->findByPk(3);

	    $this->youqing = $confWyou->content;

	    $xttj=array('12313','12302','12344','12327');

	    if($home->t21){
	        array_unshift($xttj, $home->t21);
	    }
	    if($home->t20){
	        array_unshift($xttj, $home->t20);
	    }
	    if($home->t19){
	        array_unshift($xttj, $home->t19);
	    }
	    if($home->t18){
	        array_unshift($xttj, $home->t18);
	    }
	    //新闻最新10条
	    $criteria=new CDbCriteria;
	    $criteria->condition = " 1 ";
	    $criteria->limit = 10;
	    $criteria->order='id desc';
	    $newsLastTen = Zixun::model()->findAll($criteria);

		$this->render('index', array('home'=>$home, 'mygames'=>$mygames, 'xttj'=>$xttj, 'newsLastTen'=>$newsLastTen));
	}

	public function actionList(){

	    $this->pageTitle = 'h5网游网游推荐,手机页游,最新好玩的在线网游-'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台';
	    $this->keywords = 'h5网游推荐游戏,手机页游,好玩的h5手游,最新h5手游,h5游戏大全';
	    $this->description = ($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台,h5手游网游推荐频道提供最新最好玩的html5在线网游,html5手机游戏,多人在线游戏等信息,h5手游,好玩的h5网游。找h5微游戏,h5游戏大全,h5游戏排行榜就上'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台';

	    $confWyou = Conf::model()->findByPk(1);
	    $gamesId = explode(',', $confWyou->content);

	    //$games1 = Games::model()->findAllByAttributes(array('id'=>$gamesId));

	    $confWyou2 = Conf::model()->findByPk(2);
	    $gamesId2 = explode(',', $confWyou2->content);

	    //$games2 = Games::model()->findAllByAttributes(array('id'=>$gamesId2));
	    $this->render('list', array(
	        //'games1'=>$games1,'games2'=>$games2
	        'gamesId'=>$gamesId,
	        'gamesId2'=>$gamesId2
	    ));
	}

	public function actionDanji(){
	    $this->pageTitle = 'h5单机推荐,手机页游,最新好玩的在线单机-'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台';
	    $this->keywords = 'h5单机推荐游戏,手机页游,好玩的h5手游,最新h5手游,h5游戏大全';
	    $this->description = ($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台,h5手游单机推荐频道提供最新最好玩的html5在线单机,html5手机游戏,多人在线游戏等信息,h5手游,好玩的h5单机。找h5微游戏,h5游戏大全,h5游戏排行榜就上'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台';

	    $confWyou = Conf::model()->findByPk(5);
	    $gamesId = explode(',', $confWyou->content);

	    //$games1 = Games::model()->findAllByAttributes(array('id'=>$gamesId));

	    $confWyou2 = Conf::model()->findByPk(6);
	    $gamesId2 = explode(',', $confWyou2->content);

	    //$games2 = Games::model()->findAllByAttributes(array('id'=>$gamesId2));
	    $this->render('list', array(
	        //'games1'=>$games1,'games2'=>$games2
	        'danji'=>1,
	        'gamesId'=>$gamesId,
	        'gamesId2'=>$gamesId2
	    ));
	}
	public function actionZixun(){
	    $type = '游戏新闻';
	    if(isset($_GET['type'])){
	        $type = '游戏攻略';
	    }
	    $this->pageTitle = 'h5游戏资讯,手机页游,手机页游攻略-'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台';
	    $this->keywords = 'h5游戏资讯,最新h5游戏新闻,h5游戏攻略,h5游戏活动,h5游戏公告';
	    $this->description = ($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台,h5手游频道提供最新最好玩的html5在线网游,html5手机游戏,多人在线游戏等信息,h5手游,好玩的h5网游。找h5微游戏,h5游戏大全,h5游戏排行榜就上'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台。';
	    $page = 0;
	    if(isset($_GET['page'])){
	        $page = $_GET['page'] - 1;
	    }
	    $criteria=new CDbCriteria;
	    $criteria->condition = " type = '$type' ";
	    $criteria->order='id desc';
	    $gameNews = Zixun::model()->findAll($criteria);
	    $this->render('zixun',array('gameNews'=>$gameNews, 'type'=>$type, 'page'=>$page));
	}
	public function actionZhuanti(){
	    $this->render('zhuanti');
	}
	public function actionGames(){

	    $this->pageTitle = '最新h5网游,手机页游,最新好玩的在线网游-'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台';
	    $this->keywords = '最新h5游戏,手机页游,好玩的h5手游,最新h5手游,h5游戏大全';
	    $this->description = ($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台,h5手游频道提供最新html5在线网游,html5手机游戏,多人在线游戏等信息,h5手游,好玩的h5网游。找h5微游戏,h5游戏大全,h5游戏排行榜就上'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台';

	    $criteria=new CDbCriteria;
	    $criteria->limit = 300;
	    $criteria->order='id desc';
	    $gamesId = array();
	    if(isset($_GET['type'])){
	        $confWyou = Conf::model()->findByPk(4);
	        $gamesId = explode(',', $confWyou->content);
	        $this->pageTitle = '最热h5网游,手机页游,最新好玩的在线网游-'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台';
    	    $this->keywords = '最热h5游戏,手机页游,好玩的h5手游,最新h5手游,h5游戏大全';
    	    $this->description = ($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台,h5手游频道提供最热html5在线网游,html5手机游戏,多人在线游戏等信息,h5手游,好玩的h5网游。找h5微游戏,h5游戏大全,h5游戏排行榜就上'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台';

	    }
	    $games1 = Games::model()->findAll($criteria);

	    $this->render('games', array('games1'=>$games1, 'gamesId'=>$gamesId));
	}
	public function actionLibao(){
	    $this->pageTitle = 'h5游戏礼包,h5游戏激活码,手机页游福利-'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台';
	    $this->keywords = 'h5游戏礼包,h5游戏激活码,h5游戏福利,h5游戏兑换码,h5游戏新手礼包';
	    $this->description = ($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台,h5手游频道提供最新最好玩的html5在线网游,h5游戏礼包,h5游戏激活码,h5游戏福利。找h5游戏兑换码,h5游戏新手礼包就上'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台。';
	    $criteria=new CDbCriteria;
	    $criteria->order='id desc';
	    if(isset($_GET['skey']) && trim($_GET['skey']) ){
	        $search = trim($_GET['skey']);
	        $criteria->addSearchCondition('title', $search);
	    }
	    $libaos = Libao::model()->findAll($criteria);

	    $this->render('libao', array(
	        'libaos'=>$libaos
	    ));
	}
    public function actionShop(){
        $this->pageTitle = 'h5游戏商城,手机页游,手机页游福利-'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台';
        $this->pageTitle = 'h5游戏商城,最新h5游戏奖品,h5游戏福利,h5游戏活动';
        $this->pageTitle = ($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台,h5手游频道提供最新最好玩的html5在线网游,html5手机游戏,多人在线游戏等信息,h5手游,好玩的h5网游。找h5微游戏,h5游戏大全,h5游戏排行榜就上'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台。';
        $this->render('shop');
    }
	public function actionGamedetail($id){
	    $gm = Games::model()->findByPk($id);
	    if(!$gm){
	        echo "";exit;
	        $gm = new Games();
	    }
	    $name = $gm->name;
	    if($gm->from == 2){
	        $this->pageTitle = "{$name}_{$name}H5小游戏|攻略|电脑版|微端下载_".($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈')."游戏";
	        $this->keywords = "{$name},{$name}电脑版,{$name}h5游戏,{$name}攻略,{$name}微端";
	        $this->description = ($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈')."游戏平台{$name}小游戏，{$name}在线玩,{$name}h5版,{$name}电脑版,找{$name}攻略,玩法等,{$name}微端下载,就上".($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈')."游戏平台";
	    }else{
	       $this->pageTitle = "{$name}官网_{$name}游戏攻略|激活码|礼包_".($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈')."H5游戏";
	    	$this->keywords = "{$name},{$name}网页游戏,{$name}h5游戏,{$name}攻略,{$name}礼包";
	    	$this->description = ($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈')."H5{$name}小游戏，{$name}在线玩,{$name}h5版,{$name}网页版,找{$name}攻略,玩法等,{$name}激活码,{$name}礼包就上".($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈')."H5游戏平台";

	    }
	    $criteria=new CDbCriteria;
	    $criteria->limit = 8;
	    $criteria->order='RAND()';
	    $criteria->condition = "`type` = '$gm->type'  and id != $gm->id ";
	    $same = Games::model()->findAll($criteria);

	    //$gameNews
	    //$gameGongnues

	    $criteria = new CDbCriteria();
	    $criteria->order = 'id desc';

	    $gameNews = Zixun::model()->findAllByAttributes(array(
	        'type'=>'游戏新闻',
	        'gameid'=>$gm->id,
	    ), $criteria);
	    $criteria = new CDbCriteria();
	    $criteria->order = 'id desc';
	    $gameGongnues = Zixun::model()->findAllByAttributes(array(
	        'type'=>'游戏攻略',
	        'gameid'=>$gm->id,
	    ), $criteria);

        $criteria=new CDbCriteria;
        $criteria->order='id desc';
        $criteria->condition = "gameid = '$gm->id' ";
        $libaos = Libao::model()->findAll($criteria);

	    $this->render('gamedetail',
	        array('gm'=>$gm,
	            'same'=>$same,
	            'gameNews'=>$gameNews,
	            'libaos'=>$libaos,
	            'gameGongnues'=>$gameGongnues
	        )
	    );
	}
	public function actionPlay($id){

	    $gm = Games::model()->findByPk($id);
	    if(!$gm){
	        $gm = new Games();
	    }

	    if($gm->from == 2){
	        //单机
	        $hot = GamesHots::model()->findByAttributes(array('gameid'=>$id));
	        if($hot){
	            $hot->hots += rand(1, 9);
	            $hot->save();
	        }else{
	            $hot = new GamesHots();
	            $hot->gameid = $id;
	            $hot->hots =  rand(1, 9);
	            $hot->save();
	        }
/* 	        echo $gm->enter;exit; */
//	        if(!preg_match('/www/', $gm->enter)){
//		        $gm->enter = str_replace('//', '//www.', $gm->enter);
//	        }

	        $this->redirect($gm->enter);exit;
	    }else{
    	    if(!Yii::app()->session['user_id']){
    	        Yii::app()->session['backto'] = $id;
    	    }

    	    $this->checkLogin();

    	    $user_id = Yii::app()->session['user_id'];

    	    $userGame = new UserGame();
    	    $userGame->gameid = $gm->id;
    	    $userGame->userid = $user_id;
    	    $userGame->save();

    	    $hot = GamesHots::model()->findByAttributes(array('gameid'=>$id));
    	    if($hot){
    	        $hot->hots += rand(1, 9);
    	        $hot->save();
    	    }else{
    	        $hot = new GamesHots();
    	        $hot->gameid = $id;
    	        $hot->hots =  rand(1, 9);
    	        $hot->save();
    	    }
    	    if(in_array($gm->name, array('全民战神', '天天花千骨','花千骨', '暴走大乱逗','奇迹挂机','神战三国'))){
		        $userId = $user_id;
		        $user = Users::model()->findByPk($userId);
		        $userName = $user->user_nicename;
		        $time = time();
		        $secret = "69ab069c3a16ea5b962faa42b073bb2d";
		        $sign = md5($secret . $time . $userId);
		        $data = "&userId=$userId&userName=$userName&time=$time&sign=$sign";
		        $data .="&userSex=男&channelExt=$userId&userImg=".urlencode('http://h5.91yxq.com/img/default_pic.png');
		        if($gm->name == '全民战神'){
		           $url = 'http://open.juhesdk.twan.cn/game.php?url_flag=10_64'.$data;
		        }elseif($gm->name == '天天花千骨'){
		            $url = 'http://open.juhesdk.twan.cn/game.php?url_flag=8_64'.$data;
		        }elseif($gm->name == '花千骨'){
		            $url = 'http://open.juhesdk.twan.cn/game.php?url_flag=9_64'.$data;
		        }elseif($gm->name == '暴走大乱逗'){
		            $url = 'http://open.juhesdk.twan.cn/game.php?url_flag=14_64'.$data;
		        }elseif($gm->name == '奇迹挂机'){
		            $url = 'http://open.juhesdk.twan.cn/game.php?url_flag=31_64'.$data;
		        }elseif($gm->name == '神战三国'){
		            $url = 'http://open.juhesdk.twan.cn/game.php?url_flag=32_64'.$data;
		        }
		        $this->redirect($url);exit;
		    }
    	    $gameUrl = $this->gameUrl($gm->game_egret_id, $user_id);
    	    $this->redirect($gameUrl);exit;
	    }
	}
	function checkLogin(){
	    if(!Yii::app()->session['user_id']){
	        $this->redirect(array('user/login'));exit;
	    }
	}

	function actionNewsdetail($id){
	    $news = Zixun::model()->findByPk($id);
	    $gm = Games::model()->findByPk($news->gameid);
	    $this->pageTitle =$news->title . '-'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台';//. ',h5游戏资讯,手机页游,手机页游攻略-91游戏圈游戏平台';
	    $this->keywords = $news->keywords ;//. ',h5游戏资讯,最新h5游戏新闻,h5游戏攻略,h5游戏活动,h5游戏公告';
	    $this->description =$news->description;// . ',91游戏圈游戏平台,h5手游频道提供最新最好玩的html5在线网游,html5手机游戏,多人在线游戏等信息,h5手游,好玩的h5网游。找h5微游戏,h5游戏大全,h5游戏排行榜就上91游戏圈游戏平台。';

	    $criteria=new CDbCriteria;
	    $criteria->limit = 5;
	    $criteria->order='RAND()';
	    $criteria->condition = "`gameid` = {$gm->id} and id != {$news->id} ";
	    $gameNews = Zixun::model()->findAll($criteria);

	    $criteria=new CDbCriteria;
	    $criteria->limit = 4;
	    $criteria->order='RAND()';
	    $criteria->condition = "`type` = '$gm->type' and id != $gm->id ";
	    $same = Games::model()->findAll($criteria);

	    $this->render('newsdetail',
	        array('news'=>$news,
	            'gm'=>$gm,
	            'gameNews'=>$gameNews,
	            'same'=>$same
	        )
	    );
	}

	public function actionType($t){
	    $from = 1;
	    $typeArr = Yii::app()->params['wangyoufenlei'];
	    if(isset($_GET['danji'])){
	        $from = 2;
	        $typeArr = Yii::app()->params['danjifenlei'];
	    }
// 	    var_dump($t);exit;
	    $t = $typeArr[$t]['name'];

	    $this->pageTitle = 'h5网游,手机页游,最新好玩的'.$t.'在线网游-'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台';
	    $this->keywords = 'h5'.$t.'游戏,手机页游,好玩的h5手游,最新h5手游,h5游戏大全';
	    $this->description = ($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台,h5手游频道提供最新最好玩的'.$t.'html5在线网游,html5手机游戏,多人在线游戏等信息,h5手游,好玩的h5网游。找h5微游戏,h5游戏大全,h5游戏排行榜就上'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台';
		$criteria=new CDbCriteria;
	    $criteria->condition = "`type` = '$t' and `from`= $from ";
	    $criteria->order='id desc';
	    $games = Games::model()->findAll($criteria);

	    $this->render('type',array(
	        'type'=>$t,
	        'games'=>$games,
	        'danji'=>$from
	    ));
	}

	public function actionGamesfl(){
	    $type = '网游';
	    $danji = 0;
	    if(isset($_GET['type']) && $_GET['type'] == 2){
	        $type = '单机';
	        $danji = 2;
	    }
	    $this->pageTitle = 'h5'.$type.'分类,手机页游,最新好玩的在线网游-'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台';
	    $this->keywords = 'h5分类游戏,手机页游,好玩的h5手游,最新h5手游,h5游戏大全';
	    $this->description = ($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏平台,提供最新最好玩的html5在线游戏,手机在线小游戏,h5游戏,h5小游戏,手机网页游戏。找在线小游戏,手机小游戏就上'.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'h5游戏平台';


	    $this->render('gamesfl', array('type'=>$type,'danji'=>$danji));
	}

	public function actionSearch(){
	    $keyword = $_GET['keyword'];
	    $criteria=new CDbCriteria;
	    $criteria->addSearchCondition('name', $keyword);
	    $games = Games::model()->findAll($criteria);
	    $this->render('search', array('games'=>$games));
	}

	public function actionGamezixun($gid, $type){
	    if($type == 1){
	        $type = '游戏新闻';
	    }else{
	        $type = '游戏攻略';
	    }
	    $gm = Games::model()->findByPk($gid);
	    if(!$gm){
	        $gm = new Games();
	    }
	    $name = $gm->name;
	    $this->pageTitle = "{$name}{$type}_{$name}游戏在线玩_".($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈')."游戏";
	    $this->keywords = "{$name},{$name}游戏,{$name}h5游戏,{$name}{$type},{$name}在线玩";
	    $this->description = ($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈')."{$name}小游戏，{$name}在线玩,{$name}h5版,{$name}网页版,找{$name}攻略,玩法等,{$name}激活码,{$name}就上".($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈')."游戏平台";
	    $criteria=new CDbCriteria;
	    $criteria->condition = " type = '$type' and gameid = '$gid' ";
	    $criteria->order='id desc';
	    $gameNews = Zixun::model()->findAll($criteria);
	    $this->render('gamezixun',array(
	        'gameNews'=>$gameNews,
	        'gm'=>$gm,
	        'gid'=>$gid,
	        'type'=>$type));
	}

	public function actionLibaodetail($id){
	    $libao = Libao::model()->findByPk($id);
	    $game = Games::model()->findByPk($libao->gameid);

	    $this->pageTitle = "{$libao->title}_".($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈')."游戏发号_".($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈')."游戏平台";
	    $this->keywords = "{$game->name},{$game->name}礼包,{$game->name}新手卡,{$game->name}激活码,{$game->name}独家礼包,".($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈')."游戏发号";
	    $this->description = ($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈')."游戏发号免费发放{$game->name}礼包,{$game->name}新手卡,{$game->name}激活码,最新最全{$game->name}游戏账号资源尽在".($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈')."游戏发号";

	    $this->render('libaodetail',
	        array('libao'=>$libao)
	    );
	}

	public function actionLibaoget(){
	    if(Yii::app()->session['user_id'] && Yii::app()->request->isPostRequest){
	        $user_id = Yii::app()->session['user_id'];
	        $libaoid = $_POST['libaoid'];
// 	        var_dump($libaoid);exit;
	        $key = '';
            $has = LibaoDetail::model()->findByAttributes(array(
                'libaoid'=>$libaoid,
                'userid'=>$user_id
            ));
            if($has){
                $key = $has->key;
            }else{
                $use = LibaoDetail::model()->findByAttributes(array(
                    'libaoid'=>$libaoid,
                    'userid'=>0
                ));
                if($use){
                    $use->userid = $user_id;
                    $use->save();
                    $key = $use->key;
                }
            }
            echo $key;
            exit;
	    }
	    echo "ee";
	}
}
