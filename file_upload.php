<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        background: black;
    color: aliceblue;
    }
</style>
<body>
<?php

$file = $_FILES['fileToUpload']['tmp_name'];
$md5Hash = md5_file($file);
// $SHA=hash('sha256', $file);


echo "MD5 Hash: $md5Hash";

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://www.virustotal.com/api/v3/files/$md5Hash",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "accept: application/json",
        "x-apikey: d3b53ec221b71e7ad070cad8b42a6204a28798fc40be7279a0f5805a712432e0"
    ]
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    file_put_contents('test.json', $response);

    // Redirect to the test.html file after upload
    echo '<form action="test1.html" method="get">';
    echo '<input type="submit" style="    background: green;
    width: 147px;
    height: 45px;
    color: azure;
    border: 2px solid aliceblue;
    border-radius: 21px;
    margin: auto;
    display: block;" value="click to see result">';
    echo '</form>';
}
?>
</body>
</html>
