<?php get_header() ?>

<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <h1 class="card-title text-center mt-5 mb-5"><?php the_title(); ?></h1>
    <?php the_content(); ?>
  <?php endwhile; ?>
<?php else : ?>
  <h1>No post yet!</h1>
<?php endif; ?>

<?php get_footer() ?>