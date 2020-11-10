<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crudapp";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    echo "Error connecting database.";
}

$firstName ="";
$lastName = "";
$update = false;
$id = 0;

if(isset($_POST['submit'])){
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];



    $conn->query("INSERT INTO data(firstName, lastName)
    VALUES('$firstName', '$lastName')") or die($conn->error);
  
    $_SESSION["message"] = "Record has been saved.";
    $_SESSION["msg_type"] = "Success";

    header("location: crud.php");
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM data WHERE id = $id");

    $_SESSION["message"] = "Record has been deleted.";
    $_SESSION["msg_type"] = "Danger.";

    header("location: crud.php");
}

if(isset($_GET["edit"])){
    $id = $_GET["edit"];
    $update = true;
    $result = $conn->query("SELECT * FROM  data  WHERE Id = $id");

    if($result->num_rows > 0)
    {
        $row = $result->fetch_array();
        $firstName = $row["firstName"];
        $lastName = $row["lastName"];

    }
}

if(isset($_POST["update"])){
    $id = $_POST["id"];
    $firstName = $_POST["fName"];
    $lastName = $_POST["lName"];

    $conn->query("UPDATE  data  SET firstName= '$firstName', '$lastName' WHERE id=$id");

    $_SESSION["message"] = "Record has been updated.";
    $_SESSION["msg_type"] = "warning";

    header("location : crud.php");
}


?>