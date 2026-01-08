<?php
session_start();
try {
    require_once __DIR__ . "/../private/x.php";
    require_once __DIR__ . "/../private/db.php";

    // Ensure user is logged in
    $user = $_SESSION['user'] ?? null;
    if (!$user) {
        http_response_code(401);
        throw new Exception("Not authenticated", 401);
    }

    // Validate message (centralized validator)
    $message = _validatePostMessage(1, 1000);

    // Generate post PK
    $postPk = bin2hex(random_bytes(16));

    // Handle optional image upload via helper which moves file and returns web path or null
    $imagePath = _validateImageUpload('post_image', 2 * 1024 * 1024);

    // Insert into DB
    $sql = "INSERT INTO posts (post_pk, post_message, post_image_path, post_user_fk) VALUES (:post_pk, :post_message, :post_image_path, :post_user_fk)";
    $stmt = $_db->prepare($sql);
    $stmt->bindValue(':post_pk', $postPk);
    $stmt->bindValue(':post_message', $message);
    $stmt->bindValue(':post_image_path', $imagePath ?? '');
    $stmt->bindValue(':post_user_fk', $user['user_pk']);
    $stmt->execute();

    // Success: redirect to home with success message
    header("Location: /?message=Post created successfully");
    exit;

} catch (Exception $e) {
    $respCode = is_numeric($e->getCode()) ? (int)$e->getCode() : 500;
    if ($respCode < 100 || $respCode > 599) $respCode = 500;
    http_response_code($respCode);
    
    // Redirect back with error message
    header("Location: /?error=" . urlencode($e->getMessage()));
    exit;
}
?>