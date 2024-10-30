<?php
namespace ElementorMbElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;


if (! defined('ABSPATH')) exit;

class Cuadro_Imagen_Hover extends Widget_Base {
	public function get_name(){
		return 'cuadro_imagen_hover';
	}
	/*
	* Widget Titulo
	*/
	public function get_title(){
		return __('Cuadro Imagen Hover','masterbip');
	}
	/*
	* Widget Icono
	*/
	public function get_icon(){
		return 'eicon-image-rollover';
	}
	/*
	* Widget Categoria
	*/
	public function get_categories(){
		return ['masterbip-ecat'];
	}
	
	public function get_script_depends(){
		return ['elementor-masterbip'];
	}
	/*
	* Widget Controls
	*/
	protected function register_controls(){
		$this->start_controls_section(
			'section_image_01',
			[
				'label' => __('Imagen Inicial','masterbip'),
			]
		);
		$this->add_control(
			'image_01',
			[
				'label' => __('Seleccionar Imagen','masterbip'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'tamano01', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_image_02',
			[
				'label' => __('Imagen Secundaria','masterbip'),
			]
		);
		$this->add_control(
			'image_02',
			[
				'label' => __('Seleccionar Imagen','masterbip'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'tamano02', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_contenido',
			[
				'label' => __('Contenido','masterbip'),
			]
		);
		$this->add_control(
			'titulo',
			[
				'label' => __('Titulo','masterbip'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __('Texto','masterbip'),
				'placeholder' => __('Ingrese un Texto','masterbip'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'contenido',
			[
				'label' => 'Contenido',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño.',
				'placeholder' => 'Ingrese contenido',
				'rows' => 10,
				'separator' => 'none',
				'show_label' => false,
			]
		);
		$this->add_control(
			'link',
			[
				'label' => __('Link','masterbip'),
				'type' => \Elementor\Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
				'placeholder' => __('https://your-link.com','masterbip'),
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
	}
	
	/* FRONTEND */
	protected function render(){
		$settings = $this->get_settings_for_display();

		$html = '<div class="mb-image-box-hover">';		
// LINK
		$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
		if ($settings['link']['is_external'] ) {
			$this->add_render_attribute( 'link', 'target', '_blank' );
		}
		if (! empty( $settings['link']['nofollow'])){
			$this->add_render_attribute( 'link', 'rel', 'nofollow' );
		}
		$html .= '<a '.$this->get_render_attribute_string( 'link' ) . ' class="mb-image-box-hover-img-link">';		
// IMAGEN 01
		if (! empty( $settings['image_01']['url'])){
			$this->add_render_attribute( 'image_01', 'src', $settings['image_01']['url'] );
			$this->add_render_attribute( 'image_01', 'alt', \Elementor\Control_Media::get_image_alt( $settings['image_01'] ) );
			$this->add_render_attribute( 'image_01', 'title', \Elementor\Control_Media::get_image_title( $settings['image_01'] ) );

			$html .= \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'tamano01', 'image_01' );
		}		
// IMAGEN 02
		if (! empty( $settings['image_02']['url'])){
			$this->add_render_attribute( 'image_02', 'src', $settings['image_02']['url'] );
			$this->add_render_attribute( 'image_02', 'alt', \Elementor\Control_Media::get_image_alt( $settings['image_02'] ) );
			$this->add_render_attribute( 'image_02', 'title', \Elementor\Control_Media::get_image_title( $settings['image_02'] ) );

			$html .= \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'tamano02', 'image_02' );
		}
// TEXTO
		$html .= '</a>';
		$html .= '<a '.$this->get_render_attribute_string( 'link' ) . ' class="mb-image-box-hover-content-link">';
		$html .= '<h3 class="mb-image-box-titulo">'.$settings['titulo'].'</h3>';
		$html .= '<p class="mb-image-box-contenido">'.$settings['contenido'].'</p>';
		$html .= '</a>';
		$html .= '</div>';
		
		echo $html;
	}
	
	/* EDITOR */
	protected function content_template(){
		?>
		<#		   
		var html = '<div class="mb-image-box-hover">';
		html += '<a href="' + settings.link.url + '" class="mb-image-box-hover-img-link">';
		var image_01 = {
			url: settings.image_01.url,
			size: settings.tamano_01_size,
			dimension: settings.tamano_01_custom_dimension,
			model: view.getEditModel()
		};
		var image_02 = {
			url: settings.image_02.url,
			size: settings.tamano02_size,
			dimension: settings.tamano02_custom_dimension,
			model: view.getEditModel()
		};
		var image_url_01 = elementor.imagesManager.getImageUrl( image_01 );
		var image_url_02 = elementor.imagesManager.getImageUrl( image_02 );
		
		html += '<img src="' + image_url_01 + '" />';
		html += '<img src="' + image_url_02 + '" />';
		
		html += '</a>';
		html += '<a href="' + settings.link.url + '" class="mb-image-box-hover-content-link">';
		html += '<h3 class="mb-image-box-titulo">' + settings.titulo + '</h3>';
		html += '<p class="mb-image-box-contenido">' + settings.contenido + '</p>';
		html += '</a>';
		html += '</div>';

		print( html );
		#>
		<?php
	}
}