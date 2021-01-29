<?php 
/**
*Database Class
*/
class Database{
	public  $host 		= DB_HOST;
	public  $user 		= DB_USER;
	public  $pass 		= DB_PASS;
	public  $dbname 	= DB_NAME;
	
	public $link;
	public $error;
	

	function __construct() {
		$this->connectDB();
		
	}
	private $state_csv = false; 
	
	private function connectDB(){
		$this->link = new mysqli($this->host,$this->user,$this->pass,$this->dbname);
		if (!$this->link){
			$this->error = "Connction fail.".$this->link->connect_error;
			
		}
	}

	//insert data
	public function insert($data){
		$insert_row = $this->link->query($data) or die ($this->link->error.__LINE__);
		if ($insert_row) {
			return $insert_row;
		} else {
			return false;
		}
	}
	//select data
	public function select($data) {
		$results = $this->link->query($data) or die ($this->link->error.__LINE__);
		if ($results->num_rows > 0) {
			return $results;
		} else {
			return false;
		}
		
	}
	//update data
	public function update($query){
		$update_row = $this->link->query($query) or die ($this->link->error.__LINE__);
		if ($update_row) {
			return $update_row;
		} else {
			return false;
		}
	}
	//delete data
		public function delete($query){
		$delete_row = $this->link->query($query) or die ($this->link->error.__LINE__);
		if ($delete_row) {
			return $delete_row;
		} else {
			return false;
		} 
	}
	public function export() 
        {	
			if(!is_dir("members_excel")){
				mkdir("members_excel");
			} 
			$path="members_excel/";
            $this->state_csv = false;
            $q ="SELECT t.member_code, t.type,t.Committee_m_desigination,
			t.commitee_serial,t.fixed,t.ec_sub_fees, t.First_name,
			t.Last_name, t.Mobile_number,t.Membership_date, t.Address,t.Active_status
			FROM members as t";
            $run = $this->link->query($q);
            if ($run->num_rows > 0) {
                $fn =$path."csv_".uniqid().".csv";
                $file = fopen($fn,"w");
                
                while ( $row = $run->fetch_array(MYSQLI_NUM)){
                   if( fputcsv($file, $row)){
                       $this->state_csv = true; 
                   }else{
                       $this->state_csv = false; 
                    }
				}
				
                    if($this->state_csv){
						header("location:download.php?fkdPOisd=".base64_encode(str_rot13($fn))."");
						//file_get_contents("download.php?fl=$fn");
                    }else{
                        echo"Something went to Wrong";
                    }
            }else{
                echo "NO data found";
            }
            
        }
	public function backupdb(){	
			
		$q ="BACKUP DATABASE masjid_management
		TO DISK = 'D:\backups/masjid_management.bak'"; 
        $results=$this->link->query($q); 
			if ($results==true) {
				echo "DATABASE BACKUP Successfully";
			}
        }
	
	
}

?>
