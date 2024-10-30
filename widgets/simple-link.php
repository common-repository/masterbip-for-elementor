<?php
namespace ElementorMbElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;


if (! defined('ABSPATH')) exit;

class Simple_Link extends Widget_Base {
	public function get_name(){
		return 'simple_link';
	}
	/*
	* Widget Titulo
	*/
	public function get_title(){
		return __('Simple Link','masterbip');
	}
	/*
	* Widget Icono
	*/
	public function get_icon(){
		return 'eicon-editor-link';
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
			'section_texto',
			[
				'label' => __('Texto','masterbip'),
			]
		);
		$this->add_control(
			'texto',
			[
				'label' => 'Texto',
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Texto',
				'placeholder' => 'Texto del Boton',
				'label_block' => true,
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
		
		$mbsl_texto = $settings['texto'];
		$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
		
		$html = '<div class="mb-elementor-simple-link">';
		$html .= '<a href="'.$settings['link']['url'].'"'.$target . $nofollow.'>';
		if(!empty($mbsl_texto)){
			$html .= '<span>'.$mbsl_texto.'</span>';
		}
		$html .= '</a>';
		$html .= '</div>';
		
		
		echo $html;
	}
	
	/* EDITOR */
	protected function content_template(){
		?>
		<#
			var target = settings.link.is_external ? ' target="_blank"' : '';
			var nofollow = settings.link.nofollow ? ' rel="nofollow"' : '';

			var html = '<div class="mb-elementor-simple-link">';
			html += '<a href="'+settings.link.url+'" '+target+' '+nofollow+'>';
			html += '<span>'+settings.texto+'</span>';
			html += '</a>';
			html += '</div>';
			print(html);
		#>
		<?php
	}
}