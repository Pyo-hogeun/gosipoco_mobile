<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
?>

  <div class="content-container apply-class">
<?
if(!$code) { $code="0101";$code2="01"; }else{ $code2=substr($code,0,2);  }
$data_cate=qassoc("select * from config_category where code='$code'");
$data_sub=qassoc("select * from subject where code2='$code'");
include $_SERVER['DOCUMENT_ROOT']."/inc/tab_subject.php";
?>
    <h3><?=$data_cate[name]?></h3>
<?
$tab_menu01_4=" on";
include $_SERVER['DOCUMENT_ROOT']."/inc/tab_menu01.php";
?>
    
    <div class="banners">
      <div class="header">
        <img src="../image/appy_class_banner.jpg" alt="원격평생교육시설등록기관 안내 이미지">
      </div>
      <ul>
<? if($data_sub[type1]!="1"){ ?>
		<li>
          <div class="class-banner">
            <img src="../image/appy_class_01.jpg" alt="study 단과반 수강신청">
            <span class="title"><?=$data_sub[type1_con]?></span>
            <div class="price">
              <div class="as-is"><?=number($data_sub[type1_price])?>원</div>
              <div class="to-be"><?=number($data_sub[type1_price2])?>원</div>
            </div>
            <a href="/menu02/sub01.php?c=<?=$code?>&t=type1" class="btn-link">수강신청</a>
          </a>
        </li>
<? } ?>
<? if($data_sub[type2]!="1"){ ?>
        <li>
          <div class="class-banner">
            <img src="../image/appy_class_02.jpg" alt="study 단과반 수강신청">
            <span class="title"><?=$data_sub[type2_con]?></span>
            <div class="price">
              <div class="as-is"><?=number($data_sub[type2_price])?>원</div>
              <div class="to-be"><?=number($data_sub[type2_price2])?>원</div>
            </div>
            <a href="/menu02/sub01.php?c=<?=$code?>&t=type2" class="btn-link">수강신청</a>
          </a>
        </li>
<? } ?>
<? if($data_sub[type3]!="1"){ ?>
        <li>
          <div class="class-banner">
            <img src="../image/appy_class_03.jpg" alt="study 단과반 수강신청">
            <span class="title"><?=$data_sub[type3_con]?></span>
            <div class="price">
              <div class="as-is"><?=number($data_sub[type3_price])?>원</div>
              <div class="to-be"><?=number($data_sub[type3_price2])?>원</div>
            </div>
            <a href="/menu02/sub01.php?c=<?=$code?>&t=type3" class="btn-link">수강신청</a>
          </a>
        </li>
<? } ?>
      </ul>
    </div>

  </div>

<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>

</html>