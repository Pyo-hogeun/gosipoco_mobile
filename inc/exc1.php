<?
// 공통 함수
include_once $_SERVER['DOCUMENT_ROOT']."/libraries/Function.inc.lib.php";
include_once $_SERVER['DOCUMENT_ROOT']."/libraries/DB_connect.inc.lib.php";
$connect = dbconn();
?>
<script>
	function openPopup(ref) {
		window.open(ref,'InfoList2', 'width=550, height=450, resizable=no, scrollbars=no');
	}
</script>

<?
$data_sms=mysql_fetch_array(mysql_query("select * from config_admin"));

$tb_name = "cmorder";
if($order=="reg"){	
$s_str = "M";$t_str = "cm";$t_str1 = "m";	
while(1){
	$cmono = $s_str.code_create();
	$confirm_arr = qrow("select idx from ".$t_str."order where ".$t_str."ono = '$cmono'");
	if($confirm_arr[0]){unset($confirm_arr);}else break;
}

		$lrow = qrow("select name from config_category where code='$lcode'");
		$srow = qassoc("select * from subject where code2='$lcode'");
		$term2=$srow[$term1."_term"];
		$forder="/".$lrow[1];
		$add[]="lcode ='".$lcode."'";$add[]="lname ='".$lrow[0]."'";
		$add[]="term1='$term1'";$add[]="term2='$term2'";
		$add[]="mid ='".$_SESSION[Mid]."'";$add[]="midx ='".$_SESSION[Mno]."'";$add[]="".$t_str."ono ='".$cmono."'";
		$add[]="".$t_str."osprice ='".str_replace(",","",$price2)."'";$add[]="".$t_str."ooprice ='".str_replace(",","",$price1)."'";
		//$add[]="cmopoint='$point_use'";$add[]="cmopay='".str_replace(",","",$tprice)."'";
		$add[]="".$t_str."osm ='".$cmosm."'";if($cmosm==2)$add[]="".$t_str."osmt ='카드결제'";

		$add[]="".$t_str."oname ='".$mname."'";$add[]="".$t_str."ophone ='".$mphone1."-".$mphone2."-".$mphone3."'";
		$add[]="".$t_str."ohp ='".$mhp1."-".$mhp2."-".$mhp3."'";$add[]="".$t_str."opost ='".$mpost."'";
		$add[]="".$t_str."oaddress ='".$maddress1."|".$maddress2."'";$add[]="".$t_str."oemail ='".$memail."'";
		$add[]="".$t_str."ostatus ='1'";
		$add[]="".$t_str."oip ='".$REMOTE_ADDR."'";$add[]="".$t_str."orurl ='".$rurl."'";$add[]="".$t_str."oregdate ='".time()."'";
		$add[]="cmocontents='".$cmocontents1."|".$cmocontents2."|".$cmocontents3."'";

		for($i=0;$i<sizeof($add);$i++){
			if($i) $proc_list.=",$add[$i]";
			else $proc_list=$add[$i];
		}

		if($point_use>0){
			$outpoint=str_replace(",","",$point_use);
			$data_point=qassoc("select * from member_point where mid='".$_SESSION[Mid]."' order by idx desc ");
			$point=$data_point[point]-$outpoint;
			$query="insert into member_point set 
			mid='".$_SESSION[Mid]."',
			type='2', 
			memo='".$lrow[0]."(".$cmono.") 결제',
			outpoint='$outpoint',
			point='$point',
			regdate=now()
			";
			mysql_query($query);
		}
		

		$sql="insert into $tb_name set $proc_list";
		//exit($sql);
		$res = mysql_query($sql,$connect) or die(mysql_error());
		if(1){
			$gopage = "/";
?>
		<script>
				parent.document.location.href=('<?=$gopage?><?=$href?><?=$bookm?>');
		</script>
<?
			exit;
		}else{
			$mobileBrower = '/(iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)/';
			if(preg_match($mobileBrower, $_SERVER['HTTP_USER_AGENT'])) {
				echo "<script>parent.location.href='/kcp_new/mobile_sample/basket_mobile.php?cmono=".$data_card[idx]."';</script>";
				exit;
			}

		    include $_SERVER['DOCUMENT_ROOT']."/kcp_new/cfg/site_conf_inc.php";
?>
    <script type="text/javascript" src='<?=$g_conf_js_url?>'></script>
    <script type="text/javascript">
        /* 플러그인 설치(확인) */
        StartSmartUpdate();
        function  jsf__pay( form )
        {
            var RetVal = false;

            /* Payplus Plugin 실행 */
            if ( MakePayMessage( form ) == true )
            {
                //openwin = window.open( "/kcp/sample/proc_win.html", "proc_win", "width=449, height=209, top=300, left=300" );
                RetVal = true ;
            }
            
            else
            {
                /*  res_cd와 res_msg변수에 해당 오류코드와 오류메시지가 설정됩니다.
                    ex) 고객이 Payplus Plugin에서 취소 버튼 클릭시 res_cd=3001, res_msg=사용자 취소
                    값이 설정됩니다.
                */
                res_cd  = document.order_info.res_cd.value ;
                res_msg = document.order_info.res_msg.value ;

            }

            return RetVal ;
        }

        // Payplus Plug-in 설치 안내 
        function init_pay_button()
        {
            if ((navigator.userAgent.indexOf('MSIE') > 0) || (navigator.userAgent.indexOf('Trident/7.0') > 0))
            {
                try
                {
                    if( document.Payplus.object == null )
                    {
                        document.getElementById("display_setup_message").style.display = "block" ;
                    }
                    else{
                        document.getElementById("display_pay_button").style.display = "block" ;
                    }
                }
                catch (e)
                {
                    document.getElementById("display_setup_message").style.display = "block" ;
                }
            }
            else
            {
                try
                {
                    if( Payplus == null )
                    {
                        document.getElementById("display_setup_message").style.display = "block" ;
                    }
                    else{
                        document.getElementById("display_pay_button").style.display = "block" ;
                    }
                }
                catch (e)
                {
                    document.getElementById("display_setup_message").style.display = "block" ;
                }
            }
        }

        function onload_pay()
        {
             if( jsf__pay(document.order_info) )
                document.order_info.submit();
        }
    </script>
<form name="order_info" method="post" action="../kcp_new/sample/pp_cli_hub6.php" >

                    <div class="sample">
                    <table class="tbl" cellpadding="0" cellspacing="0">
<?
                    /* ============================================================================== */
                    /* =   1-1. 결제 수단 정보 설정                                                 = */
                    /* = -------------------------------------------------------------------------- = */
                    /* =   결제에 필요한 결제 수단 정보를 설정합니다.                               = */
                    /* =                                                                            = */
                    /* =  신용카드 : 100000000000, 계좌이체 : 010000000000, 가상계좌 : 001000000000 = */
                    /* =  포인트   : 000100000000, 휴대폰   : 000010000000, 상품권   : 000000001000 = */
                    /* =  ARS      : 000000000010                                                   = */
                    /* =                                                                            = */
                    /* =  위와 같이 설정한 경우 PayPlus Plugin에서 설정한 결제수단이 표시됩니다.    = */
                    /* =  Payplug Plugin에서 여러 결제수단을 표시하고 싶으신 경우 설정하시려는 결제 = */
                    /* =  수단에 해당하는 위치에 해당하는 값을 1로 변경하여 주십시오.               = */
                    /* =                                                                            = */
                    /* =  예) 신용카드, 계좌이체, 가상계좌를 동시에 표시하고자 하는 경우            = */
                    /* =  pay_method = "111000000000"                                               = */
                    /* =  신용카드(100000000000), 계좌이체(010000000000), 가상계좌(001000000000)에  = */
                    /* =  해당하는 값을 모두 더해주면 됩니다.                                       = */
                    /* =                                                                            = */
                    /* = ※ 필수                                                                    = */
                    /* =  KCP에 신청된 결제수단으로만 결제가 가능합니다.                            = */
                    /* = -------------------------------------------------------------------------- = */
?>
                    <tr>
                        <th>지불 방법</th>
                        <td><input name="pay_method" value="100000000000">
                        </td>
                    </tr>
                    <!-- 주문번호(ordr_idxx) -->
                    <tr>
                        <th>주문 번호</th>
                        <td><input type="text" name="ordr_idxx" class="w200" value="<?=$cmono?>" maxlength="40"/></td>
                    </tr>
                    <!-- 상품명(good_name) -->
                    <tr>
                        <th>상품명</th>
                        <td><input type="text" name="good_name" class="w100" value="수강신청"/></td>
                    </tr>
                    <!-- 결제금액(good_mny) - ※ 필수 : 값 설정시 ,(콤마)를 제외한 숫자만 입력하여 주십시오. -->
                    <tr>
                        <th>결제 금액</th>
                        <td><input type="text" name="good_mny" class="w100" value="<?=str_replace(",","",$tprice)?>" maxlength="9"/>원(숫자만 입력)</td>
                    </tr>
                    <!-- 주문자명(buyr_name) -->
                    <tr>
                        <th>주문자명</th>
                        <td><input type="text" name="buyr_name" class="w100" value="<?=$mname?>"/></td>
                    </tr>
                    <!-- 주문자 E-mail(buyr_mail) -->
                    <tr>
                        <th>E-mail</th>
                        <td><input type="text" name="buyr_mail" class="w200" value="<?=$memail?>" maxlength="30" /></td>
                    </tr>
                    <!-- 주문자 연락처1(buyr_tel1) -->
                    <tr>
                        <th>전화번호</th>
                        <td><input type="text" name="buyr_tel1" class="w100" value="<?=$mphone1."-".$mphone2."-".$mphone3?>"/></td>
                    </tr>
                    <!-- 휴대폰번호(buyr_tel2) -->
                    <tr>
                        <th>휴대폰번호</th>
                        <td><input type="text" name="buyr_tel2" class="w100" value="<?=$mhp1."-".$mhp2."-".$mhp3?>"/></td>
                    </tr>
                    </table>

                    <!-- 결제 요청/처음으로 이미지 -->
                    <div class="btnset" id="display_pay_button" style="display:block">
                      <input name="" type="submit" class="submit" value="결제요청" onclick="return jsf__pay(this.form);"/>
                      <a href="../index.html" class="home">처음으로</a>
                    </div>
                    <!-- Payplus Plug-in 설치 안내 -->
                    <div id="display_setup_message" style="display:none">
                       <p class="txt">
                       결제를 계속 하시려면 상단의 노란색 표시줄을 클릭 하시거나 <a href="http://pay.kcp.co.kr/plugin_new/file/KCPUXWizard.exe"><span>[수동설치]</span></a>를 눌러
                       Payplus Plug-in을 설치하시기 바랍니다.
                       [수동설치]를 눌러 설치하신 경우 새로고침(F5)키를 눌러 진행하시기 바랍니다.
                       </p>
                     </div>
                   </div>
                  <div class="footer">
                    Copyright (c) KCP INC. All Rights reserved.
                  </div>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   1. 주문 정보 입력 END                                                    = */
    /* ============================================================================== */
?>

<?
    /* ============================================================================== */
    /* =   2. 가맹점 필수 정보 설정                                                 = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ※ 필수 - 결제에 반드시 필요한 정보입니다.                               = */
    /* =   site_conf_inc.php 파일을 참고하셔서 수정하시기 바랍니다.                 = */
    /* = -------------------------------------------------------------------------- = */
    // 요청종류 : 승인(pay)/취소,매입(mod) 요청시 사용
?>
    <input type="hidden" name="req_tx"          value="pay" />
    <input type="hidden" name="site_cd"         value="<?=$g_conf_site_cd	?>" />
    <input type="hidden" name="site_name"       value="<?=$g_conf_site_name ?>" />

<?
    /*
    할부옵션 : Payplus Plug-in에서 카드결제시 최대로 표시할 할부개월 수를 설정합니다.(0 ~ 18 까지 설정 가능)
    ※ 주의  - 할부 선택은 결제금액이 50,000원 이상일 경우에만 가능, 50000원 미만의 금액은 일시불로만 표기됩니다
               예) value 값을 "5" 로 설정했을 경우 => 카드결제시 결제창에 일시불부터 5개월까지 선택가능
    */
?>
    <input type="hidden" name="quotaopt"        value="12"/>
    
	<!-- 필수 항목 : 결제 금액/화폐단위 -->
    <input type="hidden" name="currency"        value="WON"/>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   2. 가맹점 필수 정보 설정 END                                             = */
    /* ============================================================================== */
?>

<?
    /* ============================================================================== */
    /* =   3. Payplus Plugin 필수 정보(변경 불가)                                   = */
    /* = -------------------------------------------------------------------------- = */
    /* =   결제에 필요한 주문 정보를 입력 및 설정합니다.                            = */
    /* = -------------------------------------------------------------------------- = */
?>
    <!-- PLUGIN 설정 정보입니다(변경 불가) -->
    <input type="hidden" name="module_type"     value="<?=$module_type ?>"/>
<!--
      ※ 필 수
          필수 항목 : Payplus Plugin에서 값을 설정하는 부분으로 반드시 포함되어야 합니다
          값을 설정하지 마십시오
-->
    <input type="hidden" name="res_cd"          value=""/>
    <input type="hidden" name="res_msg"         value=""/>
    <input type="hidden" name="tno"             value=""/>
    <input type="hidden" name="trace_no"        value=""/>
    <input type="hidden" name="enc_info"        value=""/>
    <input type="hidden" name="enc_data"        value=""/>
    <input type="hidden" name="ret_pay_method"  value=""/>
    <input type="hidden" name="tran_cd"         value=""/>
    <input type="hidden" name="bank_name"       value=""/>
    <input type="hidden" name="bank_issu"       value=""/>
    <input type="hidden" name="use_pay_method"  value=""/>

    <!--  현금영수증 관련 정보 : Payplus Plugin 에서 설정하는 정보입니다 -->
    <input type="hidden" name="cash_tsdtime"    value=""/>
    <input type="hidden" name="cash_yn"         value=""/>
    <input type="hidden" name="cash_authno"     value=""/>
    <input type="hidden" name="cash_tr_code"    value=""/>
    <input type="hidden" name="cash_id_info"    value=""/>

	<!-- 2012년 8월 18일 전자상거래법 개정 관련 설정 부분 -->
	<!-- 제공 기간 설정 0:일회성 1:기간설정(ex 1:2012010120120131)  -->
	<input type="hidden" name="good_expr" value="0">

	<!-- 가맹점에서 관리하는 고객 아이디 설정을 해야 합니다.(필수 설정) -->
	<input type="hidden" name="shop_user_id"    value="<?=$data[mUser]?>"/>
	<!-- 복지포인트 결제시 가맹점에 할당되어진 코드 값을 입력해야합니다.(필수 설정) -->
    <input type="hidden" name="pt_memcorp_cd"   value=""/>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   3. Payplus Plugin 필수 정보 END                                          = */
    /* ============================================================================== */
?>
</form>
<script>
onload_pay();
</script>
<?

			exit;
		}
}

if($res_cd=="0000") {
	    $bank="카드결제";
		$add[]="cmostatus ='2'";$add[]="cmoadate ='".time()."'";
//		$add[]="sdate ='now()'";

		for($i=0;$i<sizeof($add);$i++){
			if($i) $proc_list.=",$add[$i]";
			else $proc_list=$add[$i];
		}

		$data_order=mysql_fetch_array(mysql_query("select * from $tb_name where cmono='$ordr_idxx' "));

		$sms_b=str_replace("(수신)",$data_order[cmoname],$data_sms[sms_3]);
?>
<iframe name="smsform" style="display:none;"></iframe>
<form method="post" name="sendsms" action="http://cpsms.skysms.co.kr/cpsms/cp_sms_send.php" target="smsform" style="display:none;">
<input type="hidden" name="cpuserid" value="<?=$data_sms[sms_id]?>">
<input type="hidden" name="passwd" value="<?=$data_sms[sms_pass]?>">
<input type="hidden" name="destination" value="<?=$data_order[cmohp]?>">
<input type="hidden" name="callback" value="<?=$data_sms[sms_1]?>">
<textarea name="body" ><?=$sms_b?></textarea>
<input type="hidden" name="reserve_date" value=""> <!-- 예약전송일 경우, 전송일시를 입력하세요. -->
<input type="hidden" name="return_url" value="http://<?=$_SERVER['SERVER_NAME']?>/<?=$gopage?><?=$href?><?=$bookm?>">
<input type="hidden" name="cpdata1" value="">
<input type="hidden" name="cpdata2" value="">
<input type="hidden" name="cpdata3" value="">
</form>

<SCRIPT LANGUAGE="JavaScript">
document.sendsms.submit();
</SCRIPT>
<?
		
		$sql="update $tb_name set $proc_list where cmono='$ordr_idxx'";
		//exit($sql);
		$res = mysql_query($sql,$connect) or die(mysql_error());

		$qry = "select * from member where mid='$_SESSION[Mid]'";
		$res = mysql_query($qry);
		$data_m=mysql_fetch_array($res);
		if($data_m[mlevel]>70){
			qresult("update member set mlevel='70', mleveldate=".time()." where mid='$_SESSION[Mid]'");
		}

		echo '<SCRIPT LANGUAGE="JavaScript">alert("주문이 완료 되었습니다.");</SCRIPT>';
			//mail process
			$process="order";
			//include_once "../mail/mailsend.php";
		$gopage = "/mypage/";
?>
		<script>
				top.document.location.href=('<?=$gopage?><?=$href?><?=$bookm?>');
		</script>
<?
		exit;
}
if($order=="finish") {
		$add[]="cmosmt ='".$bank."'";$add[]="cmoaname ='".$cmoaname."'";$add[]="cmoadate ='".time()."'";
		for($i=0;$i<sizeof($add);$i++){
			if($i) $proc_list.=",$add[$i]";
			else $proc_list=$add[$i];
		}

		$data_order=mysql_fetch_array(mysql_query("select * from $tb_name where cmono='$ono' "));

		$sms_b=str_replace("(수신)",$data_order[cmoname],$data_sms[sms_4]);
?>
<iframe name="smsform" style="display:none;"></iframe>
<form method="post" name="sendsms" action="http://cpsms.skysms.co.kr/cpsms/cp_sms_send.php" target="smsform">
<input type="hidden" name="cpuserid" value="<?=$data_sms[sms_id]?>">
<input type="hidden" name="passwd" value="<?=$data_sms[sms_pass]?>">
<input type="hidden" name="destination" value="<?=$data_order[cmohp]?>">
<input type="hidden" name="callback" value="<?=$data_sms[sms_1]?>">
<textarea name="body" ><?=$sms_b?></textarea>
<input type="hidden" name="reserve_date" value=""> <!-- 예약전송일 경우, 전송일시를 입력하세요. -->
<input type="hidden" name="return_url" value="http://<?=$_SERVER['SERVER_NAME']?>/<?=$gopage?><?=$href?><?=$bookm?>">
<input type="hidden" name="cpdata1" value="">
<input type="hidden" name="cpdata2" value="">
<input type="hidden" name="cpdata3" value="">
</form>

<SCRIPT LANGUAGE="JavaScript">
document.sendsms.submit();
</SCRIPT>
<?
		
		$sql="update $tb_name set $proc_list where cmono='$ono'";
		//exit($sql);
		$res = mysql_query($sql,$connect) or die(mysql_error());
		
		echo '<SCRIPT LANGUAGE="JavaScript">alert("주문이 완료 되었습니다.");</SCRIPT>';
			//mail process
			$process="order";
			//include_once "../mail/mailsend.php";
		$gopage = "/mypage/";
?>
		<script>
				top.document.location.href=('<?=$gopage?><?=$href?><?=$bookm?>');
		</script>
<?
}
dbclose();
?>
<script>
		document.location.href=('<?=$gopage?><?=$href?><?=$bookm?>');
</script>