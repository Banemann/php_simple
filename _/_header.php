<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="mixhtml.css">
    <title>Document</title>
</head>
<body>

<div id="toast"></div>

<nav>
    <a href="/">Home</a>
    <?php if (isset($_SESSION['user'])): ?>
        <a href="profile">Profile</a>
        <a href="logout">Logout</a>
    <?php else: ?>
        <a href="signup">Signup</a>
        <a href="login">Login</a>
    <?php endif; ?>
    <a href="create-post">Create Post</a>
</nav>