<?php
require 'vendor/autoload.php';
use Plivo\RestAPI;
$auth_id = "MAZDVKZTHIMDYYNWQXYT";
$auth_token = "NThkNTY1ZmY4Nzk2NjRhMGYxNzYwZWYwNWMyMGE2";

$p = new RestAPI($auth_id, $auth_token);

// Set message parameters
$params = array(
    'src' => '+639072529211', // Sender's phone number with country code
    'dst' => '+639072529210', // Receiver's phone number with country code
    'text' => 'Hi, Message from Plivo', // Your SMS text message
    // To send Unicode text
    //'text' => '????????????' # Your SMS Text Message - Japanese
    //'text' => 'Ce est texte généré aléatoirement' # Your SMS Text Message - French
    'url' => 'http://example.com/report/', // The URL to which with the status of the message is sent
    'method' => 'POST' // The method used to call the url
);
// Send message
$response = $p->send_message($params);

// Print the response
echo "Response : ";
print_r ($response['response']);

// Print the Api ID
echo "<br> Api ID : {$response['response']['api_id']} <br>";

// Print the Message UUID
echo "Message UUID : {$response['response']['message_uuid'][0]} <br>";

?>