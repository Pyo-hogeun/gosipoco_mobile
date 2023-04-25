<?
// 공통 함수
include_once $_SERVER['DOCUMENT_ROOT']."/libraries/Function.inc.lib.php";
include_once $_SERVER['DOCUMENT_ROOT']."/libraries/DB_connect.inc.lib.php";
$connect = dbconn();


		$i=0;
		echo "<script>";
		echo "parent.document.$form.elements['$target'].options.length = 0; \n";
		echo "parent.document.$form.elements['$target'].options['$i'] = new Option('자격증선택', ''); \n";

		$qry = "select * from subject where (type1!='1' or type2!='1' or type3!='1' or type4!='1') and code1='$code1' ";
		$result=mysql_query($qry);
		while ($data = mysql_fetch_assoc($result)){
			$fetch_arr = cate($data[code2]);
			$i++;
			echo "parent.document.$form.elements['$target'].options['$i'] = new Option('".$fetch_arr[1][name]."', '".$data[code2]."'); \n";
		}
			echo "</script>";


/*
			if($data[type1]=="1"){
				$i++;
				echo "parent.document.$form.elements['$target'].options['$i'] = new Option('".$fetch_arr[0][name]." ".$fetch_arr[1][name]." 단과반', '".$data[code]."|type1'); \n";
			}
			if($data[type2]=="1"){
				$i++;
				echo "parent.document.$form.elements['$target'].options['$i'] = new Option('".$fetch_arr[0][name]." ".$fetch_arr[1][name]." 단기반', '".$data[code]."|type2'); \n";
			}
			if($data[type3]=="1"){
				$i++;
				echo "parent.document.$form.elements['$target'].options['$i'] = new Option('".$fetch_arr[0][name]." ".$fetch_arr[1][name]." 종합반', '".$data[code]."|type3'); \n";
			}
			if($data[type4]=="1"){
				$i++;
				echo "parent.document.$form.elements['$target'].options['$i'] = new Option('".$fetch_arr[0][name]." ".$fetch_arr[1][name]." 합격보장반', '".$data[code]."|type4'); \n";
			}
*/
?>