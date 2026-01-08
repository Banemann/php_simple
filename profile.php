My profile here

<form action="api/api-update-profile" method="POST">
<input type="text" name="name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" required />
<button>Update profile</button>
</form>

<form action="api/api-delete-profile" method="POST">
<button>Delete profile</button>
</form>