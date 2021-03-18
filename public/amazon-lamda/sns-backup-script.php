<?php
require 'aws-autoloader.php';      
use Aws\Sns\Message;
use Aws\Sns\MessageValidator; 
   



     
function parse_bounce( $message ) {
	$recipients = array();
	foreach ( $message['bounce']['bouncedRecipients'] as $recipient ) {
		$recipients[] = $recipient['emailAddress'];
	}
	switch ( $message['bounce']['bounceType'] ) {
		case 'Transient':
			error_log( "BouncesController - Soft bounces occurred for " . join( ', ', $recipients ) );

			return array();
			break;
		case 'Permanent':
			error_log( "BouncesController - Hard bounces occurred for " . join( ', ', $recipients ) );

			return $recipients;
			break;
	}
}

function parse_complaint( $message ) {
	$recipients = array();
	foreach ( $message['complaint']['complainedRecipients'] as $recipient ) {
		$recipients[] = $recipient['emailAddress'];
	}

	return $recipients;
}

function blacklist_recipients( $recipients ) {
	foreach ( $recipients as $email_address ) {
		// blacklist those emails
	}
}

try {
	$sns_message = Message::fromRawPostData();

	$validator = new MessageValidator();
	$validator->validate( $sns_message );

	if ( $validator->isValid( $sns_message ) ) 
	{
		if ( in_array( $sns_message['Type'], [ 'SubscriptionConfirmation', 'UnsubscribeConfirmation' ] ) ) 
		{			
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