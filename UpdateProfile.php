<?php
session_start();

include_once('DBConnect.php');
if ($_POST['profileButton']) {

    $username=$_SESSION['username'];

    $uname = strip_tags($_POST['uname']);

    $ulname = strip_tags($_POST['ulname']);

    $gender = strip_tags($_POST['gender']); //Radio BOx

    $address = strip_tags($_POST['address']);

    $city = strip_tags($_POST['city']);

    $country = strip_tags($_POST['country']);

    $datebirth = strip_tags($_POST['datebirth']);

    $mobilenumber = strip_tags($_POST['mobilenumber']);

    //$img_name = basename($_FILES["file"]["name"]);
    //$img_name= strip_tags($_POST['file']);



    //Image querys
    $statusMsg = '';

    // File   upload path
    $targetDir = "C:/inetpub/wwwroot/1812315/GroupAProject2/UploadImg/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);



if(isset($_POST["profileButton"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file   formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server tmp_name
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){

            // Insert image file name into database
            $query = "UPDATE  user_profile
          SET u_name= '$uname',
          u_lastname ='$ulname',
          address ='$address',
          city ='$city',
          country ='$country',
          datebirth='$datebirth',
          mobilenum='$mobilenumber',
          active='1',
          u_img = '$fileName', 
          genderID ='$gender'
          WHERE u_username = '$username'";

            $result1 = mysqli_query($conn, $query);


            if($result1){

                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                header('Location: viewProfile.php ');
            }else{
                $statusMsg = "File upload failed, please try again.";
            }
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;

// $pass= md5($password)  f;
    /*
    $query = "UPDATE  user_profile
          SET u_name= '$uname',
          u_lastname ='$ulname',
          gender ='$gender',
          address ='$address',
          city ='$city',
          country ='$country',
          datebirth='$datebirth',
          mobilenum='$mobilenumber',
          active='1',
          u_img = '$img_name' 
          WHERE u_username = '$username'";


    $result = mysqli_query($conn, $query);

    if ($result) {


        header('Location: user.php'); // need to EDIT THIS LOCATION TO THE PROFILE VIEW PAGE
    } else {

        echo "Failed to update";
    }

*/

}


?>

