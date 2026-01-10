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
    <p class="post-message" data-post-pk="<?php echo $post['post_pk']; ?>"><?php echo _($post['post_message']); ?></p>

    <?php if ($current_user_id == $post['post_user_fk']): ?>

        <form action="/api/api-delete-post" method="POST" style="margin-top: 0.75rem; display: inline-block;">
            <input type="hidden" name="post_pk" value="<?php echo $post['post_pk']; ?>">
            <button type="submit" style="background-color: #e74c3c; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer;">Delete</button>
        </form>

        <button class="post-edit-btn" data-post-pk="<?php echo $post['post_pk']; ?>" style="margin-top: 0.75rem; margin-left: 0.5rem; padding: 0.5rem 1rem; border-radius: 5px; border: 1px solid #ddd; background: #f7f7f7; cursor: pointer;">Edit</button>

        <form class="post-edit-save-form" action="/api/api-update-post" method="POST" style="display:none;">
            <input type="hidden" name="post_pk" value="<?php echo $post['post_pk']; ?>">
            <input type="hidden" name="post_message" value="">
        </form>

    <?php endif; ?>
    <hr> 
    
</article>
