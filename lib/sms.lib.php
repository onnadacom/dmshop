<?
if (!defined("_DMSHOP_")) exit;

// 아이코드 정보
$icode_id = $dmshop['icode_id'];
$icode_pw = $dmshop['icode_pw'];

// sms 설정
function shop_sms_config($sms_code)
{

    global $shop;

    return sql_fetch(" select * from $shop[sms_config_table] where sms_code = '$sms_code' ");

}

// sms 유형
function shop_sms_code($sms_code)
{

    if (!$sms_code) {
        return false;
    }

    if ($sms_code == 'signup') {
        $data = "회원가입 완료";
    }
    else if ($sms_code == 'hp_real') {
        $data = "휴대폰 인증";
    }
    else if ($sms_code == 'birth') {
        $data = "생일기념";
    }
    else if ($sms_code == 'order') {
        $data = "상품주문시";
    }
    else if ($sms_code == 'order_pg') {
        $data = "전자결제 안내";
    }
    else if ($sms_code == 'order_bank') {
        $data = "무통장  입금 안내";
    }
    else if ($sms_code == 'order_bank_self') {
        $data = "입금정보 문자로 받기";
    }
    else if ($sms_code == 'order_bank_ok') {
        $data = "무통장 입금확인";
    }
    else if ($sms_code == 'delivery') {
        $data = "상품 발송";
    }
    else if ($sms_code == 'coupon') {
        $data = "쿠폰 지급 (관리자 지급)";
    }
    else if ($sms_code == 'coupon_auto') {
        $data = "쿠폰 지급 (자동 지급)";
    }
    else if ($sms_code == 'help') {
        $data = "1:1문의 답변";
    }
    else if ($sms_code == 'adm_signup') {
        $data = "회원가입 (관리자 수신)";
    }
    else if ($sms_code == 'admin_order') {
        $data = "상품주문 (관리자 수신)";
    }
    else if ($sms_code == 'admin_order_ok') {
        $data = "결제완료 (관리자 수신)";
    }
    else if ($sms_code == 'admin_help') {
        $data = "1:1문의 접수 (관리자 수신)";
    }
    else if ($sms_code == 'item_self') {
        $data = "SNS 직접 발송";
    }
    else if ($sms_code == 'self') {
        $data = "직접 발송";
    } else {
        return false;
    }

    return $data;

}

// sms send
function shop_sms_send($sms_code, $to_id, $hps, $callback, $msg, $chkSendFlag="", $R_YEAR="", $R_MONTH="", $R_DAY="", $R_HOUR="", $R_MIN="")
{

    global $shop, $dmshop, $dmshop_user, $icode_id, $icode_pw;

    $strDest = array();

    $hps = str_replace("-", "", $hps);
    $callback = str_replace("-", "", $callback);

    if (!$hps || !$callback) {
        return false;
    }

    if (is_array($hps)) {

        for ($i=0; $i<count($hps); $i++) {

            $hp = $hps[$i];

            if (trim($hp)) {

                $strDest[] = $hp;

            }

        }

    } else {

        $strDest[] = $hps;

    }

    $strCallBack = $callback;
    $strData = $msg;

    $socket_host = "211.172.232.124";
    $port_setting = 1;

    $SMS = new smsBasicSMS;
    $SMS->SMS_con($socket_host,$icode_id,$icode_pw,$port_setting);

    $nCount = count($strDest);

    if ($chkSendFlag) {

        $strDate = $R_YEAR.$R_MONTH.$R_DAY.$R_HOUR.$R_MIN;

    } else {

        $strDate = "";

    }

    $strData = iconv("UTF-8", "EUC-KR", $strData);

    $result = $SMS->Add($strDest, $strCallBack, $strCaller, $strURL, $strData, $strDate, $nCount);

    $strData = iconv("EUC-KR", "UTF-8", $strData);

    if ($result) {

        $result = $SMS->Send();

/*
        if ($result) {

            $SMS->Init();

        }
*/

    }

    if ($chkSendFlag) {

        $datetime = $R_YEAR."-".$R_MONTH."-".$R_DAY." ".$R_HOUR.":".$R_MIN.":00";

    } else {

        $datetime = $shop['time_ymdhis'];

    }

    $sql_common = "";
    $sql_common .= " set sms_code = '".$sms_code."' ";
    $sql_common .= ", user_id = '".addslashes($dmshop_user['user_id'])."' ";
    $sql_common .= ", to_id = '".addslashes($to_id)."' ";
    $sql_common .= ", sms_to = '".addslashes($hps)."' ";
    $sql_common .= ", sms_from = '".addslashes($callback)."' ";
    $sql_common .= ", sms_message = '".addslashes($msg)."' ";
    $sql_common .= ", datetime = '".$datetime."' ";

    sql_query(" insert into $shop[sms_log_table] $sql_common ");

}

// sms sock
function shop_sms_sock($url)
{

    // host 와 uri 를 분리
    if (preg_match("/http:\/\/([a-zA-Z0-9_\-\.]+)([^<]*)/", $url, $res)) {

        $host = $res[1];
        $get  = $res[2];

    }

    // 80번 포트로 소캣접속 시도
    $fp = fsockopen ($host, 80, $errno, $errstr, 30);
    if (!$fp) {

        die("$errstr ($errno)\n");

    } else {

        fputs($fp, "GET $get HTTP/1.0\r\n");
        fputs($fp, "Host: $host\r\n");
        fputs($fp, "\r\n");

        // header 와 content 를 분리한다.
        while (trim($buffer = fgets($fp,1024)) != "") {

            $header .= $buffer;

        }

        while (!feof($fp)) {

            $buffer .= fgets($fp,1024);

        }

    }

    fclose($fp);

    // content 만 return 한다.
    return $buffer;

}

class smsBasicSMS
{

    var $icode_id;
    var $icode_pw;
    var $socket_host;
    var $socket_port;
    var $Data = array();
    var $Result = array();

    // 접속을 위해 사용하는 변수를 정리한다.
    function SMS_con($host,$id,$pw,$portcode)
    {

        if ($portcode == 1) {

            $port=(int)rand(7192,7195);

        } else {

            $port=(int)rand(7196,7199);

        }

        $this->socket_host	= $host;
        $this->socket_port	= $port;
        $this->icode_id = smsBasicFillSpace($id, 10);
        $this->icode_pw = smsBasicFillSpace($pw, 10);

    }

    function Init() {

        $this->Data = "";	// 발송하기 위한 패킷내용이 배열로 들어간다.
        $this->Result = "";	// 발송결과값이 배열로 들어간다.

    }

    function Add($strDest, $strCallBack, $strCaller, $strURL, $strData, $strDate="", $nCount)
    {

        $Error = smsBasicCheckCommonTypeDest($strDest, $nCount);
        $Error = smsBasicCheckCommonTypeCallBack($strCallBack);
        $Error = smsBasicCheckCommonTypeDate($strDate);
        
        $strCallBack = smsBasicFillSpace($strCallBack,11);
        $strCaller = smsBasicFillSpace($strCaller,10);
        $strDate = smsBasicFillSpace($strDate,12);
        
        for ($i=0; $i<$nCount; $i++) {
        
                $strDest[$i] = smsBasicFillSpace($strDest[$i],11);
        
                if (!$strURL) {
        
                    $strData = smsBasicFillSpace(smsBasicCutChar($strData,80),80);
        
                    $this->Data[$i]	= '01144 '.$this->icode_id.$this->icode_pw.$strDest[$i].$strCallBack.$strCaller.$strDate.$strData;
        
                } else {
        
                    $strURL = smsBasicFillSpace($strURL,50);
                    $strData = smsBasicFillSpace(smsBasicCheckCallCenter($strURL, $strDest[$i], $strData),80);
        
                    $this->Data[$i]	= '05173 '.$this->icode_id.$this->icode_pw.$strDest[$i].$strCallBack.$strURL.$strDate.$strData;
        
                }
        
        }
        
        return true; // 수정대기

    }

    function Send()
    {

        $fsocket=fsockopen($this->socket_host,$this->socket_port);

        if (!$fsocket) return false;

        set_time_limit(300);

        ## php4.3.10일경우
        ## zend 최신버전으로 업해주세요..
        ## 또는 69번째 줄을 $this->Data as $tmp => $puts 로 변경해 주세요.

        foreach($this->Data as $puts) {

            $dest = substr($puts,26,11);

            fputs($fsocket, $puts);

            while(!$gets) {

                $gets = fgets($fsocket,30);

            }

            if (substr($gets,0,19) == "0223  00".$dest)
                $this->Result[] = $dest.":".substr($gets,19,10);
            else
                $this->Result[$dest] = $dest.":Error(".substr($gets,6,2).")";

            $gets = "";

        }

        fclose($fsocket);

        $this->Data = "";

        return true;

    }

}

function smsBasicFillSpace($text,$size)
{

    for ($i=0; $i<$size; $i++) $text.=" ";
    $text = substr($text,0,$size);
    return $text;

}

function smsBasicCutChar($word, $cut)
{

    $word=substr($word,0,$cut); // 필요한 길이만큼 취함.

    for ($k=$cut-1; $k>1; $k--) {

        if (ord(substr($word,$k,1))<128) break; // 한글값은 160 이상.

    }

    $word=substr($word,0,$cut-($cut-$k+1)%2);

    return $word;

}

function smsBasicCheckCommonTypeDest($strDest, $nCount)
{

    for ($i=0; $i<$nCount; $i++) {

        $strDest[$i]=preg_replace("[^0-9]","",$strDest[$i]);

        if (strlen($strDest[$i])<10 || strlen($strDest[$i])>11) return "휴대폰 번호가 틀렸습니다";

        $CID=substr($strDest[$i],0,3);

        if ( preg_match("/^[0-9]/",$CID) || ($CID!='010' && $CID!='011' && $CID!='016' && $CID!='017' && $CID!='018' && $CID!='019') ) return "휴대폰 앞자리 번호가 잘못되었습니다";

    }

}

function smsBasicCheckCommonTypeCallBack($strCallBack)
{

    if (preg_match("/^[0-9]/", $strCallBack)) return "회신 전화번호가 잘못되었습니다";

}

function smsBasicCheckCommonTypeDate($strDate)
{

    $strDate=preg_replace("/^[0-9]/","",$strDate);

    if ($strDate) {

        if (!checkdate(substr($strDate,4,2),substr($strDate,6,2),substr($rsvTime,0,4))) return "예약날짜가 잘못되었습니다";
        if (substr($strDate,8,2)>23 || substr($strDate,10,2)>59) return "예약시간이 잘못되었습니다";

    }

}

function smsBasicCheckCallCenter($url, $dest, $data)
{

    switch (substr($dest,0,3)) {

        case '010': //20바이트
            return smsBasicCutChar($data,20);
            break;
        case '011': //80바이트
            return smsBasicCutChar($data,80);
            break;
        case '016': // 80바이트
            return smsBasicCutChar($data,80);
            break;
        case '017': // URL 포함 80바이트
            return smsBasicCutChar($data,80 - strlen($url));
            break;
        case '018': // 20바이트
            return smsBasicCutChar($data,20);
            break;
        case '019': // 20바이트
            return smsBasicCutChar($data,20);
            break;
        default:
            return smsBasicCutChar($data,80);
            break;

    }

}
?>