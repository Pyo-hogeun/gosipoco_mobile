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
          <th>�̸�</th>
          <td>
            <input type="text" name="textname" id="" class="default-input" value="<?=$_SESSION[Mname]?>">
          </td>
        </tr>
        <tr>
          <th>����</th>
          <td>
            <input type="text" name="subject" id="" class="default-input" value='<?=$bu[subject]?>'>
            <div class="check-wrap">
              <label class="checkbox-wrap">
                <input type="checkbox" name="level">
                <span>����</span>
              </label>
              <label class="checkbox-wrap">
                <input type="checkbox" name="level">
                <span>��б�</span>
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

// �߰� �۲� ���
//var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];

nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "ir1",
	sSkinURI: "/board/smarteditor2/SmartEditor2Skin.html",	
	htParams : {
		bUseToolbar : true,				// ���� ��� ���� (true:���/ false:������� ����)
		bUseVerticalResizer : true,		// �Է�â ũ�� ������ ��� ���� (true:���/ false:������� ����)
		bUseModeChanger : true,			// ��� ��(Editor | HTML | TEXT) ��� ���� (true:���/ false:������� ����)
		//aAdditionalFontList : aAdditionalFontSet,		// �߰� �۲� ���
		fOnBeforeUnload : function(){
			//alert("�Ϸ�!");
		}
	}, //boolean
	fOnAppLoad : function(){
		//���� �ڵ�
		//oEditors.getById["ir1"].exec("PASTE_HTML", ["�ε��� �Ϸ�� �Ŀ� ������ ���ԵǴ� text�Դϴ�."]);
	},
	fCreator: "createSEditor2"
});

function pasteHTML() {
	var sHTML = "<span style='color:#FF0000;'>�̹����� ���� ������� �����մϴ�.<\/span>";
	oEditors.getById["ir1"].exec("PASTE_HTML", [sHTML]);
}

function showHTML() {
	var sHTML = oEditors.getById["ir1"].getIR();
	alert(sHTML);
}
	
function submitContents(elClickedObj) {
	oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);	// �������� ������ textarea�� ����˴ϴ�.
	
	// �������� ���뿡 ���� �� ������ �̰����� document.getElementById("ir1").value�� �̿��ؼ� ó���ϸ� �˴ϴ�.
	
	try {
		elClickedObj.form.submit();
	} catch(e) {}
}

function setDefaultFont() {
	var sDefaultFont = '�ü�';
	var nFontSize = 24;
	oEditors.getById["ir1"].setDefaultFont(sDefaultFont, nFontSize);
}
</script>
          </td>
        </tr>
<? for($i=0;$i<$board[a_file_use];$i++){ ?>
        <tr>
          <th>����</th>
          <td>
            <input type="file" name="upfile[]" id="" class="default-input">
            <!--p class="file-name">
              <span class="description">���ϸ�.txt</span>
              <button class="btn btn-sm btn-default btn-round">����</button>
            </p>
            <p class="file-name">
              <span class="description">���ϸ�.txt</span>
              <button class="btn btn-sm btn-default btn-round">����</button>
            </p-->
          </td>
        </tr>
<? } ?>
      </tbody>
    </table>
    <div class="table-bottom-center">
      <button class="btn btn-md btn-outline-secondary btn-round">����ϱ�</button>
      <button type="button" class="btn btn-md btn-outline-primary btn-round" onclick="location.href='sub01.php?id=<?=$id?>'">��Ϻ���</button>
    </div>
</form>
  </div>

<?
include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
</body>

</html>