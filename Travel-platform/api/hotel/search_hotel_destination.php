<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

// 動態接收前端的搜尋關鍵字（例如：東京、Taipei），沒傳預設為高雄
$query = isset($_GET['query']) ? urlencode($_GET['query']) : urlencode('高雄');

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://booking-com15.p.rapidapi.com/api/v1/hotels/searchDestination?query={$query}",
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