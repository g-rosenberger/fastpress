<?php
//DATABASE
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

// Create connection
$link = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($link->connect_error) {
    die("Connection failed in db");
} 
// INDIVIDUAL WEBSITE SETTINGS
$wName = "FastPress";
$wTitle = "The fastest cms written in php!";
$wDescription = "Just a little test with my new php code.";
$wLogo = "assets/img/example.png";
$wUrl = "https://bsodlover.dynu.net/websites/fastpress/";
$wDefaultImagePath = $wUrl . $wLogo;
$tinymcekey = "br9a2d3zd29bddoetgr1g2uwm3is5oxo02bocfmxir4hr6s6";


?>
