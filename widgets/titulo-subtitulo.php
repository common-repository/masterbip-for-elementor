<?php
namespace ElementorMbElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;


if (! defined('ABSPATH')) exit;

class Titulo_Subtitulo extends Widget_Base {
	public function get_name(){
		return 'titulo_subtitulo';
	}
	/*
	* Widget Titulo
	*/
	public function get_title(){
		return __('Titulo con Subtitulo','masterbip' );
	}
	/*
	* Widget Icono
	*/
	public function get_icon(){
		return 'eicon-heading';
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
				'label' => __('Contenido','masterbip'),
			]
		);
		$this->add_control(
			'titulo',
			[
				'label' => 'Titulo',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Titulo',
				'placeholder' => 'Ingrese Titulo',
				'rows' => 4,
				'label_block' => true,
			]
		);
		$this->add_control(
			'subtitulo',
			[
				'label' => 'Subtitulo',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño.',
				'placeholder' => 'Ingrese contenido',
				'rows' => 10,
				'label_block' => true,
			]
		);
		$this->add_control(
			'alineacion',
			[
				'label'			=> 'Alineacion',
				'type'			=> \Elementor\Controls_Manager::CHOOSE,
				'options'		=> [
								'left'		=> [
											'title'		=> 'Izquierda',
											'icon'		=> 'eicon-text-align-left',
								],
								'center'	=> [
											'title'		=> 'Centro',
											'icon'		=> 'eicon-text-align-center',
								],
								'right'		=> [
											'title'		=> 'Derecha',
											'icon'		=> 'eicon-text-align-right',
								],
				],
			]
		);
		$this->end_controls_section();
	}
	
	/* FRONTEND */
	protected function render(){
		$settings = $this->get_settings_for_display();
		
		$mbts_titulo = $settings['titulo'];
		$mbts_subtitulo = $settings['subtitulo'];
		
		$html = '<div class="mbts" style="text-align:'.$settings['alineacion'].';">';
		$html .= '<div class="mbts-wrap">';
		if(!empty($mbts_titulo)){
			$html .= '<div class="titulo">';
				$html .= '<h2><span>'.$mbts_titulo.'</span></h2>';
			$html .= '</div>';
		}
		if(!empty($mbts_subtitulo)){
			$html .= '<div class="subtitulo">';
				$html .= '<p>'.$mbts_subtitulo.'</p>';
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
			var html = '<div class="mbts" style="text-align:'+settings.alineacion+';">';
			html += '<div class="mbts-wrap">';
			if (settings.titulo) {
				html += '<div class="titulo">';
				html += '<h2><span>'+settings.titulo+'</span></h3>';
				html += '</div>';
			}
			if (settings.subtitulo) {
				html += '<div class="subtitulo">';
				html += '<p>'+settings.subtitulo+'</p>';
				html += '</div>';
			}
			html += '</div>';
			html += '</div>';

			print(html);
		#>				
	<?php
	}
	}