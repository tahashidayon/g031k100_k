<?php
class BoardsController extends AppController {
    public $name = 'Boards';
    public $uses = array('Board','User');
    //public $layout = "board_layout";
    
/****認証周り*****/
    public $components = array(
            'DebugKit.Toolbar', //デバッグきっと
            'Auth' => array( //ログイン機能を利用する
                'authenticate' => array(
                    'Form' => array(
                        'userModel' => 'User',
                        'fields' => array('username' => 'name','password' => 'password','user_id'=>'id')
                    )
                ),
                //ログイン後の移動先
                'loginRedirect' => array('controller' => 'Boards', 'action' => 'index'),
                //ログアウト後の移動先
                'logoutRedirect' => array('controller' => 'Boards', 'action' => 'login'),
                //ログインページのパス
                'loginAction' => array('controller' => 'Boards', 'action' => 'login'),
                //未ログイン時のメッセージ
                'authError' => 'あなたのお名前とパスワードを入力して下さい。',
            )
        );
    public function login(){//ログイン
        if ($this->Auth->user()) {
            $this->redirect(array('action'=>'index'));
        }
            if($this->request->is('post')){//POST送信なら
                if($this->Auth->login()){//ログイン成功なら
                    //$this->Session->delete('Auth.redirect'); //前回ログアウト時のリンクを記録させない
                    return $this->redirect($this->Auth->redirect()); //Auth指定のログインページへ移動
                }else{ //ログイン失敗なら
                    $this->Session->setFlash(__('ユーザ名かパスワードが違います'), 'default', array(), 'auth');
                }
            }
        }
 
        public function logout(){
            $this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            $this->Session->setFlash(__('ログアウトしました'));
            $this->redirect(array('action' => 'login'));
        }
 
        public function useradd(){
            if ($this->Auth->user()) {
                $this->redirect(array('action'=>'index'));
            }
            //POST送信なら
            if($this->request->is('post')) {
                $this->User->set($this->request->data);
                if($this->User->validates()){
                    //パスワードとパスチェックの値をハッシュ値変換
                    $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
                    $this->request->data['User']['pass_check'] = AuthComponent::password($this->request->data['User']['pass_check']);
                    //入力したパスワートとパスワードチェックの値が一致
                    if($this->request->data['User']['pass_check'] === $this->request->data['User']['password']){

                        $this->User->create();//ユーザーの作成
                        $mes = ($this->User->save($this->request->data))? '新規ユーザーを追加しました' : '登録できませんでした。やり直して下さい';
                        $this->Session->setFlash(__($mes));
                        $this->redirect(array('action' => 'login'));
                    }else{
                        $this->Session->setFlash(__('パスワード確認の値が一致しません．'));
                    }
                    //リダイレクト   
                }
            }
        }

    public function twlogin(){

        //$this->redirect(array("action" => "index"));
    }
    public function beforeFilter(){//login処理の設定
             $this->Auth->allow('login','logout','useradd');//ログインしないで、アクセスできるアクションを登録する
             $this->set('user',$this->Auth->user()); // ctpで$userを使えるようにする 。
        }

    public function index(){
         if (!empty($this->request->data['Board']['word'])) {
            $word=$this->request->data['Board']['word'];
            $num=$this->request->data['Board']['num'];
            $condition=array("Board.comment LIKE"=>"%$word%");
            
            if (!empty($this->request->data['Board']['sort'])) {
                $sort=$this->request->data['Board']['sort'];

                if ($sort=='asc') {
                    $search=$this->Board->find('all',array('conditions'=>$condition,'limit'=>$num,'order'=>'Board.id ASC'));
                }elseif($sort=='desc'){
                    $search=$this->Board->find('all',array('conditions'=>$condition,'limit'=>$num,'order'=>'Board.id DESC'));
                }
            }else{
                $search=$this->Board->find('all',array('conditions'=>$condition,'limit'=>$num,'order'=>'Board.id DESC'));
            }
            $this->set('data',$search);
        }elseif(!empty($this->request->data['Board']['sort'])){
            $sort=$this->request->data['Board']['sort'];
            if ($sort=='asc') {
                $search=$this->Board->find('all',array('order'=>'Board.id ASC'));
            }elseif($sort=='desc'){
                $search=$this->Board->find('all',array('order'=>'Board.id DESC'));
            }
            $this->set('data',$search);
        }else{
            $this->set('data', $this->Board->find('all',array('order'=>'Board.id DESC')));
        }
    }
   

    public function edit($id){
        if(!empty($this->request->data)){//ポスト送信されたら
            $this->set('edit', $this->request->data);//ビューに値を受け渡す
        }else{
            $this->set("data", $this->Board->findById($id));
        }
    }

    public function del($id){
        $this->Board->del($this->Board->findById($id));

        $this->redirect(array("action" => "index"));
    }

    public function create(){
        if(!empty($this->request->data)){//ポスト送信されたら
            $com = $this->request->data;
            $this->set('com', $com);//ビューに値を受け渡す
        }
    
    }

    public function creatable(){
        var_dump($this->Auth->user('id'));
        //$check=$this->Auth->user('id');
        var_dump($this->request->data);
        // if (empty($check)) {
        //     $this->request->data['Board']['user_id']=$this->request->data['User']['id'];
        
        $this->request->data['Board']['user_id'] = $this->Auth->user('id');
        
        $this->Board->save($this->request->data);
        $this->redirect(array("action" => "index"));
    }
}
?>