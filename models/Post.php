<?php

class Post
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Fetch all posts joined with usernames, ordered by newest first.
     */
    public function all(): array
    {
        $sql = "SELECT posts.*, users.user_username FROM posts INNER JOIN users ON posts.post_user_fk = users.user_pk ORDER BY posts.post_created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new post row with timestamp.
     */
    public function create(string $postPk, string $message, ?string $imagePath, string $userPk): void
    {
        $sql = "INSERT INTO posts (post_pk, post_message, post_image_path, post_user_fk, post_created_at) VALUES (:post_pk, :post_message, :post_image_path, :post_user_fk, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':post_pk', $postPk);
        $stmt->bindValue(':post_message', $message);
        $stmt->bindValue(':post_image_path', $imagePath ?? '');
        $stmt->bindValue(':post_user_fk', $userPk);
        $stmt->execute();
    }
}



// $postModel = new Post($_db);
// $postModel->db->query("..."); // Error: Cannot access private property
