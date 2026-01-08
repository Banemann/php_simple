<?php
// Start session and load helpers before output so we can redirect if unauthenticated
session_start();
require_once __DIR__ . '/private/x.php';

$user = $_SESSION['user'] ?? null;
if (!$user) {
    header("Location: /login?message=User not found, please login first");
    exit;
}

// Only include the HTML header after authentication check to avoid "headers already sent" issues
require_once __DIR__ . "/_/_header.php";
?>

<form action="api/api-create-post" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 10px; width: 300px;">
    <h1>Create Post</h1>

    <label>
        Message
        <textarea name="post_message" placeholder="What's happening?" rows="4"></textarea>
    </label>
    <label>
        Image (optional)
        <input name="post_image" type="file" accept="image/*" />
    </label>

    <button type="submit">Create Post</button>
</form>

<?php require_once __DIR__."/_/_footer.php"; ?>