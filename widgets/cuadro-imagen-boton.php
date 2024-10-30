<?php
namespace ElementorMbElementor\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;


class MB_Cuadro_Imagen_Boton extends Widget_Base {
	public function get_name() {
		return 'cuadro_imagen_boton';
	}
	/*
	* Widget Titulo
	*/
	public function get_title() {
		return esc_html__( 'Cuadro de imagen con Botón','masterbip');
	}
	/*
	* Widget Icono
	*/
	public function get_icon() {
		return 'eicon-info-box';
	}
	/*
	* Widget Categoria
	*/
	public function get_categories(){
		return ['masterbip-ecat'];
	}
	/*
	* Widget Controls
	*/
	protected function register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Imagen','masterbip'),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Seleccionar Imagen','masterbip'),
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
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => esc_html__( 'Título','masterbip'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Este es el título','masterbip'),
				'placeholder' => esc_html__( 'Ingresa un Título','masterbip'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'description_text',
			[
				'label' => esc_html__( 'Contenido','masterbip'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño.','masterbip'),
				'placeholder' => esc_html__( 'Ingresa una descripción','masterbip'),
				'separator' => 'none',
				'rows' => 10,
				'show_label' => false,
			]
		);
		$this->add_control(
			'boton_text',
			[
				'label' => esc_html__( 'Texto Botón','masterbip'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Click Aquí','masterbip'),
				'placeholder' => esc_html__( 'Ingresa un Texto para el botóon','masterbip'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link','masterbip'),
				'type' => \Elementor\Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com','masterbip'),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_size',
			[
				'label' => esc_html__( 'Etiqueta del Título','masterbip'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->add_responsive_control(
			'position',
			[
				'label' => esc_html__( 'Posicion Botón', 'masterbip' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Izquierda', 'masterbip' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Centro', 'masterbip' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Derecha', 'masterbip' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor-position-',
				'toggle' => false,
			]
		);
		$this->end_controls_section();
	}

	/* FRONTEND */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute('link','href',$settings['link']['url']);
		if ($settings['link']['is_external']){
			$this->add_render_attribute('link','target','_blank');
		}
		if (!empty($settings['link']['nofollow'])){
			$this->add_render_attribute('link','rel','nofollow');
		}
		$attachment_id = $settings['image']['id'];
		$image_src = wp_kses_post( \Elementor\Group_Control_Image_Size::get_attachment_image_src($attachment_id,'thumbnail',$settings) );
		
		
		
		$html = '<div class="mb-image-box-button cover" style="background-image: url('.$image_src.');">';
		$html .= '<div class="overlay"></div>';
		$html .= '<div class="mb-image-box-button-content">';
		// Titulo
		if (!empty( $settings['title_text'] ) ) {
			$this->add_render_attribute( 'title_text', 'class', 'mb-image-box-button-title' );
			$this->add_inline_editing_attributes( 'title_text', 'none' );
			$title_html = $settings['title_text'];
			if ( ! empty( $settings['link']['url'] ) ) {
				$title_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $title_html . '</a>';
			}
			$html .= sprintf( '<%1$s %2$s>%3$s</%1$s>', \Elementor\Utils::validate_html_tag( $settings['title_size'] ), $this->get_render_attribute_string( 'title_text' ), $title_html );
		}
		// Descripcion
		if (!empty( $settings['description_text'] ) ) {
			$this->add_render_attribute( 'description_text', 'class', 'mb-image-box-button-descripcion' );
			$this->add_inline_editing_attributes( 'description_text' );
			$html .= sprintf( '<p %1$s>%2$s</p>', $this->get_render_attribute_string( 'description_text' ), $settings['description_text'] );
		}
		// Boton
		if (!empty( $settings['boton_text'] ) ) {
			
			if ( ! empty( $settings['link']['url'] ) ) {
				$html .= '<a ' . $this->get_render_attribute_string( 'link' ) . ' class="mb-image-box-button-button button">' . $settings['boton_text'] . '</a>';
			}
		}

		$html .= '</div>';
		$html .= '</div>';
		
		\Elementor\Utils::print_unescaped_internal_string( $html );
	}
	
	/* EDITOR */
	protected function content_template(){
	?>
	<#
	var target = settings.link.is_external ? ' target="_blank"' : '';
	var nofollow = settings.link.nofollow ? ' rel="nofollow"' : '';
	if ( settings.image.url ) {
		var image = {
			id: settings.image.id,
			url: settings.image.url,
			size: settings.thumbnail_size,
			dimension: settings.thumbnail_custom_dimension,
			model: view.getEditModel()
		};

		var image_url = elementor.imagesManager.getImageUrl( image );
	}

	var html = '<div class="mb-image-box-button" style="background-image: url('+image_url+');">';
	html += '<div class="overlay"></div>';
	html += '<div class="mb-image-box-button-content">';

	if ( settings.title_text ) {
		var title_html = settings.title_text,
		titleSizeTag = elementor.helpers.validateHTMLTag( settings.title_size );

		if ( settings.link.url ) {
			title_html = '<a href="' + settings.link.url + '">' + title_html + '</a>';
		}

		view.addRenderAttribute( 'title_text', 'class', 'mb-image-box-button-title' );

		view.addInlineEditingAttributes( 'title_text', 'none' );

		html += '<' + titleSizeTag  + ' ' + view.getRenderAttributeString( 'title_text' ) + '>' + title_html + '</' + titleSizeTag  + '>';
	}

	if ( settings.description_text ) {
		view.addRenderAttribute( 'description_text', 'class', 'mb-image-box-button-descripcion' );

		view.addInlineEditingAttributes( 'description_text' );

		html += '<p ' + view.getRenderAttributeString( 'description_text' ) + '>' + settings.description_text + '</p>';
	}

	if (settings.boton_text ) {
	   if ( settings.link.url ) {
	   	html += '<a href="' + settings.link.url + '" '+target+' '+nofollow+' class="mb-image-box-button-button button">' + settings.boton_text + '</a>';
	   }
	}

	html += '</div>';
	html += '</div>';

	print(html);
	#>
	<?php
	}
}