<?php

try{
    session_start();
    require_once __DIR__."/../private/x.php";
    $userFullName = _validateFullName();
    $username = _validateUsername();
    $userEmail = _validateEmail();
    $userPassword = _validatePassword();
    $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

    $userPk = bin2hex(random_bytes(25));

    require_once __DIR__."/../private/db.php";
    $sql = "INSERT INTO users (user_pk, user_username, user_full_name, user_email, user_password) VALUES (:user_pk, :user_username, :user_full_name, :email, :password)";
    $stmt = $_db->prepare( $sql );

    $stmt->bindValue(":user_pk", $userPk);
    $stmt->bindValue(":user_username", $username);
    $stmt->bindValue(":user_full_name", $userFullName);
    $stmt->bindValue(":email", $userEmail);
    $stmt->bindValue(":password", $hashedPassword);

    $stmt->execute();

    // Set session for the newly created user
    $_SESSION['user'] = [
        'user_pk' => $userPk,
        'user_username' => $username,
        'user_full_name' => $userFullName,
        'user_email' => $userEmail
    ];

    header("Location: /profile?message=Account created successfully! Welcome!");
    exit();
}

catch(PDOException $e){
    // Check for duplicate entry error (MySQL error code 1062)
    if ($e->getCode() == 23000) {
        $errorMsg = $e->getMessage();
        if (strpos($errorMsg, 'user_email') !== false) {
            $errorMessage = "This email is already registered. Please use a different email.";
        } elseif (strpos($errorMsg, 'user_username') !== false) {
            $errorMessage = "This username is already taken. Please choose a different username.";
        } else {
            $errorMessage = "Email or username already exists. Please use different values.";
        }
    } else {
        $errorMessage = "An error occurred while creating your account. Please try again.";
    }
    header("Location: /signup?error=" . urlencode($errorMessage));
    exit();
}

catch(Exception $e){
    header("Location: /signup?error=" . urlencode($e->getMessage()));
    exit();
}


