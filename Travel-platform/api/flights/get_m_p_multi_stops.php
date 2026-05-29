<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://booking-com15.p.rapidapi.com/api/v1/flights/getMinPriceMultiStops?legs=%5B%7B'fromId'%3A'BOM.AIRPORT'%2C'toId'%3A'AMD.AIRPORT'%2C'date'%3A'2024-05-25'%7D%2C%7B'fromId'%3A'AMD.AIRPORT'%2C'toId'%3A'BOM.AIRPORT'%2C'date'%3A'2024-05-26'%7D%5D&cabinClass=ECONOMY%2CPREMIUM_ECONOMY%2CBUSINESS%2CFIRST&currency_code=AED",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"Content-Type: application/json",
		"x-rapidapi-host: booking-com15.p.rapidapi.com",
		"x-rapidapi-key: 5ae72bf8d0msh975a1340d0b71e5p1df595jsn6b5a04c15866"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
// ...前面是 cURL 抓取資料的程式碼...
curl_close($curl);

if ($err) {
    echo json_encode(["status" => "error", "message" => $err]);
} else {
    // 設定 HTTP Header 告訴瀏覽器這是 JSON 資料
    header('Content-Type: application/json; charset=utf-8');
    // 直接輸出從 Booking API 拿到的 JSON 字串
    echo $response; 
}