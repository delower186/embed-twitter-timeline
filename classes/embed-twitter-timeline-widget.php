<?php
/*
    @package embed-twitter-timeline
    ==============================
    Embed_Twitter_Timeline_Widget Class
    ==============================
*/

// Check if class already exist
if ( !class_exists( 'Embed_Twitter_Timeline_Widget' ) ) {

    class Embed_Twitter_Timeline_Widget extends WP_Widget {
		
        public function __construct(){
            $widget_ops = array(
                'Classname' => 'embed-twitter-timeline', //css class name
                'description' => esc_html__('Embed Twitter Timeline on Widget','embed-twitter-timeline')
            );
            parent::__construct('embed-twitter-timeline', esc_html__('Embed Twitter Timeline','embed-twitter-timeline'),$widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         */
        function widget( $args, $instance ) {
            
            echo $args['before_widget'];

            if ( ! empty( $instance['title'] ) ) {
                echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
            }

            echo '<a class="twitter-timeline" data-width="'.$instance['width'].'" data-height="'.$instance['height'].'" data-theme="'.$instance['theme'].'" href="https://twitter.com/'.$instance['handle'].'">Tweets by "'.$instance['handle'].'"</a>';

            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form( $instance ) {
            //Widget Title
            $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Twitter Profile', 'embed-twitter-timeline' );
            //twitter handle form field
            $handle = ! empty( $instance['handle'] ) ? $instance['handle'] : esc_html__( 'BdDelower', 'embed-twitter-timeline' );
            //theme form field
            $theme = ! empty( $instance['theme'] ) ? $instance['theme'] : esc_html__( 'light', 'embed-twitter-timeline' );
            //width form field
            $width = ! empty( $instance['width'] ) ? $instance['width'] : esc_html__( '400', 'embed-twitter-timeline' );
            //height form field
            $height = ! empty( $instance['height'] ) ? $instance['height'] : esc_html__( '500', 'embed-twitter-timeline' );
            ?>
            <!--Widget Title form field -->
            <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
            <?php esc_attr_e( 'Title:', 'embed-twitter-timeline' ); ?></label>

            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>
            " name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>
            " type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>
            <!--twitter handle form field -->
            <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'handle' ) ); ?>">
            <?php esc_attr_e( 'Twitter Handle:', 'embed-twitter-timeline' ); ?></label>

            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'handle' ) ); ?>
            " name="<?php echo esc_attr( $this->get_field_name( 'handle' ) ); ?>
            " type="text" value="<?php echo esc_attr( $handle ); ?>">
            </p>
            <!--theme form field -->
            <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'theme' ) ); ?>">
            <?php esc_attr_e( 'Theme:', 'embed-twitter-timeline' ); ?></label>

            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'theme' ) ); ?>
            " name="<?php echo esc_attr( $this->get_field_name( 'theme' ) ); ?>">
            <option value="light" <?php echo ($theme == 'light')? 'selected':''; ?>>Light</option>
            <option value="dark" <?php echo ($theme == 'dark')? 'selected':''; ?>>Dark</option>
            </select>
            </p>
            <!--width form field -->
            <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>">
            <?php esc_attr_e( 'Width:', 'embed-twitter-timeline' ); ?></label>

            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'width' ) ); ?>
            " name="<?php echo esc_attr( $this->get_field_name( 'width' ) ); ?>
            " type="number" value="<?php echo esc_attr( $width ); ?>">
            </p>
            <!--height form field -->
            <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>">
            <?php esc_attr_e( 'Height:', 'embed-twitter-timeline' ); ?></label>

            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>
            " name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>
            " type="number" value="<?php echo esc_attr( $height ); ?>">
            </p>
            <?php 
        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see WP_Widget::update()
         *
         * @param array $new_instance Values just sent to be saved.
         * @param array $old_instance Previously saved values from database.
         *
         * @return array Updated safe values to be saved.
         */
        public function update( $new_instance, $old_instance ) {
            $instance = array();
            //Widget Title
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
            //Widget Title
            $instance['handle'] = ( ! empty( $new_instance['handle'] ) ) ? sanitize_text_field( $new_instance['handle'] ) : '';
            //Theme
            $instance['theme'] = ( ! empty( $new_instance['theme'] ) ) ? sanitize_text_field( $new_instance['theme'] ) : '';
            //Width
            $instance['width'] = ( ! empty( $new_instance['width'] ) ) ? sanitize_text_field( $new_instance['width'] ) : '';
            //Height
            $instance['height'] = ( ! empty( $new_instance['height'] ) ) ? sanitize_text_field( $new_instance['height'] ) : '';
            return $instance;
        }

    }

    add_action('widgets_init',function(){
        register_widget('Embed_Twitter_Timeline_Widget');
    });

}