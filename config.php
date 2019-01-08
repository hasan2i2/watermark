<?php
if (!function_exists('redirect')) {
    function redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);

        exit();
    }
}
$username = "root";
$password = "";
$dbName = "watermark";
define('BASE_URL', '/');
try {
    $conn = new PDO("mysql:host=localhost;dbname=$dbName;charset=UTF8", $username, $password);
    $conn->exec("SET CHARACTER SET utf8");
    $conn->exec("set names utf8");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function base_path($url)
{
    if ($url[0] == '/') {
        $url = ltrim($url, '/');;
    }
    return BASE_URL . $url;
}