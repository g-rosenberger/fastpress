<?php 
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: admin/login.php?e=403");
    exit;
}
$f_username = $_SESSION["username"];
require_once 'admin/config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap.css">

<script src='https://cloud.tinymce.com/5/tinymce.min.js?apiKey=<?php echo $tinymcekey; ?>'></script>
  <script>
  tinymce.init({
    selector: '#mytextarea'
  });
  </script>


    <title>Upload</title>
  </head>
  <body>

    <header>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Carousel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </header>

  <main class="container">

   <form class="form-group" method="POST" action="" enctype = "multipart/form-data">  
     <div class="form-group">
      <label for="exampleFormControlTextarea1">Title</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="title" placeholder="MAXIMUM 30 WORDS" required></textarea>
    <label for="exampleFormControlTextarea1">Subtitle</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="subtitle" required></textarea>
   
     <label for="exampleFormControlTextarea1">KeyWords</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keywords" required></textarea>
<label for="exampleFormControlTextarea1">Category</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="category" placeholder="Category if n sub category separated by /" required></textarea>
    <label for="mytextarea">Text</label>
    <textarea class="form-control" id="mytextarea" rows="3" name="text" placeholder="TEXT"></textarea>
<br>
 <input type = "file" name = "image" /><br>
         <input type = "text" name="pImgAlt" placeholder="Little description of the image, (alt attribute)"/><br>
           

  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
   </form>

  </main><!-- Container -->

      <!-- FOOTER -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="assets/jquery.js"></script>
  <script src="assets/popper.js"></script>
  <script src="assets/bootstrap.js"></script>
  </body>
</html>
<?php
//GATHER DATA FROM THE FORM & NAMING VARIABLES
$h1 = '<strong><i><h1 class="display-3">'. $_POST["title"] . '</h1></i></strong>';
$pTitle = $_POST["title"];
$pSubtitle = $_POST["subtitle"];
$pKeywords = $_POST["keywords"];
$pCategory = $_POST["category"];
$filenam = urlencode($_POST["title"]);
$filename = "$filenam.php";
$pUrl = "p/$filename";
$h2 = '<strong><h2 class="lead">'. $_POST["subtitle"] . '</h2></strong>';
$p = $_POST["text"];
$page = $h1 . $h2 . $p;
$date = date("Y-m-d:h:i:sa");
$pImgAlt = $_POST["pImgAlt"];
//OPTIONAL, UPLOADING IMAGES
 if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","zip","rar","png","exe","docx","odt","rtf","wav","mp4");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="Solo puedes subir archvios .zip, .rar, o .jpeg";
      }
      
      if($file_size > 20971520000000) {
         $errors[]='Archivo demasiado grande';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"p/img/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
$imagename = rawurlencode($file_name);
//creating the html file
$htmlpage = '
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="' . $_POST["subtitle"] . '">
    <meta name="author" content="' . $f_username . '">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
    
    <link rel="stylesheet" href="../assets/bootstrap.css">

    <title>' . $_POST["title"] . '</title>

  </head>

  <body> ' . "
<?php require_once('../header.php'); ?> " . '

<main class="container lead my-3"><div class="jumbotron">' . $h1 . $h2 . '<p><i>Date:' . $date . '</i></p><img class="img-fluid"  style="width: 100%; display: block;"  src="img/' . $imagename . '"></img></div>' . $p . '</main> ' . "
<?php require_once('../similar.php'); ?>
<?php require_once('../footer.php'); ?> " . '
  <script src="../assets/jquery.js"></script>
  <script src="../assets/popper.js"></script>
  <script src="../assets/bootstrap.js"></script>
  </body>

</html>

';

//SEND VALUES TO DB
if (isset($_POST["title"])) {

$myfile = fopen("p/$filename", "w") or die("Perission Error, on p folder");
$txt = $htmlpage;
fwrite($myfile, $txt);
fclose($myfile);

$sql = "INSERT INTO `fp` (`pKeywords`, `pUrl`, `pTitle`, `pSubtitle`, `pDate`, `pCategory`, `pImgUrl`, `pImgAlt`)
VALUES ('$pKeywords', '$pUrl', '$pTitle', '$pSubtitle', now(), '$pCategory', '$imagename', '$pImgAlt');";

if ($link->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $link->error;
}

$link->close();

} else {die();}
 ?>
