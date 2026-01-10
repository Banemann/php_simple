<?php
session_start();
try {
	require_once __DIR__ . '/../private/x.php';
	require_once __DIR__ . '/../private/db.php';

	$user = $_SESSION['user'] ?? null;
	if (!$user) {
		http_response_code(401);
		header('Location: /login?error=' . urlencode('Please login to edit posts'));
		exit;
	}

	$postPk = $_POST['post_pk'] ?? '';
	if (!is_string($postPk) || $postPk === '') {
		throw new Exception('Invalid post', 400);
	}

	// Validate and sanitize message via your helper
	$message = _validatePostMessage(1, 1000);

	// Only update if owned by current user
	$sql = 'UPDATE posts SET post_message = :post_message WHERE post_pk = :post_pk AND post_user_fk = :user_fk';
	$stmt = $_db->prepare($sql);
	$stmt->bindValue(':post_message', $message);
	$stmt->bindValue(':post_pk', $postPk);
	$stmt->bindValue(':user_fk', $user['user_pk']);
	$stmt->execute();

	if ($stmt->rowCount() === 0) {
		throw new Exception('You can only edit your own posts', 403);
	}

	header('Location: /?message=' . urlencode('Post updated'));
	exit;
} catch (Exception $e) {
	$code = (int)($e->getCode() ?: 500);
	if ($code < 100 || $code > 599) { $code = 500; }
	http_response_code($code);
	header('Location: /?error=' . urlencode($e->getMessage()));
	exit;
}
?>
