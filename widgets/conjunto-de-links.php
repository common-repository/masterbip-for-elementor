<?php
namespace ElementorMbElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;


if (! defined('ABSPATH')) exit;

class Conjunto_De_Links extends Widget_Base {
	public function get_name(){
		return 'conjunto_de_links';
	}
	/*
	* Widget Titulo
	*/
	public function get_title(){
		return __('Conjunto De Links','masterbip');
	}
	/*
	* Widget Icono
	*/
	public function get_icon(){
		return 'eicon-form-vertical';
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
			'content_section',
			[
				'label' => __( 'Contenido', 'masterbip' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'btn_text', [
				'label' => __( 'Texto del Boton', 'masterbip' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Texto del Link' , 'masterbip' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'btn_url',
			[
				'label' => 'Link del boton',
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => '#',
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);

		$this->add_control(
			'btn_list',
			[
				'label' => __( 'Listado de Botones', 'masterbip' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'btn_text' => __( 'Texto #1', 'masterbip' ),
						'btn_url' => __( '#', 'masterbip' ),
					],
					[
						'btn_text' => __( 'Texto #2', 'masterbip' ),
						'btn_url' => __( '#', 'masterbip' ),
					],
				],
				'title_field' => '{{{ btn_text }}}',
			]
		);

		$this->end_controls_section();

	}
	
	/* FRONTEND */
	protected function render(){
		$settings = $this->get_settings_for_display();

		if ( $settings['btn_list'] ) {
			foreach (  $settings['btn_list'] as $item ) {
				$url = $item['btn_url']['url'];
				$target = $item['btn_url']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $item['btn_url']['nofollow'] ? ' rel="nofollow"' : '';
				echo '<a class="button button-list-item button-list-item-' . $item['_id'] . '" href="'.$url.'"'.$target . $nofollow.'><span>' . $item['btn_text'] . '</span></a>';
			}
		}
	}

	protected function content_template() {
		?>
		<# if ( settings.btn_list.length ) { #>
			<#
			   _.each( settings.btn_list, function( item ) {
			#>
			<#
			   var url = item.btn_url.url;
			   var target = item.btn_url.is_external ? ' target="_blank"' : '';
			   var nofollow = item.btn_url.nofollow ? ' rel="nofollow"' : '';
			#>
				<a class="button button-list-item button-list-item-{{{ item._id }}}" href="{{{ url }}}" {{{ target }}} {{{ nofollow }}}><span>{{{ item.btn_text }}}</span></a>
			<# }); #>
		<# } #>
		<?php
	}
}