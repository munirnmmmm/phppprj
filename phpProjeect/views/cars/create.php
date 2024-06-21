<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Car</title>
</head>
<body>
    <h1>Add Car</h1>
    <form action="create.php" method="POST">
        <label for="make">Make:</label>
        <input type="text" id="make" name="make" required><br><br>

        <label for="model">Model:</label>
        <input type="text" id="model" name="model" required><br><br>

        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required><br><br>

        <label for="vin">VIN:</label>
        <input type="text" id="vin" name="vin" required><br><br>

        <button type="submit">Add Car</button>
    </form>
</body>
</html>

<?php
include_once '../../config/Database.php';
include_once '../../models/Car.php';

$database = new Database();
$db = $database->getConnection();

$car = new Car($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car->make = $_POST['make'];
    $car->model = $_POST['model'];
    $car->year = $_POST['year'];
    $car->vin = $_POST['vin'];

    if ($car->create()) {
        // Redirect to main page after successful creation
        header("Location: index.php");
        exit();
    } else {
        echo "<p>Unable to add car.</p>";
    }
}
?>
