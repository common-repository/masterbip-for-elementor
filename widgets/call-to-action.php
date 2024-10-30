<?php
namespace ElementorMbElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;


if (! defined('ABSPATH')) exit;

class Call_To_Action extends Widget_Base {
	public function get_name(){
		return 'call_to_action';
	}
	/*
	* Widget Titulo
	*/
	public function get_title(){
		return __('Call To Action','masterbip');
	}
	/*
	* Widget Icono
	*/
	public function get_icon(){
		return 'eicon-call-to-action';
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
			'section_contenido',
			[
				'label' => 'Contenido',
			]
		);
		$this->add_control(
			'titulo',
			[
				'label' => 'Título',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Título','masterbip'),
			]
		);
		$this->add_control(
			'texto',
			[
				'label' => 'Texto bajo título',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => '6',
				'default' => __('Texto bajo título','masterbip'),
				'placeholder' => __('Ingrese un texto','masterbip'),
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_boton',
			[
				'label' => 'Boton',
			]
		);
		$this->add_control(
			'btn_txt',
			[
				'label' => 'Texto',
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => 'Ingrese un texto para el botón',
				'default' => __('Boton','masterbip'),
			]
		);
		$this->add_control(
			'link',
			[
				'label' => 'Link del boton',
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => 'url',
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
		
		$mbcta_titulo = $settings['titulo'];
		$mbcta_texto = $settings['texto'];
		$mbcta_boton = $settings['btn_txt'];
		
		$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
		
		$html = '<div class="mb-cta">';
		$html .= '<div class="mb-cta-content">';
		$html .= '<div class="mb-cta-col mb-cta-col-01">';
		if(!empty($mbcta_titulo)){
			$html .= '<h2>'.$mbcta_titulo.'</h2>';
		}
		if(!empty($mbcta_texto)){
			$html .= '<p>'.$mbcta_texto.'</p>';
		}
		$html .= '</div>';
		if(!empty($mbcta_boton)){
			$html .= '<div class="mb-cta-col mb-cta-col-02">';
			$html .= '<a href="'.$settings['link']['url'].'"'.$target . $nofollow.' class="mb-cta-boton button">'.$settings['btn_txt'].'</a>';
			$html .= '</div>';
			
		}
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

			var html = '<div class="mb-cta">';
			html += '<div class="mb-cta-content">';
			html += '<div class="mb-cta-col mb-cta-col-01">';
			html += '<h2>'+settings.titulo+'</h2>';
			html += '<p>'+settings.texto+'</p>';
			html += '</div>';
			html += '<div class="mb-cta-col mb-cta-col-02">';
			html += '<a href="'+settings.link.url+'" '+target+' '+nofollow+' class="mb-cta-boton button">'+settings.btn_txt+'</a>';
			html += '</div>';
			html += '</div>';
			html += '</div>';

			print(html);
		#>
		<?php
	}
}