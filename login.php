<?php
require_once __DIR__ . "/private/x.php";
require_once __DIR__."/_/_header.php";

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

<form action="api/api-login" method="POST">

    <h1>Login</h1>

    <input name="user_email" type="email" value="" placeholder="email" value="a@a.com">
    <input name="user_password" type="password" value="" placeholder="password" value="password">

    <button>
        Login
    </button>

</form>

<?php
require_once __DIR__."/_/_footer.php";
?>