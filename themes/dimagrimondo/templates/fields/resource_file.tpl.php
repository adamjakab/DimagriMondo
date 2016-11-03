<?php
    // Template for resource file in child view mode
?>

<div class="resource-file">
    <a href="<?php print $link; ?>">
        <i class="fa fa-square bigfile" aria-hidden="false">
            <?php print render($icon); ?>
            <?php print render($preview); ?>
        </i>
        <?php print render($title); ?>
    </a>
</div>
