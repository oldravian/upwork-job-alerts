<?php
include_once(__DIR__.'/mailer.php');

$file_path = 'last_job_link.txt';

//put RSS feed link here
$xml_string = file_get_contents("https://www.upwork.com/ab/feed/jobs/rss?q=php&sort=recency&paging=0%3B10&api_params=1&securityToken=a5fc4cc25607aad60cbd234411dc8de1097e7d4ec74469a18509ca548621ef2342dae8501f275efc55de8e4b054a3ef62f9851a10bd741d490b692fab40d5537&userUid=1101884452087386112&orgUid=1101884452091580417");

$xml = simplexml_load_string($xml_string);

$firstJobLink = (string) $xml->channel->item[0]->link;

// If file exists and its content is different from the first job's link
if (file_exists($file_path) && file_get_contents($file_path) !== $firstJobLink) {
    $output=null;
    foreach ($xml->channel->item as $item) {
        if ((string) $item->link === file_get_contents($file_path)) {
            break;
        }
        $output .= "Title: " . $item->title . "<br/>";
        $output .= "Link: " . $item->link . "<br/>";
        //$output .= "Description: " . strip_tags($item->description) . "<br/>";
        $output .= "-----------------------------<br/>";
    }

    if($output){
        sendMail(['email'=>'', 'mail_body'=>"Upwork Jobs Alert:
        <br/>".
        $output
       ]);
    }
}

// Store the first job's link in the file
file_put_contents($file_path, $firstJobLink);
?>