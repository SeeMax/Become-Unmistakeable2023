<?php /* Template Name: Search Results */ get_header(); ?>
	<main class="search-results-page archive-page">
    <section class="hero-section">
      <div class="content">  
        <?php if (have_posts()) : ?>
          <h5>Search Results for:</h5> 
          <h2><?php the_search_query(); ?></h2>
        <?php else:?>
          <h2>No posts found. Try a different search?</h2>      
        <?php endif;?>
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
              $countPosts = $wp_query->found_posts;
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
                <h6>Sadly there are</h6>
                <h3>No Posts in %s</h3>
              </div>
            </div>
          <?php endif;?>


        </div>
      </div>
    </section>

	</main>
<?php get_footer(); ?>
