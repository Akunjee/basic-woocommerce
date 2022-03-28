<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
	<div class="header-area">
		<h1>header area</h1>
		<div class="header-right">
			<div class="notun_akta_mini">
				
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

		</div>
	</div>