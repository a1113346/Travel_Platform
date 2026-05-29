<?php
// 有傳 place 就查地方，沒傳就自動用高雄，全球各地都能查
$place = isset($_GET['place']) ? urlencode($_GET['place']) : urlencode('高雄');

$curl = curl_init();

curl_setopt_array($curl, [
    // 💡 網址尾端已改為 lang=zh_tw 輸出繁體中文
    CURLOPT_URL => "https://weather-api167.p.rapidapi.com/api/weather/forecast?place={$place}&cnt=3&standard=type&three_hour=mode&json=json&lang=zh_tw",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "Accept: application/json",
        "Content-Type: application/json",
        "x-rapidapi-host: weather-api167.p.rapidapi.com",
        "x-rapidapi-key: 5ae72bf8d0msh975a1340d0b71e5p1df595jsn6b5a04c15866"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo json_encode(["status" => "error", "message" => $err]);
} else {
    header('Content-Type: application/json; charset=utf-8');
    echo $response;
}