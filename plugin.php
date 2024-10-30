<?php
namespace ElementorMbElementor;

class Plugin {
	private static $_instance = null;
	public static function instance(){
		if (is_null( self::$_instance)){
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	public function widget_scripts(){
		// JS
		wp_register_script( 'mbe-general', plugins_url( '/assets/js/mb-elementor.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_script('mbe-general');
		
		// CSS
		wp_register_style('elementor-masterbip-css', plugins_url('/assets/css/mb-elementor.css',__FILE__));
		wp_enqueue_style('elementor-masterbip-css');
	}
	private function include_widgets_files(){
		require_once( __DIR__ . '/widgets/banner.php');
		require_once( __DIR__ . '/widgets/banner-masonry.php');
		require_once( __DIR__ . '/widgets/banner-masonry-v2.php');
		require_once( __DIR__ . '/widgets/banner-masonry-v3.php');
		require_once( __DIR__ . '/widgets/banner-masonry-v4.php');
		require_once( __DIR__ . '/widgets/boton-dual.php');
		require_once( __DIR__ . '/widgets/call-to-action.php');
		require_once( __DIR__ . '/widgets/conjunto-de-links.php');
		require_once( __DIR__ . '/widgets/cuadro-imagen-boton.php');
		require_once( __DIR__ . '/widgets/cuadro-imagen-hover.php');
		require_once( __DIR__ . '/widgets/simple-link.php');
		require_once( __DIR__ . '/widgets/super-link.php');
		require_once( __DIR__ . '/widgets/texto-en-circulo.php');
		require_once( __DIR__ . '/widgets/titulo-subtitulo.php');
		require_once( __DIR__ . '/widgets/titulo-subtitulo-bajada.php');
	}
	public function register_widgets(){
		$this->include_widgets_files();
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MB_Banner());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MB_Banner_Masonry());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MB_Banner_Masonry_v2());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MB_Banner_Masonry_v3());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MB_Banner_Masonry_v4());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Boton_Dual());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Call_To_Action());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Conjunto_De_Links());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MB_Cuadro_Imagen_Boton());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Cuadro_Imagen_Hover());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Simple_Link());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Super_Link());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Texto_En_Circulo());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Titulo_Subtitulo());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Titulo_Subtitulo_Bajada());
	}
	public function __construct(){
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}
}
Plugin::instance();
