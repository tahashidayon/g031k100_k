<html>
<head>
<meta charset="UTF-8">
</head>
<body>
左側(ロゴ部分)を属性セレクタを使わずに変更<br />
$('.logo img').attr('src','https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTir9u3Ezkgzo4wx98YeTYiAhVo8wtY3D9o9VuQq01xGU3YDecS');
<br />
<br />
左側を任意の文章に変更<br />
$('.box_left > h1:eq(0)').text('softboy');
<br />
<br />
右側(人物部分)を属性セレクタを使って変更<br />
$('img[src="http://liginc.co.jp/wp-content/themes/lig2013/images/common/header_hiroyuki2.png"]').attr('src','http://blogimg.goo.ne.jp/user_image/58/d1/607c348b1dca97bb30efc66d5e96bc3f.jpg');
<br />
<br />
ページ下部で任意のwebページへのリンクを追加<br />
$('.sitemap_about.sitemap_tile > ul:eq(2) > li > ul').append($("&ltli /&gt").append($("&lta /&gt").attr("href", "http://www.gungho.jp/pad/").text("puzzle&dragons").css('color','red')));
</body>
</html>