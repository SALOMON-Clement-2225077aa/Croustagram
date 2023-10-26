<?php
$pfp = $_POST['fileToUpload'];
$url = 'https://catbox.moe/user/api.php';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://catbox.moe/user/api.php");

curl_setopt($ch, CURLOPT_POST, true);

$datas = array("reqtype"=>"urlupload", "userhash" => "b38e110af8d7f2e9c2e720c3b" ,"url"=>"https://cdn.discordapp.com/attachments/1049120394243739779/1162056514131992586/image.png?ex=653a8c76&is=65281776&hm=3505d98d10e61ca2f98961ff4f9d11cb123761f3bb5084108880a661989a9ed4&");
curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo $http_code;
echo $response;
