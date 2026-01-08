-- Social Media Web Application Database Schema
-- MariaDB/MySQL Database Export

CREATE DATABASE IF NOT EXISTS company;
USE company;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    user_pk VARCHAR(255) PRIMARY KEY,
    user_email VARCHAR(100) NOT NULL UNIQUE,
    user_username VARCHAR(20) NOT NULL UNIQUE,
    user_full_name VARCHAR(100),
    user_password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Posts Table
CREATE TABLE IF NOT EXISTS posts (
    post_pk VARCHAR(255) PRIMARY KEY,
    post_message TEXT NOT NULL,
    post_image_path VARCHAR(255),
    post_user_fk VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_user_fk) REFERENCES users(user_pk) ON DELETE CASCADE
);

-- Comments Table (Optional)
CREATE TABLE IF NOT EXISTS comments (
    comment_pk VARCHAR(255) PRIMARY KEY,
    comment_message TEXT NOT NULL,
    comment_user_fk VARCHAR(255) NOT NULL,
    comment_post_fk VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (comment_user_fk) REFERENCES users(user_pk) ON DELETE CASCADE,
    FOREIGN KEY (comment_post_fk) REFERENCES posts(post_pk) ON DELETE CASCADE
);

-- Likes Table (Optional)
CREATE TABLE IF NOT EXISTS likes (
    like_pk VARCHAR(255) PRIMARY KEY,
    like_user_fk VARCHAR(255) NOT NULL,
    like_post_fk VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_like (like_user_fk, like_post_fk),
    FOREIGN KEY (like_user_fk) REFERENCES users(user_pk) ON DELETE CASCADE,
    FOREIGN KEY (like_post_fk) REFERENCES posts(post_pk) ON DELETE CASCADE
);

-- Follows Table (Optional)
CREATE TABLE IF NOT EXISTS follows (
    follow_pk VARCHAR(255) PRIMARY KEY,
    follow_user_fk VARCHAR(255) NOT NULL,
    follow_follower_fk VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_follow (follow_user_fk, follow_follower_fk),
    FOREIGN KEY (follow_user_fk) REFERENCES users(user_pk) ON DELETE CASCADE,
    FOREIGN KEY (follow_follower_fk) REFERENCES users(user_pk) ON DELETE CASCADE
);

-- Create indexes for better query performance
CREATE INDEX idx_posts_user_fk ON posts(post_user_fk);
CREATE INDEX idx_comments_user_fk ON comments(comment_user_fk);
CREATE INDEX idx_comments_post_fk ON comments(comment_post_fk);
CREATE INDEX idx_likes_user_fk ON likes(like_user_fk);
CREATE INDEX idx_likes_post_fk ON likes(like_post_fk);
CREATE INDEX idx_follows_user_fk ON follows(follow_user_fk);
CREATE INDEX idx_follows_follower_fk ON follows(follow_follower_fk);
