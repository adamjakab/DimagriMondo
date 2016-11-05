<?php
/**
 * The default user profile page if no other role specific template names apply
 */
?>

<div class="profile"<?php print $attributes; ?>>
    <?php print render($user_profile); ?>
</div>
