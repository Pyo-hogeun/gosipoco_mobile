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
$tab_menu01_3=" on";
include $_SERVER['DOCUMENT_ROOT']."/inc/tab_menu01.php";
?>
<?
if(!$id){$id="etc";}
if(!$bid){$bid=$code;}
$member=member_info();
$board=board_info();
?>
    <div class="border-list board">
      <ul>
<?
$qcommon="code=".$code."&";

$sql="select count(*) from $id where bdiv='$code' order by notice desc, list desc, ridx asc, date desc ";
$result=mysql_query($sql);
$trecord=mysql_result($result,0);

if (!$page) $page=1;
if (!$nperpage) $nperpage=10;
$nperblock=10;

$tpage = ceil($trecord/$nperpage); //��ü������

// ��� ���ڵ� ����
if($trecord==0) {
	$first=1;
	$last=0;
} else {
	$first=$nperpage*($page-1);
	$last=$nperpage*$page;
}

$article_num = $trecord - $nperpage*($page-1); //�����ȣ ����

// �� �������� ���� �̵��� �� �ִ� ������ ��ũ�� ���� ������ �Ѵ�.
$tblock = ceil($tpage/$nperblock);
$block = ceil($page/$nperblock);

$first_page = ($block-1)*$nperblock;

$last_page = $block*$nperblock;

if($tblock <= $block) {
   $last_page = $tpage;
}

$sql="select * from $id where bdiv='$code' order by notice desc, date desc LIMIT $first, $nperpage ";
$result=mysql_query($sql);
while($data=mysql_fetch_array($result)){
?>
        <li class="tr">
          <div class="td">
            <label class="checkbox-wrap">
              <input type="checkbox" name="level">
            </label>
          </div>
          <div class="td"><span class="fc-red"><?=$article_num--;?></span></div>
          <div class="td">
            <div class="title"><a href="sub03_view.php?id=<?=$id?>&vno=<?=$data[no]?>"><?=$data[subject]?></a></div>
            <div class="info">
              <ul>
                <li><?=$data[name]?></li>
                <li><?=date("Y-m-d",$data['date']);?></li>
                <li>��ȸ <?=$data[ref]?></li>
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
        <!--button class="btn btn-sm btn-outline-default btn-round">���û���</button-->
      </div>
      <div class="suffix">
        <!--button class="btn btn-sm btn-outline-secondary btn-round">�۾���</button-->
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