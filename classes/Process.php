<?php 
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/Session.php');
	//Session::init();
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

class Process{
	private $db;
	private $fm;
	function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function processData($data){
		$selectedAns    = $this->fm->validation($data['ans']);
		$number         = $this->fm->validation($data['number']);
        $quesno         = $this->fm->validation($data['qno']);
		$selectedAns    = mysqli_real_escape_string($this->db->link,$selectedAns);
		$number         = mysqli_real_escape_string($this->db->link,$number);
        $quesno         = mysqli_real_escape_string($this->db->link,$quesno);
//		$next           = $number+1;

		if (!isset($_SESSION['score'])) {
			$_SESSION['score'] = '0';
		}

		$total = $this->getTotal();
		$right = $this->rightAns($number);
		if ($right == $selectedAns) {
			$_SESSION['score']++;
		}
		if ($quesno == $total) {
			header("Location:final.php");
			exit();
		}else{
            $_SESSION['ques'] = $_SESSION['rand'][$quesno];
            $_SESSION['qno'] ++;
			header("Location:test.php");
		}

	}

	private function getTotal(){
	$query = "SELECT * FROM tbl_ques";
    $getResult = $this->db->select($query);
    $total = $getResult->num_rows;
    return $total;

	}
	private function rightAns($number){
	$query = "SELECT * FROM tbl_ans WHERE quesNo = '$number' AND rightAns = '1'";
    $getdata = $this->db->select($query)->fetch_assoc();
    $result = $getdata['id'];
    return $result;
	}

}


 ?>