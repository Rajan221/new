<?php
if (!isset($_GET['id'])) {
    die("not allowed on this page");
}

include('db/connect.php');
$pid = $_GET['id']; 
$postQuery="SELECT * FROM post WHERE id ='$pid'";
$postResult = mysqli_query($conn, $postQuery);

if (mysqli_num_rows($postResult)==0) {
    die("No record found");
}

$post = mysqli_fetch_assoc($postResult);


session_start();
 if(!isset($_SESSION['login']) || !$_SESSION['login']==1){
   header('Location:login.php');
 }
 $id = $_SESSION['user_id']; 

 $query = "SELECT * FROM users WHERE id='$id'";
$result = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($result);

$categoryQuery="SELECT * FROM category";
$categoryResult=mysqli_query($conn, $categoryQuery);



?>
<!DOCTYPE html>
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
                <form method="POST" action="#" enctype="multipart/form-data">
                    <div class="md-3">
                        <label for="" style="font-size:20px; font-weight:bold;" class="form-label">Title:
                        </label>
                        <input placeholder="Title" value="<?php echo $post['title']; ?>" type="text"
                            class="form-control" name="title">
                    </div>


                    <div class="md-3">
                        <br>
                        <textarea id="news" placeholder="Type some texts..." type="text" class="form-control"
                            name="content">
                        <?php echo $post['content']; ?>
                        </textarea>
                    </div>

                    <div class="md-3">
                        <label for="" style="font-size:20px; font-weight:bold;" class="form-label">Cover image:</label>
                        <br>
                        <input type="file" name="image">
                    </div>
                    <br>

                    <div class="md-3">
                        <label for="" style="font-size:20px; font-weight:bold;" class="form-label">Category:</label>
                        <select name="category" class="form-control">
                            <?php while($row=mysqli_fetch_assoc($categoryResult)){ ?>
                            <option value="<?php echo $row['id'] ?>"
                                <?php if($post['id']==$row['id']){ echo "selected"; } ?>>
                                <?php echo $row['title']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-dark">Save</button>
                    <?php include('include/message.php'); ?>
                </form>
            </div>
        </div>
    </div>



</body>
<!-- bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

<!-- tinymce -->
<script src="https://cdn.tiny.cloud/1/oyp8vni5agoimq6p683fgqg5yyyw7tcwoko88tf4a48do6hh/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
<!-- 
<script>
tinymce.init({
    selector: '#news',

});
</script> -->
<script>
var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

tinymce.init({
    selector: '#news',
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    image_advtab: true,
    link_list: [{
            title: 'My page 1',
            value: 'https://www.tiny.cloud'
        },
        {
            title: 'My page 2',
            value: 'http://www.moxiecode.com'
        }
    ],
    image_list: [{
            title: 'My page 1',
            value: 'https://www.tiny.cloud'
        },
        {
            title: 'My page 2',
            value: 'http://www.moxiecode.com'
        }
    ],
    image_class_list: [{
            title: 'None',
            value: ''
        },
        {
            title: 'Some class',
            value: 'class-name'
        }
    ],
    importcss_append: true,
    file_picker_callback: function(callback, value, meta) {
        /* Provide file and text for the link dialog */
        if (meta.filetype === 'file') {
            callback('https://www.google.com/logos/google.jpg', {
                text: 'My text'
            });
        }

        /* Provide image and alt text for the image dialog */
        if (meta.filetype === 'image') {
            callback('https://www.google.com/logos/google.jpg', {
                alt: 'My alt text'
            });
        }

        /* Provide alternative source and posted for the media dialog */
        if (meta.filetype === 'media') {
            callback('movie.mp4', {
                source2: 'alt.ogg',
                poster: 'https://www.google.com/logos/google.jpg'
            });
        }
    },
    templates: [{
            title: 'New Table',
            description: 'creates a new table',
            content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
        },
        {
            title: 'Starting my story',
            description: 'A cure for writers block',
            content: 'Once upon a time...'
        },
        {
            title: 'New list with dates',
            description: 'New List with dates',
            content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
        }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    contextmenu: 'link image imagetools table',
    skin: useDarkMode ? 'oxide-dark' : 'oxide',
    content_css: useDarkMode ? 'dark' : 'default',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});
</script>

</html>