<?php
include_once(__DIR__.'/mailer.php');

$file_path = 'last_job_link.txt';

//put RSS feed link here
$feed_link="PUT YOUR LINK HERE";
$xml_string = file_get_contents($feed_link);

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
