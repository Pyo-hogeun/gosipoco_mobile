<?
// ���� �Լ�
include_once $_SERVER['DOCUMENT_ROOT']."/libraries/Function.inc.lib.php";
include_once $_SERVER['DOCUMENT_ROOT']."/libraries/DB_connect.inc.lib.php";
$connect = dbconn();
/*****************config setting***************/
$Config = qassoc("select * from config_admin where idx='1'");
$astr = 'config_';
/*****************config setting***************/
// ���� �迭 ����
include_once $_SERVER['DOCUMENT_ROOT']."/libraries/Code.inc.lib.php";
?>
<html lang="ko">

<head>
  <meta charset="euc-kr">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>�������</title>
  <link rel="stylesheet" href="/inc/style/style_mobile.css">
  <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
  <script src="/inc/script/script.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</head>

<body>
<iframe name="HiddenFrm" id="HiddenFrm" style="display:none;"></iframe>
  <div class="gnb">
    <div class="prefix">
      <a href="javascript:void(0)" onclick="openMenu();" class="btn-menu">
        <span class="icon-hamburger"></span>
      </a>
    </div>
    <div class="center">
      <a href="/" class="go-home">
        <img src="../image/logo.png" alt="">
      </a>
    </div>
    <div class="suffix">
	<? if($_SESSION[Mid]){ ?>
      <a href="/login/exc1.php?member=logout" class="btn-login">
        <span class="icon-login"></span>
        �α׾ƿ�
      </a>
	<? }else{ ?>
      <a href="/login/login.php" class="btn-login">
        <span class="icon-login"></span>
        �α���
      </a>
	<? } ?>
    </div>
  </div>
  <div class="nav">
    <ul>
      <li><a href="/menu01/sub04.php">��������</a></li>
      <li><a href="/menu02/sub01.php">������û</a></li>
      <li><a href="/menu04/sub01.php">���ð���</a></li>
      <li><a href="/menu05/sub01.php">���Ǻ���</a></li>
    </ul>
  </div>
  <div class="all-menu">
    <div class="header">
      <img src="../image/icon_logo_menu.png" alt="������� �ΰ�" class="logo-menu">
      <span class="user">
	  <? if($_SESSION[Mid]){ echo $_SESSION[Mname]."��"; } ?>
	  </span>
      <a href="javascript:void(0);" onclick="closeMenu()" class="btn-close">
        <span class="icon-close"></span>
      </a>
    </div>
    <div class="links">
      <ul>
        <li>
		<? if($_SESSION[Mid]){ ?>
		<a href="/mypage/member_info.php">ȸ������</a>
		<? }else{ ?>
		<a href="/login/join.php">ȸ������</a>
		<? } ?>
		</li>
        <li>
		<? if($_SESSION[Mid]){ ?>
		<a href="/login/exc1.php?member=logout">�α׾ƿ�</a>
		<? }else{ ?>
		<a href="/login/login.php">�α���</a>
		<? } ?>
		</li>
      </ul>
    </div>
    <div class="menu">
      <ul>
        <li><a href="/menu01/sub01.php">��������</a></li>
        <li><a href="/menu02/sub01.php">������û</a></li>
        <li><a href="/menu04/sub01.php">���ð���</a></li>
        <li><a href="/menu05/sub01.php">���Ǻ���</a></li>
        <li><a href="/menu06/sub01.php">������</a></li>
        <!--li><a href="">1:1���</a></li-->
		<? if(!$_SESSION[Mid]){ ?>
        <li><a href="/login/find_id.php">���̵�ã��</a></li>
		<? } ?>
      </ul>
    </div>

    <div class="cs-number">
      �����: 1544-7125
    </div>
  </div>
