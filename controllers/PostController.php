<?php

require_once __DIR__ . '/../models/Post.php';

class PostController
{
    private Post $postModel;

    public function __construct(PDO $db)
    {
        $this->postModel = new Post($db);
    }

    /**
     * Return all posts for the index page.
     */
    public function listPosts(): array
    {
        return $this->postModel->all();
    }

    /**
     * Create a post using the model.
     */
    public function createPost(string $postPk, string $message, ?string $imagePath, string $userPk): void
    {
        $this->postModel->create($postPk, $message, $imagePath, $userPk);
    }
}
