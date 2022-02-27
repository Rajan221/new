<?php
include('connect.php');

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query="DELETE FROM category WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        header('Location:../category.php?msg=Successfully deleted');
        
    }
    else{
        header("Location:../category.php?errmsg=".mysqli_error($conn));
    }
}



?>