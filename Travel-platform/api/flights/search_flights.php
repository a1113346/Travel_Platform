<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

// 動態接收出發地與目的地機場三字碼，預設台北(TPE)到東京(NRT)
$from = isset($_GET['from']) ? $_GET['from'] : 'TPE.AIRPORT';
$to = isset($_GET['to']) ? $_GET['to'] : 'NRT.AIRPORT';

$curl = curl_init();

curl_setopt_array($curl, [
    // 💡 機場與幣別(TWD)皆已動態模組化
	CURLOPT_URL => "https://booking-com15.p.rapidapi.com/api/v1/flights/searchFlights?fromId={$from}&toId={$to}&stops=none&pageNo=1&adults=1&children=0%2C17&sort=BEST&cabinClass=ECONOMY&currency_code=TWD",
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
    echo json_encode(["status" => "error", "message" => $err]);
} else {
    echo $response; 
}