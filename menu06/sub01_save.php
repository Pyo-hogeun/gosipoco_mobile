<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";


if ($eno) {

	# ����о����
	$result=mysql_query("select * from $id where no=$eno") or die(mysql_error());
	$bu=mysql_fetch_array($result) or die(mysql_error());

	# ���α� üũ
	/*if ((($member[user_level]< $board[super_comp_level] )) || $u_admin){
	} elseif ($bu[pwd]!=$pwd){
		err_msg("��ȣ�� ��ġ���� �ʽ��ϴ�.");
	}
*/
	$file_data=$bu[files];
	$tmp_file_num=explode("|",$file_data);
	$file_org_data=$bu[nfiles];
	$tmp_org_num=explode("|",$file_org_data);

	
	$add[]="memo='".addslashes($memo)."'";
	if($bdate)$add[]="date='".strtotime($bdate)."'";
} else {
	
	$add[]="date='".time()."'";

	# ���üũ
	if ($list=="") {
		$tmpData=mysql_result(mysql_query("select max(list) from $id"),0);
		if ($tmpData==0) $tmpData=0;
		$list=$tmpData+1;
		unset ($tmpData);
		$level=0;
		$ridx=0;
		$add[]="memo='".addslashes($memo)."'";
	} else {
		//$Myno=mysql_result(mysql_query("select Myno from $id where list='$list'"),0);
		$prev_memo=mysql_result(mysql_query("select memo from $id where list='$list'"),0);
		$level=$level+1;
		mysql_query("update $id set ridx=ridx+1 where list=$list and ridx>$ridx") or die(mysql_error());
		$ridx=$ridx+1;

		if($id=="ans"){
			    $add[]="memo='".addslashes($memo)."'";
		}else{
				$real_memo = "��������:<BR>".$prev_memo."<BR><BR>-------------------------------------------------------------------------------------------------------------
		<BR><BR>�亯����:<BR>".addslashes($memo);
				$add[]="memo='$real_memo'";
		}

	}
}



//	input insert file upload
	//���� ���ε�
	$copyday = time();
	for ($i=0;$i<sizeof($upfile);$i++) {

	if($_FILES[upfile][tmp_name][$i]) {
		$file1 = $_FILES[upfile][tmp_name][$i];
		$file1_name = $_FILES[upfile][name][$i];
		$file1_size = $_FILES[upfile][size][$i];
		$file1_type = $_FILES[upfile][type][$i];

		if($file1_size>$file1) {
	//	if(!is_uploaded_file($file1)) movepage("goback","�������� ������� ���ε� ���ּ���");

			if($file1_size>0) {

			$s_file_name1=$file1_name;

			$file1=eregi_replace("\\\\","\\",$file1);$s_file_name1=str_replace(" ","_",$s_file_name1);$s_file_name1=str_replace("-","_",$s_file_name1);$full_filename = explode(".", $s_file_name1);$extension = $full_filename[sizeof($full_filename)-1];$extension = strtolower($extension);
			$copyname = $copyday . $i . "." . $extension;

			// �ߺ������� ������;; 
			$k=1;
			while (file_exists("$dir/board/data/$id/".$copyname)) {
			$copyname=$copyday."_".$k.".".$extension;
			$k++;
			}

			if(!move_uploaded_file($file1,"$dir/board/data/$id/".$copyname)) exit;//movepage("goback","���Ͼ��ε尡 ����� ���� �ʾҽ��ϴ�");
			if ($eno) {
				$del_list[]=$tmp_file_num[$i];
				$del_org[]=$tmp_org_num[$i];
			}
			if ($chk_first!=0) {$file_name.="|";$file_org_name.="|";}
			$chk_first=1;
			

			$file_name.=$copyname;
			$file_org_name.=$file1_name;
		} else { movepage("goback","���Ͼ��ε尡 ����� ���� �ʾҽ��ϴ�"); }
	 } else { movepage("goback","���Ͼ��ε尡 ����� ���� �ʾҽ��ϴ�"); }
	} else {
			if ($eno) {
				 if ($chk_del[$i]) { //del chk�� �Ǿ� �ִ°��
					$del_list[]=$tmp_file_num[$i];
					$del_org[]=$tmp_org_num[$i];
				} 
			}
			if ($chk_first!=0) { $file_name.="|"; $file_org_name.="|";}
			$chk_first=1;
	}
	}

if ($eno) {
			// ����ó��
			for ($i=0;$i<sizeof($del_list);$i++) {
			$file_data=str_replace($del_list[$i],"",$file_data);
			$file_org_data=str_replace($del_org[$i],"",$file_org_data);
			delfile("data/$id/".$del_list[$i]);
			}

			// ���ε� ����ó��
			$tmp=explode("|",$file_data);
			$tmp2=explode("|",$file_name);
			$tmp_org=explode("|",$file_org_data);
			$tmp_org2=explode("|",$file_org_name);

			for ($i=0;$i<sizeof($upfile);$i++) {
			if ($tmp[$i]!="") { $tmp2[$i]=$tmp[$i]; $tmp_org2[$i]=$tmp_org[$i]; }
			if ($i!=0) { $r_file_name.="|"; $r_org_file_name.="|";}
			$r_file_name.=$tmp2[$i];
			$r_org_file_name.=$tmp_org2[$i];
			}
			$file_name = $r_file_name;
			$file_org_name = $r_org_file_name;
}

//etc editor use sorce
$subject=strip_tags($subject);
if ($subject=="") $subject="[�������]";
if ($memo=="") $memo="[�������]";
if ($id=="js_schedule"){//byear bmonth bday bhour
	$add[]="bstime='".$byear."-".sprintf("%02d",$bmonth)."-".sprintf("%02d",$bday)."-".sprintf("%02d",$bhour).":00:00'";
}
	$add[]="files='$file_name'";
		$add[]="nfiles='$file_org_name'";
if(!$eno){
$add[]="name='$textname'";
}
$add[]="subject='$subject'";
if(!$eno){
$add[]="email='$email_addr'";
}

//if($id == 'qna') $add[]="hp_phone='$hp_phone'";
$add[]="bdiv='$bid'";

if(!$eno){
	if($ans){
		$odd=mysql_fetch_array(mysql_query("select * from $id where no='$ans'"));
		$add[]="pwd='".$odd[pwd]."'";
	} else {
		if($_SESSION[Mpwd]){ $pwd=$_SESSION[Mpwd]; }
		$add[]="pwd='$pwd'";
	}
}


if($bref) $add[]="ref='".$bref."'";
$add[]="notice='$notices'";
if($id=="res"){
	$add[]="security='1'";
}else{
	$add[]="security='$security'";
}
$add[]="ref='1'";
$add[]="list='$list'";
$add[]="level='$level'";
$add[]="ridx='$ridx'";
if(!$eno){
	if($ans){
		$add[]="midx='".$odd[midx]."'";
	} else {
		$add[]="midx='".$_SESSION[Mno]."'";
	}
}
if ($eno){
	for ($i=0;$i<sizeof($add);$i++){
		if ($i) $update_list.=",$add[$i]";
		else $update_list=$add[$i];
	}
	$sql="update $id set $update_list where no='$eno'";
	$act1 = 'view';
} else {

	for($i=0;$i<sizeof($add);$i++){
		if($i) $insert_list.=",$add[$i]";
		else $insert_list=$add[$i];
	}
	$sql="insert into $id set $insert_list";
	
	$act1 = 'list';

}

mysql_query($sql) or die(mysql_error());
movepage_p("sub01.php?id=$id");

?>
