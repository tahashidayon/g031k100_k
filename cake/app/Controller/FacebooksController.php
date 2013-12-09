<?php
//facebook認証
App::import('Vendor','facebook',array('file' => 'facebook'.DS.'src'.DS.'facebook.php'));
 
class FacebooksController extends AppController {
    public $name = 'Facebooks';
    public $uses = array('NewUser'); //Userモデルを追加
    public $components = array(
            'DebugKit.Toolbar', //デバッグきっと
            'TwitterKit.Twitter', //twitter
            'Auth' => array( //ログイン機能を利用する
                'authenticate' => array(
                    'Form' => array(
                        'userModel' => 'User'
                    )
                ),
                //ログイン後の移動先
                'loginRedirect' => array('controller' => 'Boards', 'action' => 'index'),
                //ログアウト後の移動先
                'logoutRedirect' => array('controller' => 'Boards', 'action' => 'logout'),
                //ログインページのパス
                'loginAction' => array('controller' => 'Boards', 'action' => 'index'),
                //未ログイン時のメッセージ
                'authError' => 'あなたのお名前とパスワードを入力して下さい。',
            )
        );
 
    function index(){}

    public function beforeFilter(){//login処理の設定
            $this->Auth->allow('index', 'facebook', 'fbpost', 'createFacebook');
            $this->set('user',$this->Auth->user('NewUser')); // ctpで$userを使えるようにする 。
        }
 
    function showdata(){//トップページ
        $facebook = $this->createFacebook(); //セッション切れ対策 (?)
        $myFbData = $this->Session->read('mydata');//facebookのデータ
        pr($myFbData);//表示
    }
 
    public function facebook(){//facebookの認証処理部分
        $this->autoRender = false;
        $this->facebook = $this->createFacebook();
        $user = $this->facebook->getUser();//ユーザ情報取得
        if($user){//認証後
            $me = $this->facebook->api('/me','GET',array('locale'=>'ja_JP'));//ユーザ情報を日本語で取得
            $this->Session->write('mydata',$me);//fbデータをセッションに保存
            
            $data = $this->NewUser->fbsignin($this->Session->read('mydata'));
            if ($this->Auth->login($data))
                return $this->redirect($this->Auth->redirect());
            
        }else{//認証前
            $url = $this->facebook->getLoginUrl(array(
            'scope' => 'email,publish_stream,user_birthday'
            ,'canvas' => 1,'fbconnect' => 0));
            $this->redirect($url);
        }
    }
 
    private function createFacebook() {//appID, secretを記述
        return new Facebook(array(
            'appId' => '220786531426541',
            'secret' => '7a461902fb632b36711c361ac3dcaa5a'
        ));
    }
 
    public function fbpost($postData) {//facebookのwallにpostする処理
        $facebook = $this->createFacebook();
        $attachment = array(
            'access_token' => $facebook->getAccessToken(), //access_token入手
            'message' => $postData,
            'name' => "test",
            'link' => "http://twitter.com/JDAMI_szn",
            'description' => "test",
        );
        $facebook->api('/me/feed', 'POST', $attachment);
    }
}
?>




