<?php
if(!isset($_POST['category'])){
    die("can not edit the recored");
}
else{
    $c =$_POST['category'];
    $i=$_POST['iconclass'];
    $id=$_POST['id'];
    include('connect.php');
    $query ="UPDATE category SET title ='$c', iconImage ='$i' WHERE id='$id'";
    if(mysqli_query($conn,$query)){
        header('location:../category.php?msg=successfully updated');
    }else{
        
        header('location:../category.php?msg=' .mysqli_error($conn));
    }
}



?>