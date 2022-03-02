<?php
if (!isset($_GET['id'])) {
    die("You can not edit");
}

$cid= $_GET['id'];


session_start();
 if(!isset($_SESSION['login']) || !$_SESSION['login']==1){
   header('Location:login.php');
 }
 $id = $_SESSION['user_id']; 
 include('db/connect.php');
 $query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($result);

$categoryQuery="SELECT * FROM category WHERE id='$cid' ";
$categoryResult=mysqli_query($conn, $categoryQuery);

if (mysqli_num_rows($categoryResult)==0) {
    die("No record found with this id");
}
else {
    $row = mysqli_fetch_assoc($categoryResult);
}

?>

<html>

<head>
    <title>Home-Asmt News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <!-- this is navbar -->
    <?php include('include/nav.php');?>

    <div class="container">
        <div class="row">
            <?php include('include/left-nav.php') ?>


            <div class="col-8">
                <form action="db/add-category.php" method="POST">
                    <label for="" style="background-color:black; color:white; padding:10px; width:100%;">Category
                        Title</label>
                    <div class="input-group">
                        <input value="<?php echo $row['title'] ?>" type="text" placeholder="Category Name"
                            name="category" class="form-control">
                    </div>
                    <br>
                    <div class="input-group">
                        <input value="<?php echo $row['iconImage'] ?>" type=" text" class="form-control"
                            placeholder="fa icon class" name="iconclass">
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color:black;">Save</button>
                </form>
                <?php include('include/message.php'); ?>



            </div>
        </div>
    </div>
    </div>




</body>
<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- bootstrap js                      -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<!-- fontawesome -->
<script src="https://kit.fontawesome.com/6f38b1151d.js" crossorigin="anonymous"></script>


<!-- bootbox -->
<script src="js/bootbox.min.js"></script>

<!-- check js something something😒 -->
<script>
function deleteConfirmation(id) {
    bootbox.confirm({
        message: "Are you sure",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function(result) {
            if (result) {
                //delete code

                window.location = 'db/delete-category.php?id=' + id;
            }

        }
    });

}
</script>

</html>