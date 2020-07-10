<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {
	public function index()
	{
		/*if (!$this->checkDBExist()) {
			echo 'Database not found';
			return;
		}*/

		// load migration library
		$this->load->library('migration');
		if ( ! $this->migration->current())
		{
				echo 'Error' . $this->migration->error_string();
		} else {
			echo 'Migrations ran successfully!';
		}
	}

	public function checkDBExist()
	{
		$this->load->dbutil();
		if (!$this->dbutil->database_exists(DB_NAME)) {
			$this->load->dbforge();
			$this->dbforge->create_database(DB_NAME);
		}
		return TRUE;
	}
}

?>