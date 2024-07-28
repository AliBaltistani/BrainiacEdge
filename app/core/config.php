<?php 


/****
* app info
*/
define('APP_NAME', 'BrainiacEdge');
define('APP_DESC', 'Courses & Competitions');

/****
* SMTP Email config
*/
// e.g
//  define('SENDER_EMAIL', 'developerali99@gmail.com');
// define('EMAIL_PASSWORD', 'rmup eomn hwgj rgxf');
define('SENDER_EMAIL', '');
define('EMAIL_PASSWORD', '');

/****
* database config
*/
if($_SERVER['SERVER_NAME'] == 'localhost')
{
	//database config for local server
	define('DBHOST', 'localhost');
	define('DBNAME', 'udemy_db');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', 'mysql');

	//root path e.g localhost/
	define('ROOT', 'http://localhost/BrainiacEdge/public');
}else
{
	//database config for live server
	define('DBHOST', 'localhost');
	define('DBNAME', 'udemy_db');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', 'mysql');

	//root path e.g https://www.yourwebsite.com
	define('ROOT', 'http://');
}

