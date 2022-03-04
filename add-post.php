<?php
session_start();
 if(!isset($_SESSION['login']) || !$_SESSION['login']==1){
   header('Location:login.php');
 }
 $id = $_SESSION['user_id']; 
 include('db/connect.php');
 $query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($result);

$categoryQuery="SELECT * FROM category";
$categoryResult=mysqli_query($conn, $categoryQuery);



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
                <form method="POST" action="">
                    <div class="md-3">
                        <label for="" style="font-size:20px; font-weight:bold;" class="form-label">Title:
                        </label>
                        <input placeholder="Title" type="text" class="form-control" name="title">
                    </div>


                    <div class="md-3">
                        <br>
                        <textarea placeholder="Type some texts..." type="text" class="form-control"
                            name="content"></textarea>
                    </div>

                    <div class="md-3">
                        <label for="" style="font-size:20px; font-weight:bold;" class="form-label">Cover image:</label>
                        <br>
                        <input type="file" name="image">
                    </div>

                    <div class="md-3">
                        <label for="" class="form-label">Category</label>
                        <select name="category" class="form-control">
                            <?php while($row=mysqli_fetch_assoc($categoryResult)){ ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['title'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>