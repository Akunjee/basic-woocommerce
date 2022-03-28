<?php

	add_action('after_setup_theme','starter_theme_functions');
	function starter_theme_functions(){
		add_theme_support('woocommerce');
		add_theme_support('title-tag');
	}

	add_action('wp_enqueue_scripts','notun_script');
	function notun_script(){
		wp_enqueue_script('main',get_template_directory_uri().'/js/main.js',array('jquery'),'',true);
	}
	add_action('wp_enqueue_scripts','notun_styles');
	function notun_styles(){
		wp_enqueue_style('stylesheet',get_stylesheet_uri());
	}

	add_filter('woocommerce_checkout_fields','checkout_somethings');
	function checkout_somethings($default){

		$default['billing']['billing_first_name']['required'] = 0;
		$default['billing']['billing_first_name']['class'][0] = 'first-row-wide';
		$default['billing']['billing_last_name']['class'][0] = 'first-row-wide';
		
		$default['billing']['thikana']=array(
			'type'	=>	'textarea',
			'label'	=>	'Thikana Den'
		);

		return $default;

	}

	add_action('woocommerce_checkout_update_order_meta','save_korbo_kina');
	function sav_korbo_kina($order_er_id){
		update_post_meta($order_er_id,'kicuakta',$_POST['thikana']);
	}

	add_filter('woocommerce_add_to_cart_fragments','ajaxify_add_to_cart_button');

	function ajaxify_add_to_cart_button( $default ){

			ob_start(); ?>
			
			<div class="notun_akta_mini">

				<p>Total Item:<?php echo WC()->cart->get_cart_contents_count(); ?></p>
				
					<ul>
						<?php foreach(WC()->cart->get_cart() as $single=>$value)	:	?>
						<?php $singleproduct=$value['data']; ?>
					
						<li>
							<?php echo $singleproduct->get_image(); ?><br>		
							<?php echo $singleproduct->get_title(); ?><br>		
							<?php echo $singleproduct->get_price(); ?><br>		
							<a href="<?php echo WC()->cart->get_remove_url($single); ?>">remove</a><br>

						</li>
						<?php endforeach; ?>
					</ul>

		
			</div>


			<?php $default['div.notun_akta_mini']=ob_get_clean();
			return $default;

	}