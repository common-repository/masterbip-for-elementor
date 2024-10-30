<?php
namespace ElementorMbElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;


if (! defined('ABSPATH')) exit;

class Super_Link extends Widget_Base {
	public function get_name(){
		return 'super_link';
	}
	/*
	* Widget Titulo
	*/
	public function get_title(){
		return __('Super Link','masterbip');
	}
	/*
	* Widget Icono
	*/
	public function get_icon(){
		return 'eicon-clone';
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
			'section_titulo',
			[
				'label' => __('Titulo','masterbip'),
			]
		);
		$this->add_control(
			'titulo',
			[
				'label' => 'Titulo',
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Titulo',
				'placeholder' => 'Ingrese Titulo',
				'label_block' => true,
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
			'texto',
			[
				'label' => '',
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
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_link',
			[
				'label' => __('Link','masterbip'),
			]
		);
		$this->add_control(
			'link',
			[
				'label' => 'Link del boton',
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://misitio.com',
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);
		$this->end_controls_section();
	}
	
	/* FRONTEND */
	protected function render(){
		$settings = $this->get_settings_for_display();
		
		$mbsl_titulo = $settings['titulo'];
		$mbsl_texto = $settings['texto'];
		$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
		
		$html = '<div class="mbsl">';
		$html .= '<div class="mbsl-wrap transicion">';
		$html .= '<a href="'.$settings['link']['url'].'"'.$target . $nofollow.'>';
		if(!empty($mbsl_titulo)){
			$html .= '<h2>'.$mbsl_titulo.'</h2>';
		}
		if(!empty($mbsl_texto)){
			$html .= '<p>'.$mbsl_texto.'</p>';
		}
		$html .= '</a>';
		$html .= '</div>';
		$html .= '</div>';
		
		echo $html;
	}
	
	/* EDITOR */
	protected function content_template(){
	?>
		<#
			var target = settings.link.is_external ? ' target="_blank"' : '';
			var nofollow = settings.link.nofollow ? ' rel="nofollow"' : '';
		   
			var html = '<div class="mbsl">';
			html += '<div class="mbsl-wrap transicion">';
			html += '<a href="'+settings.link.url+'" '+target+' '+nofollow+'>';
			if (settings.titulo){
				html += '<h3>'+settings.titulo+'</h3>';
			}
			if (settings.texto){
				html += '<p>'+settings.texto+'</p>';
			}
			html += '</a>';
			html += '</div>';
			html += '</div>';

			print(html);
		#>
	<?php
	}
}