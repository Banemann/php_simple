<?php
session_start();
require_once __DIR__ . '/private/x.php';

$user = $_SESSION['user'] ?? null;

if (!$user) {
    header("Location: /login?message=User not found, please login first");
    exit;
}

require_once __DIR__ . '/_/_header.php';

// Success / error messages
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

<div class="profile-page">
    <h1 class="profile-title">
        Welcome back <?php echo " - " . ($user['user_username'] ?? '') ?>
    </h1>

    <section class="profile-card">
        <h2>Your profile details</h2>
        <div class="profile-fields">
            <p><span class="field-label">Email</span><span class="field-value"><?php _($user['user_email'] ?? '') ?></span></p>
            <p><span class="field-label">Username</span><span class="field-value"><?php _($user['user_username'] ?? '') ?></span></p>
            <p><span class="field-label">Full Name</span><span class="field-value"><?php _($user['user_full_name'] ?? '') ?></span></p>
        </div>
    </section>

    <form class="profile-form" action="api/api-update-profile.php" method="POST">
        <div class="form-header">
            <h3>Update Profile</h3>
            <p>Keep your info up to date.</p>
        </div>
        <label>
            <span>Email</span>
            <input type="email" name="user_email" value="<?php _($user['user_email'] ?? '') ?>" required>
        </label>
        <label>
            <span>Username</span>
            <input type="text" name="user_username" value="<?php _($user['user_username'] ?? '') ?>" required>
        </label>
        <label>
            <span>Full Name</span>
            <input type="text" name="user_full_name" value="<?php _($user['user_full_name'] ?? '') ?>" required>
        </label>
        <button type="submit">
            Update Profile
        </button>
    </form>

    <form action="/api/api-delete-profile.php" method="POST">
                <input type="hidden" name="user_pk" value="<?php echo $user['user_pk']; ?>">
                <button type="submit" class="post-delete-btn">Delete Profile</button>
    </form>

</div>

<?php require_once __DIR__ . '/_/_footer.php'; ?>