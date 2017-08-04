/* 분류 스크립트 */

function shopChange(id, val)
{

    if (!val || val == '') {

        return false;

    }

    shopCate(id, val);

    var index = document.getElementById("category"+id).selectedIndex;

    if (index > '0') {

        document.getElementById("ch_subject").value = document.getElementById("category"+id).options[index].text;

    }

}

function shopCate(id, val)
{

    var tmp_category = parseInt(id);

    if (!val || val == '0') {

        var category = tmp_category;

    } else {

        var category = tmp_category + 1;

    }

    if (!document.getElementById("log"+val)) {

        return false;

    }

    document.getElementById("defalt_category").value = id;
    document.getElementById("category").value = category;
    document.getElementById("code").value = val;
    document.getElementById("defalt_code"+category).value = val;
    document.getElementById("tmp_log").value = "";
    document.getElementById("tmp_log").value = document.getElementById("log"+val).value;

    // 옵션 삭제
    shopCateDelete(category);

    // 데이터 불러온다.
    var code = document.getElementById("code"+val);

    // 데이터가 없다면.
    if (code == null) {

        // input 추가
        shopCateInput(id, val, '');

        return false;

    }

    // 첫번째 분류 -> 선택하세요. 클릭했다면.
    else if (category == '1' && val == '0' || val == '' || !val || code == null) {

        return false;

    }

    // 데이터가 존재한다면
    else if (code.value && code.value != '') {

        // 쪼갠다.
        var tmp_str = code.value.split("|%|");
    
        for (i=0; i<tmp_str.length; i++) {

            if (tmp_str[i]) {

                // 쪼갠다.
                var str = tmp_str[i].split(":%:");

                for (k=0; k<str.length; k++) {

                    if (str[k] && k == '0') {

                        // 옵션 추가
                        shopCateAdd(category, str[1], str[2], str[3], str[4]);

                    }

                } // end for

            }
    
        } // end for

    }

}

function shopCateInput(id, val, all)
{

    // input 추가
    var id = document.getElementById("inputCodeAdd");
    var objRow = id.insertRow(id.rows.length);
    var objCell = objRow.insertCell(0);

    objCell.innerHTML = "<input type='hidden' id='code"+val+"' name='code"+val+"' value='"+all+"' />";

}

function shopCateInputLog(id, val, all)
{

    // input 추가
    var id = document.getElementById("inputCodeAddLog");
    var objRow = id.insertRow(id.rows.length);
    var objCell = objRow.insertCell(0);

    objCell.innerHTML = "<input type='hidden' id='log"+val+"' name='log"+val+"' value='"+all+"' />";

}

function shopCateAdd(id, val, subject, category, code)
{

    // 옵션 인덱스
    var tmpIndex = document.getElementById("category"+id).options.length;

    // 옵션추가
    document.getElementById("category"+id).options[tmpIndex] = new Option(subject, val);

}

function shopCateInsert()
{

    // 옵션 아이디
    var id = document.getElementById("category").value;

    // 추가할 코드 (category id)
    var code = document.getElementById("code").value;

    // 제목
    var subject = document.getElementById("subject").value;

    if (!id || id == '' || !code || code == '' || code == null) {

        alert("추가할 분류를 선택하세요.");
        return;

    }

    if (!subject || subject == '') {

        alert("제목을 입력하세요.");
        return;

    }

    // 4차까지. 5차 분류는 막는다.
    if (id >= '5') {

        alert("더이상 하위에 분류를 추가할 수 없습니다.");
        return;

    }

    // 옵션 인덱스
    var tmpIndex = document.getElementById("category"+id).options.length;

    // 데이터
    var name = document.getElementById("code"+code).value;

    // 코드 id 값
    var tmp_num = parseInt(document.getElementById("tmp_code").value);

    // 코드 id 값에 1 더한다.
    var num = tmp_num + 1;

    // 옵션추가
    document.getElementById("category"+id).options[tmpIndex] = new Option(subject, num);

    // 데이터 합산
    document.getElementById("code"+code).value = name + "insert:%:"+num+":%:"+subject+":%:"+id+":%:"+code+"|%|";

    // 코드 id 값 변경
    document.getElementById("tmp_code").value = num;

    // 데이터 불러온다.
    var tmp_log = document.getElementById("log"+num);

    // 데이터가 없다면.
    if (tmp_log == null) {

        // input 추가
        shopCateInputLog(id, num, '');

    }

    // 고유키 저장
    document.getElementById("tmp_log").value = "";

    var log1 = document.getElementById("log"+code).value;

    if (!log1) {

        var log1 = code;


    }

    var log2 = num;

    document.getElementById("tmp_log").value =  log1+"|"+log2;
    document.getElementById("log"+num).value = document.getElementById("tmp_log").value;

    // 제목 리셋
    document.getElementById("subject").value = "";

}

function shopCateChange()
{

    // 아이디
    var id = document.getElementById("defalt_category").value;

    // 코드
    var code = document.getElementById("code").value;

    // 제목
    var subject = document.getElementById("ch_subject").value;

    // 체크
    if (!id || id == '' || !code || code == '') {

        alert("변경할 분류를 선택하세요.");
        return;

    }

    if (!subject || subject == '') {

        alert("변경할 제목을 입력하세요.");
        return;

    }

    // 인덱스값을 구한다.
    var index = document.getElementById("category"+id).selectedIndex;

    // 기본 코드
    var defalt_code = document.getElementById("defalt_code"+id).value;

    // 분류
    var category = document.getElementById("category"+id).value;

    if (defalt_code == null || id == '1' && category == '0') {

        alert("변경할 분류를 선택하세요.");
        return;

    }

    // input 수정
    if (id && category) {

        // 쪼갠다.
        var tmp_id = document.getElementById("code"+defalt_code);

        if (tmp_id == null || tmp_id == '' || !tmp_id) {

            return false;

        }

        var tmp_str = tmp_id.value.split("|%|");

        // 초기화 하고
        document.getElementById("code"+defalt_code).value = "";

        // 새로 덮는다.
        for (var i=0; i<tmp_str.length; i++) {

            if (tmp_str[i]) {

                // 쪼갠다.
                var str = tmp_str[i].split(":%:");

                for (k=0; k<str.length; k++) {

                    if (str[k] && k == '0') {

                        // 데이터
                        var name = document.getElementById("code"+defalt_code).value;

                        // val 값과 돌린 것이 같으면
                        if (str[1] == code) {

                            document.getElementById("code"+defalt_code).value = name + ""+str[0]+":%:"+str[1]+":%:"+subject+":%:"+str[3]+":%:"+str[4]+"|%|";

                        } else {

                            // 데이터 합산
                            document.getElementById("code"+defalt_code).value = name + ""+str[0]+":%:"+str[1]+":%:"+str[2]+":%:"+str[3]+":%:"+str[4]+"|%|";

                        }

                    }

                } // end for

            }
    
        } // end for

    }

    // 제목 변경
    document.getElementById("category"+id).options[index].innerHTML = subject;

}

function shopCateDelete(id)
{

    // 삭제될 옵션 마지막 인덱스
    var count = "1";

    if (id == '2') {

        // 옵션 수
        var ChkIndex2 = document.getElementById("category2").options.length;
        var ChkIndex3 = document.getElementById("category3").options.length;
        var ChkIndex4 = document.getElementById("category4").options.length;
    
        // 삭제
        for (i = ChkIndex2; i >= count; i--) {
    
            document.getElementById("category2").options[i] = null;
    
        }

        for (i = ChkIndex3; i >= count; i--) {
    
            document.getElementById("category3").options[i] = null;
    
        }

        for (i = ChkIndex4; i >= count; i--) {
    
            document.getElementById("category4").options[i] = null;
    
        }

    }

    else if (id == '3') {

        // 옵션 수
        var ChkIndex3 = document.getElementById("category3").options.length;
        var ChkIndex4 = document.getElementById("category4").options.length;

        for (i = ChkIndex3; i >= count; i--) {
    
            document.getElementById("category3").options[i] = null;
    
        }

        for (i = ChkIndex4; i >= count; i--) {
    
            document.getElementById("category4").options[i] = null;
    
        }

    }

    else if (id == '4') {

        // 옵션 수
        var ChkIndex4 = document.getElementById("category4").options.length;

        for (i = ChkIndex4; i >= count; i--) {
    
            document.getElementById("category4").options[i] = null;
    
        }

    }

    else if (id == '5') {

        // 옵션 수
        var ChkIndex5 = document.getElementById("category4").options.length;

        for (i = ChkIndex5; i >= count; i--) {
    
            //document.getElementById("category5").options[i] = null;
    
        }
    
    } else {

        // 옵션 수
        var ChkIndex2 = document.getElementById("category2").options.length;
        var ChkIndex3 = document.getElementById("category3").options.length;
        var ChkIndex4 = document.getElementById("category4").options.length;
    
        // 삭제
        for (i = ChkIndex2; i >= count; i--) {
    
            document.getElementById("category2").options[i] = null;
    
        }

        for (i = ChkIndex3; i >= count; i--) {
    
            document.getElementById("category3").options[i] = null;
    
        }

        for (i = ChkIndex4; i >= count; i--) {
    
            document.getElementById("category4").options[i] = null;
    
        }

    }

}

function shopDelete()
{

    if (confirm("선택한 분류를 삭제하시겠습니까?")) {

    } else {

        return;

    }

    // 아이디
    var id = document.getElementById("defalt_category").value;

    // 코드
    var code = document.getElementById("code").value;

    // 체크
    if (!id || id == '' || !code || code == '') {

        alert("삭제할 분류를 선택하세요.");
        return;

    }

    // 인덱스값을 구한다.
    var index = document.getElementById("category"+id).selectedIndex;

    // 기본 코드
    var defalt_code = document.getElementById("defalt_code"+id).value;

    // 분류
    var category = document.getElementById("category"+id).value;

    if (defalt_code == null || id == '1' && category == '0') {

        alert("삭제할 분류를 선택하세요.");
        return;

    }

    // input 수정
    if (id && category) {

        // 쪼갠다.
        var tmp_id = document.getElementById("code"+defalt_code);

        if (tmp_id == null || tmp_id == '' || !tmp_id) {

            return false;

        }

        var tmp_str = tmp_id.value.split("|%|");

        // 초기화 하고
        document.getElementById("code"+defalt_code).value = "";

        // 새로 덮는다.
        for (i=0; i<tmp_str.length; i++) {

            if (tmp_str[i]) {

                // 쪼갠다.
                var str = tmp_str[i].split(":%:");

                for (k=0; k<str.length; k++) {

                    if (str[k] && k == '0') {

                        // 데이터
                        var name = document.getElementById("code"+defalt_code).value;

                        // val 값과 돌린 것이 같으면
                        if (str[1] == code) {

                            // 삭제
                            //document.getElementById("code"+defalt_code).value = name + "delete:%:"+str[1]+":%:"+str[2]+":%:"+str[3]+":%:"+str[4]+"|%|";

                        } else {

                            // 데이터 합산
                            document.getElementById("code"+defalt_code).value = name + ""+str[0]+":%:"+str[1]+":%:"+str[2]+":%:"+str[3]+":%:"+str[4]+"|%|";

                        }

                    }

                } // end for

            }
    
        } // end for

    }

    // 삭제
    document.getElementById("category"+id).options[index] = null;

}

function shopCateMove(type)
{

    var category = document.getElementById("defalt_category").value;
    var id = document.getElementById("category"+category);
    var index = id.selectedIndex;

    if (type == "U") {

        if (index > 1) {

            shopSwap(id, index, index - 1, type);

        }

    }

    else if (type == "D") {

        if (index < id.options.length-1) {

            shopSwap(id, index, index + 1, type);

        }

    }

    else if (type == "T") {

        for (var i = index; i > 1; i--) {

            shopSwap(id, i, i - 1, type);

        }

    }

    else if (type == "B") {

        for (var i = index; i < id.options.length - 1; i++) {

            shopSwap(id, i, i + 1, type);

        }

    }

}

function shopSwap(id, index, targetIndex, type)
{

    var onetext = id.options[targetIndex].text;
    var onevalue = id.options[targetIndex].value;

    id.options[targetIndex].text = id.options[index].text;
    id.options[targetIndex].value = id.options[index].value;
    id.options[index].text = onetext;
    id.options[index].value = onevalue;
    id.options.selectedIndex = targetIndex;
    id.options[targetIndex].selected = true;

    var val1 = id.options[index].value;
    var val2 = id.options[targetIndex].value;

    swapName(val1, val2, index, targetIndex, type);

}

function swapName(val1, val2, index1, index2, type)
{

    var id = document.getElementById("defalt_category").value;

    if (id == '1') {

        var defalt_code = "0";
        var code = document.getElementById("code0").value;
        var tmp_str = code.split("|%|");

    } else {

        var defalt_code = document.getElementById("defalt_code"+id).value;
        var code = document.getElementById("code"+defalt_code).value;
        var tmp_str = code.split("|%|");

    }

    // 돌린다.
    for (var i=0; i<tmp_str.length; i++) {

        if (tmp_str[i]) {

            // 쪼갠다.
            var str = tmp_str[i].split(":%:");

            for (var k=0; k<str.length; k++) {

                if (str[k] && k == '0') {

                    if (str[1] == val1) {

                        // 선언
                        var tmp_name1 = ""+str[0]+":%:"+str[1]+":%:"+str[2]+":%:"+str[3]+":%:"+str[4];

                    }

                    if (str[1] == val2) {

                        // 선언
                        var tmp_name2 = ""+str[0]+":%:"+str[1]+":%:"+str[2]+":%:"+str[3]+":%:"+str[4];

                    }

                }

            } // end for

        }

    } // end for

    swapChange(val1, val2, index1, index2, tmp_name1, tmp_name2, type);

}

function swapChange(val1, val2, index1, index2, tmp_name1, tmp_name2, type)
{

    var id = document.getElementById("defalt_category").value;

    if (id == '1') {

        var defalt_code = "0";
        var code = document.getElementById("code0").value;
        var tmp_str = code.split("|%|");

    } else {

        var defalt_code = document.getElementById("defalt_code"+id).value;
        var code = document.getElementById("code"+defalt_code).value;
        var tmp_str = code.split("|%|");

    }

    var num = 0;

    // 초기화 하고
    document.getElementById("tmp_option").value = "";

    // 다시 새로 덮는다.
    for (var i=0; i<tmp_str.length; i++) {

        if (tmp_str[i]) {

            num++;

            // 쪼갠다.
            var str = tmp_str[i].split(":%:");

            for (var k=0; k<str.length; k++) {

                if (str[k] && k == '0') {

                    if (num == index2) {

                        if (type == 'U' || type == 'T') {

                            document.getElementById("tmp_option").value = document.getElementById("tmp_option").value + tmp_name2+"|%|";
                            document.getElementById("tmp_option").value = document.getElementById("tmp_option").value + tmp_name1+"|%|";

                        }

                        if (type == 'D' || type == 'B') {

                            document.getElementById("tmp_option").value = document.getElementById("tmp_option").value + tmp_name1+"|%|";
                            document.getElementById("tmp_option").value = document.getElementById("tmp_option").value + tmp_name2+"|%|";

                        }

                    }

                    if (tmp_str[i] != tmp_name1 && tmp_str[i] != tmp_name2) {

                        document.getElementById("tmp_option").value = document.getElementById("tmp_option").value + ""+str[0]+":%:"+str[1]+":%:"+str[2]+":%:"+str[3]+":%:"+str[4]+"|%|";

                    }

                }

            } // end for

        }

    } // end for

    // 새로 셋팅
    document.getElementById("code"+defalt_code).value = "";
    document.getElementById("code"+defalt_code).value = document.getElementById("tmp_option").value;

}