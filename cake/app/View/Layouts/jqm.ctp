<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php echo $title_for_layout; ?></title>
		 <meta name="viewport" content="width=device-width,minimum-scale=1">
		 <link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
		 <script src="http://code.jquery.com/jquery-1.7.1.min.js"> </script>
		 <script type="text/javascript">
			 /* ajaxを無効にするための設定　*/
			 $(document).bind("mobileinit",function(){
			 $.mobile.ajaxEnabled=false;
			 $.mobile.pushStateEnabled=false;
			 });
		 </script>
		 <script type="text/javascript">
if (window.location.hash == '#_=_')window.location.hash = '';
</script>
		 <script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
	</head>
	<body>
	<div data-role="page" data-theme="a">

		
		 <div data-role="header" data-theme="a">
		 <h1>たはっしーの掲示板</h1>
		 
		 	<?php //echo $this->Html->link('Home',array('action'=>'index'),array('data-icon'=>'home','data-iconpos'=>'notext'));?>
		 </div><!-- /header -->

		 <div data-role="content">
		 	<?php echo $content_for_layout; ?>
		 </div><!-- /content -->

		 <div data-role="footer">
		 	<h4>g031k100</h4>
		 </div><!-- /footer -->

	</div><!-- /page -->
	</body>
</html>