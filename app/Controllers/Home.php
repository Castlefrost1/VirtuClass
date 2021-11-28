<?php

namespace App\Controllers;

use \App\Models\AssignmentModel;

class Home extends BaseController
{
	public function index()
	{
		$session = \Config\Services::session($config);

		if($session->get('Name') != NULL)
		{
			echo view('template');
			echo view('sidebar');
			echo view('topbar');
			if($session->get('Status') == 0)
			{
				echo view('index');
			}
			else
			{
				echo view('indexGuru');
			}
		}	
		else
		{
			$url = base_url() . "/Login";
			return redirect()->to($url);
		}
	}

	public function assignment()
	{
		$AssignmentModel = new AssignmentModel(); 
		$session = \Config\Services::session($config);
		if($session->get('Name') != NULL)
		{
			$dataAs = $AssignmentModel->getData();
			$data['data'] = $dataAs[0];
			$data['dataKelas'] = $dataAs[1];
			echo view('template');
			echo view('sidebar');
			echo view('topbar');
			if($session->get('Status') == 0)
			{
				echo view('assignment', $data);
			}
			else
			{
				echo view('assignmentGuru', $data);
			}
			
		}	
		else
		{
			$url = base_url() . "/Login";
			return redirect()->to($url);
		}
	}

	public function upload()
	{
		$AssignmentModel = new AssignmentModel(); 
		$session = \Config\Services::session($config);
		if($session->get('Name') != NULL)
		{
			$path = $this->request->getFile('fileUpload')->store();
			$AssignmentModel->uploadFile($path,$_POST['assignmentId']);
		}
		$url = base_url() . "/Assignment";
		return redirect()->to($url);
	}

	public function uploadNilaiAssignment()
	{
		$AssignmentModel = new AssignmentModel(); 
		$session = \Config\Services::session($config);
		if($session->get('Name') != NULL)
		{
			print_r($AssignmentModel->uploadNilai());
		}
		$url = base_url() . "/Assignment";
		return redirect()->to($url);
	}

	public function uploadList()
	{
		$AssignmentModel = new AssignmentModel(); 
		$session = \Config\Services::session($config);
		if($session->get('Name') != NULL)
		{
			return json_encode($AssignmentModel->uploadList($_POST['assignmentId']));
		}
	}

	public function download()
	{
		$session = \Config\Services::session($config);
		if($session->get('Name') != NULL)
		{ 
			return $this->response->download(WRITEPATH . "uploads/" . $_POST['Path'],null);
		}
	}
}
