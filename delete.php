<?php
include_once("config/config.php");
$id = $_GET['id'];
$result = mysqli_query($mysqli, "DELETE FROM note WHERE id = $id;");
$mysqli->close();
header("Location: index.php");
?>