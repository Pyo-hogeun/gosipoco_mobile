<?
include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
?>
<?
if(!$id){$id="notice";}
if(!$bid){$bid=$code;}
$member=member_info();
$board=board_info();
if($eno) $bu=mysql_fetch_array(mysql_query("select * from $id where no='$eno'"));
?>
<script language="JavaScript" type="text/javascript">
		function editor_wr_ok(){
			submitContents();
			document.bwrite.action="sub01_save.php";
			return true;
		}
</script>

  <div class="content-container edu-board">
<?
include $_SERVER['DOCUMENT_ROOT']."/inc/tab_menu06.php";
?>
	<h3><?=$board[a_title]?></h3>
    
<form name="bwrite" method="post" enctype="multipart/form-data" target="HiddenFrm" onsubmit="editor_wr_ok()">
<input class='input_basic'type=hidden name="page" value="<?=$page?>">
<input class='input_basic'type=hidden name="key" value="<?=$key?>">
<input class='input_basic'type=hidden name="keyfield" value="<?=$keyfield?>">
<input class='input_basic'type=hidden name="act1" value="input_ok">
<input class='input_basic'type=hidden name="list" value="<?=$list?>">
<input class='input_basic'type=hidden name="level" value="<?=$level?>">
<input class='input_basic'type=hidden name="ridx" value="<?=$ridx?>">
<input class='input_basic'type=hidden name="id" value="<?=$id?>">
<input class='input_basic'type=hidden name="eno" value="<?=$eno?>">
<input class='input_basic'type=hidden name="ans" value="<?=$ans?>">
<input type=hidden name="bid" value="<?=$bid?>">
    <table class="table-default th-align-l">
      <colgroup>
        <col style="width: 120px;">
      </colgroup>
      <tbody>
        <tr>
          <th>이름</th>
          <td>
            <input type="text" name="textname" id="" class="default-input" value="<?=$_SESSION[Mname]?>">
          </td>
        </tr>
        <tr>
          <th>제목</th>
          <td>
            <input type="text" name="subject" id="" class="default-input" value='<?=$bu[subject]?>'>
            <div class="check-wrap">
              <label class="checkbox-wrap">
                <input type="checkbox" name="level">
                <span>공지</span>
              </label>
              <label class="checkbox-wrap">
                <input type="checkbox" name="level">
                <span>비밀글</span>
              </label>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2">
          <textarea name="memo" id="ir1" style="width:100%; height:230px;display:none;" wrap="physical"><?=stripslashes($bu[memo])?></textarea></center>
<script type="text/javascript" src="/board/smarteditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript">
var oEditors = [];

// 추가 글꼴 목록
//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "ir1",
	sSkinURI: "/board/smarteditor2/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
		bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
		//aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
		fOnBeforeUnload : function(){
			//alert("완료!");
		}
	}, //boolean
	fOnAppLoad : function(){
		//예제 코드
		//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
	},
	fCreator: "createSEditor2"
});

function pasteHTML() {
	var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
	oEditors.getById["ir1"].exec("PASTE_HTML", [sHTML]);
}

function showHTML() {
	var sHTML = oEditors.getById["ir1"].getIR();
	alert(sHTML);
}
	
function submitContents(elClickedObj) {
	oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// 에디터의 내용이 textarea에 적용됩니다.
	
	// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다.
	
	try {
		elClickedObj.form.submit();
	} catch(e) {}
}

function setDefaultFont() {
	var sDefaultFont = '궁서';
	var nFontSize = 24;
	oEditors.getById["ir1"].setDefaultFont(sDefaultFont, nFontSize);
}
</script>
          </td>
        </tr>
<? for($i=0;$i<$board[a_file_use];$i++){ ?>
        <tr>
          <th>파일</th>
          <td>
            <input type="file" name="upfile[]" id="" class="default-input">
            <!--p class="file-name">
              <span class="description">파일명.txt</span>
              <button class="btn btn-sm btn-default btn-round">삭제</button>
            </p>
            <p class="file-name">
              <span class="description">파일명.txt</span>
              <button class="btn btn-sm btn-default btn-round">삭제</button>
            </p-->
          </td>
        </tr>
<? } ?>
      </tbody>
    </table>
    <div class="table-bottom-center">
      <button class="btn btn-md btn-outline-secondary btn-round">등록하기</button>
      <button type="button" class="btn btn-md btn-outline-primary btn-round" onclick="location.href='sub01.php?id=<?=$id?>'">목록보기</button>
    </div>
</form>
  </div>

<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>

</html>