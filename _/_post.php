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
    <p><?php echo _($post['post_message']); ?></p>

    <?php if ($current_user_id == $post['post_user_fk']): ?>

        <form action="/api/api-delete-post" method="POST" style="margin-top: 1rem;">
            <input type="hidden" name="post_pk" value="<?php echo $post['post_pk']; ?>">
            <button type="submit" style="background-color: #e74c3c; color: white; padding: 0.5rem 1rem; border: none; border-radius: 5px; cursor: pointer;">Delete</button>
        </form>

    <?php endif; ?>
    <hr> 
    
</article>
