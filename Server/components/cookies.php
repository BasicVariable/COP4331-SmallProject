<?php
// reminder, $_COOKIE is the location of request cookie in php
declare(strict_types=1);
namespace components\cookies;

require('./db.php');

// https://www.php.net/manual/en/function.setcookie.php
function createCookie (string $userId) {
    $token = bin2hex(
        random_bytes(32)
    );

    $expires = time() + (60 * 60 * 24);

    // expiration date must be saved
    // need to declare this for my ide
    /** @var \PDO $pdo */
    $message = $pdo->prepare("INSERT INTO sessions (user_id, token, expires) VALUES (?, ?, ?)");
    $message->execute([$userId, $token, $expires]);
    //

    setcookie('authentication', $token, $expires, '/', '', false, true);
}

function deleteCookie (string $token) {

}

function checkCookie (string $token) {

}