<?php

/* this need some more work*/
$V = get_defined_vars();
//dpm($V);

$uri = $V['content']['field_pdf'][0]['#markup'];

?>

<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
    <div class="content"<?php print $content_attributes; ?>>
        <div class="row text-center">

            <object class="col-md-12 hidden-xs hidden-sm" data="<?php print $uri; ?>" type="application/pdf"
                    height="1200">
                <embed src="<?php print $uri; ?>" type="application/pdf"></embed>
            </object>

            <a href="<?php print $uri; ?>" class="btn btn-primary download"><?php print t("Download"); ?>&nbsp;Pdf</a>
        </div>
    </div>
</div>

