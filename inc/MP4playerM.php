<?
$CONFIG_USING=true;
include_once $_SERVER['DOCUMENT_ROOT']."/libraries/Function.inc.lib.php";
include_once $_SERVER['DOCUMENT_ROOT']."/libraries/DB_connect.inc.lib.php";
$connect = dbconn();
include_once $_SERVER['DOCUMENT_ROOT']."/libraries/setting.inc.lib.php";
// 공통 배열 관련
include_once $_SERVER['DOCUMENT_ROOT']."/libraries/Code.inc.lib.php";

$rr=qrow("select viewing from repetition WHERE midx='".$_SESSION[Mno]."'");	
if(!$rr[0]){qresult("update repetition SET regdate='".time()."' ,mip='".$REMOTE_ADDR."',viewing='1' WHERE midx='".$_SESSION[Mno]."'");}
else{
	echo "<script language='javascript'>
				alert('동영상강좌는 중복시청이 불가합니다.');
			   self.close();
			  </script>";
			  exit;
}

if(!$_SESSION[Mno]){
echo "<script language='javascript'>
	    	alert('잘못된접근입니다.');
		   self.close();
		  </script>";
		  exit;
}

if(!$l || !$lno || !$lc){
echo "<script language='javascript'>
	    	alert('잘못된접근입니다.');
		   self.close();
		  </script>";
		  exit;
}

$llcheck=false;
if($_SESSION[Mid]){
	$llno_soc = qassoc("select * from cmorder where substring(lcode,1,2)='".substr($lc,0,2)."' and midx='".$_SESSION[Mno]."' and cmostatus=2");
	//echo $llno_soc[lcode];
	if(strlen($llno_soc[lcode])==2){
		if(substr($lc,0,2)==$llno_soc[lcode])$llcheck=true;
	} else {
		if(substr($lc,0,4)==$llno_soc[lcode])$llcheck=true;
	}
	//$llno = substr($lc,0,4);
	//$lvalue = qrow("select count(idx) from cmorder where lcode like '".$llno."%' and midx='".$_SESSION[Mno]."' and cmostatus=2");
	//if($lvalue[0]>=1)$llcheck=true;
}

if(!$llcheck){
echo "<script language='javascript'>
	    	alert('동영상강좌 시청권한이 없습니다.');
		   self.close();
		  </script>";
		  exit;
}

$movie = qrow("select pmp4,eduno,subject from edumovie where idx='$lno'");
$edumovie = $movie[0];

$query="insert into subject_view set user_id='".$_SESSION[Mno]."',sub_l='$lno',type='3',cip='".$_SERVER['REMOTE_ADDR']."',ctype='$dataType',regdate=now() ";
mysql_query($query);


$cname=cate($lc);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="euc-kr">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mobile Player</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.6/mediaelementplayer.css">
    <link rel="stylesheet" href="jsNcss/jump-forward.css">
    <link rel="stylesheet" href="jsNcss/skip-back.css">
    <link rel="stylesheet" href="jsNcss/speed.css">
    <link rel="stylesheet" href="jsNcss/demo.css">
</head>
<body>
    <div id="container">

        
        <div class="media-wrapper">
            <video id="player1" width="640" height="360" style="max-width:100%;" controls preload="none">
                <source src="<?=$edumovie?>" type="video/mp4">
            </video>
        </div>

        
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.6/mediaelement-and-player.min.js"></script>
    <script src="jsNcss/jump-forward.js"></script>
    <script src="jsNcss/skip-back.js"></script>
    <script src="jsNcss/speed.js"></script>
    <script>
	    var mediaElements = document.querySelectorAll('video, audio');

	    for (var i = 0, total = mediaElements.length; i < total; i++) {

		    var features = ['playpause', 'current', 'progress', 'duration', 'volume', 'skipback', 'jumpforward', 'speed', 'fullscreen'];

		    new MediaElementPlayer(mediaElements[i], {
			    autoRewind: false,
			    features: features,
		    });
	    }
    </script>
</body>
</html>