<?php
if($_SESSION['dog'] =!67){
    header("location: ../home.php?error=ever_felt_like_you_are_in_a_wrong_place?");
};
require 'dbh.inc.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$message = '';

$form_data = json_decode(file_get_contents("php://input"));
//$username = 'null';


$username = $form_data->USERNAME;
$employee_first_name = $form_data->EMPLOYEE_FIRST_NAME;
$employee_last_name = $form_data->EMPLOYEE_LAST_NAME;
$password = $form_data->PWD;
$dob = $form_data->EMPLOYEE_DOB;
$street = $form_data->EMPLOYEE_STREET;
$city = $form_data->EMPLOYEE_CITY;
$state = $form_data->EMPLOYEE_STATE;
$zip = $form_data->EMPLOYEE_ZIP;
$salary = $form_data->EMPLOYEE_SALARY;
$password = hash('sha256', $password);

if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $dob)) {
    exit;
}
$statement = $conn->prepare("insert into P_EMPLOYEES (USERNAME, PWD, EMPLOYEE_FIRST_NAME, EMPLOYEE_LAST_NAME, EMPLOYEE_DOB, EMPLOYEE_STREET, EMPLOYEE_CITY, EMPLOYEE_STATE, EMPLOYEE_ZIP, EMPLOYEE_SALARY ) VALUES (?,?,?,?,?,?,?,?,?,?);");
$statement->bind_param("ssssssssid", $username, $password, $employee_first_name, $employee_last_name, $dob, $street, $city, $state, $zip, $salary);

if ($statement->execute()) {
    $message = 'Data Inserted';
}
$output = array(
    'message' => $message,
    'username' => $username,
    'firstname' => $employee_first_name,
    'lastname' => $employee_last_name
);

echo json_encode($output);
