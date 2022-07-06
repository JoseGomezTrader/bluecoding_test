<?php

define( 'DB_HOST', 'localhost' );
define( 'DB_USERNAME', 'bluecoding');
define( 'DB_PASSWORD', 'h9*+zBwtNCG4');
define( 'DB_NAME', 'bluecoding');

class Database
{
	/**
	 * @var connection save the db connection
	*/
	public $connection;
	

	public function __construct()
	{
		
		$link = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
		$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->connection = $link;
	}
}