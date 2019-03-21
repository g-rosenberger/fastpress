<?php
 require_once 'admin/config.php';
 $a = 1;
   ?>
   <!DOCTYPE html>
   <html>
   <head>
    <title><?php echo "$wTitle"; ?></title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/home.css">
    <meta charset="utf-8">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<meta name="description" content="<?php echo $wDescription; ?>" />
<meta property="og:title" content="<?php echo $wName; ?>">
<meta property="og:url" content="<?php echo $wUrl; ?>">
<meta property="og:image" content="<?php echo $wDefaultImagePath; ?>">
<meta property="og:site_name" content="<?php echo $wName; ?>">
<meta property="og:description" content="<?php echo $wDescription; ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo $wTitle; ?>" />
<meta property="og:image" content="<?php echo $wDefaultImagePath; ?>" />

   </head>
   <body>
    <?php $t = "home"; require_once 'header.php'; ?>
    <div class="container">
  <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-4 font-italic"><?php echo $wTitle; ?></h1>
      <p class="lead my-3"><?php echo $wDescription ?></p>
    </div>
  </div>

  <div class="row mb-2">
   <?php
if ($_GET["page"]=="2") {
    $sql = "SELECT * FROM `fp` ORDER BY `pDate` DESC LIMIT 100";} else {

  $sql = "SELECT * FROM `fp` ORDER BY `pDate` DESC LIMIT 25";  }

  
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
     $a = ++$a;
     if (empty($row["pImgUrl"])) {
       $pImgUrl = "noimg.png";
     } else {$pImgUrl = $row["pImgUrl"];}


        echo '
 <div class="col-md-6" id="' . $a . '">
      <div class="card flex-md-row mb-4 shadow-sm h-md-250">
        <div class="card-body d-flex flex-column align-items-start">
          <strong class="d-inline-block mb-2 text-primary">' . $row["pCategory"] . '</strong>
          <h3 class="mb-0">
            <a class="text-dark" href="' . $row["pUrl"] . '">' . $row["pTitle"] .'</a>
          </h3>
          <div class="mb-1 text-muted">' . $row["pDate"] . '</div>
          <p class="card-text mb-auto">' . $row["pSubtitle"] . '</p>
          <a href="' . $row["pUrl"] . '" class="btn btn-info">Continue reading</a>
        </div>
        <img src="p/img/' . $pImgUrl . '" height="240px" width="240px">
      </div>
    </div> 
        ';
    }
} else {
    echo "<h2>No posts yet</h2>";
}
$link->close();

?>


   <div class="col-md-6">
      <div class="card flex-md-row mb-4 shadow-sm h-md-250">
        <div class="card-body d-flex flex-column align-items-start">
          <strong class="d-inline-block mb-2 text-primary">World</strong>
          <h3 class="mb-0">
            <a class="text-dark" href="#">Featured post</a>
          </h3>
          <div class="mb-1 text-muted">Nov 12</div>
          <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#">Continue reading</a>
        </div>
        <img src="assets/img/example.png">
      </div>
    </div> 
   
</div>



<div class="blog-footer"><?php require_once 'footer.php'; ?> </div>
   <script src="assets/jquery.js"></script>
  <script src="assets/popper.js"></script>
  <script src="assets/bootstrap.js"></script>
   </body>
   </html>