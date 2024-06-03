<?php
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\ApiException;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;

function cleanData($data){
    $data = trim($data);              //function to clearn data
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function hashPassword($data){
    $options = [
        "cost" => 6
    ];
    $data = password_hash($data, PASSWORD_BCRYPT, $options);  //function to hass password
    return $data;
}

$otp = random_int(10000, 99999); 

//function to send sms using infobip API
function sendSMS(string $number, string $messageContent){

  require_once __DIR__ . './vendorphone/autoload.php';
  

  $configuration = new Configuration(
      host: '1vdyw1.api.infobip.com',
      apiKey: 'd66baaa6bb895e3c5381cde17bfc0868-e8642d18-b686-4b21-8f47-a6d8fc2b1fd2'
  );
  
  $sendSmsApi = new SmsApi(config: $configuration);

  $message = new SmsTextualMessage(
      destinations: [
          new SmsDestination(to: $number)
      ],
      from: 'ServiceSM',
      text: $messageContent
  );

  $request = new SmsAdvancedTextualRequest(messages: [$message]);

  try {
      $smsResponse = $sendSmsApi->sendSmsMessage($request);
  } catch (ApiException $apiException) {
      echo "error";
  }
    
 }

 //function to send email using rapid API
function sendEmail($emailAdress, $messageToSend){
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://mail-sender-api1.p.rapidapi.com/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'sendto' => $emailAdress,
            'name' => 'verify',
            'replyTo' => 'achupromiseticha12@gmail.com',
            'ishtml' => 'false',
            'title' => 'Email verification',
            'body' => $messageToSend
        ]),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "x-rapidapi-host: mail-sender-api1.p.rapidapi.com",
            "x-rapidapi-key: 6071f6e321msh280b3afa7eaea1ap1f722djsn27f048bdfdad"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        // echo $response;
}
}

