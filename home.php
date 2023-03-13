<?php /* Template Name: Posts Page */ get_header(); ?>
	<main class="posts-page archive-page">
    <section class="hero-section">
      <div class="content">  
          <!-- <h5></h5>  -->
          <h2><?php single_post_title();?></h2>
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
              $countPosts = wp_count_posts()->publish;
            ?>
            <!-- If there are more posts than posts to show, show the pagination -->
            <?php if($countPosts > $default_posts_per_page):?>
              <div class="seemax-pagination">
                  <?php html5wp_pagination(); ?>
              </div>
            <?php endif;?>
          <?php endif;?>
        </div>
      </div>
    </section>

	</main>
<?php get_footer(); ?>
