<?php

  /**
  * quote Block Template.
  * @param   array $block The block settings and attributes.
  * @param   string $content The block inner HTML (empty).
  * @param   bool $is_preview True during AJAX preview.
  * @param   (int|string) $post_id The post ID this block is saved to.
  */

  // Create id attribute allowing for custom "anchor" value.
  $id = 'quote-section-' . $block['id'];
  if( !empty($block['anchor']) ) {$id = $block['anchor'];}
  // Create class attribute allowing for custom "className" and "align" values.
  $className = 'quote-section quoteSection';
  if( !empty($block['className']) ) {$className .= ' ' . $block['className'];}
  if( !empty($block['align']) ) {$className .= ' align' . $block['align'];}
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
  <h4>Companies enjoying the BU treatment. </h4>
  <div class="quote-slider-container quoteSliderContainer">


    <?php $featured_posts = get_field('companies');
      if( $featured_posts ):?>

    <?php foreach( $featured_posts as $featured_post ): 
      $permalink = get_permalink( $featured_post->ID );
      $title = get_the_title( $featured_post->ID );
      $logo = get_field( 'logo', $featured_post->ID );?>
    <?php if( have_rows('carousel_quote', $featured_post->ID) ):
        while( have_rows('carousel_quote', $featured_post->ID) ): the_row(); 
          $preview = get_sub_field( 'quote_text', $featured_post->ID );
          $person = get_sub_field( 'person_quoted', $featured_post->ID );
        endwhile;
      endif; ?>
    <div class="single-quote-section-slide background-image-section">
      <div class="content">
        <img src="<?php echo $logo["url"];?>">
        <div class="quote-text">
          <h3><?php echo $preview;?></h3>
          <h6>
            <?php echo $person;?>
          </h6>
          <a href="<?php echo $permalink;?>">Read More</a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>

    <?php endif; ?>
  </div>
  <div class="slick-arrow-container">
    <div class="slick-previous-arrow">
    </div>
    <div class="slick-nextious-arrow">
    </div>
  </div>
</section>