<?php/* * Add function to widgets_init that'll load our widget. */add_action( 'widgets_init', 'anariel_social_widget' );/* Function that registers our widget. */function anariel_social_widget() {	register_widget( 'anariel_socials' );}class anariel_socials extends WP_Widget {	function __construct() {		/* Widget settings. */		$widget_ops = array( 'classname' => 'socials', 'description' => esc_attr__('Displays the post image and title.'.'anariel') );		/* Create the widget. */		parent::__construct( 'socials-widget',esc_attr__('Anariel - Premium Social Widget','anariel'), $widget_ops, '' );	}	function widget( $args, $instance ) {		extract( $args );		/* User-selected settings. */		$title = apply_filters('widget_title', $instance['title'] ); 		echo $before_widget; 		if ( $title ) echo $before_title . $title . $after_title; 	?>		<div class="widgett">					<div class="social_icons">				<?php anariel_socialLink() ?>			</div>		</div>			<?php		echo $after_widget;	}	function update( $new_instance, $old_instance ) {		$instance = $old_instance;		/* Strip tags (if needed) and update the widget settings. */		$instance['title'] = strip_tags( $new_instance['title'] );				return $instance;	}	function form( $instance ) {		/* Set up some default widget settings. */		$defaults = array( 'title' => 'Social');		$instance = wp_parse_args( (array) $instance, $defaults ); ?>		<p>			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_attr_e('Title:','anariel') ?></label>			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php esc_attr($instance['title']); ?>" />		</p>				<p>			<?php esc_attr_e('You can put social icons via Theme options.','anariel') ?>		</p>		<?php	}		}?>