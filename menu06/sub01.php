<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
?>
<?
if(!$id){$id="notice";}
if(!$bid){$bid=$code;}
$member=member_info();
$board=board_info();
?>
<script>
function all_check(){
	var lng =  document.getElementsByName('chk[]');
	if(document.frmdel.level.checked == true){
		for(i=0;i<lng.length;i++){
			lng[i].checked = true;
		}
	} else {
		for(i=0;i<lng.length;i++){
			lng[i].checked = false;
		}
	}
}
</script>

  <div class="content-container info-board">
<?
include $_SERVER['DOCUMENT_ROOT']."/inc/tab_menu06.php";
?>

	<h3><?=$board[a_title]?></h3>
    <div class="border-list board">
      <ul>
<?
$qcommon="code=".$code."&"."stext=".$stext."&";

if($stext) $where=" and (subject like '%$stext%' or name like '%$stext%' ) ";

$sql="select count(*) from $id where bdiv='$code' $where order by notice desc, list desc, ridx asc, date desc ";
$result=mysql_query($sql);
$trecord=mysql_result($result,0);

if (!$page) $page=1;
if (!$nperpage) $nperpage=10;
$nperblock=10;

$tpage = ceil($trecord/$nperpage); //전체페이지

// 출력 레코드 범위
if($trecord==0) {
	$first=1;
	$last=0;
} else {
	$first=$nperpage*($page-1);
	$last=$nperpage*$page;
}

$article_num = $trecord - $nperpage*($page-1); //가상번호 설정

// 각 페이지로 직접 이동할 수 있는 페이지 링크에 대한 설정을 한다.
$tblock = ceil($tpage/$nperblock);
$block = ceil($page/$nperblock);

$first_page = ($block-1)*$nperblock;

$last_page = $block*$nperblock;

if($tblock <= $block) {
   $last_page = $tpage;
}

$sql="select * from $id where bdiv='$code' $where order by notice desc, date desc LIMIT $first, $nperpage ";
$result=mysql_query($sql);
while($data=mysql_fetch_array($result)){
?>
        <li class="tr">
          <div class="td">
            <label class="checkbox-wrap">
              <input type="checkbox" name="level">
            </label>
          </div>
          <div class="td"><span class="fc-red" onclick="location.href='sub01_view.php?id=<?=$id?>&vno=<?=$data[no]?>';"><?=$article_num--;?></span></div>
          <div class="td">
            <div class="title"><a href="sub01_view.php?id=<?=$id?>&vno=<?=$data[no]?>"><?=$data[subject]?></a></div>
            <div class="info" onclick="location.href='sub01_view.php?id=<?=$id?>&vno=<?=$data[no]?>';">
              <ul>
                <li><?=$data[name]?></li>
                <li><?=date("Y-m-d",$data['date']);?></li>
                <li>조회 <?=$data[ref]?></li>
              </ul>
            </div>
          </div>
        </li>
<?
}
?>
      </ul>
    </div>
    <div class="table-bottom">
      <div class="prefix">
<? if($_SESSION[Slevel]==1){ ?>
        <!--button type="button" class="btn btn-sm btn-outline-default btn-round" onclick="document.frmdel.submit();">선택삭제</button-->
<? } ?>
      </div>
      <div class="suffix">
        <!--button type="button" class="btn btn-sm btn-outline-secondary btn-round" onclick="location.href='sub01_write.php?id=<?=$id?>';">글쓰기</button-->
      </div>
    </div>
    <div class="pagination">
      <? include "../inc/paging.php"; ?>
    </div>
  </div>

<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>

</html>