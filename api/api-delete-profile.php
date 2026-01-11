<?php

try {
    require_once __DIR__ . "/../private/db.php";

    session_start();

    if (!isset($_SESSION["user"])) {
        http_response_code(401);
        header("Location: /login?message=error");
        exit;
    }

    $user_id = $_SESSION["user"]["user_pk"];

    $sql = "DELETE FROM users WHERE user_pk = :user_pk";
    
    $stmt = $_db->prepare($sql);
    $stmt->bindValue(":user_pk", $user_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        session_destroy();
        http_response_code(200);
        header("Location: /login?message=Profile deleted successfully");
    } else {
        http_response_code(403);
        header("Location: /?message=Failed to delete profile");
    }

} catch (Exception $e) {
    http_response_code(500);
    header("Location: /?message=Error: " . urlencode($e->getMessage()));
    exit;
}
