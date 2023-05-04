<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
?>

  <div class="content-container test-schedule">
<?
if(!$code) { $code="0101";$code2="01"; }else{ $code2=substr($code,0,2);  }
$fetch_arr = cate($code);
$data_cate=qassoc("select * from config_category where code='$code'");
$data_sub=qassoc("select * from subject where code2='$code'");
$data_e=qassoc("select * from eschedule where code2='$code' and view='1' ");
include $_SERVER['DOCUMENT_ROOT']."/inc/tab_subject.php";
?>
    <h3><?=$data_cate[name]?></h3>
<?
$tab_menu01_2=" on";
include $_SERVER['DOCUMENT_ROOT']."/inc/tab_menu01.php";
?>
   
    <table class="table-default th-align-l">
      <colgroup>
        <col style="width: 85px;">
      </colgroup>
      <tbody>
        <tr>
          <th>교육과목</th>
          <td><?=$fetch_arr[0][name]?> > <?=$data_cate[name]?></td>
        </tr>
        <tr>
          <th>1차원서접수</th>
          <td><?=($data_e[adate1])?date("Y년 m월 d일",$data_e[adate1]):""?>~<?=($data_e[adate2])?date("Y년 m월 d일",$data_e[adate2]):""?></td>
        </tr>
        <tr>
          <th>1차시험일자</th>
          <td><?=($data_e[edate])?date("Y년 m월 d일",$data_e[edate]):""?></td>
        </tr>
        <tr>
          <th>1차합격발표</th>
          <td><?=($data_e[pdate1])?date("Y년 m월 d일",$data_e[pdate1]):""?></td>
        </tr>
        <tr>
          <th>2차원서접수</th>
          <td><?=($data_e[adate3])?date("Y년 m월 d일",$data_e[adate3]):""?>~<?=($data_e[adate4])?date("Y년 m월 d일",$data_e[adate4]):""?></td>
        </tr>
        <tr>
          <th>2차시험일자</th>
          <td><?=($data_e[edate3])?date("Y년 m월 d일",$data_e[edate3]):""?></td>
        </tr>
        <tr>
          <th>2차합격발표</th>
          <td><?=($data_e[pdate3])?date("Y년 m월 d일",$data_e[pdate3]):""?></td>
        </tr>
        <tr>
          <td colspan="2"><?=nl2br($data_e[contents])?></td>
        </tr>
      </tbody>
    </table>
  </div>

<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>

</html>