<?php

hide($user_profile["group_profile_info"]['group_links']);

?>
<div class="profile coach self"<?php print $attributes; ?>>
    <div class="row">
        <div class="col-md-9">
            <?php print render($user_profile["user_resources"]); ?>
        </div>
        <div class="col-md-3">
            <?php print render($user_profile["group_profile_info"]); ?>
            <?php print render($user_profile["coach_info"]); ?>
        </div>
    </div>
    <?php /*print render($user_profile);*/ ?>
</div>
