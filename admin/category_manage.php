<link href="../assets/bootstrap.css" rel="stylesheet" id="bootstrap-css">
<form action="" method="POST">
    <div class="form-group">
      <label for="exampleInputEmail1">Name of new category</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category name" name="catName" required>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Description of new category</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category descripytiopn" name="catDescription" required>
    </div>
    <select name="catRelated">
<?php 
require_once 'config.php';
$sql = "SELECT * FROM `cat`";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row["catName"] . '">' . $row["catName"] . '</option>';
    }
} else {
    echo "0 results";
}

?>
  </select>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

<?php 
if(isset($_POST["catName"])) {
    $catRelated = $_POST["catRelated"];
    $catDescription = $_POST["catDescription"];
    $catName = $_POST["catName"];
require_once 'config.php';
$sql = "INSERT INTO `cat` (`catRelated`, `catName`, `catDescription`)
VALUES ('$catRelated', '$catName', '$catDescription');";

if (mysqli_query($link, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}


}
?>
<?php 
require_once 'config.php';
$sql = "SELECT * FROM `cat`";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo '
        <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">' . $row["catName"] . '</h5>
    <h6 class="card-subtitle mb-2 text-muted"> Related to : ' . $row["catRelated"] . '</h6>
    <p class="card-text">' . $row["catDescription"] . '</p>
    <a href="?deleteid=' . $row["catId"] . '" class="btn btn-danger">Delete this category</a>
  </div>
</div>
        
        ';
    }
} else {
    echo "0 results";
}




?>
<?php
if(isset($_GET["deleteid"])){ 
    $catId = $_GET["deleteid"];
$sql = "DELETE FROM `cat`
WHERE ((`catId` = $catId))";

if (mysqli_query($link, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($link);
}
}



mysqli_close($link);
?>