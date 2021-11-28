<?php

namespace App\Controllers;

use \App\Models\loginModel;

class Login extends BaseController
{
	public function index()
	{
		$session = \Config\Services::session($config);
		//session_destroy();
		if($session->get('Name') == NULL)
		{
			echo view('template');
			echo view('login');
		}	
		else
		{
			return redirect()->to(base_url());
		}
	}

	public function login()
	{
		if(isset($_POST['Username']))
		{
			$loginModel = new loginModel(); 
			$status = $loginModel->Login($_POST['Username'],$_POST['Password']);
			echo json_encode($status);
		}
	}

	public function logout()
	{
		$session = \Config\Services::session($config);
		if($session->get('Name') != NULL)
		{
			session_destroy();
			return redirect()->to(base_url());
		}
	}
}