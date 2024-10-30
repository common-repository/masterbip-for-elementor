<?php
namespace ElementorMbElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;


if (! defined('ABSPATH')) exit;

class Texto_En_Circulo extends Widget_Base {
	public function get_name(){
		return 'texto_en_circulo';
	}
	/*
	* Widget Titulo
	*/
	public function get_title(){
		return __('Texto en Circulo','masterbip');
	}
	/*
	* Widget Icono
	*/
	public function get_icon(){
		return 'eicon-alert';
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
			'section_content',
			[
				'label' => __('Contenido','masterbip'),
			]
		);

		$this->add_control(
			'titulo',
			[
				'label' => __('Titulo','masterbip'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Titulo','masterbip'),
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
		$this->add_responsive_control(
			'tamanio',
			[
				'label' => __('Tamaño','masterbip'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 300,
						'max' => 1000,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .mbctc' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'tit_color',
			[
				'label' => __( 'Color de titulo', 'masterbip' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} h2' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'txt_color',
			[
				'label' => __( 'Color del texto', 'masterbip' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'fondo',
			[
				'label' => __( 'Color de fondo', 'masterbip' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .mbctc' => 'background-color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_section();
	}
	
	/* FRONTEND */
	protected function render(){
		
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes( 'titulo', 'none' );
		$this->add_inline_editing_attributes( 'contenido', 'none' );
		
		$html = '<div class="mbctc">';
		$html .= '<div class="mbctc-contenido">';
		$html .= '<h2 '.$this->get_render_attribute_string('titulo').'>'.$settings['titulo'].'</h2>';
		$html .= '<p '.$this->get_render_attribute_string('contenido').'>'.$settings['contenido'].'</p>';
		$html .= '</div>';
		$html .= '</div>';
		
		echo $html;
	}
	
	/* EDITOR */
	protected function content_template(){
	?>
	<#
		var size = settings.tamanio.size;
		var unit = settings.tamanio.unit;

		html = '<div class="mbctc">';
		html += '<div class="mbctc-contenido">';
		html += '<h2>'+settings.titulo+'</h2>';
		html += '<p>'+settings.contenido+'</p>';
		html += '</div>';
		html += '</div>';

		print(html);
	#>
	<?php
	}
}
