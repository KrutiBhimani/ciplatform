<?php

class Model
{

	protected $connection = '';
	protected $servername = 'localhost';
	protected $username = 'root';
	protected $password = '';
	protected $db = 'ci_platform';

	function __construct()
	{

		mysqli_report(MYSQLI_REPORT_STRICT);
		try {
			$this->connection = new mysqli($this->servername, $this->username, $this->password, $this->db);
		} catch (Exception $ex) {
			echo "Connection Failed: " . $ex->getMessage();
			exit;
		}
	}
}