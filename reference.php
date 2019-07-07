<?php
    require_once('config.php');
    $request  = 'USER='.$USER;
    $request .= '&VENDOR='.$VENDOR ;
    $request .= '&PARTNER='.$PARTNER;
    $request .= '&PWD='.$PWD;
    $request .= '&TENDER=C';
    $request .= '&TRXTYPE=S' ; // S => sale transaction
    $request .= '&AMT=40';
    $request .= '&CURRENCY=USD';
    $request .= '&ORIGID=A70AAC321078';

    if ($METHOD == 'live') {
        $curl = curl_init('https://payflowpro.paypal.com');
    } else {
        $curl = curl_init('https://pilot-payflowpro.paypal.com');
    }

    curl_setopt($curl, CURLOPT_PORT, 443);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FORBID_REUSE, 1);
    curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

    $response = curl_exec($curl);
    curl_close($curl);
    $response_info = array();
    parse_str($response, $response_info);
    
    if ($response_info['RESULT'] == '0') {
        echo 'success';
        echo '<pre>';
        print_r($response_info);
        echo '</pre>';
    }
    else {
        echo 'Failed';
        echo '<pre>';
        print_r($response_info);
        echo '</pre>';
    }
?>      