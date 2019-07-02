<?php
    require_once('config.php');
    $request  = 'USER='.$USER;
    $request .= '&VENDOR='.$VENDOR ;
    $request .= '&PARTNER='.$PARTNER;
    $request .= '&PWD='.$PWD;
    $request .= '&TENDER=C';
    $request .= '&TRXTYPE=A' ; // A => atuhtorization
    $request .= '&AMT=100';
    $request .= '&CURRENCY=USD';
    $request .= '&NAME=sadam bapunawar';
    $request .= '&ACCT=4111111111111111';
    $request .= '&EXPDATE=0522';
    $request .= '&CVV2=123';

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