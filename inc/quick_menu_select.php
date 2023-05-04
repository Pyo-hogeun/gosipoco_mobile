<?
// 공통 함수
include_once $_SERVER['DOCUMENT_ROOT']."/libraries/Function.inc.lib.php";
include_once $_SERVER['DOCUMENT_ROOT']."/libraries/DB_connect.inc.lib.php";
$connect = dbconn();


		$i=0;
		echo "<script>";
		echo "parent.document.$form.elements['$target'].options.length = 0; \n";
		echo "parent.document.$form.elements['$target'].options['$i'] = new Option('==교육과목==', ''); \n";
		if($code1=="03"){
			$qry = "select * from config_category where (code1='03' or code1='04') and length(code)=4 order by code1 asc, sortno asc ";
		}else{
			$qry = "select * from config_category where code1='$code1' and length(code)=4 order by sortno asc ";
		}
		$result=mysql_query($qry);
		while ($data = mysql_fetch_assoc($result)){
			$i++;
			echo "parent.document.$form.elements['$target'].options['$i'] = new Option('".$data[name]."', '".$data[code]."'); \n";
		}
			echo "</script>";


?>