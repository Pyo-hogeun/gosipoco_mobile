<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
?>
<?
if(!$id){$id="notice";}
if(!$bid){$bid=$code;}
$member=member_info();
$board=board_info();
$query="update $id set ref=ref+1 where no='$vno' ";
mysql_query($query);
$bu=mysql_fetch_array(mysql_query("select * from $id where no='$vno'"));
if ($board[a_file_use]>0) {
	$textfile="";
	$tmp_file_num=explode("|",$bu['files']);
	$tmp_org_name=explode("|",$bu['nfiles']);
	$tmp_cnt = sizeof($tmp_file_num);
	//echo $tmp_cnt;
	if($tmp_file_num[0]) $textfile="";
	for ($i=0;$i<$tmp_cnt;$i++){
		
		if($tmp_org_name[$i]){
			$tmp_img=explode(".",$tmp_org_name[$i]);
			if( strtolower($tmp_img[1]) == "jpg" || strtolower($tmp_img[1]) == "gif"|| strtolower($tmp_img[1]) == "bmp"){
			$textfile .= '';
			$img_files[]=$tmp_file_num[$i];
			$CkImsi.=$tmp_org_name[$i];
			}elseif($tmp_img[1] == "wmv") $mov_files[]=$tmp_file_num[$i];
			else{
			$textfile.="<li>첨부파일 : <a href=\"/board/download.php?no=$bu[no]&num=$i&db=$id\">".$tmp_org_name[$i]."</a></li>";
			$chk_blank++;
			$CkImsi.=$tmp_org_name[$i];
			}
		}
	
	}

}
# 사진첨가
if ($img_files){
	for ($i=0;$i<sizeof($img_files);$i++){
		if(file_exists("$dir/board/data/$id/$img_files[$i]")){
			$GetSize=@GetImageSize("$dir/board/data/$id/$img_files[$i]");
			if ($GetSize[0]>600) $GetSize[0]=600;
			$Bmemo.="<center><img src='/board/data/$id/$img_files[$i]' width='$GetSize[0]' galleryimg=no></center><br>";
		}else{
			$Bmemo.="<center><img src='http://www.dwse.or.kr/board/data/$id/$img_files[$i]' galleryimg=no style='max-width:600px;'></center><br>";
		}
	}
}

$sql="select no,subject,list,ridx from $id where bdiv='$code' and date<'$bu[date]' order by date desc limit 0,1";
$bp=@mysql_fetch_array(mysql_query($sql));
$sql="select no,subject,list,ridx  from $id where bdiv='$code' and date>'$bu[date]' order by date asc limit 0,1";
$np=@mysql_fetch_array(mysql_query($sql));
?>
  <div class="content-container notice-board">
<?
include $_SERVER['DOCUMENT_ROOT']."/inc/tab_menu06.php";
?>
	<h3><?=$board[a_title]?></h3>
    
  </div>
  <div class="notice-board">

    <div class="board-view">
      <div class="view-header">
        <p class="title"><?=$bu[subject]?></p>
        <div class="info">
          <ul>
            <li><?=$bu[name]?></li>
            <li><?=date("Y-m-d",$bu['date']);?></li>
            <li>조회 <?=$bu[ref]?></li>
          </ul>
        </div>
      </div>
      <div class="view-body">
        <div class="files">
          <ul>
		  <?=$textfile?>
          </ul>
        </div>
  
        <div class="content-wrap"><?=$Bmemo?><?=nl2br($bu[memo])?></div>
      </div>
    </div>
    <div class="table-bottom-center">
      <!--button class="btn btn-md btn-outline-secondary btn-round">수정하기</button-->
      <button class="btn btn-md btn-outline-primary btn-round" onclick="location.href='sub01.php?id=<?=$id?>';">목록보기</button>
    </div>

    <div class="nav-button">
<? if($bp[no]){ ?>
      <a href="sub01_view.php?code=<?=$code?>&vno=<?=$bp[no]?>" class="prev">이전</a>
      </a>
<? } ?>
<? if($np[no]){ ?>
      <a href="sub01_view.php?code=<?=$code?>&vno=<?=$np[no]?>" class="next">다음</a>
<? } ?>
    </div>
  </div>

<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>

</html>