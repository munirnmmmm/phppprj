<?php
include_once '../../config/Database.php';
include_once '../../models/Car.php';

$database = new Database();
$db = $database->getConnection();

$car = new Car($db);

$car->id = isset($_GET['id']) ? $_GET['id'] : die('Car ID not provided.');

if ($car->delete()) {
    echo "<p>Car was deleted successfully.</p>";
    header("Location: index.php");
} else {
    echo "<p>Unable to delete car.</p>";
}
?>
