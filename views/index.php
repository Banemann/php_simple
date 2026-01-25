<?php
session_start();
require_once __DIR__ . '/../_/_header.php';
require_once __DIR__ . '/../private/x.php';

require_once __DIR__ . '/../private/db.php';
require_once __DIR__ . '/../controllers/PostController.php';

$current_user_id = $_SESSION['user']['user_pk'] ?? null;

try {
    $postController = new PostController($_db);
    $posts = $postController->listPosts();
} catch (Exception $e) {
    echo "<div>Error: Could not fetch posts.</div>";
    $posts = [];
}
?>

<?php 
$message = $_GET['message'] ?? '';
$error = $_GET['error'] ?? '';
?>

<div id="toast">
    <?php if ($message): ?>
        <div class="toast-ok">
            <?php _($message) ?>
        </div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="toast-error">
            <?php _($error) ?>
        </div>
    <?php endif; ?>
</div>

<main class="feed-layout">
    <aside class="feed-left">
        <?php if (isset($_SESSION['user'])): ?>
            <div class="side-card">
                <h2>Actions</h2>
                <a class="side-button" href="/create-post">Create a Post</a>
            </div>
        <?php else: ?>
            <div class="side-card">
                <h2>Welcome</h2>
                <p>Login to share your thoughts.</p>
                <a class="side-button" href="/login">Login</a>
            </div>
        <?php endif; ?>
    </aside>

    <section class="feed-center">
        <h1>All Posts</h1>
        <div class="posts-container">
            <?php if (empty($posts)): ?>
                <p>No posts found.</p>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <?php require __DIR__ . '/../_/_post.php'; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <aside class="feed-right">
        <div class="side-card">
            <h2>Recommendations</h2>
            <ul class="reco-list">
                <li>#php</li>
                <li>#webdev</li>
                <li>#design</li>
            </ul>
        </div>
    </aside>
</main>

<?php
require_once __DIR__ . '/../_/_footer.php';
?>