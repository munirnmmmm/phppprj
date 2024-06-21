
-- CREATE DATABASE car_management;


-- USE car_management;


-- CREATE TABLE cars (
 --    id INT(11) AUTO_INCREMENT PRIMARY KEY,
--    make VARCHAR(50) NOT NULL,
 --   model VARCHAR(50) NOT NULL,
 --   year INT(4) NOT NULL,
 --   vin VARCHAR(17) UNIQUE NOT NULL 
-- );

INSERT INTO cars (make, model, year, vin) VALUES
('Honda', 'Accord', 2020, '1HGCM82633A000000'),
('Toyota', 'Camry', 2019, '4T1BF1FK1GU000001'),
('Ford', 'Mustang', 2021, '1FA6P8JZ6L5555000'),
('Chevrolet', 'Corvette', 2018, '1G1Y72D41E5000002'),
('BMW', 'X5', 2022, '5UXKR0C53N0A000003'),
('Mercedes-Benz', 'E-Class', 2020, 'WDDZF4JB5HA000004');
SELECT * FROM cars;

