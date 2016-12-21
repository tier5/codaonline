<?php
// =============================== My Request Quote Widget ======================================
class MY_RequestQuoteWidget extends WP_Widget {
    /** constructor */
    function MY_RequestQuoteWidget() {
        parent::WP_Widget(false, $name = 'My - Request a Quote');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
				$bg = apply_filters('widget_bg', $instance['bg']);
				$txt2 = apply_filters('widget_txt2', $instance['txt2']);
				$txt3 = apply_filters('widget_txt3', $instance['txt3']);
        ?>
              
		<?php 
			if($txt2=="" && $txt3==""){ 
				$class='w-full';
			} else {}
		?>
              <?php echo $before_widget; ?>
			  			<div class="top-box <?php echo $bg; ?>">
							<div class="number">	</div>
							<?php if($title!=""){ ?>
							<div class="box-text <?php echo $class; ?>">
								<h3><?php echo $title; ?></h3>
							</div><!-- end 'with title' -->
							<?php } ?>
								
							<?php if($txt2!="" && $txt3!=""){ ?>
								<div class="box-button">
									<a href="<?php echo $txt3; ?>" class=""><?php echo $txt2; ?></a>
								</div><!-- end 'button' -->
							<?php } ?>
						</div>
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
				$bg = esc_attr($instance['bg']);
				$txt2 = esc_attr($instance['txt2']);
				$txt3 = esc_attr($instance['txt3']);
        ?>
       <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'theme1669'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
	   
	   	<p>
			<label for="<?php echo $this->get_field_id('bg'); ?>"><?php _e('Background:', 'theme1669'); ?><br />
				<select id="<?php echo $this->get_field_id('bg'); ?>" name="<?php echo $this->get_field_name('bg'); ?>" style="width:100%;" > 
					<option value="bg1" <?php echo ($bg === 'bg1' ? ' selected="selected"' : ''); ?>>Background Color 1</option>
					<option value="bg2" <?php echo ($bg === 'bg2' ? ' selected="selected"' : ''); ?>>Background Color 2</option>
					<option value="bg3" <?php echo ($bg === 'bg3' ? ' selected="selected"' : ''); ?>>Background Color 3</option>
					<option value="bg4" <?php echo ($bg === 'bg4' ? ' selected="selected"' : ''); ?>>Background Color 4</option>
					<option value="bg5" <?php echo ($bg === 'bg5' ? ' selected="selected"' : ''); ?>>Background Color 5</option>
				</select>
			</label>
		</p>
		
			 <p><label for="<?php echo $this->get_field_id('txt2'); ?>"><?php _e('Button Text:', 'theme1669'); ?> <input class="widefat" id="<?php echo $this->get_field_id('txt2'); ?>" name="<?php echo $this->get_field_name('txt2'); ?>" type="text" value="<?php echo $txt2; ?>" /></label></p>
			 <p><label for="<?php echo $this->get_field_id('txt3'); ?>"><?php _e('Button URL:', 'theme1669'); ?> <input class="widefat" id="<?php echo $this->get_field_id('txt3'); ?>" name="<?php echo $this->get_field_name('txt3'); ?>" type="text" value="<?php echo $txt3; ?>" /></label></p>
        <?php 
    }

} // class Request Quote Widget

?>