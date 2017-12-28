<?php
require_once(Yii::getPathOfAlias('extensions').'/qiniu/autoload.php');
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Qiniu\Config;
use Qiniu\Storage\BucketManager;
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout='//layouts/column1';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu=array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();

    public $youqing = '';

    public $logincss = false;
    public $keywords = 'h5游戏';
    public $description = 'h5游戏 91游戏圈游戏';

    public $appid = '20437';
    public $appkey = 'NUmj6F72ffkRsqyifZXAW';
    //构造
    public function init() {
        parent::init();
        $this->description = 'h5游戏 '.($_SERVER['HTTP_HOST']=='www.81900.com'?'81900':'91游戏圈').'游戏';

        require_once(__DIR__.'/../helpers/base.php');
        require_once(__DIR__.'/../helpers/project.php');
    }

    public function uploadFile($allowExt=array("gif","jpeg","png","jpg","wbmp"), $maxSize=2097152, $imgFlag=true, $oldImg, $from){
        // 构建鉴权对象
        $auth = new Auth(QINIU_ACCESS_KEY, QINIU_SECRET_KEY);
        $config = new Config();
        $bucketManager = new BucketManager($auth, $config);
        // 生成上传 Token
        $token = $auth->uploadToken(QINIU_BUCKET);
        $files = $this->buildInfo();
        if(!($files && is_array($files))){
            return ;
        }
        foreach($files as $file){
            if($file['error'] === UPLOAD_ERR_OK){//就是0
                $ext = $this->getExt($file['name']);

                //检测文件的扩展名
                if(!in_array($ext,$allowExt)){
                    exit("<script>alert('非法文件类型')</script>");
                }

                //校验是否是一个真正的图片类型
                if($imgFlag){
                    if(!getimagesize($file['tmp_name'])){
                        exit("<script>alert('不是真正的图片类型')</script>");
                    }else{
                        //把文件信息付给$file 传到前台返回时数组
                        //如 [720, 1280, 2, "width="720" height="1280"", 8, 3, "image/jpeg"]
                        $file["filesize"] = getimagesize($file['tmp_name']);
                        if ($from == 'icon' && ($file["filesize"][0] != 100 || $file["filesize"][1] != 100)) {
                            exit("<script>alert('图片尺寸必须为100x100像素')</script>");
                        }
                        if ($from == 'game_picture' && ($file["filesize"][0] != 400 || $file["filesize"][1] != 600)) {
                            exit("<script>alert('图片尺寸必须为400x600像素')</script>");
                        }
                    }
                }
                //上传文件的大小
                if($file['size'] > $maxSize){
                    exit("<script>alert('上传文件过大')</script>");
                }
                if(!is_uploaded_file($file['tmp_name'])){
                    exit("<script>alert('不是通过HTTP POST方式上传上来的')</script>");
                }
                $filename = $this->getUniName().".".$ext;//改文件重新命名
                $destination = "h5/" . $filename;

                // 初始化 UploadManager 对象并进行文件的上传。
                $uploadMgr = new UploadManager();

                // 调用 UploadManager 的 putFile 方法进行文件的上传。
                list($ret, $err) = $uploadMgr->putFile($token, $destination, $file['tmp_name']);
                if ($err !== null) {
                    exit("<script>alert('上传失败')</script>");
                } else {
                    if (!in_array(basename($oldImg), array('default_img.jpg', 'default_icon.png'))) {
                        $bucketManager->delete(QINIU_BUCKET, 'h5/' . basename($oldImg));
                    }
                    $file['name'] = $filename;
                    $file['path_name'] = QINIU_RES_URL . $destination;
                    unset($file['tmp_name'],$file['size'],$file['type']);//去除不需要传给的信息
                }
            }else{
                switch($file['error']){
                    case 1:
                        $mes = "超过了配置文件上传文件的大小";break;
                    case 2:
                        $mes = "超过了表单设置上传文件的大小";break;
                    case 3:
                        $mes = "文件部分被上传";break;
                    case 4:
                        $mes = "没有文件被上传1111";break;
                    case 6:
                        $mes = "没有找到临时目录";break;
                    case 7:
                        $mes = "文件不可写";break;
                    case 8:
                        $mes = "由于PHP的扩展程序中断了文件上传";break;
                }
                exit("<script>alert('" . $mes . "')</script>");
            }
        }
        return $file;
    }

    /**
     * 生成唯一字符串
     * @return string
     */
    private function getUniName(){
        return md5(uniqid(microtime(true),true));
    }

    /**
     * 得到文件的扩展名
     * @param string $filename
     * @return string
     */
    private function getExt($filename){
        $arr = explode(".", $filename);
        $ext = strtolower(end($arr));
        return $ext;
    }

    /**
     * 构建上传文件信息
     * @return array
     */
    private function buildInfo(){
        if(!$_FILES){
            return ;
        }
        $i=0;
        foreach($_FILES as $v){
            //单文件
            if(is_string($v['name'])){
                $files[$i]=$v;
                $i++;
            }else{
                //多文件
                foreach($v['name'] as $key=>$val){
                    $files[$i]['name']=$val;
                    $files[$i]['size']=$v['size'][$key];
                    $files[$i]['tmp_name']=$v['tmp_name'][$key];
                    $files[$i]['error']=$v['error'][$key];
                    $files[$i]['type']=$v['type'][$key];
                    $i++;
                }
            }
        }

        return $files;
    }

    public function getGamelist(){
        $json = $this->page('http://api.open.egret.com/Channel.gameList?app_id=20437');
        return json_decode($json);
    }
    public function page($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_NOBODY, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        $timeout=5;
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $return = curl_exec($ch);
        if(curl_errno($ch)){
            var_dump(curl_errno($ch));
            echo "ERROR";
        }
        $status = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        curl_close($ch);
        if('404' == $status){
            return "";
        }
        return $return;
    }

    /**
     * 生成游戏链接
     * @param unknown $gameid
     * @param unknown $userId
     * @return string
     */
    public function gameUrl($gameid, $userId){
        $time = time();
        $game = 'http://api.egret-labs.org/v2/game/20437/'.$gameid;
        $params = array(
            'appId'=>$this->appid,
            'userId'=>$userId,
            'time' => $time
        );
        $canshu = '';
        foreach ($params as $key => $value) {
            if($key=='appId'){
                continue;
            }
            $canshu .="$key=$value&";
        }
        $sign = $this->createSign($params, $this->appkey);
        return $game.'?'.$canshu.'sign='.$sign;
    }

    public function createSign($params, $appkey){
        ksort($params);
        $str  = "";
        foreach($params as $key=>$value){
            $str  .=  $key ."=". $value;
        }
        return md5($str.$appkey);
    }
    public function getGameIcon($id){
        $game = Games::model()->findByPk($id);
        return $game->icon;
    }
    public function PrintGameType1($id){
        $game = Games::model()->findByPk($id);
        $result = '';
        if($game){
            $hot = $this->gamehots($id);
            $detailLink = '/games/' . $game->id.'/';// $this->createUrl('index/gamedetail',array('id'=>$game->id));
            $result = "
                        <a href='$detailLink' >
                        <p class='p1'>
                        <img src='{$game->icon}' alt=\"{$game->name}\" title=\"$game->name\" />
                        </p>
                        <p class='p2'>
                        <i>{$game->name}</i>
                        <em>
                        <img src='/static/star_1.png'>
                        <img src='/static/star_1.png'>
                        <img src='/static/star_1.png'>
                        <img src='/static/star_1.png'>
                        <img src='/static/star_2.png'>
                        </em>
                        <span>
                        人气：{$hot}
                        <strong>{$game->desc}</strong>
                        </span>
                        </p>
                        <p class='p3'><span>开始玩</span></p>
                        </a>";
        }
        return $result;
    }


    public function PrintGameType2($id){
        $game = Games::model()->findByPk($id);
        $result = '';
        if($game){
            $discount = sprintf("%.1f", $game->discount * 10);
            $detailLink = '/games/' . $game->id.'/';//$this->createUrl('index/gamedetail',array('id'=>$game->id));
            if ($discount == 10.0) {
                $result = "
            <div class='a_in'>
                <a href='$detailLink' >
                <img src='{$game->icon}'  alt=\"{$game->name}\" title=\"$game->name\" />
                <p><span>{$game->name}</span><em>开始玩</em></p></a>
              </div>";
            } else {
                $result = "
            <div class='a_in'>
                <div class='hron'></div>
                <a href='$detailLink' >
                <img src='{$game->icon}'  alt=\"{$game->name}\" title=\"$game->name\" />
                <p><span>{$game->name}</span><em>开始玩</em></p></a>
                <div class='sale'>{$discount}折</div>
              </div>";
            }
        }
        return $result;
    }

    public function PrintGameType3($id){
        $game = Games::model()->findByPk($id);
        $result = '';
        if($game){
            $hot = $this->gamehots($id);
            $detailLink = '/games/' . $game->id.'/';//$this->createUrl('index/gamedetail',array('id'=>$game->id));
            $result = "
            <a href='$detailLink'>
            <p class='p1'><img src='{$game->icon}'  alt=\"{$game->name}\" title=\"$game->name\" /></p>
            <p class='p2'>
            <i>
            <b class='game_name'>{$game->name}</b>
            </i>
            <em><img src='/static/star_1.png'><img src='/static/star_1.png'><img src='/static/star_1.png'><img src='/static/star_1.png'><img src='/static/star_2.png'></em>
            <span>{$game->type}&nbsp;&nbsp;&nbsp;人气：{$hot}</span>
            </p>
            <p class='p3'><span>开始玩</span></p>
            </a>";
        }
        return $result;
    }

    public function PrintGameType4($id){
        $game = Games::model()->findByPk($id);
        $result = '';
        if($game){
            $detailLink = '/games/' . $game->id.'/';//$this->createUrl('index/gamedetail',array('id'=>$game->id));
            $result = "
           <div class='myitem'>
                <a href='$detailLink'>
                <img src='{$game->icon}'  alt=\"{$game->name}\" title=\"$game->name\" />
                <span class='myname'>{$game->name}</span></a>
            </div>";
        }
        return $result;
    }

    public function PrintGameType5($id){
        $game = Games::model()->findByPk($id);
        $result = '';
        if($game){
            $discount = sprintf("%.1f", $game->discount * 10);
            $detailLink = '/games/' . $game->id.'/';//$this->createUrl('index/gamedetail',array('id'=>$game->id));
            if ($discount == 10.0) {
                $result = "
           <div class='myitem foritem4'>
           <a href='$detailLink'>
           <img src='{$game->icon}'  alt=\"{$game->name}\" title=\"$game->name\">
           <span class='myname'>{$game->name}</span>
           <div class='swan'>开始玩</div>
           </a>
           </div>";
            } else {
                $result = "
           <div class='myitem foritem4'>
           <div class='hron'></div>
           <a href='$detailLink'>
           <img src='{$game->icon}'  alt=\"{$game->name}\" title=\"$game->name\">
           <span class='myname'>{$game->name}</span>
           <div class='swan'>开始玩</div>
           </a>
           <div class='sale'>{$discount}折</div>
           </div>";
            }
        }
        return $result;
    }
    public function PrintGameType6($id){
        $game = Games::model()->findByPk($id);
        $result = '';
        if($game){
            $detailLink = '/games/' . $game->id.'/';//$this->createUrl('index/gamedetail',array('id'=>$game->id));
            $result = "
           <div class='myitem foritem4'>
           <a href='$detailLink'>
           <img src='{$game->icon}'  alt=\"{$game->name}\" title=\"$game->name\">
           <span class='myname'>{$game->name}</span>
           </a>
           </div>";
        }
        return $result;
    }
    public function isCollection($gmid){
        if(Yii::app()->session['user_login']){
            $user = Users::model()->findByPk(Yii::app()->session['user_id']);
            $userC = UserCollection::model()->findByAttributes(array(
                'gameid' => $gmid,
                'userid' => $user->id
            ));
            return $userC;
        }
        return false;
    }

    function postdata($url,$data,$timeout=10)
    {
        global $app;

        $ch = curl_init ();

        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $return = curl_exec($ch);

        if(curl_errno($ch))
            return "";

        curl_close ($ch);

        return $return;
    }


    function gamehots($gid){
        $hot = GamesHots::model()->findByAttributes(array('gameid'=>$gid));
        if($hot){
            return $hot->hots;
        }
        return 0;
    }
    public function getUploadFile($is_file, $postname, $i){
        $file = CUploadedFile::getInstanceByName($is_file);
        if (is_object($file))
        {
            $type = preg_replace('/.*?\//', '', $file->type);
            $filenameT = Yii::app()->basePath .'/..'.'/upload/'.$postname.'/';
            if (!file_exists($filenameT)) {
                mkdir($filenameT, 0777);
            }
            $filename = $filenameT.$i.'.'.$type;
            $file->saveAs($filename);

//	        $smallfilename = $filename;
//            try {
//                //缩略图
//                $smallfilename = $filenameT.'_small.'.$type;
//                $smallFullFilePath = Yii::app()->basePath.'/..'.$smallfilename;
//                $resize = new resize();
//                $resizeimage = $resize->resizeimage($finalFileName, "140", "140", "1",$smallFullFilePath);
//            } catch (Exception $e) {
//
//            }
            return array(
                'big' => '/upload/'.$postname.'/'.$i.'.'.$type,
//                'small'=>$smallfilename
            );
        }
        return false;
    }

    //判断是否是普通管理员
    protected function isNormalAdmin()
    {
        if (isset(Yii::app()->session['admin_id']))
            return true;
        $this->redirect(array('/backend/site/login'));
    }

    //判断是否是超级管理员
    protected function isSuperAdmin()
    {
        if (isset(Yii::app()->session['super_admin']))
            return true;
        $this->redirect(array('/admin/houtai/login'));
    }

}
