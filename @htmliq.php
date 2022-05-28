<?php
$url = $_GET['url'];
if($url !=NULL){
  $ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.videodownloaderpro.net/api/convert');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"url\":\"$url\"}");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: api.videodownloaderpro.net';
$headers[] = 'Sec-Ch-Ua: \" Not A;Brand\";v=\"99\", \"Chromium\";v=\"98\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?1';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 11; M2101K6I) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.89 Mobile Safari/537.36';
$headers[] = 'Sec-Ch-Ua-Platform: \"Android\"';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: */*';
$headers[] = 'Origin: https://videodownloaderpro.net';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Referer: https://videodownloaderpro.net/';
$headers[] = 'Accept-Language: ar-EG,ar;q=0.9,en-US;q=0.8,en;q=0.7';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
print_r($result);
}else{
  echo "Error";
}