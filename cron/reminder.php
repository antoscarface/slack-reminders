<?php 

date_default_timezone_set('Europe/Rome');

include( '../sdk/vendor/autoload.php' );

use ThreadMeUp\Slack\Client;

$reminders = require_once( '../reminders.php' );
$config    = require_once( '../config.php' );

$slack = new Client( $config );
// $xml = new SimpleXMLElement('<xml/>');
// $xmlReminders = $xml->addChild("reminders");

// // set times for each reminder of last sending
// if ( file_exists('times.xml') ) {
// 	$p = xml_parser_create();
// 	xml_parse_into_struct( $p, file_get_contents( 'times.xml' ), $times );
// 	foreach ( $times as $item ) {
// 		if ( strtolower( $item['tag'] ) != 'reminder' ) {
// 			continue;
// 		}

// 		$reminders[ $item['attributes']['NAME'] ]['send_at'] = $item['attributes']['NEXT_SEND'];
// 	}
// }

// send messages
foreach ( $reminders as $reminder_name => &$params ) {

	// calcola il timestamp del prossimo invio, scritto in quest aposizione perchè potrebbe servire per la IF successiva
	if ( isset( $params['on'] ) && isset( $params['at'] ) ) {
		$days = strpos( $params['on'], ',' ) !== false ? array_map( 'trim', (array) explode( ',', $params['on'] ) ) : array( $params['on'] );
		$tmp = array();
		foreach ( $days as $day ) {
			$hours = strpos( $params['at'], ',' ) !== false ? array_map( 'trim', (array) explode( ',', $params['at'] ) ) : array( $params['at'] );
			foreach ( $hours as $hour ) {
				$ts = strtotime( $day . ' ' . $hour );
				if ( $ts < roundToMinute( time() ) ) {
					$ts = strtotime( '1 week', $ts );
				}
				$tmp[] = $ts;
			}
		}

		$next = getClosest( time(), $tmp );
	}
	
	// set xml
	// $xmlReminder = $xmlReminders->addChild('reminder');
	// $xmlReminder->addAttribute( 'name', $reminder_name );
	// $xmlReminder->addAttribute( 'next_send', date( 'Y-m-d H:i:s', $next ) );  // imposta la data del prossimo invio

	// don't send
	if ( isset( $params['send_at'] ) && $params['send_at'] > roundToMinute( time() ) || $next > roundToMinute( time() ) ) {
		continue;
	}

	$chat = $slack;

	// set channel
	if ( isset( $params['channel'] ) ) {
		$chat = $chat->chat( $params['channel'] );
	}

	// send message
	$chat->send( $params['message'] );

}

// write XML
// file_put_contents( 'times.xml', $xml->asXML() );

/**
 * Prende il valore più vicino
 */
function getClosest($search, $arr) {
   $closest = null;
   foreach ($arr as $item) {
      if ($closest === null || abs($search - $closest) > abs($item - $search)) {
         $closest = $item;
      }
   }
   return $closest;
}

function roundToMinute( $time ) {
	return round($time/60)*60;
}