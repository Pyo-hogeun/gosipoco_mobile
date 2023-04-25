<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
?>

  <div class="content-container info-board">
<?
if(!$code) { $code="0101";$code2="01"; }else{ $code2=substr($code,0,2);  }
$data_cate=qassoc("select * from config_category where code='$code'");
$data_sub=qassoc("select * from subject where code2='$code'");
include $_SERVER['DOCUMENT_ROOT']."/inc/tab_subject.php";
?>
    <h3><?=$data_cate[name]?></h3>
<?
$tab_menu01_1=" on";
include $_SERVER['DOCUMENT_ROOT']."/inc/tab_menu01.php";
?>
    
    <div>자격정보</div>
    <div class="content-detail-wrap">
	<? if($data_sub[upfile]){ ?>
		<img src="htttp://gosi.wjn02.co.kr/data/subject/<?=$data_sub[upfile]?>" style="max-width:100%;">
	<? } ?>
	<?=nl2br($data_sub[contents])?>
    </div>
  </div>

<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>

</html>