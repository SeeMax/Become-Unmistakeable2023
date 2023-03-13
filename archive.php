<?php get_header(); ?>
	<main class="archive-page">

  

  <section class="hero-section">
    <div class="content">
        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
        <?php /* If this is a category archive */ if (is_category()) { ?>
         <h5>Archive of</h5>
         <h2><?php single_cat_title(); ?></h2>
        <?php the_archive_description( '<div class="archive-description">', '</div>' );?>
        <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
          <h5>Posts Tagged</h5>
          <h2><?php single_tag_title(); ?></h2>
          <?php the_archive_description( '<div class="archive-description">', '</div>' );?>
        <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
         <h5>Archive for</h5>
         <h2><?php the_time('F jS, Y'); ?></h2>
        <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
         <h5>Archive for</h5>
         <h2><?php the_time('F, Y'); ?></h2>
        <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
         <h5>Archive for</h5>
         <h2><?php the_time('Y'); ?></h2>
        <?php /* If this is an author archive */ } elseif (is_author()) { ?>
         <h5>Author Archive</h5>
         <h2><?php echo get_the_author();?></h2>
        <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
         <h2>Posts Archive</h2>
        <?php } ?>
    </div>
  </section>
  <section class="posts-section">
    <div class="content">
      <div class="single-posts-preview-area">
        <?php if (have_posts()) : ?>
        
          <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part( 'partials/_single-post-preview' ); ?>
          <?php endwhile; ?>
          <!-- Get The Variables For:  -->
          <!-- the Posts to Show Count from Settings -> Reading -->
          <!-- The total posts in the category / area -->
          <?php 
            $default_posts_per_page = get_option( 'posts_per_page' );
            $countPosts = $GLOBALS['wp_query']->found_posts;
          ?>
          <!-- If there are more posts than posts to show, show the pagination -->
          <?php if($countPosts > $default_posts_per_page):?>
          <div class="seemax-pagination">
              <?php html5wp_pagination(); ?>
          </div>
          <?php endif;?>

        <?php else :?>
          <div class="single-post-preview c-width-32">
            <div class="single-post-preview-image background-image-section"
              style="background-image:url(<?php echo get_template_directory_uri();?>/dist/images/default-image.jpg)"
            ></div>
            <div class="single-post-preview-text">
              <?php if ( is_category() ) { // If this is a category archive
                printf("<h6>Sadly there are</h6><h3>No Posts in %s</h3>", single_cat_title('',false));
              } else if ( is_date() ) { // If this is a date archive
                echo("<h6>Sadly there are</h6><h3>No Posts With This Date.</h3>");
              } else if ( is_author() ) { // If this is a category archive
                $userdata = get_userdatabylogin(get_query_var('author_name'));
                printf("<h6>Sadly there are</h6><h3>No Posts by %s.</h3>", $userdata->display_name);
              } else {
                echo("<h6>Sadly there are</h6><h3>No Posts Here.</h3>");
              };?>
            </div>
          </div>
          <!-- get_search_form(); -->
        <?php endif;?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>
