<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
?>

  <div class="content-container test-schedule">
<?
if(!$code) { $code="0101";$code2="01"; }else{ $code2=substr($code,0,2);  }
$data_cate=qassoc("select * from config_category where code='$code'");
$data_sub=qassoc("select * from subject where code2='$code'");
$data_e=qassoc("select * from eschedule where code2='$code'");
include $_SERVER['DOCUMENT_ROOT']."/inc/tab_subject.php";
?>
    <h3><?=$data_cate[name]?></h3>
<?
$tab_menu01_2=" on";
include $_SERVER['DOCUMENT_ROOT']."/inc/tab_menu01.php";
?>
    
    <table class="table-default th-align-l">
      <colgroup>
        <col style="width: 100px;">
      </colgroup>
      <tbody>
        <tr>
          <th>��������</th>
          <td><?=$data_cate[name]?></td>
        </tr>
        <tr>
          <th>1����������</th>
          <td><?=($data_e[adate1])?date("Y�� m�� d��",$data_e[adate1]):""?>~<?=($data_e[adate2])?date("Y�� m�� d��",$data_e[adate2]):""?></td>
        </tr>
        <tr>
          <th>1����������</th>
          <td><?=($data_e[edate])?date("Y�� m�� d��",$data_e[edate]):""?></td>
        </tr>
        <tr>
          <th>1���հݹ�ǥ</th>
          <td><?=($data_e[pdate1])?date("Y�� m�� d��",$data_e[pdate1]):""?></td>
        </tr>
        <tr>
          <th>2����������</th>
          <td><?=($data_e[adate3])?date("Y�� m�� d��",$data_e[adate3]):""?>~<?=($data_e[adate4])?date("Y�� m�� d��",$data_e[adate4]):""?></td>
        </tr>
        <tr>
          <th>2����������</th>
          <td><?=($data_e[edate3])?date("Y�� m�� d��",$data_e[edate3]):""?></td>
        </tr>
        <tr>
          <th>2���հݹ�ǥ</th>
          <td><?=($data_e[pdate3])?date("Y�� m�� d��",$data_e[pdate3]):""?></td>
        </tr>
        <tr>
          <th>�󼼼���</th>
          <td><?=nl2br($data_e[contents])?></td>
        </tr>
      </tbody>
    </table>
  </div>

<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>

</html>