<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* SETTING WEBSITE NAME
*/
	$config['website_name'] = 'http://galba-auth.galba';
/*
* SETTING GENERIC PASS
*/
	$config['passGeneric'] = '123456';

/*
*	FAILED LOGIN ATTEMPT SETTINGS
* 	@param int
*
* 	Note: If a user exceeds 3 times the limit set, the resulting time ban is doubled to further slow down attempts.
*	Example: 0 = unlimited attempts, 3 = 3 attempts.
*/
	$config['login_attempt_limit'] = 0;
/*
* 
*	Example: Time in seconds, 0 = no time ban, 10 = 10 seconds, 60*3 = 3 minutes.
*/
	$config['login_attempt_time_ban'] = 0;
/*
*	system downtime
*	Example: Time in seconds, 0 = no time ban, 10 = 10 seconds, 60*3 = 3 minutes.
*/
	$config['downtime'] = 60*5;
