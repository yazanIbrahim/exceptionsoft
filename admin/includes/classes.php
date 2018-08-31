<?php



class validator{
    private $error;
    
}

class Project{
    
  
    private $name;
    private $startDate;
    private $endDate;
    private $price;
    private $client;
    
    
   //constructor
    public function __construct(Client $client){
       $this->client = $client;
    }
        
        
  
    
    //memeber functions
    public function addNewProject($name,$startDate,$endDate,$price){
        $this->name      = $name;
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
        $this->price     = $price;
        
        
        $db  = new connection();
        // insert client information 
        $stmt = "INSERT INTO client (client_name,client_phone) values(?,?)";
        $temp = array($this->client->getName(),$this->client->getPhone());
        $db->sqlStatmentWithPrepare($stmt, $temp);
        $id = (int)$db->getId();
        
        //insert into project table
        $stmt = "INSERT INTO project (client_id,project_name,start_date,end_date,price) VALUES ($id,?,?,?,?)";
        
        $res  = $db->sqlStatmentWithPrepare($stmt,array($name,$startDate,$endDate,$price));
        if($res >0){
            echo "Project Has Been Added Successfully";
        }else {
            echo "Failed to Project";
        }
        
    }
}


class Payment{
   
    private $amount=array();
    private $date = array();
    
   
    //constructor
    public function __Payment(){
        
    }
    
    
    //member functions
    
    public function addNewPayment($amount,$date){
        $this->amount = $amount;
        $this->date   = $date;
    }
    
}

class Client{
    
    private $name;
    private $phone;
    
     //constructor
    public function __construct($name,$phone){
        $this->name  = $name;
        $this->phone = $phone;
    }
    
    //member functions
    
    public function getName(){
        return $this->name;
    }
    
    public function getPhone(){
        return $this->phone;
    }
}

class Exspenses {
    
    private $amount;
    private $date;
    private $paidTo;
    private $notes;
    
    public function __construct() {
     $this->date  = time();
     
    }
    
    
    //memeber functions
    public function addNewExpense($amount,$paidTo,$note="No Notes For This Expense"){
        $time = date("Y-m-d H:i:s");
     
        
        $db   = new connection();
        $stmt = "INSERT INTO expenses (amount,expenses_date,paid_to,notes) VALUES(?,?,?,?)";
        $res = $db->sqlStatmentWithPrepare($stmt, array($amount,$time,$paidTo,$note));
        
        $stmt = "SELECT amount,expenses_date,paid_to,notes FROm expenses where id=?";
        $res  = $db->fetchDataWithCondition($stmt, array((int)$db->getId()));
        
        if($res > 0){
           return $res;
        }else {
            return false;
        }
        
        
    }
    
    
    public function getExpenses($year,$month,$day,$offset){
        $db = new connection();
        
        $stmt = "SELECT amount,expenses_date,paid_to,notes FROM expenses "
                . "WHERE month(expenses_date) = ? OR year(expenses_date)=? OR day(expenses_date) = ? limit 15 "
                . "offset $offset";
      
        $res = $db->fetchDataWithCondition($stmt,array($month,$year,$day));
        
       
        if($res > 0){
            return $res;
        }else{
            return "No Expenses Found";
        }
    }
}

class connection {
    private $hostname = 'localhost';
    private $databaseName='exception_soft';
    private $username = 'root';
    private $password = '';
    protected $connect;
    public function __construct() {
        try{
           $this->connect = new PDO("mysql:host=$this->hostname;dbname=$this->databaseName",$this->username, $this->password);
           $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        } catch (Exception $ex) {
            echo 'failed '.$ex->getMessage();
        }
    }
    public function sqlStatmentWithPrepare($stmt , $arr){
        $sql    = $this->connect->prepare($stmt);
        $result = $sql->execute($arr);
        return $result;
    }
    public function fetchData($stmt){
        $sql=$this->connect->prepare($stmt);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }
    public function fetchDataWithCondition($stmt , $arr){
        $sql=$this->connect->prepare($stmt);
        $sql->execute($arr);
        $result = $sql->fetchAll();
        return $result;
    }
    public function returnConnection (){
        return $this->connect;
    }
    
    
    public function getId(){
        
        return $this->connect->lastInsertId();
    }
    
    
    public function countRow($stmt,$cond){
        
        $query = $this->connect->prepare($stmt);
        $query->execute($cond);
        return $query->rowCount();
    }
    
    
}

/*--------------------------------------*/
class gdrive{
	//credentials (get those from google developer console https://console.developers.google.com/)
	var $clientId = '1068406447391-05onnrrggb9d9furngqthm1i9dvjhnsu.apps.googleusercontent.com';
        var $clientSecret = 'D2cFVJOu6TCkU0VB5tPvFEAU';
        var $redirectUri = 'http://localhost/exceptionSoftSystem/admin/uploadProjects.php';
	
	//variables
	var $fileRequest;
	var $mimeType;
	var $filename;
	var $path;
	var $client;
	
	
	function __construct(){
		//require_once 'src/Google/autoload.php'; // get from here https://github.com/google/google-api-php-client.git 
           
            $this->client = new Google_Client();
	}
	
	
	function initialize(){
		echo "initializing class\n";
		$client = $this->client;
		
		$client->setClientId($this->clientId);
		$client->setClientSecret($this->clientSecret);
		$client->setRedirectUri($this->redirectUri);
				
		$refreshToken = file_get_contents("token.txt"); 
		$client->refreshToken(json_decode($refreshToken,true)['refresh_token']);
		$tokens = $client->getAccessToken();
                echo "<pre>";
                print_r(json_decode($refreshToken,true));
               $client->setAccessToken(json_decode($refreshToken,true));
		
		$client->setDefer(true);
		$this->processFile();
		
	}
	
	function processFile(){
		
		$fileRequest = $this->fileRequest;
		echo "Process File $fileRequest\n";
		$path_parts = pathinfo($fileRequest);
		$this->path = $path_parts['dirname'];
		$this->fileName = $path_parts['basename'];
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$this->mimeType = finfo_file($finfo, $fileRequest);
		finfo_close($finfo);
		
		echo "Mime type is " . $this->mimeType . "\n";
		
		$this->upload();
			
	}
	
	function upload(){
		$client = $this->client;
		
		$file = new Google_Service_Drive_DriveFile();
		$file->title = $this->fileName;
		$chunkSizeBytes = 1 * 1024 * 1024;
		
		$fileRequest = $this->fileRequest;
		$mimeType = $this->mimeType;
		
		$service = new Google_Service_Drive($client);
		$request = $service->files->create($file);
		// Create a media file upload to represent our upload process.
		$media = new Google_Http_MediaFileUpload(
		  $client,
		  $request,
		  $mimeType,
		  null,
		  true,
		  $chunkSizeBytes
		);
		$media->setFileSize(filesize($fileRequest));
		// Upload the various chunks. $status will be false until the process is
		// complete.
		$status = false;
		$handle = fopen($fileRequest, "rb");
		
		// start uploading		
		echo "Uploading: " . $this->fileName . "\n";  
		
		$filesize = filesize($fileRequest);
		
		// while not reached the end of file marker keep looping and uploading chunks
		while (!$status && !feof($handle)) {
			$chunk = fread($handle, $chunkSizeBytes);
			$status = $media->nextChunk($chunk);  
		}
		
		// The final value of $status will be the data from the API for the object
		// that has been uploaded.
		$result = false;
		if($status != false) {
		  $result = $status;
		}
		fclose($handle);
		// Reset to the client to execute requests immediately in the future.
		$client->setDefer(false);	
	}
	
}
