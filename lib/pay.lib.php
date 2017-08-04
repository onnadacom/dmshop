<?php
if (!defined("_DMSHOP_")) exit;

// 결제사 취소
function shop_pg_cancel($order_code)
{

    global $shop, $dmshop, $dmshop_user;

    if (!$order_code) {

        return false;

    }

    // 주문정보
    $dmshop_order = shop_order($order_code);
    
    // 데이터가 없다
    if (!$dmshop_order['id']) {

        return false;

    }

    // kcp
    if ($dmshop_order['order_pg'] == '3') {

        // 데이터가 없다
        if (!$dmshop['kcp_site_code'] || !$dmshop_order['order_pg_code1']) {

            return false;

        }

        // lib
        include_once("$shop[path]/pay/kcp/cfg/site_conf_inc.php");
        include_once("$shop[path]/pay/kcp/pp_ax_hub_lib.php");

        $tno = $dmshop_order['order_pg_code1'];
        $cust_ip = getenv("REMOTE_ADDR");
        $ordr_idxx = $order_code;
        $tran_cd = "00200000";

        // 에스크로
        if ($dmshop_order['order_pg_escrow']) {

            // 배송전
            if ($dmshop_order['order_pg_escrow'] == '1') {

                // 가상계좌 미결제
                if ($dmshop_order['order_pay_type'] == '4' && $dmshop_order['order_payment'] == '1') {

                    // 가상계좌 발급취소
                    $mod_type = "STE5";

                } else {
                // 기타

                    // 즉시 취소
                    $mod_type = "STE2";

                }

            }

            // 배송시작 단계
            else if ($dmshop_order['order_pg_escrow'] == '2') {

                // 정산보류
                $mod_type = "STE3";

                $c_PayPlus = new C_PP_CLI;
                $c_PayPlus->mf_clear();
                $c_PayPlus->mf_set_modx_data("tno", $tno); // KCP 원거래 거래번호
                $c_PayPlus->mf_set_modx_data("mod_type", $mod_type); // 원거래 변경 요청 종류
                $c_PayPlus->mf_set_modx_data("mod_ip", $cust_ip); // 변경 요청자 IP
                $c_PayPlus->mf_set_modx_data("mod_desc", ""); // 변경 사유

                $c_PayPlus->mf_do_tx($tno, $g_conf_home_dir, $g_conf_site_cd, $g_conf_site_key, $tran_cd, "", $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx, $cust_ip, $g_conf_log_level, 0, 0, $g_conf_key_dir, $g_conf_log_dir);

                $res_cd  = $c_PayPlus->m_res_cd;  // 결과 코드
                $res_msg = $c_PayPlus->m_res_msg; // 결과 메시지
                $res_msg = mb_convert_encoding($res_msg, 'UTF-8', 'CP949'); // 한글 문자열을 변환

                if ($res_cd != '0000') {

                    echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$shop[charset]\">";
                    echo "<script type='text/javascript'>alert('KCP 에스크로 정산보류 요청을 실패하였습니다.\\n\\n가맹점 상점관리에서 직접 정산보류 후 취소신청 하시기 바랍니다.\\n\\n결과 메세지 : {$res_msg}\\n\\n주문번호 : {$order_code}');</script>";

                }

                // 취소
                $mod_type = "STE4";

            }

            // 정산보류 단계
            else if ($dmshop_order['order_pg_escrow'] == '3') {

                // 취소
                $mod_type = "STE4";

            } else {
            // 기타

                // 즉시 취소
                $mod_type = "STE2";

            }

        } else {
        // 일반결제

            $mod_type = "STSC";

            // 결제완료된 가상계좌는 취소가 안 된다.
            if ($dmshop_order['order_pay_type'] == '4' && $dmshop_order['order_payment'] == '2') {

                return false;

            }

        }

        $c_PayPlus = new C_PP_CLI;
        $c_PayPlus->mf_clear();
        $c_PayPlus->mf_set_modx_data("tno", $tno); // KCP 원거래 거래번호
        $c_PayPlus->mf_set_modx_data("mod_type", $mod_type); // 원거래 변경 요청 종류
        $c_PayPlus->mf_set_modx_data("mod_ip", $cust_ip); // 변경 요청자 IP
        $c_PayPlus->mf_set_modx_data("mod_desc", "관리자 직권취소"); // 변경 사유

        // 에스크로, 가상계좌, 결제완료, 환불계좌 정보가 있다면
        if ($dmshop_order['order_pg_escrow'] && $dmshop_order['order_pay_type'] == '4' && $dmshop_order['order_payment'] == '2' && $dmshop_order['order_refund_number'] && $dmshop_order['order_refund_holder'] && $dmshop_order['order_refund_code']) {

            $c_PayPlus->mf_set_modx_data("refund_account", $dmshop_order['order_refund_number']); // 환불수취계좌번호
            $c_PayPlus->mf_set_modx_data("refund_nm", $dmshop_order['order_refund_holder']); // 환불수취계좌주명
            $c_PayPlus->mf_set_modx_data("bank_code", $dmshop_order['order_refund_code']); // 환불수취은행코드

        }

        $c_PayPlus->mf_do_tx($tno, $g_conf_home_dir, $g_conf_site_cd, $g_conf_site_key, $tran_cd, "", $g_conf_gw_url, $g_conf_gw_port, "payplus_cli_slib", $ordr_idxx, $cust_ip, $g_conf_log_level, 0, 0, $g_conf_key_dir, $g_conf_log_dir);

        $res_cd  = $c_PayPlus->m_res_cd;  // 결과 코드
        $res_msg = $c_PayPlus->m_res_msg; // 결과 메시지
        $res_msg = mb_convert_encoding($res_msg, 'UTF-8', 'CP949'); // 한글 문자열을 변환

        if ($res_cd == '0000') {

            return true;

        } else {

            echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=$shop[charset]\">";
            echo "<script type='text/javascript'>alert('KCP 결제취소 요청을 실패하였습니다.\\n\\n가맹점 상점관리에서 직접 취소신청 하시기 바랍니다.\\n\\n결과 메세지 : {$res_msg}\\n\\n주문번호 : {$order_code}');</script>";

            return false;

        }

    } else {

        return false;

    }

}

// 결제사 이름
function shop_pg_name($order_pg)
{

    if ($order_pg == '1') {

        $name = "이니시스";

    }

    else if ($order_pg == '2') {

        $name = "올더게이트";

    }

    else if ($order_pg == '3') {

        $name = "KCP";

    }

    else if ($order_pg == '4') {

        $name = "KICC";

    }

    else if ($order_pg == '5') {

        $name = "LG U+";

    } else {

        return false;

    }

    return $name;

}

// 결제사 홈페이지
function shop_pg_homepage($order_pg)
{

    if ($order_pg == '1') {

        $name = "https://iniweb.inicis.com/";

    }

    else if ($order_pg == '2') {

        $name = "http://www.allthegate.com/";

    }

    else if ($order_pg == '3') {

        $name = "http://www.kcp.co.kr/";

    }

    else if ($order_pg == '4') {

        $name = "https://www.kicc.co.kr/";

    }

    else if ($order_pg == '5') {

        $name = "http://ecredit.uplus.co.kr";

    } else {

        return false;

    }

    return $name;

}

// 결제사 상점페이지
function shop_pg_admin($order_pg)
{

    if ($order_pg == '1') {

        $name = "https://iniweb.inicis.com";

    }

    else if ($order_pg == '2') {

        $name = "https://www.allthegate.com";

    }

    else if ($order_pg == '3') {

        $name = "https://admin.kcp.co.kr";

    }

    else if ($order_pg == '4') {

        $name = "https://office.easypay.co.kr/";

    }

    else if ($order_pg == '5') {

        $name = "http://pgweb.uplus.co.kr";

    } else {

        return false;

    }

    return $name;

}

// 은행코드
function shop_pg_bankcode($code)
{

    if (!$code) {

        return false;

    }

    if ($code == '01') { $name = ""; }
    else if ($code == '02') { $name = "산업은행"; }
    else if ($code == '03') { $name = "기업은행"; }
    else if ($code == '04') { $name = "국민은행"; }
    else if ($code == '05') { $name = "외환은행"; }
    else if ($code == '07') { $name = "수협중앙회"; }
    else if ($code == '11') { $name = "농협중앙회"; }
    else if ($code == '12') { $name = "단위농협"; }
    else if ($code == '16') { $name = "축협중앙회"; }
    else if ($code == '20') { $name = "우리은행"; }
    else if ($code == '21') { $name = "신한은행"; }
    else if ($code == '23') { $name = "제일은행"; }
    else if ($code == '25') { $name = "하나은행"; }
    else if ($code == '26') { $name = "신한은행"; }
    else if ($code == '27') { $name = "한국씨티은행"; }
    else if ($code == '31') { $name = "대구은행"; }
    else if ($code == '32') { $name = "부산은행"; }
    else if ($code == '34') { $name = "광주은행"; }
    else if ($code == '35') { $name = "제주은행"; }
    else if ($code == '37') { $name = "전북은행"; }
    else if ($code == '38') { $name = "강원은행"; }
    else if ($code == '39') { $name = "경남은행"; }
    else if ($code == '41') { $name = "비씨카드"; }
    else if ($code == '45') { $name = "새마을금고"; }
    else if ($code == '48') { $name = "신협"; }
    else if ($code == '53') { $name = "씨티은행"; }
    else if ($code == '54') { $name = "홍콩상하이은행"; }
    else if ($code == '71') { $name = "우체국"; }
    else if ($code == '81') { $name = "하나은행"; }
    else if ($code == '83') { $name = "평화은행"; }
    else if ($code == '87') { $name = "신세계"; }
    else if ($code == '88') { $name = "신한은행"; }
    else if ($code == '209') { $name = "동양종합금융증권"; }
    else if ($code == '218') { $name = "현대증권"; }
    else if ($code == '230') { $name = "미래에셋증권"; }
    else if ($code == '243') { $name = "한국투자증권"; }
    else if ($code == '247') { $name = "우리투자증권"; }
    else if ($code == '262') { $name = "하이투자증권"; }
    else if ($code == '263') { $name = "HMC투자증권"; }
    else if ($code == '266') { $name = "SK증권"; }
    else if ($code == '267') { $name = "대신증권"; }
    else if ($code == '270') { $name = "하나대투증권"; }
    else if ($code == '278') { $name = "신한금융투자"; }
    else if ($code == '279') { $name = "동부증권"; }
    else if ($code == '280') { $name = "유진투자증권"; }
    else if ($code == '287') { $name = "메리츠증권"; }
    else if ($code == '291') { $name = "신영증권"; }
    else if ($code == '240') { $name = "삼성증권"; }
    else if ($code == '269') { $name = "한화증권"; } else { return false; }

    return $name;

}

// 은행코드 셀렉트
function shop_pg_bankcode_option($order_pg)
{

    $option = "";

    if ($order_pg == '3') {

        $option .= "<option value='02'>산업은행</option>";
        $option .= "<option value='03'>기업은행</option>";
        $option .= "<option value='04'>국민은행</option>";
        $option .= "<option value='05'>외환은행</option>";
        $option .= "<option value='07'>수협중앙회</option>";
        $option .= "<option value='11'>농협중앙회</option>";
        $option .= "<option value='12'>단위농협</option>";
        $option .= "<option value='16'>축협중앙회</option>";
        $option .= "<option value='20'>우리은행</option>";
        $option .= "<option value='21'>신한은행</option>";
        $option .= "<option value='23'>제일은행</option>";
        $option .= "<option value='25'>하나은행</option>";
        $option .= "<option value='26'>신한은행</option>";
        $option .= "<option value='27'>한국씨티은행</option>";
        $option .= "<option value='31'>대구은행</option>";
        $option .= "<option value='32'>부산은행</option>";
        $option .= "<option value='34'>광주은행</option>";
        $option .= "<option value='35'>제주은행</option>";
        $option .= "<option value='37'>전북은행</option>";
        $option .= "<option value='38'>강원은행</option>";
        $option .= "<option value='39'>경남은행</option>";
        $option .= "<option value='41'>비씨카드</option>";
        $option .= "<option value='45'>새마을금고</option>";
        $option .= "<option value='48'>신협</option>";
        $option .= "<option value='53'>씨티은행</option>";
        $option .= "<option value='54'>홍콩상하이은행</option>";
        $option .= "<option value='64'>산림조합</option>";
        $option .= "<option value='71'>우체국</option>";
        $option .= "<option value='81'>하나은행</option>";
        $option .= "<option value='83'>평화은행</option>";
        $option .= "<option value='87'>신세계</option>";
        $option .= "<option value='88'>신한은행</option>";
        $option .= "<option value='209'>동양종합금융증권</option>";
        $option .= "<option value='218'>현대증권</option>";
        $option .= "<option value='230'>미래에셋증권</option>";
        $option .= "<option value='240'>삼성증권</option>";
        $option .= "<option value='243'>한국투자증권</option>";
        $option .= "<option value='247'>우리투자증권</option>";
        $option .= "<option value='262'>하이투자증권</option>";
        $option .= "<option value='263'>HMC투자증권</option>";
        $option .= "<option value='266'>SK증권</option>";
        $option .= "<option value='267'>대신증권</option>";
        $option .= "<option value='269'>한화증권</option>";
        $option .= "<option value='270'>하나대투증권</option>";
        $option .= "<option value='278'>신한금융투자</option>";
        $option .= "<option value='279'>동부증권</option>";
        $option .= "<option value='280'>유진투자증권</option>";
        $option .= "<option value='287'>메리츠증권</option>";
        $option .= "<option value='291'>신영증권</option>";

    }

    else if ($order_pg == '4') {

        $option .= "<option value='002'>산업은행</option>";
        $option .= "<option value='003'>기업은행</option>";
        $option .= "<option value='004'>국민은행</option>";
        $option .= "<option value='005'>외환은행</option>";
        $option .= "<option value='007'>수협중앙회</option>";
        $option .= "<option value='011'>농협중앙회</option>";
        $option .= "<option value='012'>단위농협</option>";
        $option .= "<option value='016'>축협중앙회</option>";
        $option .= "<option value='020'>우리은행</option>";
        $option .= "<option value='021'>신한은행</option>";
        $option .= "<option value='023'>제일은행</option>";
        $option .= "<option value='025'>하나은행</option>";
        $option .= "<option value='026'>신한은행</option>";
        $option .= "<option value='027'>한국씨티은행</option>";
        $option .= "<option value='031'>대구은행</option>";
        $option .= "<option value='032'>부산은행</option>";
        $option .= "<option value='034'>광주은행</option>";
        $option .= "<option value='035'>제주은행</option>";
        $option .= "<option value='037'>전북은행</option>";
        $option .= "<option value='038'>강원은행</option>";
        $option .= "<option value='039'>경남은행</option>";
        $option .= "<option value='041'>비씨카드</option>";
        $option .= "<option value='045'>새마을금고</option>";
        $option .= "<option value='048'>신협</option>";
        $option .= "<option value='053'>씨티은행</option>";
        $option .= "<option value='054'>홍콩상하이은행</option>";
        $option .= "<option value='064'>산림조합</option>";
        $option .= "<option value='071'>우체국</option>";
        $option .= "<option value='081'>하나은행</option>";
        $option .= "<option value='083'>평화은행</option>";
        $option .= "<option value='087'>신세계</option>";
        $option .= "<option value='088'>신한은행</option>";
        $option .= "<option value='209'>동양종합금융증권</option>";
        $option .= "<option value='218'>현대증권</option>";
        $option .= "<option value='230'>미래에셋증권</option>";
        $option .= "<option value='240'>삼성증권</option>";
        $option .= "<option value='243'>한국투자증권</option>";
        $option .= "<option value='247'>우리투자증권</option>";
        $option .= "<option value='262'>하이투자증권</option>";
        $option .= "<option value='263'>HMC투자증권</option>";
        $option .= "<option value='266'>SK증권</option>";
        $option .= "<option value='267'>대신증권</option>";
        $option .= "<option value='269'>한화증권</option>";
        $option .= "<option value='270'>하나대투증권</option>";
        $option .= "<option value='278'>신한금융투자</option>";
        $option .= "<option value='279'>동부증권</option>";
        $option .= "<option value='280'>유진투자증권</option>";
        $option .= "<option value='287'>메리츠증권</option>";
        $option .= "<option value='291'>신영증권</option>";

    } else {

        return false;

    }

    return $option;

}

// 택배사 이름
function shop_pg_parcelname($parcel_id)
{

    if ($parcel_id == '1') {

        $data = "대한통운";

    }

    else if ($parcel_id == '2') {

        $data = "CJ GLS";

    }

    else if ($parcel_id == '3') {

        $data = "로젠 택배";

    }

    else if ($parcel_id == '4') {

        $data = "한진 택배";

    }

    else if ($parcel_id == '5') {

        $data = "현대 택배";

    }

    else if ($parcel_id == '6') {

        $data = "우체국 택배";

    }

    else if ($parcel_id == '7') {

        $data = "KG 옐로우캡";

    }

    else if ($parcel_id == '8') {

        $data = "KGB 택배";

    }

    else if ($parcel_id == '9') {

        $data = "SC로지스";

    }

    else if ($parcel_id == '10') {

        $data = "동부익스프레스택배";

    }

    else if ($parcel_id == '11') {

        $data = "하나로택배";

    }

    else if ($parcel_id == '12') {

        $data = "기타";

    }

    else if ($parcel_id == '99') {

        $data = "자가배송";

    } else {

        return false;

    }

    return $data;

}

// 택배사 코드
function shop_pg_parcelcd($parcel_id, $order_pg)
{

    if ($parcel_id == '1') {

        $kicc = "DC01";

    }

    else if ($parcel_id == '2') {

        $kicc = "DC02";

    }

    else if ($parcel_id == '3') {

        $kicc = "DC05";

    }

    else if ($parcel_id == '4') {

        $kicc = "DC08";

    }

    else if ($parcel_id == '5') {

        $kicc = "DC09";

    }

    else if ($parcel_id == '6') {

        $kicc = "DC07";

    }

    else if ($parcel_id == '7') {

        $kicc = "DC04";

    }

    else if ($parcel_id == '8') {

        $kicc = "DC10";

    }

    else if ($parcel_id == '9') {

        $kicc = "DC03";

    }

    else if ($parcel_id == '10') {

        $kicc = "DC06";

    }

    else if ($parcel_id == '11') {

        $kicc = "DC11";

    }

    else if ($parcel_id == '12') {

        $kicc = "DC13";

    }

    else if ($parcel_id == '99') {

        $kicc = "DC13";

    } else {

        return false;

    }

    if ($order_pg == '1') {

        return false;

    }

    else if ($order_pg == '2') {

        return false;

    }

    else if ($order_pg == '3') {

        return $kcp;

    }

    else if ($order_pg == '4') {

        return $kicc;

    }

    else if ($order_pg == '5') {

        return false;

    } else {

        return false;

    }

}

// 택배사 셀렉트
function shop_pg_parcel_option()
{

    $option = "";
    $option .= "<option value='1'>대한통운</option>";
    $option .= "<option value='2'>CJ GLS</option>";
    $option .= "<option value='3'>로젠 택배</option>";
    $option .= "<option value='4'>한진 택배</option>";
    $option .= "<option value='5'>현대 택배</option>";
    $option .= "<option value='6'>우체국 택배</option>";
    $option .= "<option value='7'>KG 옐로우캡</option>";
    $option .= "<option value='8'>KGB 택배</option>";
    $option .= "<option value='9'>SC로지스</option>";
    $option .= "<option value='10'>동부익스프레스택배</option>";
    $option .= "<option value='11'>하나로택배</option>";
    $option .= "<option value='12'>기타</option>";
    $option .= "<option value='99'>자가배송</option>";

    return $option;

}
?>