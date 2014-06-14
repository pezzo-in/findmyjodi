<?php
/* ----- The DB class ----- */

class DB {
	public $connect;
	function __construct(){
		$this->connect();
	}
	
	// This function connects to the database.
	private function connect() {
		try{
			$this->connect =new mysqli(HOST,USER,PASS,DB);
			$error=mysqli_connect_errno($this->connect);
			if($error!=0){
				throw new Exception('Fatal Error => Unable to connect to the database,please check out that the database exists already ');
			}	
		}
		catch (Exception $e){
			echo $e->getMessage();
		}
	} 
	
	// Querying the database
	public function query($query) {
		try{
			$result =@$this->connect->query($query);
			$error=mysqli_errno($this->connect);
			if($error!=0){
				throw new Exception(' Unable to get the results of the query.'/*.mysqli_error($this->connect)*/);
			}
			return $result;	
		}
		catch (Exception $e){
			echo $e->getMessage();
		}
	}
	
	// retreive data of the query !
	public function retrieve_data($result) {
		if(isset($result)){
			$result_arr=array();
			$num_result = $result->num_rows;
			for($i=0;$i<$num_result;$i++){
				$result_arr[$i]=$result->fetch_assoc(); 
			}
			return $result_arr;
		}	
	}
	
	// This function closes the connection
	public function close() {
		if(isset($this->connect)){
			if(!$this->connect->close()){
				die("Database logging out has failed !");
			 }
		}
	}
	
	public function cleanInput($method,$input,$sql=0) {
		// Cleaning for $_POST vars
		if($method == 'p'){
			$cleaned = @trim($_POST["{$input}"]);
		// Cleaning for $_GET vars
		}elseif($method == 'g'){
			$cleaned = @trim($_GET["{$input}"]);
		// Cleaning for string vars
		}elseif($method == 's'){
			$cleaned = @trim($input);
		}
		
		$cleaned = @htmlentities(strip_tags($cleaned));
		if(@$sql == 1){
		// needs reference to $connect ! or else it won't work
		global $connect;
		$cleaned = mysqli_real_escape_string($this->connect,$cleaned);
		}
		return $cleaned;
	}
}
$db=new DB();
?>