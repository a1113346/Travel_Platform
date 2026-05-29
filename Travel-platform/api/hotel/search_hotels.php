<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');

// 動態接收前一動查到的地區代碼，如果沒傳，預設帶高雄的 Booking 代碼 -2632354
$dest_id = isset($_GET['dest_id']) ? $_GET['dest_id'] : '-2632354';

$curl = curl_init();

curl_setopt_array($curl, [
    // 💡 幣別已幫你修正為 TWD (新台幣)，這才符合台灣使用者
	CURLOPT_URL => "https://booking-com15.p.rapidapi.com/api/v1/hotels/searchHotels?dest_id={$dest_id}&search_type=CITY&adults=1&children_age=0%2C17&room_qty=1&page_number=1&units=metric&temperature_unit=c&languagecode=zh-tw&currency_code=TWD",
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