<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
?>
<?
UserCheck('member');
if($_SESSION[Mid]) {
	
	$query = mysql_query("select * from member where mid = '".$_SESSION[Mid]."'");
	$row = mysql_fetch_assoc($query);

	$tmp = explode('-',$row[mpost]);
	$mpost1	 = $row[mpost];
	$mpost2	 = $tmp[1];
	$tmp = explode('|',$row[maddress]);
	$maddress1	 = $tmp[0];
	$maddress2	 = $tmp[1];
	$tmp = explode('-',$row[mphone]);
	$mphone1	 = $tmp[0];
	$mphone2	 = $tmp[1];
	$mphone3	 = $tmp[2];
	$tmp = explode('-',$row[mhp]);
	$mhp1	 = $tmp[0];
	$mhp2	 = $tmp[1];
	$mhp3	 = $tmp[2];

	$tmp = explode(' ',$row[mch]);
	$mch1	 = $tmp[0];
	$mch2	 = $tmp[1];
}
if($c){
	$data_subject = mysql_fetch_array(mysql_query("select * from subject where code2='$c' "));
	if($t=="type1"){
		$i_price1=$data_subject[type1_price];
		$i_price2=$data_subject[type1_price2];
	}else if($t=="type2"){
		$i_price1=$data_subject[type2_price];
		$i_price2=$data_subject[type2_price2];
	}else if($t=="type3"){
		$i_price1=$data_subject[type3_price];
		$i_price2=$data_subject[type3_price2];
	}else{
		$i_price1=$data_subject[type1_price];
		$i_price2=$data_subject[type1_price2];
	}
}
?>
<script type="text/javascript">
	function acount_submit(){
		var frm = document.cform;	

		if(document.getElementById("js_agree").checked==false){
			alert('������û �� ȯ�ұ����� Ȯ���� �ּ���.');
			return;
		}

		if(!frm.c.value){
			alert("�ڰ����� ������ �ּ���");
			frm.c.focus();
			return;
		}

		if(!frm.mname.value){
			alert("�̸��� �Է����ּ���");
			frm.mname.focus();
			return;
		}

		if(!frm.mphone1.value || !frm.mphone2.value || !frm.mphone3.value){
			alert("��ȭ��ȣ�� �Է����ּ���");		
			frm.mphone1.focus();
			return;
		}

		if(!frm.mhp1.value || !frm.mhp2.value || !frm.mhp3.value){
			alert("�޴���ȭ��ȣ�� �Է����ּ���");		
			frm.mhp1.focus();
			return;
		}
		frm.action="/inc/exc1.php";
		frm.submit();
	}
	function openPopup(ref) {
		window.open(ref,'InfoList2', 'width=550, height=450, resizable=no, scrollbars=no');
	}
	function pr_c(p1,p2){
		document.cform.price.value=p1;
		document.cform.sprice.value=p2;
		document.cform.tprice.value=p2;
		document.cform.pprice.value=p2;
		cal();
	}
	function cal(){
		<? if($data_point[point]>0){ ?>
		if(<?=$data_point[point]?><document.cform.point_use.value){
			document.cform.point_use.value=<?=$data_point[point]?>;
		}
		<? }else{ ?>
			document.cform.point_use.value=0;
		<? } ?>
		var rv=parseInt(removeC(document.cform.tprice.value))/2;
		if(document.cform.point_use.value>rv){
			document.cform.point_use.value=rv;
		}
		k=removeC(document.cform.tprice.value);
		document.cform.pprice.value=addComma(k-document.cform.point_use.value);
	}
	function addComma (str)
	{
	 var input_str = str.toString();

	 if (input_str == '') return false;
	 input_str = parseInt(input_str.replace(/[^0-9]/g, '')).toString();
	 if (isNaN(input_str)) { return false; }

	 var sliceChar = ',';
	 var step = 3;
	 var step_increment = -1;
	 var tmp  = '';
	 var retval = '';
	 var str_len = input_str.length;

	 for (var i=str_len; i>=0; i--)
	 {
	  tmp = input_str.charAt(i);
	  if (tmp == sliceChar) continue;
	  if (step_increment%step == 0 && step_increment != 0) retval = tmp + sliceChar + retval;
	  else retval = tmp + retval;
	  step_increment++;
	 }

	 return retval;
	}
		function removeC(a){
		  return a.replace(/,/g, "");
	}
	function cate(str,code){
		document.getElementById("HiddenFrm").src=str;
	}
</script>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
	function openDaumPostcode() {
       new daum.Postcode({
            oncomplete: function(data) {
                var fullAddr = ''; // ���� �ּ� ����
                var extraAddr = ''; // ������ �ּ� ����
                if (data.userSelectedType === 'R') { // ����ڰ� ���θ� �ּҸ� �������� ���
                    fullAddr = data.roadAddress;
                } else { // ����ڰ� ���� �ּҸ� �������� ���(J)
                    fullAddr = data.jibunAddress;
                }
                if(data.userSelectedType === 'R'){
                    //���������� ���� ��� �߰��Ѵ�.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }
				document.cform.mpost.value = data.zonecode;
				document.cform.maddress1.value = fullAddr;
				document.cform.maddress2.focus();
            }
        }).open();
    }
</script>

  <div class="content-container apply-class">
    <h2>������û</h2>
<form name="cform" method="post" style="margin:0px;" enctype='multipart/form-data' action="sub01.php" >
<input type="hidden" name="order" value="reg"><input type="hidden" name="lno" value="<?=$lno?>"><input type="hidden" name="lcode" value="<?=$data_subject[code2]?>">
<input type="hidden" name="rurl" value="<?=str_cut($reserv_url,230)."|".$reserv_keyword?>">
    <table class="table-default th-align-l">
      <colgroup>
        <col style="width: 100px;">
      </colgroup>
      <tbody>
        <tr>
          <th>��������</th>
          <td>
            <div class="select-certify">
              <select name="" id="" class="default-input" onchange="cate('/inc/select_cate.php?form=cform&target=c&code1='+this.value);">
                <option value="">����</option>
			<?
				$cr1=mysql_query("select * from config_category where CHAR_LENGTH(code)=2 order by code");
				while ($cd1 = mysql_fetch_assoc($cr1)){
			?>
              <option value="<?=$cd1[code]?>" <?=substr($c,0,2)==$cd1[code]?"selected":""?>><?=($cd1[name])?$cd1[name]:""?></option>
			<? } ?>
              </select>
              <select name="c" id="" class="default-input" onchange="document.cform.submit();">
                <option value="">��������</option>
              <option value="">:::��������:::</option>
			<?
				if($c){
					$cr1=mysql_query("select * from subject where code1='".substr($c,0,2)."' ");
					while ($cd1 = mysql_fetch_assoc($cr1)){
						$fetch_arr = cate($cd1[code2]);
			?>
              <option value="<?=$cd1[code2]?>" <?=$c==$cd1[code2]?"selected":""?>><?=$fetch_arr[1][name]?></option>
			<? }} ?>
              </select>
            </div>
          </td>
        </tr>
        <tr>
          <th>�����Ⱓ</th>
          <td>
            <div class="class-period">
<? if($data_subject[type1]!="1"){ ?>
              <label class="radio-wrap">
                <input type="radio" name="term1" <?=$t=="type1"||$t==""?"checked":""?> onclick="document.cform.price1.value='<?=number($data_subject[type1_price])?>';document.cform.price2.value='<?=number($data_subject[type1_price2])?>';document.getElementById('t_price').innerHTML='<?=number($data_subject[type1_price2])?>';">
                <span>�ܰ���(1����)</span>
              </label>
<? } ?>
<? if($data_subject[type2]!="1"){ ?>
              <label class="radio-wrap">
                <input type="radio" name="term1" <?=$t=="type2"?"checked":""?> onclick="document.cform.price1.value='<?=number($data_subject[type2_price])?>';document.cform.price2.value='<?=number($data_subject[type2_price2])?>';document.getElementById('t_price').innerHTML='<?=number($data_subject[type2_price2])?>';">
                <span>�ܱ��(6����)</span>
              </label>
<? } ?>
<? if($data_subject[type3]!="1"){ ?>
              <label class="radio-wrap">
                <input type="radio" name="term1" <?=$t=="type3"?"checked":""?> onclick="document.cform.price1.value='<?=number($data_subject[type3_price])?>';document.cform.price2.value='<?=number($data_subject[type3_price2])?>';document.getElementById('t_price').innerHTML='<?=number($data_subject[type3_price2])?>';">
                <span>���չ�(12����)</span>
              </label>
<? } ?>
            </div>
          </td>
        </tr>
        <tr>
          <th>�ݾ�</th>
          <td>
            <div class="price">
              <div class="input-wrap">
                <input type="text" maxlength="4" name="price1" id="" value="<?=$c?number($i_price1):""?>" class="default-input input-sm">
                ��
              </div>
              <span class="dash">
                -> 
              </span>
              <div class="input-wrap discounted">
                <input type="text" maxlength="4" name="price2" id="" value="<?=$c?number($i_price2):""?>" class="default-input input-sm">
                ��
              </div>
            </div>
            <p class="notice">
              <span class="notice-text">�� ���� �δ���Դϴ�.</span>
            </p>
          </td>
        </tr>
      </tbody>
    </table>

    <h4>������<span class="sub-text">(��ȭ��ȣ�� �ּҴ� ��Ȯ�� �����Ͽ� �ֽʽÿ�.)</span></h4>
    <table class="table-default th-align-l customer-info-basic">
      <colgroup>
        <col style="width: 100px;">
      </colgroup>
      <tbody>
        <tr>
          <th>�̸�</th>
          <td>
            <input type="text" name="mname" id="" class="default-input input-md" value="<?=$row[mname]?>">
          </td>
        </tr>
        <tr>
          <th>�̸���</th>
          <td>
            <input type="text" name="memail" id="" class="default-input input-md" value="<?=$row[memail]?>">
          </td>
        </tr>
        <tr>
          <th>�Ϲ���ȭ</th>
          <td>
            <div class="cell-phone">
              <div class="input-wrap">
                <input type="text" maxlength="4" name="mphone1" id="" class="default-input" value="<?=$mphone1?>">
              </div>
              <span class="dash">-</span>
              <div class="input-wrap">
                <input type="text" maxlength="4" name="mphone2" id="" class="default-input" value="<?=$mphone2?>">
              </div>
              <span class="dash">-</span>
              <div class="input-wrap">
                <input type="text" maxlength="4" name="mphone3" id="" class="default-input" value="<?=$mphone3?>">
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <th>�޴���ȭ</th>
          <td>
            <div class="cell-phone">
              <div class="input-wrap">
                <input type="text" maxlength="4" name="mhp1" id="" class="default-input" value="<?=$mhp1?>">
              </div>
              <span class="dash">-</span>
              <div class="input-wrap">
                <input type="text" maxlength="4" name="mhp2" id="" class="default-input" value="<?=$mhp2?>">
              </div>
              <span class="dash">-</span>
              <div class="input-wrap">
                <input type="text" maxlength="4" name="mhp3" id="" class="default-input" value="<?=$mhp3?>">
              </div>
            </div>
          </td>
        </tr>
        
        <tr>
          <th>�ּ�</th>
          <td>
            <div class="address-wrap">
              <div class="post-number">
                <input type="text" name="mpost" id="" class="default-input input-sm" value="<?=($mpost1)?$mpost1:""?>" onclick="openDaumPostcode();">
                <button type="button" class="btn btn-sm btn-primary btn-round" onclick="openDaumPostcode();">�����ȣ</button>
              </div>
              <div class="address">
                <input type="text" name="maddress1" id="" class="default-input input-md" value="<?=($maddress1)?$maddress1:""?>">
                <input type="text" name="maddress2" id="" class="default-input input-md" value="<?=($maddress2)?$maddress2:""?>">
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <table class="table-default th-align-l">
      <colgroup>
        <col style="width: 100px;">
      </colgroup>
      <tbody>
        <tr>
          <th>���ҹ��</th>
          <td>
            <div class="class-period">
              <label class="radio-wrap">
                <input type="radio" name='cmosm' value="1" checked>
                <span>�������Ա�</span>
              </label>
              <label class="radio-wrap">
                <input type="radio" name="cmosm" value="2">
                <span>�ſ�ī��</span>
              </label>
            </div>
          </td>
        </tr>
        <tr>
          <th>�����ݾ�</th>
          <td>
            <span id="t_price"><?=number($data_subject[type1_price2])?></span>��
          </td>
        </tr>
        <tr>
          <th>�������</th>
          <td>
            <ol class="order-list">
              <li>
                1. �ſ�ī������� �������Ǵ� �ڵ����� ��û�� �����մϴ�
              </li>
              <li>
                2. �������Ա��� ��� �Ա�Ȯ���� �� �Ŀ� �ڵ����� �������Ǵ� ��û�� �����մϴ�
              </li>
              <li>
                3. ����߼��� ��������� �Ա� �� 3~4�� �� ������ �����մϴ�
              </li>
            </ol>
          </td>
        </tr>
        <tr>
          <th>ȯ�ұ���</th>
          <td>
            <ol class="order-list">
              <li>
                1. ������û(�ԱݿϷ�) �� ȯ�ҽ�û�� 7�� �̳��� �Ͻø� �˴ϴ� 
              </li>
              <li>
                2. ����� ������ �� ȸ��,�ļյ��� ����� ��ǰ �� ȯ���� �Ұ��մϴ�
              </li>
              <li>
                3. ���� �߼��Ϸ� ���� 7���� ���� ���� ��ü�� ȯ���� �Ұ��մϴ�  
              </li>
              <li>
                4. ���� ���ɿ� ���� ��� �պ��ù��� 8,000���� �δ��ϼž� �մϴ�
              </li>
            </ol>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="term-text">
      ������ ������ڿ� ��������� �Կ� �־� ��� ü�� �� ������ ����Ͽ� �Ʒ����� ������ ������ �����Ͽ� ������û �ֿ� ���� �� ������û�ڰ� �δ��ϴ� ������ ���Ͽ� ����� ������  ��� ���� �Ͽ����� Ȯ�� �մϴ�.
    </div>

    <div class="contract">
      <div class="date">
        2023�� 1�� 30��
      </div>
      <div class="agree">
        <label class="checkbox-wrap">
          <input type="checkbox" name="level" id="js_agree">
          <span>������û �� ȯ�ұ����� Ȯ�� ��.</span>
        </label>
        <p>�� ���� ������ (��)</p>
      </div>
      <p class="notice-important">�� �� ����� ���� ��û ���� �Ϸ� �� ȿ���� �߻��Ǹ�, ���ʼ����� ���� ��Ȯ�Ρ�üũ�� ���� �մϴ�.</p>
    </div>

    <button type="button" class="btn btn-primary btn-lg btn-wide" onclick="acount_submit()">������û�Ϸ�</button>
 </form>   
  </div>


<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>

</html>