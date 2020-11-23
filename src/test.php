<?php
session_start();
$user_id = $_SESSION["user_id"];

$restaurant_id = $_GET[restaurant];
$meeting_name = $_GET[meeting_name];

$dateandtime = $_GET[meeting_datetime];
$dateandtime1 = strtotime($dateandtime) - 57600;
$meeting_datetime = date("Y-m-d H:i:s", ($dateandtime1 + 57600));

$max_participants = $_GET[max_participants];
$meeting_description = $_GET[meeting_description];

date_default_timezone_set('Asia/Seoul');
$CurrentTime = time();
$Now = date("Y-m-d H:i:s", ($CurrentTime));

echo "

dsafdsafsdaf <br>
$user_id <br>
$restaurant_id <br>
$meeting_name <br> <br>
$meeting_datetime
$dateandtime1 <br>
$CurrentTime <br>
$Now <br>
$max_participants <br>
$meeting_description <br>

";

if (empty($restaurant_name) || empty($meeting_name) || empty($max_participants) || empty($meeting_description) || empty($meeting_datetime)) {
		echo "bye";
		exit();
}




?>