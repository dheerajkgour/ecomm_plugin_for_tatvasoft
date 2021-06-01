<?php
if ( !defined('ABSPATH') )
	exit;

if( !class_exists('Frontend_class')){
	class Frontend_class {
		function __construct() {
				// Run this on plugin activation
				add_action( 'init', array( $this, 'create_shortcodes' ));
				add_action( 'init', array( $this, 'start_session_for_cart',1 ));
			}


		/*
		for start the session
		*/
		public function start_session_for_cart(){
			if (!session_id()) {
				session_start();
			}
		}


		public function create_shortcodes(){
			//shortcode for show products in grid
			add_shortcode('products_grid',array($this,'show_products_grid'));
			//shortcode for show cart products
			add_shortcode('show_cart',array($this,'show_cart_products'));
		}

		// Handle shortcode for ahow products in grid
		public function show_products_grid(){
			ob_start();
			echo '<div id="products_grid" class="prod_grid_sec grid-3"><div class="grid_container clearfix">';
				$args = array( 
					'post_type'   => 'products',
					'post_status' => 'publish'
				);

				$products = new WP_Query( $args );

				if ( $products->have_posts() ) : 
					while( $products->have_posts() ) : $products->the_post(); 
						if ( has_post_thumbnail($post->ID) ){
							$image_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
						}
						else{
							$image_url = PLUGIN_URL.'assets/images/placeholder.png';
						}

						$prod_price = get_post_meta( get_the_ID(), 'product_price',true );
						echo '<div class="prod_grid"><div class="prod_img_sec"><a href="'.get_permalink().'" rel="productPhoto"><img src="'.$image_url.'" class="prod_image"/></a>';
						echo '<div class="prod_dtail_sec"><h1 class="prod_title"><a href="'.get_permalink().'" rel="productPhoto">'.get_the_title().'</a></h1>';
						echo '<div class="prod_price">Price: '.$prod_price.'</div></div>';
						echo '<a href="#" data-prod_id="'.get_the_ID().'" class="add_to_cart_btn">Add to cart</a>';
						echo '</div></div>';
					endwhile;
				else : 
					echo "<h2>No Products Found</h2>";
				endif;
			echo '</div></div>';
			return ob_get_clean();
		}


		public function show_cart_products(){
			ob_start();
			// global $wp_session;
			$wp_session = WP_Session::get_instance();
			// $get_sess = $wp_session[ 'cart_products' ];
					echo json_encode( $wp_session );
			// if( isset( $_SESSION[ 'cart_products' ] ) && !empty($_SESSION[ 'cart_products' ]) ){
			// 	$get_sess = $_SESSION[ 'cart_products' ];
			// 	print_r($get_sess);
			// }

			return ob_get_clean();
		}
	}
}

?>