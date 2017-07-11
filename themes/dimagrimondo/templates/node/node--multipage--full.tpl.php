<?php
/**
 * Node
 *
 * Hook suggestions examples:
 *
 *  node--child.tpl.php
 *  node--child--1.tpl.php
 *  node--type.tpl.php
 *  node--type--1.tpl.php
 *  node--type--child.tpl.php
 *  node--type--child--1.tpl.php
 *
 */
?>

<?php
hide($content['links']);
hide($content['comments']);
hide($content['field_single_image']);

?>

<div class="wrapper-content">
    <div class="main-container container">
        <a id="main-content"></a>
        <div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

            <div class="node-content"<?php print $content_attributes; ?>>

                <?php print render($content["field_paragraphs_pages"]); ?>

                <?php print render($title_prefix); ?>
                <?php print render($content["title_field"]); ?>
                <?php print render($title_suffix); ?>

            </div>
        </div>
    </div>
</div>