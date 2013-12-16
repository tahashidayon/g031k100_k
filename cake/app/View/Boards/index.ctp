<h2>掲示板</h2>
<?php
	echo $this->Form->create() ;//フォーム開始
	echo $this->form->input('Board.word',array('label'=>'検索したい文字'));
	echo $this->form->input('Board.num',array('label'=>'検索件数'),array('value'=>'0'));
	echo $this->form->select('Board.sort',
		array('asc'=>'昇順','desc'=>'降順'),
		//array('value'=>'desc'),
		array('label'=>'Board.sort')
	);//テキストボックス
	echo $this->Form->submit('検索');//送信ボタン
	echo $this->Form->end();//フォーム終了


	echo $this->Html->link('ログアウト', array('controller' => 'Boards', 'action' => 'logout')).'//';
	echo $this->Html->link('投稿する', array('controller' => 'Boards', 'action' => 'create'));
	echo $this->Html->tag('br');

	foreach ($data as $key => $value) {
		if(!empty($value["Board"]["comment"])){
			echo $value["Board"]["id"].' : ';
			
			echo $value["User"]["name"].' ';	
			echo $value["User"]["email"].' ';
			if (!empty($user["id"])) {
					if ($value["Board"]["user_id"]==$user["id"]) {
						echo $this->Html->link('編集', array(
								'action' => 'edit', 
								$value["Board"]["id"]
							)).' ';
						echo $this->Html->link('削除', array(
								'action' => 'del', 
								$value["Board"]["id"]
							));
						echo $this->Html->tag('br');
					}else{
						echo $this->Html->tag('br');
					}
				}elseif(!empty($user["NewUser"]["tw_id"])){
					$value["User"]["id"]==$user["NewUser"]["tw_id"];
					echo $this->Html->tag('br');
				}

			echo $value["Board"]["created"].' : ';
			echo $value["Board"]["comment"].' <br>';
			
			echo $this->Html->tag('br');
		}
	}
	echo $this->Html->tag('br');
	
?>
