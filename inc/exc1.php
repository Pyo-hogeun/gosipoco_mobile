<?
// ���� �Լ�
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
		$add[]="".$t_str."osm ='".$cmosm."'";if($cmosm==2)$add[]="".$t_str."osmt ='ī�����'";

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
			memo='".$lrow[0]."(".$cmono.") ����',
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
        /* �÷����� ��ġ(Ȯ��) */
        StartSmartUpdate();
        function  jsf__pay( form )
        {
            var RetVal = false;

            /* Payplus Plugin ���� */
            if ( MakePayMessage( form ) == true )
            {
                //openwin = window.open( "/kcp/sample/proc_win.html", "proc_win", "width=449, height=209, top=300, left=300" );
                RetVal = true ;
            }
            
            else
            {
                /*  res_cd�� res_msg������ �ش� �����ڵ�� �����޽����� �����˴ϴ�.
                    ex) ���� Payplus Plugin���� ��� ��ư Ŭ���� res_cd=3001, res_msg=����� ���
                    ���� �����˴ϴ�.
                */
                res_cd  = document.order_info.res_cd.value ;
                res_msg = document.order_info.res_msg.value ;

            }

            return RetVal ;
        }

        // Payplus Plug-in ��ġ �ȳ� 
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
                    /* =   1-1. ���� ���� ���� ����                                                 = */
                    /* = -------------------------------------------------------------------------- = */
                    /* =   ������ �ʿ��� ���� ���� ������ �����մϴ�.                               = */
                    /* =                                                                            = */
                    /* =  �ſ�ī�� : 100000000000, ������ü : 010000000000, ������� : 001000000000 = */
                    /* =  ����Ʈ   : 000100000000, �޴���   : 000010000000, ��ǰ��   : 000000001000 = */
                    /* =  ARS      : 000000000010                                                   = */
                    /* =                                                                            = */
                    /* =  ���� ���� ������ ��� PayPlus Plugin���� ������ ���������� ǥ�õ˴ϴ�.    = */
                    /* =  Payplug Plugin���� ���� ���������� ǥ���ϰ� ������ ��� �����Ͻ÷��� ���� = */
                    /* =  ���ܿ� �ش��ϴ� ��ġ�� �ش��ϴ� ���� 1�� �����Ͽ� �ֽʽÿ�.               = */
                    /* =                                                                            = */
                    /* =  ��) �ſ�ī��, ������ü, ������¸� ���ÿ� ǥ���ϰ��� �ϴ� ���            = */
                    /* =  pay_method = "111000000000"                                               = */
                    /* =  �ſ�ī��(100000000000), ������ü(010000000000), �������(001000000000)��  = */
                    /* =  �ش��ϴ� ���� ��� �����ָ� �˴ϴ�.                                       = */
                    /* =                                                                            = */
                    /* = �� �ʼ�                                                                    = */
                    /* =  KCP�� ��û�� �����������θ� ������ �����մϴ�.                            = */
                    /* = -------------------------------------------------------------------------- = */
?>
                    <tr>
                        <th>���� ���</th>
                        <td><input name="pay_method" value="100000000000">
                        </td>
                    </tr>
                    <!-- �ֹ���ȣ(ordr_idxx) -->
                    <tr>
                        <th>�ֹ� ��ȣ</th>
                        <td><input type="text" name="ordr_idxx" class="w200" value="<?=$cmono?>" maxlength="40"/></td>
                    </tr>
                    <!-- ��ǰ��(good_name) -->
                    <tr>
                        <th>��ǰ��</th>
                        <td><input type="text" name="good_name" class="w100" value="������û"/></td>
                    </tr>
                    <!-- �����ݾ�(good_mny) - �� �ʼ� : �� ������ ,(�޸�)�� ������ ���ڸ� �Է��Ͽ� �ֽʽÿ�. -->
                    <tr>
                        <th>���� �ݾ�</th>
                        <td><input type="text" name="good_mny" class="w100" value="<?=str_replace(",","",$tprice)?>" maxlength="9"/>��(���ڸ� �Է�)</td>
                    </tr>
                    <!-- �ֹ��ڸ�(buyr_name) -->
                    <tr>
                        <th>�ֹ��ڸ�</th>
                        <td><input type="text" name="buyr_name" class="w100" value="<?=$mname?>"/></td>
                    </tr>
                    <!-- �ֹ��� E-mail(buyr_mail) -->
                    <tr>
                        <th>E-mail</th>
                        <td><input type="text" name="buyr_mail" class="w200" value="<?=$memail?>" maxlength="30" /></td>
                    </tr>
                    <!-- �ֹ��� ����ó1(buyr_tel1) -->
                    <tr>
                        <th>��ȭ��ȣ</th>
                        <td><input type="text" name="buyr_tel1" class="w100" value="<?=$mphone1."-".$mphone2."-".$mphone3?>"/></td>
                    </tr>
                    <!-- �޴�����ȣ(buyr_tel2) -->
                    <tr>
                        <th>�޴�����ȣ</th>
                        <td><input type="text" name="buyr_tel2" class="w100" value="<?=$mhp1."-".$mhp2."-".$mhp3?>"/></td>
                    </tr>
                    </table>

                    <!-- ���� ��û/ó������ �̹��� -->
                    <div class="btnset" id="display_pay_button" style="display:block">
                      <input name="" type="submit" class="submit" value="������û" onclick="return jsf__pay(this.form);"/>
                      <a href="../index.html" class="home">ó������</a>
                    </div>
                    <!-- Payplus Plug-in ��ġ �ȳ� -->
                    <div id="display_setup_message" style="display:none">
                       <p class="txt">
                       ������ ��� �Ͻ÷��� ����� ����� ǥ������ Ŭ�� �Ͻðų� <a href="http://pay.kcp.co.kr/plugin_new/file/KCPUXWizard.exe"><span>[������ġ]</span></a>�� ����
                       Payplus Plug-in�� ��ġ�Ͻñ� �ٶ��ϴ�.
                       [������ġ]�� ���� ��ġ�Ͻ� ��� ���ΰ�ħ(F5)Ű�� ���� �����Ͻñ� �ٶ��ϴ�.
                       </p>
                     </div>
                   </div>
                  <div class="footer">
                    Copyright (c) KCP INC. All Rights reserved.
                  </div>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   1. �ֹ� ���� �Է� END                                                    = */
    /* ============================================================================== */
?>

<?
    /* ============================================================================== */
    /* =   2. ������ �ʼ� ���� ����                                                 = */
    /* = -------------------------------------------------------------------------- = */
    /* =   �� �ʼ� - ������ �ݵ�� �ʿ��� �����Դϴ�.                               = */
    /* =   site_conf_inc.php ������ �����ϼż� �����Ͻñ� �ٶ��ϴ�.                 = */
    /* = -------------------------------------------------------------------------- = */
    // ��û���� : ����(pay)/���,����(mod) ��û�� ���
?>
    <input type="hidden" name="req_tx"          value="pay" />
    <input type="hidden" name="site_cd"         value="<?=$g_conf_site_cd	?>" />
    <input type="hidden" name="site_name"       value="<?=$g_conf_site_name ?>" />

<?
    /*
    �Һοɼ� : Payplus Plug-in���� ī������� �ִ�� ǥ���� �Һΰ��� ���� �����մϴ�.(0 ~ 18 ���� ���� ����)
    �� ����  - �Һ� ������ �����ݾ��� 50,000�� �̻��� ��쿡�� ����, 50000�� �̸��� �ݾ��� �Ͻúҷθ� ǥ��˴ϴ�
               ��) value ���� "5" �� �������� ��� => ī������� ����â�� �ϽúҺ��� 5�������� ���ð���
    */
?>
    <input type="hidden" name="quotaopt"        value="12"/>
    
	<!-- �ʼ� �׸� : ���� �ݾ�/ȭ����� -->
    <input type="hidden" name="currency"        value="WON"/>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   2. ������ �ʼ� ���� ���� END                                             = */
    /* ============================================================================== */
?>

<?
    /* ============================================================================== */
    /* =   3. Payplus Plugin �ʼ� ����(���� �Ұ�)                                   = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ������ �ʿ��� �ֹ� ������ �Է� �� �����մϴ�.                            = */
    /* = -------------------------------------------------------------------------- = */
?>
    <!-- PLUGIN ���� �����Դϴ�(���� �Ұ�) -->
    <input type="hidden" name="module_type"     value="<?=$module_type ?>"/>
<!--
      �� �� ��
          �ʼ� �׸� : Payplus Plugin���� ���� �����ϴ� �κ����� �ݵ�� ���ԵǾ�� �մϴ�
          ���� �������� ���ʽÿ�
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

    <!--  ���ݿ����� ���� ���� : Payplus Plugin ���� �����ϴ� �����Դϴ� -->
    <input type="hidden" name="cash_tsdtime"    value=""/>
    <input type="hidden" name="cash_yn"         value=""/>
    <input type="hidden" name="cash_authno"     value=""/>
    <input type="hidden" name="cash_tr_code"    value=""/>
    <input type="hidden" name="cash_id_info"    value=""/>

	<!-- 2012�� 8�� 18�� ���ڻ�ŷ��� ���� ���� ���� �κ� -->
	<!-- ���� �Ⱓ ���� 0:��ȸ�� 1:�Ⱓ����(ex 1:2012010120120131)  -->
	<input type="hidden" name="good_expr" value="0">

	<!-- ���������� �����ϴ� �� ���̵� ������ �ؾ� �մϴ�.(�ʼ� ����) -->
	<input type="hidden" name="shop_user_id"    value="<?=$data[mUser]?>"/>
	<!-- ��������Ʈ ������ �������� �Ҵ�Ǿ��� �ڵ� ���� �Է��ؾ��մϴ�.(�ʼ� ����) -->
    <input type="hidden" name="pt_memcorp_cd"   value=""/>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   3. Payplus Plugin �ʼ� ���� END                                          = */
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
	    $bank="ī�����";
		$add[]="cmostatus ='2'";$add[]="cmoadate ='".time()."'";
//		$add[]="sdate ='now()'";

		for($i=0;$i<sizeof($add);$i++){
			if($i) $proc_list.=",$add[$i]";
			else $proc_list=$add[$i];
		}

		$data_order=mysql_fetch_array(mysql_query("select * from $tb_name where cmono='$ordr_idxx' "));

		$sms_b=str_replace("(����)",$data_order[cmoname],$data_sms[sms_3]);
?>
<iframe name="smsform" style="display:none;"></iframe>
<form method="post" name="sendsms" action="http://cpsms.skysms.co.kr/cpsms/cp_sms_send.php" target="smsform" style="display:none;">
<input type="hidden" name="cpuserid" value="<?=$data_sms[sms_id]?>">
<input type="hidden" name="passwd" value="<?=$data_sms[sms_pass]?>">
<input type="hidden" name="destination" value="<?=$data_order[cmohp]?>">
<input type="hidden" name="callback" value="<?=$data_sms[sms_1]?>">
<textarea name="body" ><?=$sms_b?></textarea>
<input type="hidden" name="reserve_date" value=""> <!-- ���������� ���, �����Ͻø� �Է��ϼ���. -->
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

		echo '<SCRIPT LANGUAGE="JavaScript">alert("�ֹ��� �Ϸ� �Ǿ����ϴ�.");</SCRIPT>';
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

		$sms_b=str_replace("(����)",$data_order[cmoname],$data_sms[sms_4]);
?>
<iframe name="smsform" style="display:none;"></iframe>
<form method="post" name="sendsms" action="http://cpsms.skysms.co.kr/cpsms/cp_sms_send.php" target="smsform">
<input type="hidden" name="cpuserid" value="<?=$data_sms[sms_id]?>">
<input type="hidden" name="passwd" value="<?=$data_sms[sms_pass]?>">
<input type="hidden" name="destination" value="<?=$data_order[cmohp]?>">
<input type="hidden" name="callback" value="<?=$data_sms[sms_1]?>">
<textarea name="body" ><?=$sms_b?></textarea>
<input type="hidden" name="reserve_date" value=""> <!-- ���������� ���, �����Ͻø� �Է��ϼ���. -->
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
		
		echo '<SCRIPT LANGUAGE="JavaScript">alert("�ֹ��� �Ϸ� �Ǿ����ϴ�.");</SCRIPT>';
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