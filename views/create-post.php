<?php
// Start session and load helpers before output so we can redirect if unauthenticated
session_start();
require_once __DIR__ . '/../private/x.php';

$user = $_SESSION['user'] ?? null;
if (!$user) {
    header("Location: /login?message=User not found, please login first");
    exit;
}

// Only include the HTML header after authentication check to avoid "headers already sent" issues
require_once __DIR__ . '/../_/_header.php';
?>

<main class="create-post-page">
    <form action="api/api-create-post" method="POST" enctype="multipart/form-data" class="create-post-form-card">
        <div class="form-header">
            <h1>Create a New Post</h1>
            <p>Share what's on your mind.</p>
        </div>

        <label>
            <span>Message</span>
            <textarea name="post_message" placeholder="What's happening?" rows="5" required></textarea>
        </label>
        
        <label>
            <span>Image (optional)</span>
            <input name="post_image" type="file" accept="image/*" />
        </label>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Post</button>
            <a href="/" class="btn-secondary">Cancel</a>
        </div>
    </form>
</main>

<?php require_once __DIR__ . '/../_/_footer.php'; ?>