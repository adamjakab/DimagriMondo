<?php
    // Template for resource folder in child view mode
?>

<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
    <a href="<?php print $link; ?>">
        <i class="fa fa-folder bigfolder" aria-hidden="false">
            <?php print render($icon); ?>
            <div class="children-count">
                <?php print $number_of_children; ?>
            </div>
        </i>
        <?php print render($title); ?>

    </a>
</div>
