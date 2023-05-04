<?
include_once $_SERVER['DOCUMENT_ROOT']."/inc/header.php";

$hp=$hp1;


$query="insert into reservmail set 
code='one',
status='1',
name='$name',
lname='$code',
hp='$hp',
email='$email',
subject='$subject', 
contents='$contents',
regdate='".time()."'
";
mysql_query($query);

//$data_sms=mysql_fetch_array(mysql_query("select * from config_admin"));

?>

<SCRIPT LANGUAGE="JavaScript">
alert('상담이 등록되었습니다.');
top.document.location.reload();
</SCRIPT>

