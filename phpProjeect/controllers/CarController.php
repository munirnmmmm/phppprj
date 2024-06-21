<?php
require_once '../config/Database.php';
require_once '../models/Car.php';

class CarController {
    private $conn;
    private $car;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->car = new Car($this->conn);
    }

    // Action to list all cars
    public function index() {
        $stmt = $this->car->read();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $cars_arr = array();
            $cars_arr["records"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $car_item = array(
                    "id" => $id,
                    "make" => $make,
                    "model" => $model,
                    "year" => $year,
                    "vin" => $vin
                );

                array_push($cars_arr["records"], $car_item);
            }

            http_response_code(200);
            echo json_encode($cars_arr);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "No cars found."));
        }
    }

    // Action to create a car
    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        // Check if data is not empty
        if (
            !empty($data->make) &&
            !empty($data->model) &&
            !empty($data->year) &&
            !empty($data->vin)
        ) {
            $this->car->make = $data->make;
            $this->car->model = $data->model;
            $this->car->year = $data->year;
            $this->car->vin = $data->vin;

            if ($this->car->create()) {
                http_response_code(201);
                echo json_encode(array("message" => "Car was created."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Unable to create car."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to create car. Data is incomplete."));
        }
    }

    // Action to update a car
    public function update() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id) && !empty($data->make) && !empty($data->model) && !empty($data->year) && !empty($data->vin)) {
            $this->car->id = $data->id;
            $this->car->make = $data->make;
            $this->car->model = $data->model;
            $this->car->year = $data->year;
            $this->car->vin = $data->vin;

            if ($this->car->update()) {
                http_response_code(200);
                echo json_encode(array("message" => "Car was updated."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Unable to update car."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to update car. Data is incomplete."));
        }
    }

    // Action to delete a car
    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id)) {
            $this->car->id = $data->id;

            if ($this->car->delete()) {
                http_response_code(200);
                echo json_encode(array("message" => "Car was deleted."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Unable to delete car."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to delete car. Data is incomplete."));
        }
    }

    // Action to read one car
    public function readOne() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id)) {
            $this->car->id = $data->id;

            if ($this->car->readOne()) {
                $car_arr = array(
                    "id" => $this->car->id,
                    "make" => $this->car->make,
                    "model" => $this->car->model,
                    "year" => $this->car->year,
                    "vin" => $this->car->vin
                );

                http_response_code(200);
                echo json_encode($car_arr);
            } else {
                http_response_code(404);
                echo json_encode(array("message" => "Car not found."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to read car. Data is incomplete."));
        }
    }
}
?>
