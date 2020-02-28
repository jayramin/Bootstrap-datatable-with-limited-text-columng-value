 <?php
// error_reporting(0);
mysqli_report(MYSQLI_REPORT_STRICT);
class mymodel{
    public $Connection = "";
    function __construct(){
        // echo "constructor calling";
        try {
            $this->Connecion = new mysqli("localhost","root","","masterdatabase");
            // echo "in try";
        } catch (Exception $e) {
            $log = "log";
            
            if(!file_exists){
                mkdir($log,777);
            } 
            $ErrorMsgData = PHP_EOL."Error >> ". $e->getMessage().PHP_EOL;
            $ErrorMsgData .= "Error Date Time >> ". date("d-m-Y H:i:s").PHP_EOL;

            file_put_contents($log."/log".date('d_m_Y').".txt", $ErrorMsgData,FILE_APPEND);
            //throw $th;
            // echo "<pre>";
            // print_r($e);
            // echo "<br>";
            // echo $e->getMessage();
            // echo "<br>";
            // echo "test";
        }
    }
    public function SelectLoginData($uname,$pass)
    {
        $SelectLoginDataSQL = "SELECT * FROM users WHERE password='$pass' AND (username='$uname' OR email='$uname' OR mobile = '$uname')";
        $SelectLoginDataSQLEx = $this->Connecion->query($SelectLoginDataSQL);
        // print_r($SelectLoginDataSQLEx);
        if ( $SelectLoginDataSQLEx->num_rows> 0 ) {
            # code...
            $FetchData = $SelectLoginDataSQLEx->fetch_object();
            // $FetchData = $SelectLoginDataSQLEx->fetch_array(); //reponse associative + numeric 
            // echo $FetchData['username'];
            // echo $FetchData[1];
            // $FetchData = $SelectLoginDataSQLEx->fetch_assoc(); // response only in associative array
            // echo $FetchData['username'];
            // $FetchData = $SelectLoginDataSQLEx->fetch_row(); // response only in numeric array 
            // echo $FetchData[1];
            // echo "<pre>";
            // print_r($FetchData->username);
            $ResData['Code'] = 1;
            $ResData['Msg'] = 'Success';
            $ResData['Data'] =$FetchData ;
        }else{
            $ResData['Code'] = 0;
            $ResData['Msg'] = "try again";
            $ResData['Data'] = 0;
        }
        return $ResData; 
    }
    function SelectData($tbl,$where=""){
        // print_r($where);
         $SelectSQL = "SELECT * FROM $tbl";
        // $SelectEx = $this->Connection->query("SELECT * FROM $tbl");
        
        if ($where != '') {
            # code...
            $SelectSQL .= " WHERE ";
            // $where = array("TOPS","Techno");
            // print_r($where);
            // $i = 1;
            // $wCount = count($where);
            // foreach ($where as $key => $value) {
            //     if ($i < $wCount) {
            //         $SelectSQL .= " $key = '$value' AND";    
            //     }else{
            //         $SelectSQL .= " $key = '$value'";
            //     }
            //     $i++;
            // }
            foreach ($where as $key => $value) {
                $SelectSQL .= " $key = '$value' AND";
            }
            $SelectSQL = rtrim($SelectSQL,"AND");
            // echo "<br>";
            // exit;
        }
        $SelectEx = $this->Connecion->query($SelectSQL);
        // echo "<pre>";
        // print_r($SelectEx);
        // $FetchData = $SelectEx->fetch_object();
        // print_r($FetchData);
        if ($SelectEx->num_rows > 0) {
            # code...
       
        while ($FetchData = $SelectEx->fetch_object()) {
            $AllUsersData[]=$FetchData;
        }
        // echo "<pre>";
        // print_r($AllUsersData);
        // echo $FetchData->username;
        $ResData['Code'] = 1;
        $ResData['Msg'] = 'Success';
        $ResData['Data'] =$AllUsersData ;
    }else{
        $ResData['Code'] = 0;
        $ResData['Msg'] = 'Success';
        $ResData['Data'] = 0;
    }
   
    return $ResData; 

    }
    function InsertData($tbl,$rd){
        // echo "test";
        // echo "INSERT INTO `users`(`id`, `username`, `fullname`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`, `mobile`, `gender`, `hobby`, `city`, `status`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15])";
        // echo "<br>"; 
        // echo "<pre>";
         // print_r($rd);
        // print_r($_GET);

        $Keys = array_keys($rd);
         // print_r($Keys);
        $implodeData = (implode(",",$Keys));
         $vals = implode("','",$rd);
         $InsertSQL = "INSERT INTO $tbl($implodeData) VALUES ('$vals')";
         $InsertSQLEx = $this->Connecion->query($InsertSQL);
         if ($InsertSQLEx == 1) {
             $ResData['Code'] = 1;
             $ResData['Msg'] = 'Success';
             $ResData['Data'] =1 ;
         }else{
             $ResData['Code'] = 0;
             $ResData['Msg'] = "try again";
             $ResData['Data'] = 0;
         }
         return $ResData;                                                                                                                                                         
        }

}

// $ModelObject = new mymodel;

// $Data = array("username"=>"TOPS",
// "fullname"=>"Tops Techno",
// "email"=>"mail@mail.com",
// "email_verified_at"=>"",
// "password"=>"123",
// "remember_token"=>"1",
// "role_id"=>"2",
// "mobile"=>"9879879877",
// "hobby"=>"Cricket",
// "status"=>"Active",
// "gender"=>"Male",
// );

// $ModelObject->InsertData('users',$Data);
?>