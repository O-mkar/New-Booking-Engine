<?php $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=custom' ); ?>

<div class="header-language">
    <ul class="menu">
        <li class="has-dropdown">
            <i class="fa fa-angle-down"></i>
            <a href="#" class="language-toggle"><?php echo ICL_LANGUAGE_CODE; ?></a>
            <ul>
                <?php
                if(!( empty($languages) )){
                    foreach($languages as $l){
                        echo '<li><a href="'.$l['url'].'">'.$l['native_name'].'</a></li>';
                    }
                }
                ?>
            </ul>
        </li>
    </ul>
</div>