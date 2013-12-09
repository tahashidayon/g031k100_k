 
<div class="hero-unit">
    <?php echo $this->Session->flash('Auth'); ?>
    <?php echo $this->Form->create('User', array('url' => 'login')); ?>
    <?php echo $this->Form->input('User.name', array('label' => 'ユーザーネーム')); ?>
    <?php echo $this->Form->input('User.password', array('label' => 'パスワード')); ?>
    <?php echo $this->Form->end('ログイン'); ?>
   	<?php echo $this->Html->link('Twitterでログインする', array('controller' => 'Twitterlogins', 'action' => 'login'));?>
   	<?php echo $this->Html->link('Facebookでログインする', array('controller' => 'Facebooks', 'action' => 'Facebook'));?>
    <a href="useradd" id="switch" class="label btn-primary">新規登録</a>
</div>
