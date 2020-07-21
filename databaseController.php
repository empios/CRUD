<?php 

session_start();

$mysqlCon = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqlCon));

$id = 0;
$name = '';
$height = '';
$update = false;

if (isset($_POST['dodaj'])){
    $name = $_POST['name'];
    $height = $_POST['height'];

    $_SESSION['message'] = "Zapisano";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");

    $mysqlCon->query("INSERT into crud(imie, wzrost) VALUES('$name', $height)") or die($mysqlCon->error);
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqlCon->query("DELETE from crud WHERE id=$id") or die($mysqlCon->error);
    $_SESSION['message'] = "Usunięto wpis";
    $_SESSION['msg_type'] = "danger";
    header("location: index.php");
}


if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqlCon->query("SELECT * FROM crud WHERE id = $id") or die($mysqlCon->error);
    if ($result -> num_rows) {
        $row = $result->fetch_array();
        $name = $row['imie'];
        $height = $row['wzrost'];
    }

}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $height = $_POST['height'];
    $mysqlCon->query("UPDATE crud SET imie='$name', wzrost=$height WHERE id=$id") or die ($mysqlCon->error);
    $_SESSION['message'] = "Zaaktualizowano wpis";
    $_SESSION['msg_type'] = "warning";
    header('location: index.php');
}
