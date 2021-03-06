<?php
//if($_SESSION['cat'] =! 'yeah'|| isset($_SESSION['cat'])){
//    header("location: ../index.php?error=ever_felt_like_you_are_in_a_wrong_place?");
//    exit();
//};
require 'dbh.inc.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$error = "working after the connection";
$message = '';
$form_data = json_decode(file_get_contents("php://input"));
$customer_id = $form_data->CUSTOMER_ID;
$username = $form_data->CUSTOMER_USERNAME;
$pwd = $form_data->CUSTOMER_PWD;
$customer_first_name = $form_data->CUSTOMER_FIRST_NAME;
$customer_last_name = $form_data->CUSTOMER_LAST_NAME;
$dln = $form_data-> DRIVERS_LICENSE_NUMBER;
$number = $form_data-> CUSTOMER_PHONE_NUMBER;
$age = $form_data-> CUSTOMER_AGE;
$street = $form_data -> CUSTOMER_STREET;
$city = $form_data -> CUSTOMER_CITY;
$state = $form_data -> CUSTOMER_STATE;
$zip = $form_data -> CUSTOMER_ZIP;

$error = "working after form_data";
//if(empty($username)||empty($pwd)||empty($customer_first_name)||empty($customer_last_name)
//    ||empty($dln)||empty($number)||empty($age)||empty($street)
//    ||empty($city)||empty($state)||empty($zip)){
//    exit();
//}
$password = hash('sha256',$password);
//if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$number)) {
//    exit();
//}
//if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$age)) {
//    exit();
//}
//if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$dln)) {
//    exit();
//}
//if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$zip)) {
//    exit();
//}
//if (!preg_match('/^\w{5,}$/', $username)) {
//    exit();
//}
$error = "working after the match";
$statement = $conn->prepare("SELECT CUSTOMER_PWD FROM P_CUSTOMER WHERE CUSTOMER_ID=?");
$statement->bind_param("i", $username);
$statement->execute();
$statement->bind_result($result);
$statement->fetch();
$statement->close();
//$error = $result." ".$pwd;
//echo 'working after the fetch';
//echo $result;
if ($result == $pwd) {
//    $error ='working after the if condition';
//    echo 'working right after the if statement '.$result.'  '.$pwd;fg
    $statement = $conn->prepare("UPDATE P_CUSTOMER SET CUSTOMER_USERNAME =?,CUSTOMER_FIRST_NAME = ?, CUSTOMER_LAST_NAME = ?, DRIVERS_LICENSE_NUMBER= ?,
                      CUSTOMER_PHONE_NUMBER=?, CUSTOMER_AGE = ?, CUSTOMER_STREET =?,CUSTOMER_CITY=?, CUSTOMER_STATE=?, CUSTOMER_ZIP=? WHERE CUSTOMER_ID = ?;");
//    echo 'working after the prepare';
//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);
//$query= ("UPDATE P_CUSTOMERS SET employee_first_name = :first_name, employee_last_name = :last_name where CUSTOMER_ID = :id");
    $statement -> bind_param('ssssiisssis', $username,$customer_first_name, $customer_last_name, $dln, $number, $age, $street,$city, $state, $zip, $customer_id);
//    echo 'working after the binding';
//$statement= $connect->prepare($query);
    if ($statement->execute()) {
        $message = 'Data Successfully Edited without password';
    }
//    echo 'working after the pwd statement';
} else {
//    echo 'working after the else statement';
    $pwd = hash('sha256', $pwd);
    $statement = $conn->prepare("UPDATE P_CUSTOMER SET CUSTOMER_USERNAME =?,CUSTOMER_PWD=?, CUSTOMER_FIRST_NAME = ?, CUSTOMER_LAST_NAME = ?, DRIVERS_LICENSE_NUMBER= ?,
                      CUSTOMER_PHONE_NUMBER=?, CUSTOMER_AGE =?, CUSTOMER_STREET =?, CUSTOMER_CITY=?, CUSTOMER_STATE=?, CUSTOMER_ZIP=? WHERE CUSTOMER_ID = ?;");
//$query= ("UPDATE P_EMPLOYEES SET employee_first_name = :first_name, employee_last_name = :last_name where EMPLOYEE_ID = :id");
    $statement->bind_param('sssssiisssis', $username,$pwd, $customer_first_name, $customer_last_name, $dln, $number, $age, $street, $city, $state, $zip, $customer_id);

//$statement= $connect->prepare($query);
    if ($statement->execute()) {
        $message = 'Data Successfully Edited';
    }
}

//$statement->bind_result($result);
//$statement->fetch();
$output = array(
    'error' => $error,
    'message' => $message,
    'id'=> $customer_id,
    'username' => $username,
    'password' => $pwd,
    'first name' => $employee_first_name,
    'last Name' => $employee_last_name,
    'License'=> $dln,
    'Phone_number'=>$number,
    'age'=>$age,
    'street'=>$street,
    'city'=>$city,
    'state'=>$state,
    'zip'=>$zip
);

echo json_encode($output);