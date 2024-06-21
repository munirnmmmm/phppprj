<?php
class Car {
    private $conn;
    private $table_name = "cars";

    public $id;
    public $make;
    public $model;
    public $year;
    public $vin;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all cars
    function read() {
        $query = "SELECT id, make, model, year, vin FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Create car
    function create() {
        $query = "INSERT INTO " . $this->table_name . " SET make=:make, model=:model, year=:year, vin=:vin";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->make = htmlspecialchars(strip_tags($this->make));
        $this->model = htmlspecialchars(strip_tags($this->model));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->vin = htmlspecialchars(strip_tags($this->vin));

        // Bind parameters
        $stmt->bindParam(":make", $this->make);
        $stmt->bindParam(":model", $this->model);
        $stmt->bindParam(":year", $this->year);
        $stmt->bindParam(":vin", $this->vin);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Update car
    function update() {
        $query = "UPDATE " . $this->table_name . " SET make=:make, model=:model, year=:year, vin=:vin WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->make = htmlspecialchars(strip_tags($this->make));
        $this->model = htmlspecialchars(strip_tags($this->model));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->vin = htmlspecialchars(strip_tags($this->vin));

        // Bind parameters
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":make", $this->make);
        $stmt->bindParam(":model", $this->model);
        $stmt->bindParam(":year", $this->year);
        $stmt->bindParam(":vin", $this->vin);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete car
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind parameter
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Read single car
    function readOne() {
        $query = "SELECT id, make, model, year, vin FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->make = $row['make'];
            $this->model = $row['model'];
            $this->year = $row['year'];
            $this->vin = $row['vin'];
            return true;
        }

        return false;
    }
}
?>
