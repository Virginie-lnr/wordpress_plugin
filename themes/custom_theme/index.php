<?php get_header() ?>

<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <h1 class="text-center mb-5"><?php the_title(); ?></h1>
    <?php the_content(); ?>
  <?php endwhile; ?>
<?php else : ?>
  <div class="text-center custom-container">
    <h1>Hello 👋</h1>
    <p>You requested to see the following page :</p>
    <p></p>
    <?php
    global $wp;
    $currentUrl = add_query_arg($wp->query_vars, home_url());
    ?>
    <p><?php echo $currentUrl ?></p>
  </div>
<?php endif; ?>

<?php get_footer() ?>