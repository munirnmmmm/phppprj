<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Cars</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .add-link {
            display: block;
            text-align: right;
            margin-bottom: 10px;
        }

        .add-link a {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
        }

        .add-link a:hover {
            background-color: #45a049;
        }

        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .actions {
            white-space: nowrap; /* Prevent line break */
        }

        .actions a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            margin-right: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .actions a:hover {
            background-color: #f0f0f0;
        }
    </style>
<body>
    <div class="container">
        <h1>List of Cars</h1>
        <div class="add-link">
            <a href="create.php">Add New Car</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>VIN</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../../config/Database.php';
                include_once '../../models/Car.php';

                $database = new Database();
                $db = $database->getConnection();

                $car = new Car($db);

                $stmt = $car->read();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    echo "<tr>";
                    echo "<td>{$id}</td>";
                    echo "<td>{$make}</td>";
                    echo "<td>{$model}</td>";
                    echo "<td>{$year}</td>";
                    echo "<td>{$vin}</td>";
                    echo "<td class='actions'>";
                    echo "<a href='update.php?id={$id}'>Edit</a>";
                    echo "<a href='delete.php?id={$id}'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
