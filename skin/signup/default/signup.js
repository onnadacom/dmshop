// 포커스
function signupFocusIn(i)
{

    (i).style.border = "1px solid #027d94";
    (i).style.padding = "0px 3px 0px 3px";

}

function signupFocusOut(i)
{

    (i).style.border = "1px solid #c9c9c9";
    (i).style.padding = "0px 3px 0px 3px";

}

function signupFocusIn2(i)
{

    (i).style.border = "2px solid #027d94";
    (i).style.padding = "0px 5px 0px 5px";

}

function signupFocusOut2(i)
{

    (i).style.border = "2px solid #c9c9c9";
    (i).style.padding = "0px 5px 0px 5px";

}

function signupFocusIn3(i)
{

    (i).style.border = "2px solid #027d94";

}

function signupFocusOut3(i)
{

    (i).style.border = "1px solid #c9c9c9";

}

// 약관동의
function submitSignup()
{

    var f = document.formSignup;

    if (f.check1.checked == true && f.check2.checked == true) {

        // 이메일, 휴대폰
        if (user_real_check == '2' || user_real_check == '3') {

            if (f.user_name.value == '') {

                alert("성명을 입력하세요.");
                f.user_name.focus();
                return false;

            }

            if (isValid_name(f.user_name.value) == 0) {

                f.user_name.focus();
                return false;

            }

        }

        // 실명 인증
        if (user_real_check == '1') {

            if (f.real_jumin_check.value == '') {

                alert("실명인증이 완료되지 않았습니다.");
                f.user_name.focus();
                return false;

            }

            juminCheck = signupJuminCheck();

            if (!juminCheck) {

                return false;

            }

            f.submit();

        }

        // 이메일 인증
        if (user_real_check == '2') {

            if (f.real_email_check.value == '') {

                alert("이메일 인증이 완료되지 않았습니다.");
                f.user_email.focus();
                return false;

            }

            emailCheck = signupEmailCheck();

            if (!emailCheck) {

                return false;

            }

        }

        // 휴대폰 인증
        if (user_real_check == '3') {

            if (f.real_hp_check.value == '') {

                alert("휴대폰 인증이 완료되지 않았습니다.");
                return false;

            }

            hpCheck = signupHpCheck();

            if (!hpCheck) {

                return false;

            }

        }

        // 본인 인증
        if (user_real_check == '4') {

            if (f.real_my_check.value == '') {

                alert("본인인증이 완료되지 않았습니다.");
                return false;

            }

            myCheck = signupMyCheck();

            if (!myCheck) {

                return false;

            }

            f.submit();

        }

        return true;

    } else {

        alert("서비스 이용약관과 개인정보 취급방침 및 이용에 대한 안내를 모두 동의해 주세요.");
        return false;

    }

}

// 회원정보
function submitSignupForm()
{

    var f = document.formSignup;

    // 아이디 입력
    if (f.m.value == '') {

        if (f.user_id.value == '') {

            alert("아이디를 입력하세요.");
            f.user_id.focus();
            return false;

        } else {

            retVal = isValid_id(f.user_id.value);

            if (!retVal) {

                f.user_id.focus();
                return false;

            }

        }

        if (f.m.value == '' && f.user_id_check.value == '' || f.m.value == '' && f.user_id_check.value != f.user_id.value) {

            alert("아이디 중복확인을 하세요.");
            f.user_id.focus();
            return false;

        }

    }

    // 패스워드 입력
    if (f.m.value == '' || f.m.value == 'u' && f.user_pw.value) {

        if (f.user_pw.value == "") {

            alert("비밀번호를 입력하세요.");
            f.user_pw.focus();
            return false;

        } else {

            res = isValid_passwd(f.user_pw.value);

            if (!res) {

                f.user_pw.focus();
                return false;

            }

        }

        if (f.user_pw_check.value == "") {

            alert("비밀번호 확인을 입력하세요.");
            f.user_pw_check.focus();
            return false;

        } else {

            res = isValid_passwd(f.user_pw_check.value);

            if (!res) {

                f.user_pw_check.focus();
                return false;

            }

        }

    }

    // 패스워드 일치
    if (f.user_pw.value != f.user_pw_check.value) {

        alert("비밀번호가 일치하지 않습니다.");
        f.user_pw.focus();
        return false;

    }

    // 아이디와 같다
    if (f.user_id.value == f.user_pw.value) {

        alert("아이디와 비밀번호가 같습니다.\n보안 상의 이유로 아이디와 같은 비밀번호는 허용하지 않습니다.");
        f.user_pw.focus();
        return false;

    }

    // 패스워드 qna 질문
    if (f.user_pw_q.value == '') {

        alert("비밀번호 재발급을 위한 질문을 입력 하세요.");
        f.user_pw_q.focus();
        return false;

    }

    // 패스워드 qna 답변
    if (f.user_pw_a.value == '') {

        alert("비밀번호 재발급을 위한 답변을 입력 하세요.");
        f.user_pw_a.focus();
        return false;

    }

    // 성명
    if (f.m.value == '' || f.m.value == 'u') {

        if (f.user_name.value == '') {

            alert("성명을 입력하세요.");
            f.user_name.focus();
            return false;

        }

        if (isValid_name(f.user_name.value) == 0) {

            f.user_name.focus();
            return false;

        }

    }

    // 생년월일
    if (f.m.value == '') {

        // 사용이면서 입력했다면
        if (user_birth == '1' && f.user_birth1.value && f.user_birth2.value && f.user_birth3.value || user_birth == '2') {

            birthCheck = signupBirthCheck();

            if (!birthCheck) {

                return false;

            }

            f.user_birth.value = f.user_birth1.value+f.user_birth2.value+f.user_birth3.value;

        }

    }

    // 닉네임
    if (user_nick == '1' && f.user_nick.value || user_nick == '2') {

        if (f.user_nick.value == '') {

            alert("닉네임을 입력하세요.");
            f.user_nick.focus();
            return false;

        } else {

            retVal = isValid_nick(f.user_nick.value);

            if (!retVal) {

                f.user_nick.focus();
                return false;

            }

        }

        if (f.user_nick_check.value == '' || f.user_nick_check.value != f.user_nick.value) {

            alert("닉네임 중복확인을 하세요.");
            f.user_nick.focus();
            return false;

        }

    }

    // 휴대폰
    if (user_hp == '1' && f.user_hp1.value || user_hp == '1' && f.user_hp2.value || user_hp == '1' && f.user_hp3.value || user_hp == '2' || user_hp == '3') {

        if (f.user_hp1.value == '') {

            alert("휴대폰 번호를 입력하세요.");
            f.user_hp1.focus();
            return false;

        }

        if (f.user_hp2.value == '') {

            alert("휴대폰 번호를 입력하세요.");
            f.user_hp2.focus();
            return false;

        }

        if (f.user_hp3.value == '') {

            alert("휴대폰 번호를 입력하세요.");
            f.user_hp3.focus();
            return false;

        }

        // 휴대폰 인증
        if (user_hp == '3') {

            if (f.real_hp_check.value == '') {

                alert("휴대폰 인증이 완료되지 않았습니다.");
                return false;

            }

            hpCheck = signupHpCheck();

            if (!hpCheck) {

                return false;

            }

        }

        f.user_hp.value = f.user_hp1.value+"-"+f.user_hp2.value+"-"+f.user_hp3.value;

    }

    // 일반 전화
    if (user_tel == '1' && f.user_tel1.value || user_tel == '1' && f.user_tel2.value || user_tel == '1' && f.user_tel3.value || user_tel == '2') {

        if (f.user_tel1.value == '') {

            alert("일반 전화번호를 입력하세요.");
            f.user_tel1.focus();
            return false;

        }

        if (f.user_tel2.value == '') {

            alert("일반 전화번호를 입력하세요.");
            f.user_tel2.focus();
            return false;

        }

        if (f.user_tel3.value == '') {

            alert("일반 전화번호를 입력하세요.");
            f.user_tel3.focus();
            return false;

        }

        f.user_tel.value = f.user_tel1.value+"-"+f.user_tel2.value+"-"+f.user_tel3.value;

    }

    // 일반 주소
    if (user_addr == '1' && f.user_addr1.value || user_addr == '1' && f.user_addr2.value || user_addr == '2') {

        if (f.user_addr1.value == '') {

            alert("우편번호 찾기를 이용하여 주소를 입력하세요.");
            f.user_zip1.focus();
            return false;

        }

        if (f.user_addr2.value == '') {

            alert("상세 주소를 입력하세요.");
            f.user_addr2.focus();
            return false;

        }

    }

    // 직장명
    if (user_company == '2') {

        if (f.user_company.value == '') {

            alert("직장명을 입력하세요.");
            f.user_company.focus();
            return false;

        }

    }

    // 직장 전화번호
    if (user_company_tel == '1' && f.user_company_tel1.value || user_company_tel == '1' && f.user_company_tel2.value || user_company_tel == '1' && f.user_company_tel3.value || user_company_tel == '2') {

        if (f.user_company_tel1.value == '') {

            alert("직장 전화번호를 입력하세요.");
            f.user_company_tel1.focus();
            return false;

        }

        if (f.user_company_tel2.value == '') {

            alert("직장 전화번호를 입력하세요.");
            f.user_company_tel2.focus();
            return false;

        }

        if (f.user_company_tel3.value == '') {

            alert("직장 전화번호를 입력하세요.");
            f.user_company_tel3.focus();
            return false;

        }

        f.user_company_tel.value = f.user_company_tel1.value+"-"+f.user_company_tel2.value+"-"+f.user_company_tel3.value;

    }

    // 직장 주소
    if (user_company_addr == '1' && f.user_company_addr1.value || user_company_addr == '1' && f.user_company_addr2.value || user_company_addr == '2') {

        if (f.user_company_addr1.value == '') {

            alert("우편번호 찾기를 이용하여 주소를 입력하세요.");
            f.user_company_zip1.focus();
            return false;

        }

        if (f.user_company_addr2.value == '') {

            alert("상세 주소를 입력하세요.");
            f.user_company_addr2.focus();
            return false;

        }

    }

    // 이메일
    if (user_email == '1' || user_email == '2') {

        if (!isValid_email(f.user_email1.value+"@"+f.user_email2.value)) {

            f.user_email1.focus();
            return false;

        }

        if (user_real_check == '2') {

            if (f.real_email_check.value == '') {

                alert("이메일 인증이 완료되지 않았습니다.");
                return false;

            }

            emailCheck = signupEmailCheck();

            if (!emailCheck) {

                return false;

            }

        }

        f.user_email.value = f.user_email1.value+"@"+f.user_email2.value;

    }

    // 홈페이지
    if (user_homepage == '2') {

        if (f.user_homepage.value == '') {

            alert("홈페이지를 입력하세요.");
            f.user_homepage.focus();
            return false;

        }

    }

    // 추천인
    if (user_recommend != '0' && f.m.value == '') {

        if (user_recommend == '2' && f.user_recommend.value == '') {

            alert("추천인 아이디를 입력하세요.");
            f.user_recommend.focus();
            return false;

        }

        if (f.user_recommend.value && f.user_recommend_check.value != f.user_recommend.value) {

            alert("추천인 아이디 중복확인을 하세요.");
            f.user_recommend.focus();
            return false;

        }

    }

    // 자기소개
    if (user_profile == '2') {

        if (f.user_profile.value == '') {

            alert("자기소개를 입력하세요.");
            f.user_profile.focus();
            return false;

        }

    }

/*
    // 자동등록방지
    if (f.m.value == '' && user_robot == '1') {

        if (f.robot_key.value == '') {
    
            alert('자동등록방지를 입력하십시오.');
            f.robot_key.focus();
            return false;
    
        }
    
       if (typeof(f.robot_key) != 'undefined') {
    
            if (!checkFrm()) {
    
                alert ("자동등록방지 코드가 틀렸습니다. 다시 입력해 주세요.");
                return false;
    
            }
    
        }

    }
*/

    // 부가정보
    if (user_etc == '2') {

        if (user_etc1) {

            if (f.user_etc1.value == '') {

                alert("항목을 입력하세요.");
                f.user_etc1.focus();
                return false;

            }

        }

        if (user_etc2) {

            if (f.user_etc2.value == '') {

                alert("항목을 입력하세요.");
                f.user_etc2.focus();
                return false;

            }

        }

        if (user_etc3) {

            if (f.user_etc3.value == '') {

                alert("항목을 입력하세요.");
                f.user_etc3.focus();
                return false;

            }

        }

        if (user_etc4) {

            if (f.user_etc4.value == '') {

                alert("항목을 입력하세요.");
                f.user_etc4.focus();
                return false;

            }

        }

        if (user_etc5) {

            if (f.user_etc5.value == '') {

                alert("항목을 입력하세요.");
                f.user_etc5.focus();
                return false;

            }

        }

    }

    return true;

}

// 탈퇴신청
function submitSignupLeave()
{

    var f = document.formSignup;

    if (f.check1.checked == true) {

        if (confirm("탈퇴하시겠습니까?\n\n탈퇴하시면 복구가 불가능합니다.")) {
    
            return true;
    
        } else {

            return false;

        }

    } else {

        alert("회원탈퇴와 관련한 내용을 동의해 주세요.");
        return false;

    }

    return true;

}

// 패스워드확인
function submitSignupCheck()
{

    var f = document.formSignup;

    // 패스워드 입력
    if (f.user_pw.value == "") {

        alert("비밀번호를 입력하세요.");
        f.user_pw.focus();
        return false;

    } else {

        res = isValid_passwd(f.user_pw.value);

        if (!res) {

            f.user_pw.focus();
            return false;

        }

    }

    return true;

}

// 주민등록 인증
function signupJuminSend()
{

    var f = document.formSignup;

    if (f.user_name.value == '') {

        alert("성명을 입력하세요.");
        f.user_name.focus();
        return false;

    }

    if (isValid_name(f.user_name.value) == 0) {

        f.user_name.focus();
        return false;

    }

    if (f.user_jumin1.value == '') {

        alert("주민등록번호 앞자리를 입력하세요");
        f.user_jumin1.focus();
        return false;

    }

    if (f.user_jumin1.value.length != 6) {

        alert("유효한 주민등록번호가 아닙니다");
        f.user_jumin1.focus();
        return false;

    }

    if (f.user_jumin2.value == '') {

        alert("주민등록번호 뒷자리를 입력하세요");
        f.user_jumin2.focus();
        return false;

    }

    if (f.user_jumin2.value.length != 7) {

        alert("유효한 주민등록번호가 아닙니다");
        f.user_jumin2.focus();
        return false;

    }

    var socno = (f.user_jumin1.value + f.user_jumin2.value);
    var rVal1 = isValid_socno(socno);

    if (rVal1 != true) {

        alert("주민등록번호가 유효하지 않습니다. 다시 입력하세요");

        if (f.user_jumin1.disabled) {

            f.user_jumin2.focus();

        } else {

            f.user_jumin1.focus();

        }

        return false;

    }

    f.real_jumin_check.value = "";
    f.real_user_name.value = "";
    f.real_user_jumin.value = "";

    $.post(shop_path+"/signup_jumin_send.php", {"page_id" : f.page_id.value, "user_name" : f.user_name.value, "user_jumin1" : f.user_jumin1.value, "user_jumin2" : f.user_jumin2.value}, function(data) {

        $("#signup_data").html(data);

    });

}

// 주민등록 인증 체크
function signupJuminCheck()
{

    var f = document.formSignup;

    if (f.user_name.value != f.real_user_name.value || f.user_name.value == '') {

        alert("성명이 변경되었습니다. 새로 인증을 하셔야 합니다.");
        signupRealJuminReset();
        return false;

    }

    var jumin = f.user_jumin1.value+f.user_jumin2.value;

    if (jumin != f.real_user_jumin.value || f.user_jumin1.value == '' || f.user_jumin2.value == '') {

        alert("주민등록번호가 변경되었습니다. 새로 인증을 하셔야 합니다.");
        signupRealJuminReset();
        return false;

    }

    return true;

}

// 주민등록 인증 초기화
function signupRealJuminReset()
{

    var f = document.formSignup;

    // 초기화
    f.real_user_name.value = "";
    f.real_user_jumin.value = "";
    f.real_jumin_check.value = "";

}

// 이메일 발송
function signupEmailSend()
{

    var f = document.formSignup;

    if (f.user_name.value == '') {

        alert("성명을 입력하세요.");
        f.user_name.focus();
        return false;

    }

    if (isValid_name(f.user_name.value) == 0) {

        f.user_name.focus();
        return false;

    }

    if (f.user_email.value == '') {

        alert("이메일주소를 입력하세요.");
        f.user_email.focus();
        return false;

    }

    signupRealEmailLayer("send");

    if (f.page_id.value == 'signup') {

        f.real_email_code.value = "";
        f.real_email_code_check.value = "";
        f.real_email.value = "";

        $.post(shop_path+"/signup_email_send.php", {"page_id" : f.page_id.value, "user_name" : f.user_name.value, "user_email" : f.user_email.value}, function(data) {
    
            $("#signup_data").html(data);
    
        });

    } else {

        f.real_email_code.value = "";
        f.real_email_code_check.value = "";
        f.real_email1.value = "";
        f.real_email2.value = "";

        $.post(shop_path+"/signup_email_send.php", {"page_id" : f.page_id.value, "user_name" : f.user_name.value, "user_email1" : f.user_email1.value, "user_email2" : f.user_email2.value}, function(data) {

            $("#signup_data").html(data);

        });

    }

}

// 이메일 인증 체크
function signupEmailCheck()
{

    var f = document.formSignup;

    if (f.real_email_code.value == '') {

        alert("이메일 인증번호가 발송되지 않았습니다.");
        return false;

    }

    if (f.page_id.value == 'signup') {

        if (f.user_email.value != f.real_email.value || f.user_email.value == '') {

            alert("이메일 주소가 변경되었습니다. 새로 인증을 하셔야 합니다.");
            signupRealEmailReset();
            f.user_email.focus();
            return false;

        }

    } else {

        if (f.user_email1.value != f.real_email1.value || f.user_email1.value == '') {

            alert("이메일 주소가 변경되었습니다. 새로 인증을 하셔야 합니다.");
            signupRealEmailReset();
            f.user_email1.focus();
            return false;

        }

        if (f.user_email2.value != f.real_email2.value || f.user_email2.value == '') {

            alert("이메일 주소가 변경되었습니다. 새로 인증을 하셔야 합니다.");
            signupRealEmailReset();
            f.user_email2.focus();
            return false;

        }

    }

    if (f.real_email_code.value == '') {

        alert("이메일 인증번호가 발송되지 않았습니다.");
        return false;

    }

    if (f.real_email_code_check.value == '') {

        alert("이메일 인증번호를 입력하세요.");
        f.real_email_code_check.focus();
        return false;

    }

    if (f.real_email_code.value != f.real_email_code_check.value) {

        alert("이메일 인증번호가 틀립니다.");
        f.real_email_code_check.focus();
        return false;

    }

    if (f.page_id.value == 'signup') {

        f.real_email_check.value = f.user_email.value;

    } else {

        f.real_email_check.value = f.user_email1.value+"@"+f.user_email2.value;

    }

    signupRealEmailLayer("ok");

    return true;

}

// 이메일 인증 레이어
function signupRealEmailLayer(mode)
{

    if (mode == 'send') {

        document.getElementById("signup_real_email_layer1").style.display = "none";
        document.getElementById("signup_real_email_layer2").style.display = "inline";
        document.getElementById("signup_real_email_layer3").style.display = "none";

    }

    else if (mode == 'ok') {

        document.getElementById("signup_real_email_layer1").style.display = "none";
        document.getElementById("signup_real_email_layer2").style.display = "none";
        document.getElementById("signup_real_email_layer3").style.display = "inline";

    } else {

        document.getElementById("signup_real_email_layer1").style.display = "inline";
        document.getElementById("signup_real_email_layer2").style.display = "none";
        document.getElementById("signup_real_email_layer3").style.display = "none";

    }

}

// 이메일 인증 초기화
function signupRealEmailReset()
{

    var f = document.formSignup;

    if (f.page_id.value == 'signup') {

        f.real_email_code.value = "";
        f.real_email_code_check.value = "";
        f.real_email.value = "";

    } else {

        f.real_email_code.value = "";
        f.real_email_code_check.value = "";
        f.real_email1.value = "";
        f.real_email2.value = "";

    }

    signupRealEmailLayer("");

}

// SMS 발송
function signupHpSend()
{

    var f = document.formSignup;

    if (f.user_hp1.value == '') {

        alert("휴대폰 번호를 입력하세요.");
        f.user_hp1.focus();
        return false;

    }

    if (f.user_hp2.value == '') {

        alert("휴대폰 번호를 입력하세요.");
        f.user_hp2.focus();
        return false;

    }

    if (f.user_hp3.value == '') {

        alert("휴대폰 번호를 입력하세요.");
        f.user_hp3.focus();
        return false;

    }

    signupRealHpLayer("send");

    // 초기화
    f.real_hp_code.value = "";
    f.real_hp_code_check.value = "";
    f.real_hp1.value = "";
    f.real_hp2.value = "";
    f.real_hp3.value = "";

    $.post(shop_path+"/signup_hp_send.php", {"page_id" : f.page_id.value, "user_hp1" : f.user_hp1.value, "user_hp2" : f.user_hp2.value, "user_hp3" : f.user_hp3.value}, function(data) {

        $("#signup_data").html(data);

    });

}

// 휴대폰 인증 체크
function signupHpCheck()
{

    var f = document.formSignup;

    if (f.real_hp_code.value == '') {

        alert("휴대폰 인증번호가 발송되지 않았습니다.");
        return false;

    }

    if (f.user_hp1.value != f.real_hp1.value || f.user_hp1.value == '') {

        alert("휴대폰 번호가 변경되었습니다. 새로 인증을 하셔야 합니다.");
        signupRealHpReset();
        return false;

    }

    if (f.user_hp2.value != f.real_hp2.value || f.user_hp2.value == '') {

        alert("휴대폰 번호가 변경되었습니다. 새로 인증을 하셔야 합니다.");
        signupRealHpReset();
        f.user_hp2.focus();
        return false;

    }

    if (f.user_hp3.value != f.real_hp3.value || f.user_hp3.value == '') {

        alert("휴대폰 번호가 변경되었습니다. 새로 인증을 하셔야 합니다.");
        signupRealHpReset();
        return false;

    }

    if (f.real_hp_code.value == '') {

        alert("휴대폰 인증번호가 발송되지 않았습니다.");
        return false;

    }

    if (f.real_hp_code_check.value == '') {

        alert("휴대폰 인증번호를 입력하세요.");
        f.real_hp_code_check.focus();
        return false;

    }

    if (f.real_hp_code.value != f.real_hp_code_check.value) {

        alert("휴대폰 인증번호가 틀립니다.");
        f.real_hp_code_check.focus();
        return false;

    }

    // 인증완료
    f.real_hp_check.value = f.user_hp1.value+"-"+f.user_hp2.value+"-"+f.user_hp3.value;

    signupRealHpLayer("ok");

    return true;

}

// 휴대폰 인증 레이어
function signupRealHpLayer(mode)
{

    if (mode == 'send') {

        document.getElementById("signup_real_hp_layer1").style.display = "none";
        document.getElementById("signup_real_hp_layer2").style.display = "inline";
        document.getElementById("signup_real_hp_layer3").style.display = "none";

    }

    else if (mode == 'ok') {

        document.getElementById("signup_real_hp_layer1").style.display = "none";
        document.getElementById("signup_real_hp_layer2").style.display = "none";
        document.getElementById("signup_real_hp_layer3").style.display = "inline";

    } else {

        document.getElementById("signup_real_hp_layer1").style.display = "inline";
        document.getElementById("signup_real_hp_layer2").style.display = "none";
        document.getElementById("signup_real_hp_layer3").style.display = "none";

    }

}

// 휴대폰 인증 초기화
function signupRealHpReset()
{

    var f = document.formSignup;

    // 초기화
    f.real_hp_code.value = "";
    f.real_hp_code_check.value = "";
    f.real_hp1.value = "";
    f.real_hp2.value = "";
    f.real_hp3.value = "";

    signupRealHpLayer("");

}

// 본인 인증
function signupMySend()
{

    var f = document.formSignup;

    if (f.user_name.value == '') {

        alert("성명을 입력하세요.");
        f.user_name.focus();
        return false;

    }

    if (isValid_name(f.user_name.value) == 0) {

        f.user_name.focus();
        return false;

    }

    if (f.user_jumin1.value == '') {

        alert("주민등록번호 앞자리를 입력하세요");
        f.user_jumin1.focus();
        return false;

    }

    if (f.user_jumin1.value.length != 6) {

        alert("유효한 주민등록번호가 아닙니다");
        f.user_jumin1.focus();
        return false;

    }

    if (f.user_jumin2.value == '') {

        alert("주민등록번호 뒷자리를 입력하세요");
        f.user_jumin2.focus();
        return false;

    }

    if (f.user_jumin2.value.length != 7) {

        alert("유효한 주민등록번호가 아닙니다");
        f.user_jumin2.focus();
        return false;

    }

    var socno = (f.user_jumin1.value + f.user_jumin2.value);
    var rVal1 = isValid_socno(socno);

    if (rVal1 != true) {

        alert("주민등록번호가 유효하지 않습니다. 다시 입력하세요");

        if (f.user_jumin1.disabled) {

            f.user_jumin2.focus();

        } else {

            f.user_jumin1.focus();

        }

        return false;

    }

    if (f.real_type.value == '') {

        alert("인증수단을 선택하세요.");
        return false;

    }

    f.real_jumin_check.value = "";
    f.real_user_name.value = "";
    f.real_user_jumin.value = "";

    $.post(shop_path+"/real/kcb/check.php", {"page_id" : f.page_id.value, "user_name" : f.user_name.value, "user_jumin1" : f.user_jumin1.value, "user_jumin2" : f.user_jumin2.value, "real_type" : f.real_type.value}, function(data) {

        $("#signup_data").html(data);

    });

}

// 패스워드 질문 선택
function signupPasswordQ(val)
{

    var f = document.formSignup;

    f.user_pw_q.value = val;

}

// 이메일 선택
function signupEmail()
{

    var f = document.formSignup;

    if (f.user_email_list.value != '' && f.user_email_list.value != 'self') {

        f.user_email2.value = f.user_email_list.value;
        f.user_email2.style.display = "none";

    }

    else if (f.user_email_list.value == 'self') {

        f.user_email2.value = "";
        f.user_email2.focus();
        f.user_email2.style.display = "";

    }

}

// 추천인 체크
function signupRecommend()
{

    var f = document.formSignup;

    if (f.user_recommend.value == '') {

        alert("추천인 아이디를 입력하세요.");
        f.user_recommend.focus();
        return false;

    }

    var f = document.formSignup;

    if (f.user_recommend.value == '') {

        alert("추천인 아이디를 입력하세요.");
        f.user_recommend.focus();
        return false;

    } else {

        retVal = isValid_id(f.user_recommend.value);

        if (!retVal) {

            f.user_recommend.focus();
            return false;

        }

    }

    $.post(shop_path+"/signup_user_recommend_check.php", {"user_id" : f.user_recommend.value}, function(data) {

        $("#user_recommend_message").html(data);

    });

}

// 아이디 중복
function signupIdOverlap()
{

    var f = document.formSignup;

    if (f.user_id.value == '') {

        alert("아이디를 입력하세요.");
        f.user_id.focus();
        return false;

    } else {

        retVal = isValid_id(f.user_id.value);

        if (!retVal) {

            f.user_id.focus();
            return false;

        }

    }

    $.post(shop_path+"/signup_user_id_check.php", {"user_id" : f.user_id.value}, function(data) {

        $("#user_id_message").html(data);

    });

}

// 닉네임 중복
function signupNickOverlap()
{

    var f = document.formSignup;

    if (f.user_nick.value == '') {

        alert("닉네임을 입력하세요.");
        f.user_nick.focus();
        return false;

    } else {

        retVal = isValid_nick(f.user_nick.value);

        if (!retVal) {

            f.user_nick.focus();
            return false;

        }

    }

    $.post(shop_path+"/signup_user_nick_check.php", {"user_nick" : f.user_nick.value}, function(data) {

        $("#user_nick_message").html(data);

    });

}

// 생년월일 체크
function signupBirthCheck()
{

    var f = document.formSignup;

    if (f.user_birth1.value == '') {

        alert("생년월일의 년도를 입력하세요.");
        f.user_birth1.focus();
        return false;

    }

    if (f.user_birth2.value == '') {

        alert("생년월일의 월을 입력하세요.");
        f.user_birth2.focus();
        return false;

    }

    if (f.user_birth3.value == '') {

        alert("생년월일의 일을 입력하세요.");
        f.user_birth3.focus();
        return false;

    }

    if (f.user_birth1.value.length != '4') {

        alert("유효한 생년월일이 아닙니다. (예제 : 1990)");
        f.user_birth1.focus();
        return false;

    }

    if (f.user_birth2.value.length != '2') {

        alert("유효한 생년월일이 아닙니다. (예제 : 01)");
        f.user_birth2.focus();
        return false;

    }

    if (f.user_birth3.value.length != '2') {

        alert("유효한 생년월일이 아닙니다. (예제 : 01)");
        f.user_birth3.focus();
        return false;

    }

    var user_birth1 = parseInt(f.user_birth1.value, 10);
    var user_birth2 = parseInt(f.user_birth2.value, 10);
    var user_birth3 = parseInt(f.user_birth3.value, 10);

    if (user_birth1 < '1900' || user_birth1 > signup_year || !isNumeric(user_birth1)) {

        alert("유효한 생년월일이 아닙니다.");
        f.user_birth1.focus();
        return false;

    }

    if (user_birth2 < '1' || user_birth2 > '12' || !isNumeric(user_birth2)) {

        alert("유효한 생년월일이 아닙니다.");
        f.user_birth2.focus();
        return false;

    }

    if (user_birth3 < '1' || user_birth3 > '31' || !isNumeric(user_birth3)) {

        alert("유효한 생년월일이 아닙니다.");
        f.user_birth3.focus();
        return false;

    }

    return true;

}