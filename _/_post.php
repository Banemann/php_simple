<?php
/**
 * Post Component
 * Displays a single post
 * Expects $post and $current_user_id variables to be set
 */
?>
<article class="post">
    <div>
    <?php 
    if (!empty($post['post_image_path'])): 
    ?>
        <div class="post-image">
            <img src="<?php echo _($post['post_image_path']); ?>" 
                alt="Image for <?php echo _($post['post_message']); ?>">
        </div>
    <?php 
    endif; 
    ?>
        <strong><?php echo _($post['user_username']); ?></strong>
    </div>
    <div class="post-content">
        <p class="post-message post-msg-<?php echo $post['post_pk']; ?>"><?php echo _($post['post_message']); ?></p>

        <?php if ($current_user_id == $post['post_user_fk']): ?>
            <form class="post-edit-form-<?php echo $post['post_pk']; ?> mix-hidden" action="/api/api-update-post" method="POST">
                <textarea name="post_message" style="width: 100%; padding: 0.5rem; border-radius: 5px; border: 1px solid #ddd; font-family: inherit; resize: vertical;" rows="3"><?php echo htmlspecialchars($post['post_message'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                <input type="hidden" name="post_pk" value="<?php echo $post['post_pk']; ?>">
                <div style="margin-top: 0.5rem;">
                    <button type="submit" style="padding: 0.5rem 1rem; background: #667eea; color: white; border: none; border-radius: 5px; cursor: pointer;">Save</button>
                    <button type="button" class="post-cancel-btn" onclick="hide_elements('.post-edit-form-<?php echo $post['post_pk']; ?>'); show_elements('.post-msg-<?php echo $post['post_pk']; ?>, .post-controls-<?php echo $post['post_pk']; ?>');" style="margin-left: 0.5rem;">Cancel</button>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <?php if ($current_user_id == $post['post_user_fk']): ?>
        <div class="post-controls-<?php echo $post['post_pk']; ?>" style="margin-top: 0.75rem;">
            <form action="/api/api-delete-post" method="POST" style="display: inline-block;">
                <input type="hidden" name="post_pk" value="<?php echo $post['post_pk']; ?>">
                <button type="submit" style="background-color: #e74c3c; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer;">Delete</button>
            </form>

            <button type="button" class="post-edit-btn" onclick="show_elements('.post-edit-form-<?php echo $post['post_pk']; ?>'); hide_elements('.post-msg-<?php echo $post['post_pk']; ?>, .post-controls-<?php echo $post['post_pk']; ?>');">Edit</button>
        </div>
    <?php endif; ?>

    <hr> 
    
</article>
