<?php
if ( !defined('ABSPATH') )
	exit;

if( !class_exists('Admin_class')){
	class Admin_class {
		function __construct() {
			// Run this on plugin activation
			add_action( 'init', array( $this, 'create_post_types' ));
			add_action( 'init', array( $this, 'start_session_for_cart',1 ));
			add_action( 'admin_init',  array( $this, 'add_custom_meta' ));
			add_action( 'save_post', array( $this, 'save_products_custom_fields'), 10, 2 );
			add_action('wp_enqueue_scripts', array( $this, 'add_scripts_and_styles'));
			add_action("wp_ajax_add_product_in_cart",  array( $this,"add_product_in_cart"));
			add_action("wp_ajax_nopriv_add_product_in_cart", array( $this, "add_product_in_cart"));
		}

		public function add_scripts_and_styles() {
			wp_register_script( 'add-tse-js', PLUGIN_URL . 'assets/js/tse.js', array('jquery'),'',true  );
			wp_register_style( 'add-tse-css', PLUGIN_URL . 'assets/css/tse.css','','', 'screen' );
			wp_localize_script( 'add-tse-js', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));  
			wp_enqueue_script( 'add-tse-js' );
			wp_enqueue_style( 'add-tse-css' );
		}

		/*
		for start the session
		*/
		public function start_session_for_cart(){
			if (!session_id()) {
				session_start();
			}
		}

		public function create_post_types(){
			//Register product post type 
			register_post_type( 'products',
			array(
				'labels' => array(
					'name' => 'Products',
					'singular_name' => 'Product',
					'add_new' => 'Add New',
					'add_new_item' => 'Add New Product',
					'edit' => 'Edit',
					'edit_item' => 'Edit Product',
					'new_item' => 'New Product',
					'view' => 'View',
					'view_item' => 'View Product',
					'search_items' => 'Search Products',
					'not_found' => 'No Products found',
					'not_found_in_trash' => 'No Products found in Trash',
					'parent' => 'Parent Product'
				),
				'public' => true,
				'menu_position' => 10,
				'supports' => array( 'title', 'editor', 'thumbnail' ),
				'taxonomies' => array( 'product_category' ),
				'has_archive' => true
			)
		);


			// Register Taxonomy for Product category
			 register_taxonomy(
				'product_category', 
				'products',
				array(
					'hierarchical' => true,
					'label' => 'Categories', // display name
					'query_var' => true,
				)
			);
		}


		/*
		* Add Custom Fields for Products
		*/
		public function add_custom_meta(){
			add_meta_box( 'product_custom_fields',
				'Product Custom Fields',
				array( $this, 'display_product_price_meta_box'),
				'products', 'normal', 'high'
			);


		}

		/*
		For Show the Meta fields for Products
		*/
		function display_product_price_meta_box( $product ) {
			$product_price = esc_html( get_post_meta( $product->ID, 'product_price', true ) );
			$product_quantity = intval( get_post_meta( $product->ID, 'product_quantity', true ) );
			?>
			<table>
				<tr>
					<td style="width: 100%">Product Price</td>
					<td><input type="text" size="80" name="product_price" value="<?php echo $product_price; ?>" required/></td>
				</tr>
				<tr>
					<td style="width: 150px">Product Quantity</td>
					<td>
						<input type="number" name="product_quantity" value="<?php echo $product_quantity; ?>" />
					</td>
				</tr>
			</table>
			<?php
		}

		/*
		*Save Products Custom fields in the database 
		*/
		function save_products_custom_fields( $product_id, $product ) {
			if ( $product->post_type == 'products' ) {

				if ( isset( $_POST['product_price'] ) && $_POST['product_price'] != '' ) {
					update_post_meta( $product_id, 'product_price', $_POST['product_price'] );
				}
				if ( isset( $_POST['product_quantity'] ) && $_POST['product_quantity'] != '' ) {
					if( is_numeric( $_POST['product_quantity'] ) )
					update_post_meta( $product_id, 'product_quantity', $_POST['product_quantity'] );
					else
						echo 'Invalid Product Quatity';
				}
			}
		}

		/*
		** Ajax Handle add products into the cart
		*/
		public function add_product_in_cart(){
			if( isset( $_POST['prod_id'] ) && $_POST['prod_id'] != '' ) {
				// global $wp_session[ 'cart_products' ] = array('prod_id' => 23);
				$prod_id = $_POST['prod_id'];
				$product = get_post( $prod_id );
				$get_sess = array();
				if( !empty($product) ){
					global $wp_session;
					if( isset( $wp_session[ 'cart_products' ] ) && !empty($wp_session[ 'cart_products' ]) ){
						$get_sess = $wp_session[ 'cart_products' ];
					}
					$sess_var = array( 'prod_id' => $prod_id, 'quantity' => 1 );
					$quantity = get_post_meta($prod_id, 'product_quantity', true);
					$wp_session['cart_products']= $sess_var;
					$get_sess = $wp_session[ 'cart_products' ];
					echo json_encode( $get_sess );
				}
			}
		}

	}
}

?>