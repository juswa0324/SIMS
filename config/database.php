    <?php
$servername = "127.0.0.1";
$username = "sims";
$password = "sims@2026";
$database = "sims";
$charset = 'utf8mb4';

date_default_timezone_set('Asia/Manila');

//Create connenction
$conn = new mysqli($servername, $username, $password, $database);


//Check connection
if ($conn->connect_error) {
     die("Connection Failed" . $conn->connect_error);
}

$conn->set_charset("utf8");




//PDO CONNECTION
$dsn = "mysql:host=$servername;dbname=$database;charset=$charset";
$options = [
     PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
     PDO::ATTR_EMULATE_PREPARES   => true,
];

try {
     $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
