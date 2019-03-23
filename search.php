<link href="assets/bootstrap.css" rel="stylesheet" id="bootstrap-css">
<title>Search "<?php echo $_GET["search"]; ?>"</title>
<h1>Search</h1>
<div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8">
                            <form class="card card-sm" action="" method="GET">
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-search h4 text-body"></i>
                                    </div>
                                    <!--end of col-->
                                    <div class="col">
                                        <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Buscar cualquier palabra" name="search">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-success" type="submit">BUSCAR</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                        </div>
                        <!--end of col-->
                    </div>
<?php
if(isset($_GET["search"])) {
//<Remove "" to protect from SQL injections>
$query = $_GET["search"];
$query = str_replace("'", "", $query);
$query = str_replace('"', "", $query);
//</>
echo $query;
require_once 'admin/config.php';
$sql = "SELECT * FROM `fp` WHERE (`pImgUrl` LIKE '%$query%' OR `pKeywords` LIKE '%$query%' OR `pUrl` LIKE '%$query%' OR `pTitle` LIKE '%$query%' OR `pSubtitle` LIKE '%$query%' OR `pDate` LIKE '%$query%' OR `pCategory` LIKE '%$query%') LIMIT 50";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
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
    echo '
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>No results</strong> Maybe the file has been deleted, or the query is not spelled correctly. <i>If it is a private file, check it on "My Account" page.</i>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
        ';
}

mysqli_close($link);
}?>