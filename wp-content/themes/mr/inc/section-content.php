<?php declare(strict_types=1) ;?>

<?php if (have_posts()) {
    while (have_posts()) {
        the_post();
        the_content();
    }
} ?>