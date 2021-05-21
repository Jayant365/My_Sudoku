<?php
$username= $_POST['username'];
$password= $_POST['password']; 
$gender= $_POST['gender'];
$email= $_POST['email'];

if(!empty($username) || !empty($password) || !empty($gender) || !empty($email)){
    $host="localhost";
        $dbusername="root";
    $dbpassword="";
    $dbname="youtube";
    
    $conn = new mysqli($host,$username,$dbpassword,$dbname);
    if(mysqli_onnecterror()){
        die('Connect Error('mysql_connect_errno().')'.mysqli_connect_error());
    }else{
        $SELECT = "SELECT emain From register Where email = ? Limit 1";
        $INSERT = "INSERT Into register (username,password,gender,email) values(?,?,?,?)";
        
        //prepare statement
        $stmt= $conn->prepare($SELECT);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bid_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_row;
        
        if($rnum==0){
            $stmt->close();
            
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssss",$username,$password,$gender,$email);
            $stmt->execute();
            echo "New record inserted sucessfully";
        }
        else {
            echo "Someone already register using this email";
    }
    $stmt->close();
    stmt->close();
}
}
else {
    echo "All field are required";
die();
}

?>