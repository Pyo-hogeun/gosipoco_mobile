<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
?>
<?
if($_SESSION[Mid]){
	$sql_ml="select * from member where mid = '".$_SESSION[Mid]."'";
	$result_ml=mysql_query($sql_ml);
	$member_login=mysql_fetch_array($result_ml);
}
?>
<script>
function sms_go(){
	f=document.cform_counsel;
	if(f.agree.checked==false){
		alert('�������� ������ �ּ���.');
	}else if(f.name.value==''){
		alert('�̸��� �Է��� �ּ���.');
	}else if(f.hp1.value==''){
		alert('����ó�� �Է��� �ּ���.');
	}else{
		f.action="/inc/consult_save.php";
		f.submit();
	}
}
	function cate(str,code){
		document.getElementById("HiddenFrm").src=str;
	}
</script>

  <div class="main">
  <div class="swiper main-swiper visual-wrap main">
    <div class="swiper-wrapper">
<?
$sql="select * from home_main where type='5' order by list_num asc";
$result=mysql_query($sql);
while ($data=mysql_fetch_array($result)){
?>
      <div class="swiper-slide">
        <a href="#"><img src="http://gosi.wjn02.co.kr/data/submain/<?=$data[imgfile]?>" style="width:100%;"></img></a>
      </div>
<?
}
?>
    </div>
    <!-- <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div> -->
    <div class="swiper-pagination"></div>
  </div>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".main-swiper", {
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>
    <div class="multie-banner">
      <a href="">
        <img src="../image/banner-boucher.png" alt="����̹���">
      </a>
      <a href="">
        <img src="../image/banner-edu.png" alt="����̹���">
      </a>
    </div>
    <div class="content-container">
      <div class="overview-wrap">
        <div class="board-overview">
          <div class="header">
            <h4>��������</h4>
            <a href="/menu06/sub01.php" class="btn-more">
              <span class="icon-more"></span>
            </a>
          </div>
          <ul class="content">
					   <?php
					   $co=0;
						$bid="notice";
						$sql="select * from $bid where level < 1 order by no desc limit 0,5";
						$dre=mysql_query($sql) or die(mysql_error());
						while($ddata=mysql_fetch_array($dre)){
						?>
            <li><a href="/menu06/sub01_view.php?id=<?=$bid?>&act1=view&vno=<?=$ddata[no]?>"><?=cut_str(strip_tags($ddata[subject]),45)?></a></li>
					   <?php
						$co++;
					   }
					   ?>
          </ul>
        </div>
        <!--div class="board-overview">
          <div class="header">
            <h4>������ �Խ���</h4>
            <ul>
              <li class="on">
                <a href="">������ �Խ���</a>
              </li>
              <li>
                <a href="">�����,�հݼ�</a>
              </li>
            </ul>
            <a href="/menu06/sub01.php?id=addition" class="btn-more">
              <span class="icon-more"></span>
            </a>
          </div>
          <ul class="content">
					   <?php
					   $co=0;
						$bid="addition";
						$sql="select * from $bid where level < 1 order by no desc limit 0,5";
						$dre=mysql_query($sql) or die(mysql_error());
						while($ddata=mysql_fetch_array($dre)){
						?>
            <li><a href="/menu06/sub01_view.php?id=<?=$bid?>&act1=view&vno=<?=$ddata[no]?>"><?=cut_str(strip_tags($ddata[subject]),30)?></a></li>
					   <?php
						$co++;
					   }
					   ?>
          </ul>
        </div-->
      </div>
    </div>
<form name="cform_counsel" method="post" enctype="multipart/form-data" target="HiddenFrm">
<input type="hidden" name="inlink" value="<?=$_SERVER['HTTP_REFERER']?>">
    <div class="contact">
      <div class="content-container">
        <div class="header">
          <span class="title">�������</span><br>
          <span class="sub-text">(�ñ��Ͻ� ������ �Ѱ��ֽø� �ż��ϰ� �����帳�ϴ�.)</span>
        </div>
        <div class="type">
          <label class="radio-wrap">
            <input type="radio" name="code" value="�������" checked onclick="cate('/inc/quick_menu_select.php?form=cform_counsel&target=subject&code1=01');">
            <span>�������</span>
          </label>
          <label class="radio-wrap">
            <input type="radio" name="code" value="������" onclick="cate('/inc/quick_menu_select.php?form=cform_counsel&target=subject&code1=02');">
            <span>������</span>
          </label>
          <label class="radio-wrap">
            <input type="radio" name="code" value="�ڰ���" onclick="cate('/inc/quick_menu_select.php?form=cform_counsel&target=subject&code1=03');">
            <span>�ڰ���</span>
          </label>
        </div>
        <div class="subject">
          <select name="subject" id="" class="default-input">
            <option value="">==��������==</option>
			<?
			$cr1=mysql_query("select * from config_category where code1='01' and length(code)=4 ");
			while ($cd1 = mysql_fetch_assoc($cr1)){
			?>
              <option value="<?=$cd1[code]?>"><?=$cd1[name]?></option>
			<? } ?>
          </select>
        </div>
        <div class="info">
          <div class="left">
            <input type="text" name="name" id="" class="default-input name" placeholder="�̸�" value="<?=$_SESSION[Mname]?>">
            <input type="text" name="hp1" id="" class="default-input phone" placeholder="����ó" value="<?=$member_login[mhp]?>">
          </div>
          <div class="right">
            <textarea name="contents" id="" cols="30" rows="3" class="default-input" placeholder="���޸�"></textarea>
          </div>
        </div>

        <div class="agree">
          <label class="checkbox-wrap">
            <input type="checkbox" name="agree">
            <span>�������������� �����մϴ�.</span>
          </label>
        </div>
        
        <div class="btn-apply">
          <button type="button" class="btn btn-yellow submit" onclick="sms_go();">��û�ϱ�</button>
        </div>

      </div>
    </div>
</form>
  </div>
<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>

</html>