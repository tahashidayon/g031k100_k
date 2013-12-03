<h2>ユーザー登録画面です</h2>
<?php
	echo $this->Form->create('user',array(
		'type'=>'post',
		'url'=>'show'
	));

	
	echo $this->form->input('user.myouji',array('label'=>'名字'));
	echo $this->form->input('user.namae',array('label'=>'名前'));


	echo '<br>性別<br><br>';
	echo $this->form->radio('user.gender',
		array('0'=>'男性','1'=>'女性'),
		array('legend'=>false,'value'=>'1')
	);


	echo '<br>学年<br>';
	echo $this->form->select('user.gread',
		array('1年'=>'1年','2年'=>'2年','3年'=>'3年','4年'=>'4年'),
		array('value'=>'2年'),
		array('label'=>'学年')
	);
	
	echo '<br><br>好きな食べ物<br>';
	echo $this->form->checkbox('user.fav1',array('value'=>'卵かけご飯','checked'=>true));
	echo $this->form->label('user.卵かけご飯');
	echo $this->form->checkbox('user.fav2',array('value'=>'お茶漬け','checked'=>false));
	echo $this->form->label('user.お茶漬け');
	echo $this->form->checkbox('user.fav3',array('value'=>'牛丼','checked'=>true));
	echo $this->form->label('user.牛丼');
	echo '<br><br>コメント<br>';
	echo $this->form->textarea('user.comment');

	echo '<br><br>パスワード<br>';
	echo $this->form->password('user.password');
	echo $this->form->hidden('user.time',array('value'=>date("h.i.s")));
	echo $this->Form->submit();
	echo $this->Form->end();
?>