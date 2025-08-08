<?php

$host = "localhost";
$username = "root"; 
$password = "";     
$dbname = "crud";

$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS `$dbname`";
if ($conn->query($sql) === TRUE) {
   echo "";
} else {
    die("Error creating database: " . $conn->error);
}

$conn->select_db($dbname);

$tableSql = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL UNIQUE,
  `phone` varchar(15) DEFAULT NULL,
  `hobbies` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `cpassword` varchar(30) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

if ($conn->query($tableSql) === TRUE) {
    echo "";
} else {
    die("Error creating table: " . $conn->error);
}

$dataSql = "INSERT IGNORE INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `hobbies`, `password`, `cpassword`, `role`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', '9898989898', 'Playing, Singing, Learning, Reading', 'admin', 'admin', 'admin'),
(2, 'Tirth', 'Patel', 'tirth@gmail.com', '9696969696', 'Playing, Reading', '12345678', '12345678', 'user'),
(4, 'Raj', 'Patel', 'raj@gmail.com', '8777777777', 'Playing, Singing, Learning', 'raj@1234', 'raj@1234', 'user')";

if ($conn->query($dataSql) === TRUE) {
    echo "";
} else {
    die("Error inserting data: " . $conn->error);
}


$conn->close();
?>
