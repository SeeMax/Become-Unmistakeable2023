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
$id = 'posts-preview-section-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'posts-preview-section';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>

<?php 
  $sectionTitle = get_field('section_title');
  $RecorCat = get_field('recent_or_category');
  $allOrThree = get_field('all_or_three');
  $cat_id = get_field('post_category');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
  <div class="content">
    <h2 class="section-header">
      <?php echo $sectionTitle;?>
    </h2>
    <div class="single-posts-preview-area">
      <?php if($RecorCat == 'category'):?>
        <?php $args = array(
          'posts_per_page'      =>3,
          'post_type'           => 'post',
          'cat'                 => $cat_id,
          'ignore_sticky_posts' => true,
          );
        ?>
      <?php else:?>

        <?php if($allOrThree == 'all'):?>
          <?php $args = array(
            'post_type'           => 'post',
            'ignore_sticky_posts' => true,
            );
          ?>
        <?php else:?>
          <?php $args = array(
            'posts_per_page'      =>3,
            'post_type'           => 'post',
            'ignore_sticky_posts' => true,
            );
          ?>
        <?php endif;?>
      <?php endif;?>
    
      <?php $wp_query = new WP_Query($args);?>
      <?php while ($wp_query->have_posts()) : $wp_query->the_post();?>
        <?php $post_id = get_the_ID();?>
          <?php get_template_part( 'partials/_single-post-preview' ); ?>
      <?php endwhile; ?>
      <?php wp_reset_query(); ?>
      
      <?php if( have_rows('section_button') ): while( have_rows('section_button') ) : the_row();
        $btnText = get_sub_field('button_text');
        $btnDest = get_sub_field('button_destination');
      ?>
        <?php if($btnText):?>
          <div class="all-posts-button-area">
            <div class="seemax-button">
              <span><?php echo $btnText;?></span>
              <a class="c-block-fill" href="<?php echo $btnDest;?>"></a>
            </div>
          </div>
        <?php endif;?>
      <?php endwhile;endif;?>
    </div>
  </div>
</section>
