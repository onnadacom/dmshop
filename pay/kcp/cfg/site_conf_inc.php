<?php
if (!defined('_DMSHOP_')) exit;

/*------------------------------------------------------------
    결제 정보 환경 설정
    Copyright (c) 2013 KCP Inc. All Rights Reserverd.
------------------------------------------------------------*/

/*
$g_conf_home_dir = "/home/user/pay/kcp";
$g_conf_key_dir ="/home/user/pay/kcp";
$g_conf_log_dir = "/home/user/pay/kcp/log"; // 영향이 없음. pp_cli 위치로 기준

접근이 불가한 곳에 kcp 로그파일이 생성되도록 변경하려면 다음과 같은 형식으로 파일을 옮깁니다. (pp_cli 파일이 위치한 상위 폴더에 log 폴더가 생성됩니다. 퍼미션 읽기 쓰기 확인)

ex) dmshop 설치 절대경로
/home/user/www
/home/user/kcp/bin/pp_cli
/home/user/kcp/log
*/

$g_conf_home_dir = $shop['path']."/pay/kcp";
$g_conf_key_dir = $shop['path']."/pay/kcp/bin";
$g_conf_log_dir = $shop['path']."/pay/kcp/log";

$g_conf_gw_url = "paygw.kcp.co.kr";
$g_conf_js_url = "https://pay.kcp.co.kr/plugin/payplus_un.js";
$g_wsdl           = "real_KCPPaymentService.wsdl";
$g_conf_site_cd = $dmshop['kcp_site_code'];
$g_conf_site_key = $dmshop['kcp_site_key'];
$g_conf_site_name = $dmshop['kcp_site_name'];

$g_conf_log_level = "3"; // 변경불가
$g_conf_gw_port = "8090"; // 포트번호(변경불가)
$module_type = "01"; // 변경불가
?>