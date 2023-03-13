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
$className = 'custom-post-type-grid-section';
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
      <!-- AJAX DATA GOES HERE -->
      <div class="custom-post-type-pop-up-image c-width-30">
      </div>
      <div class="custom-post-type-pop-up-text c-width-70">
        <h3></h3>
        <h5></h5> 
        <p></p>
      </div>
    </div>

    <?php $sectionTitle = get_field('grid_title');?>
    <?php if($sectionTitle):?>
      <h2 class="grid-title"><?php echo get_field('grid_title');?></h2>
    <?php endif;?>
     
    <div class="custom-post-type-grid-container CPTGridContainer"> 
      <?php $featured_posts = get_field('posts_to_show');?>
      <?php if( $featured_posts ): ?>

        <?php foreach( $featured_posts as $featured_post ): ?>
          <?php $headline = get_the_title($featured_post->ID);?>
          <?php $subheadline = get_field('subheadline', $featured_post->ID);?>
          <?php $body = get_field('body', $featured_post->ID);?>
          <?php $image = get_field('image', $featured_post->ID);?>
        
          <div class="single-custom-post-type-grid-item singleCPTGridItem c-width-32" data-cpt-popup=<?php echo $featured_post->ID;?>>  
            <div class="team-image-mask background-image-section" 
            style="background-image:url(
            <?php if ( $image != '' ):?>
              <?php echo $image['url'];?>
            <?php else:?>
              <?php echo catch_that_image();?>
            <?php endif;?>
            );">
            </div>
            <h3><?php echo $headline;?></h3>
            <h5><?php echo $subheadline;?></h5>
            <?php echo $body;?>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>
