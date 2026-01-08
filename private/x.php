<?php

function _($text) {
    echo htmlspecialchars($text);
}

function _noCache() {
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");
    header('Clear-Site-Data: "cache", "cookies", "storage", "executionContexts"');
}

define("usernameMinLength", 3);
define("usernameMaxLength", 20);
function _validateUsername() {
    $username = trim($_POST['user_username']);
    $len = strlen($username);
    if ($len < usernameMinLength || $len > usernameMaxLength) {
        throw new Exception("Username must be between " . usernameMinLength . " and " . usernameMaxLength . " characters");
    }
    return $username;
}

define("emailMinLength", 6);
define("emailMaxLength", 100);
function _validateEmail() {
    $email = trim($_POST['user_email']);
    $len = strlen($email);
    if ($len < emailMinLength) {
        throw new Exception("Email must be at least " . emailMinLength . " characters");
    } else if ($len > emailMaxLength) {
        throw new Exception("Email must be at most " . emailMaxLength . " characters");
    }
    return $email;
}

define("passwordMinLength", 6);
define("passwordMaxLength", 50);
function _validatePassword() {
    $password = $_POST['user_password'];
    $len = strlen($password);
    if ($len < passwordMinLength) {
        throw new Exception("Password must be at least " . passwordMinLength . " characters");
    } else if ($len > passwordMaxLength) {
        throw new Exception("Password must be at most " . passwordMaxLength . " characters");
    }
    return $password;
}

define("fullNameMinLength", 3);
define("fullNameMaxLength", 20);
function _validateFullName() {
    $full_name = trim($_POST['user_full_name']);
    $len = strlen($full_name);
    if ($len < fullNameMinLength) {
        throw new Exception("Full name must be at least " . fullNameMinLength . " characters");
    } else if ($len > fullNameMaxLength) {
        throw new Exception("Full name must be at most " . fullNameMaxLength . " characters");
    }
    return $full_name;
}

/**
 * Validate a post message from POST input and enforce length limits.
 * Returns the trimmed message string or throws Exception with code 400.
 */
function _validatePostMessage($min = 1, $max = 1000) {
    $message = trim($_POST['post_message'] ?? '');
    $len = mb_strlen($message);
    if ($len < $min) {
        throw new Exception("Message must be at least " . $min . " characters", 400);
    }
    if ($len > $max) {
        throw new Exception("Message must be at most " . $max . " characters", 400);
    }
    return $message;
}

/**
 * Validate an uploaded image from the given $_FILES key.
 * If no file was uploaded, returns null.
 * On success moves the file into uploads/ and returns the web path (e.g. /uploads/xxx.jpg).
 * Throws Exception on validation or move failures.
 */
function _validateImageUpload($fileKey = 'post_image', $maxBytes = 2097152) {
    if (!isset($_FILES[$fileKey]) || ($_FILES[$fileKey]['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    $file = $_FILES[$fileKey];
    if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
        throw new Exception("Image upload failed (code: " . ($file['error'] ?? 'unknown') . ")", 400);
    }

    if (!empty($file['size']) && $file['size'] > $maxBytes) {
        throw new Exception("Image too large. Max " . ($maxBytes/1024/1024) . " MB", 400);
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp'
    ];
    if (!isset($allowed[$mime])) {
        throw new Exception("Unsupported image type", 400);
    }

    $ext = $allowed[$mime];
    $uploadsDir = __DIR__ . "/../uploads";
    if (!is_dir($uploadsDir)) {
        if (!mkdir($uploadsDir, 0755, true)) {
            throw new Exception("Failed to create uploads directory", 500);
        }
    }

    $safeName = bin2hex(random_bytes(12)) . '_' . time() . '.' . $ext;
    $target = $uploadsDir . DIRECTORY_SEPARATOR . $safeName;
    if (!move_uploaded_file($file['tmp_name'], $target)) {
        throw new Exception("Failed to move uploaded file", 500);
    }

    return '/uploads/' . $safeName;
}

/**
 * Render a PHP partial to a string. $vars are extracted into the partial scope.
 * Returns the rendered HTML string.
 */
function _render_partial(string $partialPath, array $vars = []): string {
    // allow passing variables into the partial safely
    extract($vars, EXTR_SKIP);
    ob_start();
    require $partialPath;
    return ob_get_clean();
}
