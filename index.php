<?php
session_start();
require_once __DIR__."/_/_header.php";
require_once __DIR__."/private/x.php";

require_once __DIR__ . "/private/db.php";

$current_user_id = $_SESSION['user']['user_pk'] ?? null;

try {

    $sql = "SELECT posts.*, users.user_username FROM posts INNER JOIN users ON posts.post_user_fk = users.user_pk";
    $stmt = $_db->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo "<div>Error: Could not fetch posts.</div>";
    $posts = [];
}

?>

<main>
    <h1>All Posts</h1>

    
    <div class="posts-container">
        
        <?php
        if (empty($posts)):
        ?>
            <p>No posts found.</p>
        <?php
        else:
            foreach ($posts as $post):
                require __DIR__ . "/_/_post.php";
            endforeach;
        endif;
        ?>

    </div>
</main>

<?php
require_once __DIR__."/_/_footer.php";
?>