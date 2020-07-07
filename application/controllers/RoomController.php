<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoomController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('RoomModel');
	}

	public function index()
	{
		$this->load->view('rooms');
	}
}
