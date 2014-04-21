<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Share Youtube</title>
<?php
session_start();
require_once('/function.php');
	dbconnect();
$header = null;	
$sql = sprintf('SELECT movid FROM mov');
$var = mysql_query($sql) or die();
while($movid = mysql_fetch_assoc($var))
{
	$movids[] = $movid['movid'];
	$allids[] = $movid['movid'];
}
@shuffle($movids);
//var_dump($movids);

	
$ip = ip2long($_SERVER['REMOTE_ADDR']);
//echo $ip;
$items = array();
if(isset($_POST['address1']) || isset($_POST['address2']) || isset($_POST['address3']) || isset($_POST['address4']) || isset($_POST['address5'])){
$items = array(
		h($_POST['address1']),
		h($_POST['address2']),
		h($_POST['address3']),
		h($_POST['address4']),
		h($_POST['address5']),
	);

}
	if(@strlen($items[0]) === 11){
		$id = substr_replace($ip,'',0,3);
		$sql = null;
		$sql = sprintf('REPLACE INTO mov SET id=%d, ip = %d, num = 1, movid = "%s"',
				mre($id.'1'),
				mre($ip),
				mre($items[0])
			);
		mysql_query($sql) or die('error'.mysql_error());
		$header = 1;
	}
	if(@strlen($items[1]) === 11){
		$id = substr_replace($ip,'',0,3);
		$sql = null;
		$sql = sprintf('REPLACE INTO mov SET id=%d, ip = %d, num = 2, movid = "%s"',
				mre($id.'2'),
				mre($ip),
				mre($items[1])
			);
		mysql_query($sql) or die('error'.mysql_error());
		$header = 1;
	}
	if(@strlen($items[2]) === 11){
		$id = substr_replace($ip,'',0,3);
		$sql = null;
		$sql = sprintf('REPLACE INTO mov SET id=%d, ip = %d, num = 3, movid = "%s"',
				mre($id.'3'),
				mre($ip),
				mre($items[2])
			);
		mysql_query($sql) or die('error'.mysql_error());
		$header = 1;
	}
	if(@strlen($items[3]) === 11){
		$id = substr_replace($ip,'',0,3);
		$sql = null;
		$sql = sprintf('REPLACE INTO mov SET id=%d, ip = %d, num = 4, movid = "%s"',
				mre($id.'4'),
				mre($ip),
				mre($items[3])
			);
		mysql_query($sql) or die('error'.mysql_error());
		$header = 1;
	}
	if(@strlen($items[4]) === 11){
		$id = substr_replace($ip,'',0,3);
		$sql = null;
		$sql = sprintf('REPLACE INTO mov SET id=%d, ip = %d, num = 5, movid = "%s"',
				mre($id.'5'),
				mre($ip),
				mre($items[4])
			);
		mysql_query($sql) or die('error'.mysql_error());
		$header = 1;
	}
if($header === 1){
	session_unset();
	header('location: /youtube/index.php');
}

$titles = array();
$sql2 = sprintf('SELECT * FROM mov WHERE ip = %d ORDER BY num',
			mre($ip));
$var2 = mysql_query($sql2) or die();
while($title = mysql_fetch_assoc($var2)){
	$titles[] = $title['movid'];
	$nums[] = $title['num'];
}
//var_dump($titles);


//youtubeタイトル取得
$pattern = "<title>(.*)<\/title>";//Ｖに見えるけどバックスラッシュです。

foreach(@$titles as $img){
$html = file('http://www.youtube.com/watch?v='.$img);//サイトのURL
$str = implode("", $html);

if(preg_match("/".$pattern."/i", $str, $match)){
		$string2 = mb_convert_encoding($match[1], "UTF-8", "UTF-8");//UTF-8からShift-JISへ変換する。
		$string = substr_replace($string2, '', -10,10);
		$tnames[] = $string;
}
}
//全youtubeタイトル取得
$pattern = "<title>(.*)<\/title>";//Ｖに見えるけどバックスラッシュです。

foreach(@$allids as $mimg){
$html = file('http://www.youtube.com/watch?v='.$mimg);//サイトのURL
$str = implode("", $html);

if(preg_match("/".$pattern."/i", $str, $match)){
		$string2 = mb_convert_encoding($match[1], "UTF-8", "UTF-8");//UTF-8からShift-JISへ変換する。
		$string = substr_replace($string2, '', -10,10);
		$mnames[] = $string;
}
}


?>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<style>
*{
	margin:0;
	padding:0;
}
iframe{
	margin-left:5px;
}
h2{
	padding:15px 0 5px 0;
	font-size:30px;
	width:805px;
	margin:0 auto;
	
}
#wrapper{
	padding-top:40px;
	width:805px;

	margin:0 auto;
}
.thumb{
	float:left;
	width:154px;
	border:1px solid #585858;
	margin-bottom:15px;
	overflow:hidden;
	height:210px;
	margin-left:5px;
	}
	.thumb p{
		display:block;
		width:154px;
		min-height:70px;
		text-align:center;
		font-weight:bold;
		font-size:16px;
		width:154px;
		padding:10px 0;
		overflow:hidden;
	}
#formline{
	width:800px;
	margin:20px auto 0 auto;
}
	input[type=text]{
		margin:6px 0 0 ;
	   border-radius: 5px;
	   -moz-border-radius: 5px;
	   -webkit-border-radius: 5px;
	   -o-border-radius: 5px;
	   -ms-border-radius: 5px;
	   border:#a9a9a9 1px solid;
	   -moz-box-shadow: inset 0 0 5px rgba(0,0,0,0.2),0 0 2px rgba(0,0,0,0.3);
	   -webkit-box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2),0 0 2px rgba(0,0,0,0.3);
	   box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2),0 0 2px rgba(0,0,0,0.3);
	   width:200px;
	   height:25px;
	   padding:0 3px;
	}
	
	input[type=text]:focus {
	   border:solid 1px #20b2aa;
	}
	
	input[type=text], select { 
	   outline: none;
	}

		
	label{
		margin:0 10px 0 280px;
		width:100px;
		font-size:16px;
		font-weight:bold;
	}
	input[type=submit]{
		width:100px;
		margin-top:20px;
		margin-left:360px;
		height:50px;
		border-radius:10px;
		-moz-border-radius:10px;
		-webkit-border-radius:10px;
	}
	span{
		font-weight:bold;
		color:red;
	}
	#formline p{
		padding:15px 0 0 0;
		text-align:center;
	}
	.thumwrap{
		overflow:hidden;
		width:805px;
		margin:0 auto;
	}
	.mt20{
		margin-top:20px;
	}
	.tesla{
		margin:0 10px 0 180px;
	}
</style>
</head>

<body>
<div id="wrapper">
<iframe width="800" height="450" src="http://www.youtube.com/embed/<?php echo$movids[0]; $movids[0] = null; ?>?rel=0&autoplay=1&loop=1&playlist=<?php foreach($movids as $mid){ echo$mid.',';} ?>"  frameborder="0" allowfullscreen></iframe>
	<h2>自分が投稿したyoutube</h2>
	<div class="thumwrap">
	<?php $i = $nums[0] or 1; $t = 0; foreach($titles as $img): ?>
    <div class="thumb">
    <p>#<?php echo $i;?>: <?php echo$tnames[$t]; $t++;?></p>
    <a href="http://www.youtube.com/watch?v=<?php echo $img; ?>" target="_blank"><img src="http://i.ytimg.com/vi/<?php echo $img; $q[$i] = $img; $i++;?>/0.jpg" width="154"/></a>
    </div>
    <?php endforeach; ?>
    </div>
</div>
<div id="formline">

<p><br>http://www.youtube.com/watch?v=<span>1n4TAnULBa0</span> ここの部分を投稿。<br>
embedが禁止されてる動画だと再生されずに飛ばされます。ご了承<br>
5件まで登録できます。それ以上は上書き。<br>
自動再生＋ループなのでラジオみたいにずっといろんな曲がランダムで再生されます</p><br>
<form method="post" action="">
<label for="address">#1</label><input type="text" name="address1" class="address" value="<?php if(isset($q[1])){echo $q[1];}?>"/><br>
<label for="address">#2</label><input type="text" name="address2" class="address" value="<?php if(isset($q[2])){echo $q[2];}?>"/><br>
<label for="address">#3</label><input type="text" name="address3" class="address" value="<?php if(isset($q[3])){echo $q[3];}?>"/><br>
<label for="address">#4</label><input type="text" name="address4" class="address" value="<?php if(isset($q[4])){echo $q[4];}?>"/><br>
<label for="address">#5</label><input type="text" name="address5" class="address" value="<?php if(isset($q[5])){echo $q[5];}?>"/><br>
<input type="submit" value="SUBMIT" />
</form><br><br>

<form method="get" action="index2.php" target="_blank">
<label for="address" class="tesla">タグ確認。見れるか確認してみよう。</label><input type="text" name="url" class="address"/><br>
<input type="submit" value="GO!!!!" />
</form>
</div>
	<h2>みんなが投稿したyoutube</h2>
	<div class="thumwrap">
	<?php $t = 0; foreach($allids as $mimg): ?>
    <div class="thumb">
    <p><?php echo$mnames[$t]; $t++;?></p>
    <a href="http://www.youtube.com/watch?v=<?php echo $mimg; ?>" target="_blank"><img src="http://i.ytimg.com/vi/<?php echo $mimg; ?>/0.jpg" width="154"/></a>
    </div>
    <?php endforeach; ?>
    </div>
</body>
</html>
