<?php
/*
send: {username: "", password: ""}

on success (200 status): {}
then redirect to contacts page
*/

declare(strict_types=1);

ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/phpErrors.txt');
error_reporting(E_ALL);

header('Content-Type: application/json');
$input = json_decode(
    file_get_contents('php://input'),
    true
);

require './components/db.php';
require './components/cookies.php';

try {
    $username = $input["username"];
    $password = $input["password"];

    if (!isset($username, $password)) {
        http_response_code(500);
        echo json_encode([
            "error" => "Invalid username or password."
        ]);
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $message = $pdo->prepare("SELECT * FROM users WHERE password_hash = ? && username = ?");
    $message->execute([$hash, $username]);

    $user = $message->fetch(\PDO::FETCH_OBJ);

    components\cookies\createCookie($pdo, $user->id);
    echo json_encode([]);
    http_response_code(200);
}catch (\PDOException $er) {
    http_response_code(500);
    echo json_encode([
        "error" => "Invalid username or password."
    ]);
    exit;
}
