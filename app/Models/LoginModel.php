<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    public function Login($username,$password)
    {
    	$session = \Config\Services::session($config);
    	$db = \Config\Database::connect();
		
		$builder = $db->table('user');
		$query = $builder->GetWhere(['Username' => $username,'Password' => $password]);
		$row = $query->getRow();
		
		$status = 0;
		
		if(isset($row))
		{
			$sessionData = [
				"UserID" => $row->userID,
				"Name" => $row->name,
				"Status"	=> $row->status,
				"photoPath" => $row->photoPath
			];
			$status = 1;
			$session->set($sessionData);
		}
    	
    	return $status;
    }
}