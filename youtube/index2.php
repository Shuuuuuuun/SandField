<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無題ドキュメント</title>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<?php 
if(isset($_GET['url'])){
	$i = $_GET['url'];
}
?>
<style>

</style>
</head>

<body>


<div id="videoDiv"></div>
<h1>再生されればＯＫ</h1>
<a href="" onclick="play();" id="push">Play</a>
<a href="index.php" >back to top</a>
<button id="b" onclick="play();">hey</button>
<script type="text/javascript">

    var player;

    var VIDEO_ID = '<?php echo $i; ?>'
    var PLAYER_ID = 'videoDiv';



    // プレーヤーでエラーが発生した
    function onPlayerError( errorCode )
    {
        switch( errorCode )
        {
            case 100:
                break;
        }
    }

    // プレーヤーの準備が整った
    function onYouTubePlayerReady( playerId )
    {
        player = document.getElementById( PLAYER_ID );

        player.addEventListener( 'onStateChange', 'onPlayerStateChange' );
        player.addEventListener( 'onError', 'onPlayerError' );
		
    }


    // プレーヤーを読み込む
    function LoadPlayer()
    {
        var swfUrl = 'http://www.youtube.com/v/' + VIDEO_ID + '?enablejsapi=1';

        var replaceElemId = PLAYER_ID;
        var width = '480';
        var height = '295';
        var swfVersion = '8';

        var params = { allowScriptAccess: 'always' };    // 外部のドメインからのアクセスを許可
        var atts = { id: replaceElemId };                // 埋め込みプレーヤーのID

        // YouTubeプレーヤーの埋め込み
        swfobject.embedSWF(
            swfUrl,
            replaceElemId,
            width,
            height,
            swfVersion,
            null,
            null,
            params,
            atts
            );




    }
	
	
	        function onPlayerStateChange(state)
		{
            // Event.data contains the event parameter, which is the new player state
            //プレイヤーの状態を判定
            //未開始（-1）、終了（0）、再生中（1）、一時停止中（2）、バッファリング中（3）、頭出し済み（5）
            if (state == "0") { //動画が終了した場合
                movieIdListIndex++;
                if(movieIdListIndex > movieIdList.length - 1) return; //動画IDリストを超えた場合は処理を行わない
                player.loadVideoById(movieIdList[movieIdListIndex], 0, "default");
            }
        }
	
	
	
	
	
	function play()
	{
		
		if(player){
			player.loadVideoById(VIDEO_ID, 0, "default");
		}
	}

    google.load( 'swfobject', '2.2' );
    google.setOnLoadCallback( LoadPlayer );
	google.setOnLoadCallback( play );
	
$(function(){
	var time = 1000;
	var clicker = function(){
		$('#b').trigger("click");	
	}
	setTimeout(clicker, time);
});	

</script>
</body>
</html>
