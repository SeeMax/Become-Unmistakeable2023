<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $eost_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'custom-post-type-grid-section-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'custom-post-type-grid-section animatedSection';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
  <div class="custom-post-type-overlay c-block-fill CPTPopUpOverlay"></div>
  <div class="content">
    <?php get_template_part( 'partials/_ajax-loader' ); ?>
    <div class="custom-post-type-popup CPTPopup">
      <div class="custom-post-type-popup-close CPTPopupClose">x</div>
      <div class="custom-post-type-popup-inner">
        <!-- AJAX DATA GOES HERE -->
        <div class="custom-post-type-pop-up-image c-width-30">
        </div>
        <div class="custom-post-type-pop-up-text c-width-70">
          <h2></h2>
          <h4></h4>
          <p></p>
          <div class="linkedin"></div>
        </div>
      </div>
    </div>

    <?php $sectionTitle = get_field('grid_title');?>
    <?php if($sectionTitle):?>
    <h1 class="grid-title"><?php echo get_field('grid_title');?></h1>
    <?php endif;?>

    <div class="custom-post-type-grid-container CPTGridContainer">
      <?php $featured_posts = get_field('posts_to_show');?>
      <?php if( $featured_posts ): ?>

      <?php foreach( $featured_posts as $featured_post ): ?>
      <?php $headline = get_the_title($featured_post->ID);?>
      <?php $bio = get_field('biography', $featured_post->ID);?>
      <?php if( have_rows('bio_details', $featured_post->ID) ): ?>
      <?php while( have_rows('bio_details', $featured_post->ID) ): the_row();?>


      <?php $image = get_sub_field('image', $featured_post->ID);?>
      <?php $title = get_sub_field('title', $featured_post->ID);?>
      <?php $linkedin = get_sub_field('linkedin', $featured_post->ID);?>
      <?php endwhile;?>
      <?php endif;?>

      <div class="single-custom-post-type-grid-item singleCPTGridItem" data-cpt-popup=<?php echo $featured_post->ID;?>>
        <div class="team-image-mask">
          <div class="image-background-circle"></div>
          <div class="image-background-circle image-background-circle-2 aboutSpinner"></div>
          <div class="team-picture-mask">
            <div class="background-image-section slidingImage" style="background-image:url(  
              <?php echo $image['url'];?>
            );"></div>
          </div>
        </div>
        <h5><?php echo $headline;?></h5>
        <h6><?php echo $title;?></h6>
        <h6 class="full-bio-link fullBioLink">Full Bio</h6>
      </div>

      <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>