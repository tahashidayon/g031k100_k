<h2>掲示板</h2>
<?php
		
	//debug($data);
	
	echo $this->Html->link('投稿する', array('controller' => 'Boards', 'action' => 'create'));
	echo $this->Html->tag('br');

	foreach ($data as $key => $value) {
		if(!empty($value["Board"]["comment"])){
			echo $value["Board"]["id"].' ';
			echo $value["Board"]["comment"].' ';
			echo $value["Board"]["timestamp"].' ';
			echo $this->Html->link('編集', array(
					'action' => 'edit', 
					$value["Board"]["id"]
				)).' ';
			echo $this->Html->link('削除', array(
					'action' => 'del', 
					$value["Board"]["id"]
				));
			echo $this->Html->tag('br');

		}
	}

?>