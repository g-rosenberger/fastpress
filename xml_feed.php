<?xml version="1.0" encoding="ISO-8859-1"?>
<feed>
<header>
<name><?php require_once 'admin/config.php'; echo $wName; ?></name>
<title><?php echo $wTitle; ?></title>
<description><?php echo $wDescription; ?></description>
</header>
<?php 
require_once 'admin/config.php';
$sql = "SELECT * FROM `fp` ORDER BY `pDate` DESC LIMIT 100";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<article><articletitle>" . $row["pTitle"] . "</articletitle><articlesubtitle>" . $row["pSubtitle"] . "</articlesubtitle><articlecategory>" . $row["pCategory"] . "</articlecategory><articledate>" . $row["pDate"] . "</articledate><articleimg>" . $wUrl . "p/img" . $row["pImg"] . "</articleimg><articleimgalt>" . $row["pImgAlt"] . "</articleimgalt>";
    }
} else {
    echo "0 results";
}
$link->close();
?> 
</feed>