<?php
namespace ElementorMbElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;


if (! defined('ABSPATH')) exit;

class Boton_Dual extends Widget_Base{
	public function get_name(){
		return 'boton_dual';
	}
	/*
	* Widget Titulo
	*/
	public function get_title(){
		return __('Boton Dual','masterbip');
	}
	/*
	* Widget Icono
	*/
	public function get_icon(){
		return 'eicon-post-navigation';
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
	* Widget controls
	*/
	protected function register_controls(){
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Link Izquierdo','masterbip'),
			]
		);
		$this->add_control(
			'texto_01',
			[
				'label' => __('Texto 01','masterbip'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Texto','masterbip'),
			]
		);
		$this->add_control(
			'link_01',
			[
				'label' => __('URL','masterbip'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://misitio.com','masterbip'),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_02',
			[
				'label' => __('Link Derecho','masterbip'),
			]
		);
		$this->add_control(
			'texto_02',
			[
				'label' => __('Texto','masterbip'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Texto','masterbip'),
			]
		);
		$this->add_control(
			'link_02',
			[
				'label' => __('URL','masterbip'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://misitio.com','masterbip'),
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
		
		$target_01 = $settings['link_01']['is_external'] ? ' target="_blank"' : '';
		$nofollow_01 = $settings['link_01']['nofollow'] ? ' rel="nofollow"' : '';
		$target_02 = $settings['link_02']['is_external'] ? ' target="_blank"' : '';
		$nofollow_02 = $settings['link_02']['nofollow'] ? ' rel="nofollow"' : '';
		
		$html = '<div class="mb-dual-btn-wrap"><div class="mb-dual-btn">';
		$html .= '<a href="'.$settings['link_01']['url'] . '"'.$target_01 . $nofollow_01 . ' class="mb-dual-btn-l">'.$settings['texto_01'].'</a>';
		$html .= '<span></span>';
		$html .= '<a href="'.$settings['link_02']['url'] . '"'.$target_02 . $nofollow_02 . ' class="mb-dual-btn-r">'.$settings['texto_02'].'</a>';
		$html .= '</div></div>';
		
		echo $html;
	}
	
	/* EDITOR */
	protected function content_template(){
		?>
		<#
		var target_01 = settings.link_01.is_external ? ' target="_blank"' : '';
		var nofollow_01 = settings.link_01.nofollow ? ' rel="nofollow"' : '';
		var target_02 = settings.link_02.is_external ? ' target="_blank"' : '';
		var nofollow_02 = settings.link_02.nofollow ? ' rel="nofollow"' : '';
		   
	   var html = '<div class="mb-dual-btn-wrap"><div class="mb-dual-btn">';
	   html += '<a href="'+settings.link_01.url+'" '+target_01+' '+nofollow_01+' class="mb-dual-btn-l">'+settings.texto_01+'</a>';
	   html += '<span></span>';
	   html += '<a href="'+settings.link_02.url+'" '+target_02+' '+nofollow_02+' class="mb-dual-btn-l">'+settings.texto_02+'</a>';
	   html += '</div></div>';

	   print(html);
		#>
		<?php
	}
}
