<?php

/* Template Name: home */
?>

<?php get_header(); ?>

<!-- fires the search template -->
<?php get_search_form(); ?>

<h4>Section</h4>

<?php   get_template_part('inc/form-enquiry'); ?>


<?php the_content();?>

<?php  get_footer();?>