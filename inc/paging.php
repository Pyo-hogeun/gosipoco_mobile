<?
	// ù��° ��Ͽ� ���� ��ũ
	if($block > 1 && $tblock>2) {
	   echo "<a href=\"$PHP_SELF?$qcommon&page=1\" class=\"to-first\"></a>";
	} 


	// ������Ͽ� ���� ��ũ
	if($block > 1) {
		$imsi=$page;
	   $page = $first_page;
	   echo "<a href=\"$PHP_SELF?$qcommon&page=$page\" class=\"prev\"></a>";
	   $page=$imsi;
	} 

	// �������̵�(��ϳ�)

	for($direct_page = $first_page+1; $direct_page <= $last_page; $direct_page++) {
	   if($page == $direct_page) {
		  echo "<a href=\"$PHP_SELF?$qcommon&page=$direct_page\" class='page-num current'>$direct_page</a>";
	   } else {
		  echo "<a href=\"$PHP_SELF?$qcommon&page=$direct_page\" class='page-num'>$direct_page</a>";
	   }
	}


	// ������Ͽ� ���� ��ũ

	if($block < $tblock) {
	   $page = $last_page+1;
	   echo "<a href=\"$PHP_SELF?$qcommon&page=$page\" class=\"next\"></a>";
	} 

	//������ ��Ͽ� ���� ��ũ
	if($block < $tblock && $tblock>2) {
	$final_page=($tblock*10)-9;
	 echo "<a href=\"$PHP_SELF?$qcommon&page=$final_page\" class=\"to-last\"></a>";
	}

?>

 
