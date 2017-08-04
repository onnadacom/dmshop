// 주민번호 입력할 때 자동으로 다음 input 으로 이동한다.
var next_go = true;
var cur_val = null;

function moveNext(id_from, id_to, maxSize)
{

    var cur = document.getElementById(id_from).value;

    curSize = cur.length;
    numFlag = isNumeric(cur);
    
    if (!numFlag && curSize >= 1 && cur != '00' &&  cur != '000') {

        alert('숫자를 넣어주세요');

        document.getElementById(id_from).value='';
        document.getElementById(id_from).focus();

        return false;

    }

    if (curSize == maxSize) {

        if (next_go || cur_val != cur) {

            cur_val = cur;
            next_go = false;

            document.getElementById(id_to).focus();

        }

        return true;

    }

    next_go = true;

}

function containsCharsOnly(input, chars)
{

    for (var i=0; i< input.length; i++) {

        if (chars.indexOf(input.charAt(i)) == -1) {

            return false;

        }

  }

  return  true;

}

function isNumeric(input)
{

    var chars = "0123456789";

    return containsCharsOnly(input,chars);

}

function isValid_name(str)
{

    str = str.replace(/(^\s*)|(\s*$)/g, "");

    if (str == ''){

        alert("이름을 입력하세요.");
        return false;

    }
    
    var retVal = checkSpace(str);

    if (retVal){

        alert("이름은 띄어쓰기 없이 입력하세요.");
        return false;

    }

    if (!isHangul(str)) {

        alert("이름을 한글로 입력하세요.");
        return false;

    }

    if (str.length > 10) {

        alert("이름은 10자까지만 사용할 수 있습니다.");
        return false;

    }

    return true;

}

function isValid_nick(str)
{

    str = str.replace(/(^\s*)|(\s*$)/g, "");

    if (str == '') {

        alert("별명을 입력하세요.");
        return false;

    }
    
    var retVal = checkSpace(str);

    if (retVal) {

        alert("별명은 띄어쓰기 없이 입력하세요.");
        return false;

    }

    if (str.length > 20) {

        alert("별명은 20자까지만 사용할 수 있습니다.");
        return false;

    }

    return true;

}

function isValid_id(str)
{
     // check whether input value is included space or not
     if( str == ""){
     	alert("아이디를 입력하세요.");
     	return false;
     }

	// 아이디 가운데 빈 공간이 없도록 체크한다.
     var retVal = checkSpace( str );
     if( retVal ) {
         alert("아이디는 빈 공간 없이 연속된 영문 소문자와 숫자만 사용할 수 있습니다.");
         return false;
     }

     // 아이디는 '-' 로 시작할 수 없다.
	if( str.charAt(0) == '_') {
		alert("아이디의 첫문자는 '_'로 시작할수 없습니다.");
		return false;
	}

     // 길이와 허용 문자를 체크한다.
     var isID = /^[a-z0-9_]{3,12}$/;
     if( !isID.test(str) ) {
         alert("아이디는 3~12자의 영문 소문자와 숫자,특수기호(_)만 사용할 수 있습니다.");
         return false;
     }

	 var isNum = /\d/;
     var i;
     var cnt = 0;
     for( i=0; i < str.length; i++) {
     	if( isNum.test( str.substring( i, i+1 ) ) ) {
     		cnt++;
     	}
     	if( cnt > 7 ) {
     		alert("같은 문자가 7개 이상 사용되면 안됩니다.");
     		return false;
     	}
     }

     return true;
}

function isValid_passwd(str)
{
     var cnt = 0;
     if( str == ""){
     	alert("비밀번호를 입력하세요.");
     	return false;
     }

    /* check whether input value is included space or not  */
     var retVal = checkSpace( str );
     if( retVal ) {
         alert("비밀번호에는 공백이 있으면 안됩니다.");
         return false;
     }
			if( str.length < 6 ){
				alert("비밀번호는 6~16자의 영문 대소문자와 숫자, 특수문자를 사용할 수 있습니다.");
				return false;
			}
     for( var i=0; i < str.length; ++i)
     {
         if( str.charAt(0) == str.substring( i, i+1 ) ) ++cnt;
     }
     if( cnt == str.length ) {
         alert("보안상의 이유로 한 문자로 연속된 비밀번호는 허용하지 않습니다.");
         return false;
     }

     var isPW = /^[A-Za-z0-9`\-=\\\[\];',\./~!@#\$%\^&\*\(\)_\+|\{\}:"<>\?]{6,16}$/;
     if( !isPW.test(str) ) {
         alert("비밀번호는 6~16자의 영문 대소문자와 숫자, 특수문자를 사용할 수 있습니다.");
         return false;
     }
     return true;
}

function isValid_email(str)
{

    /* check whether input value is included space or not  */
    if (str == "") {
    
        alert("이메일 주소를 입력하세요.");
        return false;
    
    }

    var retVal = checkSpace( str );

    if (retVal) {

        alert("이메일 주소를 빈공간 없이 넣으세요.");
        return false;

    }
    
    if (-1 == str.indexOf('.')) {

        alert("이메일 형식이 잘못 되었습니다.");
        return false;

    }
    
    /* checkFormat */
    var isEmail = /[-!#$%&'*+\/^_~{}|0-9a-zA-Z]+(\.[-!#$%&'*+\/^_~{}|0-9a-zA-Z]+)*@[-!#$%&'*+\/^_~{}|0-9a-zA-Z]+(\.[-!#$%&'*+\/^_~{}|0-9a-zA-Z]+)*/;

    if (!isEmail.test(str)) {

        alert("이메일 형식이 잘못 되었습니다.");
        return false;

    }

    if (str.length > 60) {

        alert("이메일 주소는 60자까지 유효합니다.");
        return false;

    }
    
    return true;

}

function isValid_email2(word){

    for (var i=0; i< word.length; i++) {

        var checkStr = word.charAt(i);
        
        if ("@" == checkStr) {
    
            return false;
    
        }

    }

    return true;

}

function checkSpace(str)
{

    if (str.search(/\s/) != -1) {

        return true;

    } else {

        return false;

    }

}

function isHangul(s)
{

     var len;

     len = s.length;

     for (var i = 0; i < len; i++)  {

         if (s.charCodeAt(i) != 32 && (s.charCodeAt(i) < 44032 || s.charCodeAt(i) > 55203)) {

            return false;

        }

     }

     return true;

}

// 주민번호 7번째 자리의 규칙 ########################
// 1800년대: 남자 9, 여자 0
// 1900년대: 남자 1, 여자 2
// 2000년대: 남자 3, 여자 4
// 2100년대: 남자 5, 여자 6
// 외국인 등록번호: 남자 7, 여자 8

// 주민번호, 외국인 등록번호의  validation 체크 함수
function isValid_socno(socno)
{

    var socnoStr = socno.toString();
    a = socnoStr.substring(0, 1);
    b = socnoStr.substring(1, 2);
    c = socnoStr.substring(2, 3);
    d = socnoStr.substring(3, 4);
    e = socnoStr.substring(4, 5);
    f = socnoStr.substring(5, 6);
    g = socnoStr.substring(6, 7);
    h = socnoStr.substring(7, 8);
    i = socnoStr.substring(8, 9);
    j = socnoStr.substring(9, 10);
    k = socnoStr.substring(10, 11);
    l = socnoStr.substring(11, 12);
    m = socnoStr.substring(12, 13);
    month = socnoStr.substring(2,4);
    day = socnoStr.substring(4,6);
    socnoStr1 = socnoStr.substring(0, 7);
    socnoStr2 = socnoStr.substring(7, 13);
    
    // 월,일 Validation Check
    if (month <= 0 || month > 12) {

        return false;

    }

    if (day <= 0 || day > 31) {

        return false;

    }
    
    // 주민등록번호에 공백이 들어가도 가입이 되는 경우가 발생하지 않도록 한다.
    if (isNaN(socnoStr1) || isNaN(socnoStr2)) {

        return false;

    }
    
    temp=a*2+b*3+c*4+d*5+e*6+f*7+g*8+h*9+i*2+j*3+k*4+l*5;
    temp=temp%11;
    temp=11-temp;
    temp=temp%10;
    
    if (temp == m) {
    
        return true;
    
    } else {
    
        return false;
    
    }

}