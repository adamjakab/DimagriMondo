<?php

global $base_url;

?>
<div class="wrapper-social spazio-20">
    <hr>
    <ul class="btn-social clearfix">
        <?php if ($enabled["facebook_like"]): ?>
            <li class="li-social li-social-facebook li-social-facebook-like">
                <div class="fb-like" data-href="<?php print $link; ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
            </li>
        <?php endif; ?>

        <?php if ($enabled["facebook_share"]): ?>
            <li class="li-social li-social-facebook li-social-facebook-share">
                <div class="fb-share-button" data-href="<?php print $link; ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true">
                    <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php print $link_encoded; ?>&amp;src=sdkpreparse">Condividi</a>
                </div>
            </li>
        <?php endif; ?>
        
        <?php if ($enabled["facebook_page"]): ?>
            <li class="li-social li-social-facebook li-social-facebook-page">
                <div class="fb-page" data-href="https://www.facebook.com/DimagriMondo" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/DimagriMondo" class="fb-xfbml-parse-ignore">
                        <a href="https://www.facebook.com/DimagriMondo">DimagriMondo</a>
                    </blockquote>
                </div>
            </li>
        <?php endif; ?>

        <?php if ($enabled["twitter"]): ?>
            <li class="li-social li-social-twitter">
                <a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php print $link; ?>" data-count="horizontal">Tweet</a>
            </li>
        <?php endif; ?>

        <?php if ($enabled["plusone"]): ?>
            <li class="li-social li-social-plusone">
                <g:plusone size="medium" href="<?php print $link; ?>"></g:plusone>
            </li>
        <?php endif; ?>

        <?php if ($enabled["pinterest"]): ?>
            <li class="li-social li-social-pinterest">
                <a href="http://pinterest.com/pin/create/button/?url=<?php print $link; ?>" class="pin-it-button" count-layout="horizontal">Pin It</a>
            </li>
        <?php endif; ?>

    </ul>
</div>
