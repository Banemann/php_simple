<?php

?>
<article class="post">
    <strong><?php echo _($post['user_username']); ?></strong>
    
    <div class="post-content">
        <p class="post-message post-msg-<?php echo $post['post_pk']; ?>"><?php echo _($post['post_message']); ?></p>

        <?php if ($current_user_id == $post['post_user_fk']): ?>
            <form class="post-edit-form post-edit-form-<?php echo _($post['post_pk']); ?> mix-hidden" action="/api/api-update-post" method="POST">
                <textarea name="post_message" rows="3"><?php echo _($post['post_message']); ?></textarea>
                <input type="hidden" name="post_pk" value="<?php echo _($post['post_pk']); ?>">
                <div class="edit-buttons">
                    <button type="submit">Save</button>
                    <button type="button" class="post-cancel-btn" onclick="hide_elements('.post-edit-form-<?php echo $post['post_pk']; ?>'); show_elements('.post-msg-<?php echo $post['post_pk']; ?>, .post-controls-<?php echo $post['post_pk']; ?>');">Cancel</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
    
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


    <?php if ($current_user_id == $post['post_user_fk']): ?>
        <div class="post-controls post-controls-<?php echo _($post['post_pk']); ?>">
            <form action="/api/api-delete-post" method="POST">
                <input type="hidden" name="post_pk" value="<?php echo _($post['post_pk']); ?>">
                <button type="submit" class="post-delete-btn">Delete</button>
            </form>

            <button type="button" class="post-edit-btn" onclick="show_elements('.post-edit-form-<?php echo $post['post_pk']; ?>'); hide_elements('.post-msg-<?php echo $post['post_pk']; ?>, .post-controls-<?php echo $post['post_pk']; ?>');">Edit</button>
        </div>
    <?php endif; ?>

    
</article>
