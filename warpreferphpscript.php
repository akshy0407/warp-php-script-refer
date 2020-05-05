
<?php

//Author - Akshay Shetty
//Project - Warp+ Refer Php Script
//Date - 05 May,2020
//Credits - https://github.com/yyuueexxiinngg/some-scripts/

date_default_timezone_set('Asia/ShangHai');

//Enter Your refer id
$referrer='Your Refer Id';



function random($length) {
    $characters = '012tuvw348DJqyzK9abMXYdeEFIfNOUVW7mncrsxPQRghijGHl56STABCLBCLopAZ';
    $charactersLength = strlen($characters);
    $key = '';
    for ($i = 0; $i < $length; $i++) {
        $key .= $characters[rand(0, $charactersLength - 1)];
    }
    return $key;
}



    $install_id = random(11);

    $data = [
        'key'          => random(43) . '=',
        'install_id'   => $install_id,
        'fcm_token'    => $install_id . ":APA91b" . random(134),
        'referrer'     => $referrer,
        'warp_enabled' => false,
        'tos'          => date('c'),
        "type"         => "Android",
        "locale"       => "zh-CN",
    ];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL            => "https://api.cloudflareclient.com/v0a745/reg",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => "",
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => "POST",
        CURLOPT_POSTFIELDS     => json_encode($data),
        CURLOPT_HTTPHEADER     => [
            'Connection: Keep-Alive',
            "Content-Type: application/json",
            "Accept-Encoding: gzip",
            "User-Agent: okhttp/3.12.1",
            "Content-Length" => strlen(json_encode($data)),
        ],
    ]);

    $response = curl_exec($curl);
    $err      = curl_error($curl);

    if ($err) {
        echo "cURL Error #:" . $err . "\r\n";
    } else {
        $response = json_decode($response, true);
        if (!empty($response['referrer'])) {
            echo "success \r\n";
        } else {
            echo "{$response['message']} \r\n";
        }
    }
    curl_close($curl);


?>