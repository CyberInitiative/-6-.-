<?php

session_start();

$mysqli = new mysqli('kylin', 'miroslav', 'Stronghold666!', 'Library_db') or die(mysqli_error($mysqli));

    $id = 0;
    $update = false;
    $author = '';
    $bookname = '';
    $abstractname = '';
    $isbn = '';
    $review = '';

if(isset($_POST['save'])){
    $author = $_POST['author'];
    $bookname = $_POST['bookname'];
    $abstractname = $_POST['abstractname'];
    $isbn = $_POST['isbn'];
    $review = $_POST['review'];

    $mysqli->query("INSERT INTO Library_table (author,bookname,abstractname, isbn, review) VALUES ('$author', '$bookname', '$abstractname', '$isbn', '$review')") or
        die ($mysqli->error);

    $_SESSION['message'] = "Record havу been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");

}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM Library_table WHERE id=$id");

    $_SESSION['message'] = "Record have been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM Library_table WHERE id=$id") or die ($mysqli->error());
    if ($result->num_rows){
        $row = $result->fetch_array();
        $author = $row['author'];
        $bookname = $row['bookname'];
        $abstractname = $row['abstractname'];
        $isbn = $row['isbn'];
        $review = $row['review'];
    }
   
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $author = $_POST['author'];
    $bookname = $_POST['bookname'];
    $abstractname = $_POST['abstractname'];
    $isbn = $_POST['isbn'];
    $review = $_POST['review'];

    $mysqli->query("UPDATE Library_table SET author='$author', bookname='$bookname',abstractname='$abstractname',isbn='$isbn',review='$review' WHERE id=$id");

    $_SESSION['message'] = "Record have been updated!";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
}

