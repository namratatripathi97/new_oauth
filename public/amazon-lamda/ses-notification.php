<?php 
  
    
require 'aws-autoloader.php';       

// Turn off error reporting
error_reporting(0);

// Report runtime errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Report all errors
error_reporting(E_ALL);

// Same as error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);

           
/*use Aws\S3\S3Client;   
use Aws\Exception\AwsException;    

 $s3Client = new S3Client([                      
							    'region' => 'ap-south-1',
							    'version' => '2006-03-01',   
							    'visibility' => 'public',       
							    'credentials' => [    
							        'key' => 'AKIAZTJD6IJF5JJ56ARB',    
							        'secret' => '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'
							    ]         
							]);     

   
$result = $s3Client->listBuckets();     

foreach ($result['Buckets'] as $bucket) 
{ 
    echo "{$bucket['Name']} - {$bucket['CreationDate']}\n";  
    echo "<br/>";  
} */     
use Aws\Sns\SnsClient;       
use Aws\Sns\Message;  
use Aws\Sns\MessageValidator;    




/*$SnSclient = new SnsClient([
     'credentials' => [    
							        'key' => 'AKIAZTJD6IJF5JJ56ARB',    
							        'secret' => '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'
							    ],  
    'region' => 'ap-south-1',
    'version' => '2010-03-31'   
]);

try {
    $result = $SnSclient->listTopics([
    ]);
    var_dump($result);
} catch (AwsException $e) {
    // output error message if fails
    error_log($e->getMessage());
} */

$topic="arn:aws:sns:ap-south-1:659889734219:sns-ses-updates";    

try {
	$sns_message = Message::fromRawPostData();

	$validator = new MessageValidator();
	$validator->validate( $sns_message );

	if ( $validator->isValid( $sns_message ) ) {
		if ( in_array( $sns_message['Type'], [ 'SubscriptionConfirmation', 'UnsubscribeConfirmation' ] ) ) {
			file_get_contents( $sns_message['SubscribeURL'] );
			error_log( 'Subscribed to ' . $sns_message['SubscribeURL'] );
		}

		if ( $sns_message['Type'] == 'Notification' ) {
			$message           = $sns_message['Message'];
			$notification_type = $message['notificationType'];
			if ( $notification_type == 'Bounce' ) {
				blacklist_recipients( parse_bounce( $message ) );
			}
			if ( $notification_type == 'Complaint' ) {
				blacklist_recipients( parse_complaint( $message ) );
			}
		}
	}


} catch ( Exception $e ) {
	error_log( 'Error: ' . $e->getMessage() );
	http_response_code( 404 );
	die;
}




        



   



     

?>   