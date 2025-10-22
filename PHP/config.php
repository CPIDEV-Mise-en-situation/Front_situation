<?php
//require_once __DIR__ . "/vendor/autoload.php";

//use Dotenv\Dotenv;

//$dotenv = Dotenv::createImmutable(__DIR__);
//$dotenv->load();

//$host = $_ENV['HOST'];
//$bdd = $_ENV['DB_NAME'];
//$user = $_ENV['USER'];
//$password = $_ENV['PASSWORD'];

$host = 'localhost';    
$bdd = 'lendprojet';
$user = 'root';
$password = '';

try {
    $dsn = "mysql:host=$host;dbname=$bdd;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password);


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
