<?php
/**
 * Page
 * page.tpl.php
 */
?>
<?php if ($messages) : ?>
    <div class="messages">
        <?php print $messages; ?>
    </div>
<?php endif; ?>

<?php if (!empty($tabs)): ?>
    <div class="admin-tabs">
        <?php print render($tabs); ?>
    </div>
<?php endif; ?>

<?php print render($page['content']); ?>
