<?php
require 'dbh.inc.php';
if($_SESSION['cat'] =! 'yeah'|| isset($_SESSION['cat'])){
    header("location: ../index.php?error=ever_felt_like_you_are_in_a_wrong_place?");
    exit();
};
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
$message = '';
$form_data = json_decode(file_get_contents("php://input"));
$model = $form_data->MODEL;
$statement = $conn->prepare("DELETE FROM P_CAR_MODEL WHERE MODEL = ?;");
//$query= ("UPDATE P_EMPLOYEES SET employee_first_name = :first_name, employee_last_name = :last_name where EMPLOYEE_ID = :id");
$statement -> bind_param("s", $model);

if($statement -> execute())
{
    $message = 'Data Successfully Deleted';
}
$conn->close();
$output = array(
    'message' => $message
);

echo json_encode($output);