<?php

$phone = "9789008688";
$message = "Your salary has been generated successfully.";

$fields = array(
    "route" => "q",
    "message" => $message,
    "language" => "english",
    "numbers" => $phone,
);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => json_encode($fields),
  CURLOPT_HTTPHEADER => array(
    "authorization: Ek6VYH4ybGOBRPpTSjevx9a5tsQW2gUfc1Kozui0ACJ3MZlnr7ZOW5FpN3EtCYfVeRABPas09byDKJjI",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
curl_close($curl);

echo "SMS Sent Successfully";

?>