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
			alert('수강신청 및 환불규정을 확인해 주세요.');
			return;
		}

		if(!frm.c.value){
			alert("자격증을 선택해 주세요");
			frm.c.focus();
			return;
		}

		if(!frm.mname.value){
			alert("이름을 입력해주세요");
			frm.mname.focus();
			return;
		}

		if(!frm.mphone1.value || !frm.mphone2.value || !frm.mphone3.value){
			alert("전화번호를 입력해주세요");		
			frm.mphone1.focus();
			return;
		}

		if(!frm.mhp1.value || !frm.mhp2.value || !frm.mhp3.value){
			alert("휴대전화번호를 입력해주세요");		
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
                var fullAddr = ''; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    fullAddr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    fullAddr = data.jibunAddress;
                }
                if(data.userSelectedType === 'R'){
                    //법정동명이 있을 경우 추가한다.
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
    <h2>수강신청</h2>
<form name="cform" method="post" style="margin:0px;" enctype='multipart/form-data' action="sub01.php" >
<input type="hidden" name="order" value="reg"><input type="hidden" name="lno" value="<?=$lno?>"><input type="hidden" name="lcode" value="<?=$data_subject[code2]?>">
<input type="hidden" name="rurl" value="<?=str_cut($reserv_url,230)."|".$reserv_keyword?>">
    <table class="table-default th-align-l">
      <colgroup>
        <col style="width: 100px;">
      </colgroup>
      <tbody>
        <tr>
          <th>교육과목</th>
          <td>
            <div class="select-certify">
              <select name="" id="" class="default-input" onchange="cate('/inc/select_cate.php?form=cform&target=c&code1='+this.value);">
                <option value="">구분</option>
			<?
				$cr1=mysql_query("select * from config_category where CHAR_LENGTH(code)=2 order by code");
				while ($cd1 = mysql_fetch_assoc($cr1)){
			?>
              <option value="<?=$cd1[code]?>" <?=substr($c,0,2)==$cd1[code]?"selected":""?>><?=($cd1[name])?$cd1[name]:""?></option>
			<? } ?>
              </select>
              <select name="c" id="" class="default-input" onchange="document.cform.submit();">
                <option value="">교육선택</option>
              <option value="">:::교육선택:::</option>
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
          <th>수강기간</th>
          <td>
            <div class="class-period">
<? if($data_subject[type1]!="1"){ ?>
              <label class="radio-wrap">
                <input type="radio" name="term1" <?=$t=="type1"||$t==""?"checked":""?> onclick="document.cform.price1.value='<?=number($data_subject[type1_price])?>';document.cform.price2.value='<?=number($data_subject[type1_price2])?>';document.getElementById('t_price').innerHTML='<?=number($data_subject[type1_price2])?>';">
                <span>단과반(1개월)</span>
              </label>
<? } ?>
<? if($data_subject[type2]!="1"){ ?>
              <label class="radio-wrap">
                <input type="radio" name="term1" <?=$t=="type2"?"checked":""?> onclick="document.cform.price1.value='<?=number($data_subject[type2_price])?>';document.cform.price2.value='<?=number($data_subject[type2_price2])?>';document.getElementById('t_price').innerHTML='<?=number($data_subject[type2_price2])?>';">
                <span>단기반(6개월)</span>
              </label>
<? } ?>
<? if($data_subject[type3]!="1"){ ?>
              <label class="radio-wrap">
                <input type="radio" name="term1" <?=$t=="type3"?"checked":""?> onclick="document.cform.price1.value='<?=number($data_subject[type3_price])?>';document.cform.price2.value='<?=number($data_subject[type3_price2])?>';document.getElementById('t_price').innerHTML='<?=number($data_subject[type3_price2])?>';">
                <span>종합반(12개월)</span>
              </label>
<? } ?>
            </div>
          </td>
        </tr>
        <tr>
          <th>금액</th>
          <td>
            <div class="price">
              <div class="input-wrap">
                <input type="text" maxlength="4" name="price1" id="" value="<?=$c?number($i_price1):""?>" class="default-input input-sm">
                원
              </div>
              <span class="dash">
                -> 
              </span>
              <div class="input-wrap discounted">
                <input type="text" maxlength="4" name="price2" id="" value="<?=$c?number($i_price2):""?>" class="default-input input-sm">
                원
              </div>
            </div>
            <p class="notice">
              <span class="notice-text">※ 본인 부담금입니다.</span>
            </p>
          </td>
        </tr>
      </tbody>
    </table>

    <h4>고객정보<span class="sub-text">(전화번호와 주소는 정확히 기재하여 주십시오.)</span></h4>
    <table class="table-default th-align-l customer-info-basic">
      <colgroup>
        <col style="width: 100px;">
      </colgroup>
      <tbody>
        <tr>
          <th>이름</th>
          <td>
            <input type="text" name="mname" id="" class="default-input input-md" value="<?=$row[mname]?>">
          </td>
        </tr>
        <tr>
          <th>이메일</th>
          <td>
            <input type="text" name="memail" id="" class="default-input input-md" value="<?=$row[memail]?>">
          </td>
        </tr>
        <tr>
          <th>일반전화</th>
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
          <th>휴대전화</th>
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
          <th>주소</th>
          <td>
            <div class="address-wrap">
              <div class="post-number">
                <input type="text" name="mpost" id="" class="default-input input-sm" value="<?=($mpost1)?$mpost1:""?>" onclick="openDaumPostcode();">
                <button type="button" class="btn btn-sm btn-primary btn-round" onclick="openDaumPostcode();">우편번호</button>
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
          <th>지불방법</th>
          <td>
            <div class="class-period">
              <label class="radio-wrap">
                <input type="radio" name='cmosm' value="1" checked>
                <span>무통장입금</span>
              </label>
              <label class="radio-wrap">
                <input type="radio" name="cmosm" value="2">
                <span>신용카드</span>
              </label>
            </div>
          </td>
        </tr>
        <tr>
          <th>결제금액</th>
          <td>
            <span id="t_price"><?=number($data_subject[type1_price2])?></span>원
          </td>
        </tr>
        <tr>
          <th>참고사항</th>
          <td>
            <ol class="order-list">
              <li>
                1. 신용카드결제시 동영상강의는 자동으로 시청이 가능합니다
              </li>
              <li>
                2. 무통장입금인 경우 입금확인이 된 후에 자동으로 동영상강의는 시청이 가능합니다
              </li>
              <li>
                3. 교재발송은 평균적으로 입금 후 3~4일 내 수령이 가능합니다
              </li>
            </ol>
          </td>
        </tr>
        <tr>
          <th>환불규정</th>
          <td>
            <ol class="order-list">
              <li>
                1. 수강신청(입금완료) 후 환불신청은 7일 이내로 하시면 됩니다 
              </li>
              <li>
                2. 교재는 받으신 후 회손,파손등이 생길시 반품 및 환불이 불가합니다
              </li>
              <li>
                3. 교재 발송일로 부터 7일이 넘은 경우는 일체의 환불이 불가합니다  
              </li>
              <li>
                4. 고객의 변심에 의한 경우 왕복택배비용 8,000원을 부담하셔야 합니다
              </li>
            </ol>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="term-text">
      본인은 고시포코에 수강등록을 함에 있어 계약 체결 전 직원과 상담하여 아래에서 설명한 내용을 포함하여 수강신청 주요 내용 및 수강신청자가 부담하는 교육비에 대하여 충분히 설명을  듣고 이해 하였음을 확인 합니다.
    </div>

    <div class="contract">
      <div class="date">
        2023년 1월 30일
      </div>
      <div class="agree">
        <label class="checkbox-wrap">
          <input type="checkbox" name="level" id="js_agree">
          <span>수강신청 및 환불규정을 확인 함.</span>
        </label>
        <p>위 본인 정진용 (인)</p>
      </div>
      <p class="notice-important">※ 본 계약은 수강 신청 결제 완료 시 효력이 발생되며, 자필서명은 본인 ‘확인’체크로 갈음 합니다.</p>
    </div>

    <button type="button" class="btn btn-primary btn-lg btn-wide" onclick="acount_submit()">수강신청완료</button>
 </form>   
  </div>


<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>

</html>