<?php

namespace App\Models;

use CodeIgniter\Model;

class AssignmentModel extends Model
{
    public function getData()
    {
    	$db = \Config\Database::connect();
    	$session = \Config\Services::session($config);

		$builder = $db->table('kelasuser');
		$builder->join('kelas', 'kelas.kelasID = kelasuser.kelasID');
		$query = $builder->GetWhere(['userID' => $_SESSION['UserID']]);

		$builder2 = $db->table('assignment');
		$builder2->join('kelas', 'kelas.kelasID = assignment.kelasId');
		$builder2->join('matkul', 'matkul.matkulId = kelas.matkulId');
		$builder2->join('kelasuser', 'kelas.kelasID = kelasuser.kelasID');
		$builder2->where(['kelasuser.userID' => $_SESSION['UserID']]);
		$query2 = $builder2->get();
    	
		//$error = $db->error();
		$data = [$query2,$query];

    	return $data;
    }

    public function uploadFile($path,$assignmentId)
    {
    	$db = \Config\Database::connect();
    	$session = \Config\Services::session($config);

    	if($assignmentId != "Guru")
    	{
			$builder = $db->table('jawaban');
			$query = $builder->GetWhere(['userID' => $_SESSION['UserID'],'assignmentId' => $assignmentId]);

			foreach ($query->getResult() as $row)
			{					
    			$data = [
    				'jawabanID' => $row->jawabanID,
    				'assignmentId'  => $row->assignmentId,
    				'userID'  => $row->userID,
    				'lastUpload'  => 0,
    				'pathJawaban'  => $row->pathJawaban,
    				'nilai'  => $row->nilai,
	    			'dateUploaded'  => $row->dateUploaded,
				];

				$builder->replace($data);
			}

			$data = [
    			'assignmentId'  => $assignmentId,
    			'userID'  => $_SESSION['UserID'],
    			'lastUpload'  => 1,
	   			'pathJawaban'  => $path,
   				'dateUploaded'  => date("Y-m-d"),
			];

			$builder->insert($data);
    	}

    	else
    	{
    		$builder = $db->table('assignment');

    		$data = [
    			'kelasId'  => $_POST['kelas'],
	   			'pathSoal'  => $path,
   				'deadline'  => $_POST['date'],
			];

			$builder->insert($data);
    	}
    }

    public function uploadNilai()
    {
    	$db = \Config\Database::connect();

    	$builder = $db->table('jawaban');
		$query = $builder->GetWhere(['lastUpload' => 1,'assignmentId' => $_POST['assginemntIDUN']]);
		
		$x = 0;
		foreach ($query->getResult() as $row)
		{					
    		$data = [
    			'jawabanID' => $row->jawabanID,
    			'assignmentId'  => $row->assignmentId,
    			'userID'  => $row->userID,
    			'lastUpload'  => $row->lastUpload,
    			'pathJawaban'  => $row->pathJawaban,
    			'nilai'  => $_POST['nilai'][$x],
	    		'dateUploaded'  => $row->dateUploaded,
			];
			$builder->replace($data);
			$x++;
		}
		return $_POST['nilai'];
    }

    public function uploadList($assignmentId)
    {
    	$db = \Config\Database::connect();
    	$session = \Config\Services::session($config);

    	$builder = $db->table('jawaban');
    	$builder->orderBy('dateUploaded', 'DESC');
    	if($_SESSION['Status'] == 1)
    	{
    		$builder->join('user', 'user.userID = jawaban.userID');
    		$query = $builder->GetWhere(['assignmentId' => $assignmentId,"lastUpload" => 1]);
    	}
    	else
    	{
			$query = $builder->GetWhere(['userID' => $_SESSION['UserID'],'assignmentId' => $assignmentId]);
		}
		return $query->getResult();
    }
}