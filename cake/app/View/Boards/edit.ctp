<h2>コメント編集画面</h2>
<?php
	if (!empty($data)) { // 最初の画面
		echo $this->Form->create() ;//フォーム開始

		echo $this->Form->text('comment', array("value" => $data["Board"]["comment"]));//テキストボックス
		echo $this->Form->hidden("id", array("value" => $data["Board"]["id"]));
		echo $this->Form->submit('送信');//送信ボタン
		echo $this->Form->end();//フォーム終了
	}else{
		echo $this->Form->create(array(
			'action' => 'creatable'
		)) ;//フォーム開始

		echo $this->Html->tag('h2',$edit["Board"]["comment"]);
		echo $this->Html->tag('br');

		echo $this->Form->hidden('comment', array("value" => $edit["Board"]["comment"]));//テキストボックス
		echo $this->Form->hidden("id", array("value" => $edit["Board"]["id"]));

		echo'この内容で投稿してもいいですか？';
		echo $this->Form->submit('送信');//送信ボタン
		echo $this->Form->end();//フォーム終了
	}
?>