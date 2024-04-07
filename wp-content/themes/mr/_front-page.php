<?php

declare(strict_types=1);


get_header();
echo "I come with ?";




get_template_part('inc/content');
echo '<br/>';
get_template_part('inc/section-content') ;


get_footer();
