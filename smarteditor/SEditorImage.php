<?
include_once("./_dmshop.php");
if ($id) { $id = preg_match("/^[A-Za-z0-9_\-]+$/", $id) ? $id : ""; }
?>
<html>
<head>
<meta http-equiv='Content-type' content='text/html; charset=utf-8'>
<title>사진 첨부 팝업</title>
<style type="text/css">
*{margin:0; padding:0; font-family:AppleGothic, "돋움", Dotum, "굴림", Gulim, Sans-serif;}
button{font-weight:normal; font-size:12px; color:#000; letter-spacing:0; vertical-align:middle; margin-right:1px; margin-bottom:2px; padding:2px 3px; *padding:4px 3px 2px; _padding-bottom:0; overflow:visible;}
button img{vertical-align:middle; margin:0 2px 1px 0;}
.b{font-weight:bold;}
.addButton{position:relative; margin:0 20px; padding:7px 0 13px; text-align:center !important; line-height:1em;}
#naver_common_editor{margin:0 auto; padding:0 0 20px 0; text-align:left;}
#naver_common_editor div, #naver_common_editor ul, #naver_common_editor td, #naver_common_editor input, #naver_common_editor textarea{font-family:돋움, Dotum, AppleGothic, sans-serif; font-size:12px; color:#333333;}
.pic_content{padding:7px; border:1px solid #C5C5C5; background-color:#FBFBFB; text-align:center;}
.pic_content .search{padding-bottom:7px !important; text-align:left;}
.pic_content .search input{height:17px; border-top:1px solid #989898; border-left:1px solid #989898; border-right:1px solid #D8D8D8; border-bottom:1px solid #D8D8D8;}
.pic_content .pic_area{width:220px; _width:222px; height:143px; _height:145px; border:1px solid #E6E7E6; background:url(./img/txt_view.gif) center no-repeat;}

#pop_footer{padding:10px 0 16px;text-align:center}
.btn_area{word-spacing:2px}
</style>

<script type="text/javascript">
var AppName = navigator.appName;

if (AppName == "Netscape") {

var oFReader = new FileReader(), rFilter = /^(image\/bmp|image\/cis-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x-cmu-raster|image\/x-cmx|image\/x-icon|image\/x-portable-anymap|image\/x-portable-bitmap|image\/x-portable-graymap|image\/x-portable-pixmap|image\/x-rgb|image\/x-xbitmap|image\/x-xpixmap|image\/x-xwindowdump)$/i;

oFReader.onload = function (oFREvent) {

    document.getElementById("upload_preview").src = oFREvent.target.result;
    //document.getElementById("upload_preview").style.backgroundImage = "url('"+oFREvent.target.result+"')";

};

}

function smarteditorFile() {

    var obj = document.getElementById("update_image");

    if (AppName == "Netscape") {

        if (obj.files.length == 0) { return; }

        var oFile = obj.files[0];

        if (!rFilter.test(oFile.type)) { alert("You must select a valid image file!"); return; }

        oFReader.readAsDataURL(oFile);

    } else {

        var img_path = "";

        if (obj.value.indexOf("\\fakepath\\") < 0) {

            img_path = obj.value;

        } else {

            obj.select();

            var selectionRange = document.selection.createRange();

            img_path = selectionRange.text.toString();

            obj.blur();

        }

        document.getElementById("upload_preview").src = "file://" + img_path;

    }

}

function smarteditorUpload(uploadForm)
{

    var theFrm = document.editor_upimage;

    fileName = theFrm.update_image.value;

    if (fileName == '') {

        alert('본문에 삽입할 이미지를 선택해주세요.');
        return;

    }

    pathpoint = fileName.lastIndexOf('.');
    filepoint = fileName.substring(pathpoint+1,fileName.length);
    filetype = filepoint.toLowerCase();

    if (filetype != 'jpg' && filetype != 'gif' && filetype != 'png' && filetype != 'jpeg' && filetype !='bmp') {

        alert('이미지 파일만 선택할 수 있습니다.');
        self.close();
        return;

    }

    try {

        theFrm.submit();

    } catch (e) {

        theFrm.reset();
        alert('파일을 업로드할 수 없습니다.');
        return;

    }

}

function smarteditorClose()
{

    parent.parent.oEditors.getById["<?=$id?>"].exec("SE_TOGGLE_IMAGEUPLOAD_LAYER");  
    return false;

}
</script>
</head>
<body>
<div id="naver_common_editor">
<form id="editor_upimage" name="editor_upimage" action="SEditorImageUpload.php" method="post" enctype="multipart/form-data" onSubmit="return false;">
<input type="hidden" name="id" value="<?=$id?>" />
<div class="pic_content" style="border:0;">

<p class="search"><input type="file" id="update_image" name="update_image" style="ime-mode:disabled;" size="18" onchange="smarteditorFile();" onkeydown="return false"></p>

<div class="pic_area"><img src="./img/blank.gif" id="upload_preview" style="width:220px; height:143px;"></div>


    <div id="pop_footer">
	    <div class="btn_area">
            <a href="#" onclick="smarteditorUpload(document.getElementById('editor_upimage')); return false;"><img src="./img/photoQuickPopup/btn_confirm2.png" width="49" height="28" border="0" alt="확인" id="btn_confirm"></a>
            <a href="#" onclick="smarteditorClose(); return false;"><img src="./img/photoQuickPopup/btn_cancel.png" width="48" height="28" border="0" alt="취소" id="btn_cancel"></a>
        </div>
    </div>


</div>
</form>
</div>
</body>
</html>