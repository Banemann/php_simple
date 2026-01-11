<?php
// PDO
try {
    $dbUserName = 'root';
    $dbPassword = 'password'; // root | admin
    $dbConnection = 'mysql:host=mariadb; dbname=company; charset=utf8mb4';
    // utf8 every character in the world
    // mb4 every character and also emojies
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // try-catch
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // ['nickname']
        // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ // ->nickname
        // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM // [[2],[],[]]

// Associative array example
//  $user = [
//   "user_pk" => "1",
//   "user_username" => "casper",
//   "user_email" => "a@a.com",
//   "profile" => [
//     "full_name" => "Casper Banemann",
//     "created_at" => "2026-01-08"
//   ],

//   "posts" => [
//     [
//       "post_pk" => "p1",
//       "post_message" => "Hello world",
//       "post_created_at" => "2026-01-08 20:15:00"
//     ]
//   ]
// ];

// Accessing values
// echo $user["profile"]["full_name"];
// echo $user["user_username"];

    ];
    $_db = new PDO(
        $dbConnection,
        $dbUserName,
        $dbPassword,
        $options
    );
} catch (PDOException $ex) {
    echo $ex;
    exit(); //die
}
