<?php
// =============================== My Carousel widget ======================================
class MY_CarouselWidget extends WP_Widget {
    /** constructor */
    function MY_CarouselWidget() {
        parent::WP_Widget(false, $name = 'My - Carousel');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
				$limit = apply_filters('widget_limit', $instance['limit']);
				$category = apply_filters('widget_category', $instance['category']);
				$count = apply_filters('widget_count', $instance['count']);
        ?>
				<?php echo $before_widget; ?>
					<?php if ( $title )
								echo $before_title . $title . $after_title; ?>
							
							<!-- Elastislide Carousel -->
							<div id="carousel" class="es-carousel-wrapper">
								<div class="es-carousel">
									
										<?php $limittext = $limit;?>
										<?php global $more;	$more = 0;?>
										<?php query_posts("posts_per_page=". $count ."&post_type=" . $category);?>
										<?php while (have_posts()) : the_post(); ?>
										
										<?php
										$thumb = get_post_thumbnail_id();
										$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
										$image = aq_resize( $img_url, 300, 133, true ); //resize & crop img
										?>
										
										<?php if($limittext=="" || $limittext==0){ ?>
										<li>
										<?php if(has_post_thumbnail()) { ?>
											<figure class="thumbnail"><a href="<?php the_permalink(); ?>"><img src="<?php echo $image ?>" alt="<?php the_title(); ?>" /></a></figure>
										<?php } ?>
										</li>
										<?php }else{ ?>
										<li>
										<?php if(has_post_thumbnail()) { ?>
											<figure class="thumbnail"><a href="<?php the_permalink(); ?>"><img src="<?php echo $image ?>" alt="<?php the_title(); ?>" /></a></figure>
										<?php } ?>
											
											<div class="excerpt"><?php $excerpt = get_the_excerpt(); echo my_string_limit_words($excerpt,$limittext); ?></div>
											<a href="<?php the_permalink() ?>" class="link"><?php _e('', 'theme1669'); ?></a>
                                            <h3 style="border-bottom:1px dotted #FFFFFF; padding-bottom:10px; color:#FFF;">-<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										</li>
										<?php } ?>
										
										 <?php endwhile; ?>
										<?php wp_reset_query(); ?>
									
								</div>
							</div>
							<script type="text/javascript">
								jQuery('#carousel').elastislide({
									imageW 	: 300,
									minItems	: 1
								});
							</script>
							<!-- End Elastislide Carousel -->
			
			
				<?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
			$title = esc_attr($instance['title']);
			$limit = esc_attr($instance['limit']);
			$category = esc_attr($instance['category']);
			$count = esc_attr($instance['count']);
    ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'theme1669'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

      <p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit Text:', 'theme1669'); ?> <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Posts per page:', 'theme1669'); ?><input class="widefat" style="width:30px; display:block; text-align:center" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>

      <p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Post type:', 'theme1669'); ?><br />

      <select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" style="width:150px;" > 
      <option value="testi" <?php echo ($category === 'testi' ? ' selected="selected"' : ''); ?>>Testimonials</option>
      <option value="portfolio" <?php echo ($category === 'portfolio' ? ' selected="selected"' : ''); ?> >Portfolio</option>
      <option value="clients" <?php echo ($category === 'clients' ? ' selected="selected"' : ''); ?> >Clients</option>
      <option value="" <?php echo ($category === '' ? ' selected="selected"' : ''); ?>>Blog</option>
      </select>
      </label></p>
       
      <?php 
    }

} // class Carousel Widget


?>