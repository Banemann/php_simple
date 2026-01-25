<?php
require_once __DIR__ . '/../private/x.php';
require_once __DIR__ . '/../_/_header.php';

$message = $_GET['message'] ?? '';
$error = $_GET['error'] ?? '';
if ($message || $error):
?>
    <div id="toast">
        <?php if ($message): ?>
            <div class="toast-ok"><?php _($message) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="toast-error"><?php _($error) ?></div>
        <?php endif; ?>
    </div>
<?php endif; ?>


<form action="api/api-create-profile" method="POST">
    <h1>Signup</h1>

    <input name="user_full_name" type="text" placeholder="Full Name" required>
    <input name="user_username" type="text" placeholder="Username" required>
    <input name="user_email" type="email" placeholder="Email" required>
    <input name="user_password" type="password" placeholder="Password" required>
    
    <button type="submit">Signup</button>
</form>



<?php require_once __DIR__ . '/../_/_footer.php'; ?>