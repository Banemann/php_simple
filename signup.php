<?php
require_once __DIR__ . "/private/x.php";
require_once __DIR__ . "/_/_header.php";

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

?>

<form action="api/api-create-profile" method="POST" style="display: flex; flex-direction: column; gap: 10px; width: 300px;">
    <h1>Signup</h1>

    <input name="user_full_name" type="text" placeholder="fullname">Full Name</input>
    <input name="user_username" type="text" placeholder="username">Username</input>
    <input name="user_email" type="text" placeholder="email">Email</input>
    <input name="user_password" type="password" placeholder="password">Password</input>
    
    <button>Signup</button>
</form>



<?php require_once __DIR__."/_/_footer.php"; ?>