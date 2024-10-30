<?php
namespace ElementorMbElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;


if (! defined('ABSPATH')) exit;

class Titulo_Subtitulo_Bajada extends Widget_Base {
	public function get_name(){
		return 'titulo_subtitulo_bajada';
	}
	/*
	* Widget Titulo
	*/
	public function get_title(){
		return __('Titulo con Subtitulo y Bajada','masterbip' );
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
				'label_block' => true,
				'rows' => 4,
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
				'default' => 'Subtitulo.',
				'placeholder' => 'Ingrese Subtitulo',
				'label_block' => true,
				'rows' => 4,
			]
		);
		$this->add_control(
			'bajada',
			[
				'label' => 'Bajada',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño.',
				'placeholder' => 'Ingrese Contenido de la Bajada',
				'label_block' => true,
				'rows' => 10,
			]
		);
		$this->add_control(
			'alineacion',
			[
				'label'			=> 'Alineación',
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
		
		$mbtsb_titulo = $settings['titulo'];
		$mbtsb_subtitulo = $settings['subtitulo'];
		$mbtsb_bajada = $settings['bajada'];
		
		$html = '<div class="mbtsb" style="text-align:'.$settings['alineacion'].';">';
		$html .= '<div class="mbtsb-wrap">';
		if(!empty($mbtsb_titulo)){
			$html .= '<div class="titulo">';
				$html .= '<h2><span>'.$mbtsb_titulo.'</span></h2>';
			$html .= '</div>';
		}
		if(!empty($mbtsb_subtitulo)){
			$html .= '<div class="subtitulo">';
				$html .= '<h3><span>'.$mbtsb_subtitulo.'</span></h3>';
			$html .= '</div>';
		}
		if(!empty($mbtsb_bajada)){
			$html .= '<div class="bajada">';
				$html .= '<p>'.$mbtsb_bajada.'</p>';
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
			var html = '<div class="mbtsb" style="text-align:'+settings.alineacion+';">';
			html += '<div class="mbtsb-wrap">';
			if (settings.titulo) {
				html += '<div class="titulo">';
				html += '<h2><span>'+settings.titulo+'</span></h2>';
				html += '</div>';
			}
			if (settings.subtitulo) {
				html += '<div class="subtitulo">';
				html += '<h3><span>'+settings.subtitulo+'</span></h3>';
				html += '</div>';
			}
			if (settings.bajada) {
				html += '<div class="bajada">';
				html += '<p>'+settings.bajada+'</p>';
				html += '</div>';
			}
			html += '</div>';
			html += '</div>';

			print(html);
		#>				
	<?php
	}
	}