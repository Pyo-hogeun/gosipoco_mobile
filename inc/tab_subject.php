    <div class="tab-wrap col-4 mt-10">
      <div class="tab-item<?="01"==$code2?' on':''?>"><a href="<?=$_SERVER['PHP_SELF']?>?code=0101" class="tab">�������</a></div>
      <div class="tab-item<?="02"==$code2?' on':''?>"><a href="<?=$_SERVER['PHP_SELF']?>?code=0201" class="tab">������</a></div>
      <div class="tab-item<?="04"==$code2?' on':''?>"><a href="<?=$_SERVER['PHP_SELF']?>?code=0401" class="tab">�ΰ��ڰ���</a></div>
      <div class="tab-item<?="03"==$code2?' on':''?>"><a href="<?=$_SERVER['PHP_SELF']?>?code=0308" class="tab">�����ڰ���</a></div>
    </div>
    <div class="tab-wrap col-4 dark mt-10">
<?
$sql="select * from config_category where code1='$code2' and length(code)=4 and ov!='1' order by sortno asc";
$result=mysql_query($sql);
while ($data=mysql_fetch_array($result)){
?>
      <div class="tab-item<?=$data[code]==$code?' on':''?>"><a href="<?=$_SERVER['PHP_SELF']?>?code=<?=$data[code]?>" class="tab"><?=$data[name]?></a></div>
<?
}
?>
    </div>
