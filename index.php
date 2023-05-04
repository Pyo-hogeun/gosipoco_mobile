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
		alert('개인정보 동의해 주세요.');
	}else if(f.name.value==''){
		alert('이름을 입력해 주세요.');
	}else if(f.hp1.value==''){
		alert('연락처를 입력해 주세요.');
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
        <img src="../image/banner-boucher.png" alt="배너이미지">
      </a>
      <a href="">
        <img src="../image/banner-edu.png" alt="배너이미지">
      </a>
    </div>
    <div class="content-container">
      <div class="overview-wrap">
        <div class="board-overview">
          <div class="header">
            <h4>공지사항</h4>
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
            <h4>가산점 게시판</h4>
            <ul>
              <li class="on">
                <a href="">가산점 게시판</a>
              </li>
              <li>
                <a href="">경쟁률,합격선</a>
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
          <span class="title">빠른상담</span><br>
          <span class="sub-text">(궁금하신 사항을 넘겨주시면 신속하게 연락드립니다.)</span>
        </div>
        <div class="type">
          <label class="radio-wrap">
            <input type="radio" name="code" value="검정고시" checked onclick="cate('/inc/quick_menu_select.php?form=cform_counsel&target=subject&code1=01');">
            <span>검정고시</span>
          </label>
          <label class="radio-wrap">
            <input type="radio" name="code" value="공무원" onclick="cate('/inc/quick_menu_select.php?form=cform_counsel&target=subject&code1=02');">
            <span>공무원</span>
          </label>
          <label class="radio-wrap">
            <input type="radio" name="code" value="자격증" onclick="cate('/inc/quick_menu_select.php?form=cform_counsel&target=subject&code1=03');">
            <span>자격증</span>
          </label>
        </div>
        <div class="subject">
          <select name="subject" id="" class="default-input">
            <option value="">==교육과목==</option>
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
            <input type="text" name="name" id="" class="default-input name" placeholder="이름" value="<?=$_SESSION[Mname]?>">
            <input type="text" name="hp1" id="" class="default-input phone" placeholder="연락처" value="<?=$member_login[mhp]?>">
          </div>
          <div class="right">
            <textarea name="contents" id="" cols="30" rows="3" class="default-input" placeholder="상담메모"></textarea>
          </div>
        </div>

        <div class="agree">
          <label class="checkbox-wrap">
            <input type="checkbox" name="agree">
            <span>개인정보수집에 동의합니다.</span>
          </label>
        </div>
        
        <div class="btn-apply">
          <button type="button" class="btn btn-yellow submit" onclick="sms_go();">신청하기</button>
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