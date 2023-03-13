<?php

  /**
  * Hero Block Template.
  * @param   array $block The block settings and attributes.
  * @param   string $content The block inner HTML (empty).
  * @param   bool $is_preview True during AJAX preview.
  * @param   (int|string) $post_id The post ID this block is saved to.
  */

  // Create id attribute allowing for custom "anchor" value.
  $id = 'hero-section-' . $block['id'];
  if( !empty($block['anchor']) ) {$id = $block['anchor'];}
  // Create class attribute allowing for custom "className" and "align" values.
  $className = 'hero-section heroSection';
  if( !empty($block['className']) ) {$className .= ' ' . $block['className'];}
  if( !empty($block['align']) ) {$className .= ' align' . $block['align'];}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> background-image-section" style="background-image:url(<?php echo $image['url'];?>)">
  <div class="hero-slider-container heroSliderContainer">
    
    <?php if( have_rows('hero_slide') ): while( have_rows('hero_slide') ) : the_row();
      $image = get_sub_field('image');
      if( have_rows('slide_text') ): while( have_rows('slide_text') ) : the_row();
        $headline = get_sub_field('headline');
        $body = get_sub_field('body');
        if( have_rows('button') ): while( have_rows('button') ) : the_row();
          $btn_dest = get_sub_field('button_destination');
          $btn_text = get_sub_field('button_text');
        endwhile;endif;
      endwhile;endif;
    ?>
    
      <div class="single-hero-section-slide background-image-section" style="background-image:url(<?php echo $image['url'];?>)">
      <div class="hero-overlay c-block-fill"></div>
        <div class="content">    
          <?php if($headline):?>
            <h1>
              <?php echo $headline;?>
            </h1>
          <?php endif;?>  
          <?php if($body):?>
            <?php echo $body;?>
          <?php endif;?>
          <?php if($btn_text):?>
            <div class="seemax-button">
              <a href="<?php echo $btn_dest;?>" class="c-block-fill"></a>
              <span><?php echo $btn_text;?></span>
            </div>
          <?php endif;?>
        </div>
      </div>
    <?php endwhile;endif;?>
  </div>
  <!-- <div class="slick-arrow-container">
    <div class="slick-previous-arrow">
      <
    </div>
    <div class="slick-nextious-arrow">
      >
    </div>
  </div> -->
</section>
