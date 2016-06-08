<?php

return [
	
	/**
	 * Define any reminder you want, by defining an array like this for each reminder.
	 * 
     * - The index of array should be an identification "slug", in lowercase and without space or special characters
     * - 'message' is the message you want to show on chat
     * - 'channel' is where you want to send the message
     * - 'on' a simple human day of week indication.. more days must be
     * - 'at' when send it 
	 */
	'reminder1' => [
		'message' => 'I want say this',
		'channel' => '#general',
		'on' => 'monday, tuesday, wednesday, thursday, friday',
		'at' => '17:06' // or 2am or 5.30pm
	],
	
	/*'reminder2' => [
		'message' => 'I want say this',
		'channel' => '#general',
		'on' => 'monday, tuesday, wednesday, thursday, friday',
		'at' => '17:06' // or 2am or 5.30pm
	],*/

];