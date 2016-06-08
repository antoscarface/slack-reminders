# Slack Reminders
PHP script allows you to add one of more reminders to send in your slack chat using Slack API

# Create a new integration on your slack team
1. Go to https://api.slack.com/docs/oauth-test-tokens and set an API token for your team
2. Copy it and take it an a safe place

# Set config.php file
Copy `config.sample.php` and set the configuration within it, typing the API token copyed previously and setting the other informations about your team

# Set reminders.php file
In this file you will set the reminders to send on chat. It's a simply PHP multiarray that contains the reminders, one for array.
Here an example of how configure reminders.php file:

```
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
```

Define any reminder you want, by defining an array like this for each reminder.
* The index of array should be an identification "slug", in lowercase and without space or special characters
* 'message' is the message you want to show on chat
* 'channel' is where you want to send the message
* 'on' a simple human day of week indication.. more days must be
* 'at' when send it 
