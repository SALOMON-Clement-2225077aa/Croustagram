<?php

function upload_img() {

    // Client ID of Imgur App
    $IMGUR_CLIENT_ID = "23ad4ae172d4530";
    $client_secret = '098599a2cbc7c0c926d9d35a4a535deb19298bf4';

    // Validate form input fields
    if(empty($_FILES["myfile"]["name"])){
        // Later
        var_dump($_FILES["myfile"]["name"]);
        die;
    }

    else {
        // Get file info
        $fileName = basename($_FILES["myfile"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {

            // Source image
            $image_source = file_get_contents($_FILES['myfile']['tmp_name']);
            $postFields = array('image' => base64_encode($image_source));

            // Post image to Imgur via API
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image');
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $IMGUR_CLIENT_ID));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            curl_close($ch);

            // Extract the link from the response
            $responseArr = json_decode($response, true);
            if (!empty($responseArr['data']['link'])) {
                $imgurLink = $responseArr['data']['link'];
                return $imgurLink;
            }
        }
    }
    return null;
}