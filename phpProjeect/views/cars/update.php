<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Car</title>
</head>
<body>
    <h1>Edit Car</h1>
    <?php
    include_once '../../config/Database.php';
    include_once '../../models/Car.php';

    $database = new Database();
    $db = $database->getConnection();

    $car = new Car($db);

    // Get car ID from URL
    $car->id = isset($_GET['id']) ? $_GET['id'] : die('Car ID not provided.');

    // Read car details based on ID
    $car->readOne();

    if ($car->make) {
        ?>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $car->id; ?>">
            <label for="make">Make:</label>
            <input type="text" id="make" name="make" value="<?php echo $car->make; ?>" required><br><br>

            <label for="model">Model:</label>
            <input type="text" id="model" name="model" value="<?php echo $car->model; ?>" required><br><br>

            <label for="year">Year:</label>
            <input type="number" id="year" name="year" value="<?php echo $car->year; ?>" required><br><br>

            <label for="vin">VIN:</label>
            <input type="text" id="vin" name="vin" value="<?php echo $car->vin; ?>" required><br><br>

            <button type="submit">Update Car</button>
        </form>
    <?php
    } else {
        echo "<p>Car not found.</p>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $car->make = $_POST['make'];
        $car->model = $_POST['model'];
        $car->year = $_POST['year'];
        $car->vin = $_POST['vin'];

        if ($car->update()) {
            echo "<p>Car was updated successfully.</p>";
            header("Location: index.php");
        } else {
            echo "<p>Unable to update car.</p>";
        }
    }
    ?>
</body>
</html>
