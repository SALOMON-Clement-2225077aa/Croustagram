<?php

function recup_img() {
    var_dump($_FILES);
    echo '<br><br>';

    $image = $_FILES["myfile"]["tmp_name"];
    $image = base64_encode(file_get_contents($image));
    var_dump($image);

    upload_image($image);
}


function upload_image($image) {

    $client_id = '23ad4ae172d4530';
    $client_secret = '098599a2cbc7c0c926d9d35a4a535deb19298bf4';

    $image = $_FILES["myfile"]["tmp_name"];
    $title = $_FILES["myfile"]["name"];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.imgur.com/3/upload',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => array(
            'image' => $image,
            'type' => 'file',
        ),
        CURLOPT_HTTPHEADER => array(
            "Authorization: Client-ID " . $client_id
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    var_dump($response);
    echo '<br><br>';


    // data":{"error":"Bad Request","request":"/3/upload","method":"POST"}} "
    var_dump($err);
    echo '<br><br>';

    if ($err) {
        return null;
    }
    else {
        $json = json_decode($response, true);
        $link = $json['data']['link'];
        return $link;
    }
}