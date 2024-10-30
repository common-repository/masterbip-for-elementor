<?php
namespace ElementorMbElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;


if (! defined('ABSPATH')) exit;

class MB_Banner_Masonry extends Widget_Base{
	public function get_name(){
		return 'banner_masonry';
	}
	/*
	* Widget Titulo
	*/
	public function get_title(){
		return __('Banner Masonry V1','masterbip');
	}
	/*
	* Widget Icono
	*/
	public function get_icon(){
		return 'eicon-gallery-masonry';
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
			'section_image',
			[
				'label' => __('Banner para galeria Masonry','masterbip'),
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __('Seleccionar Imagen','masterbip'),
				'type' => \Elementor\Controls_Manager::MEDIA,
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
				'label' => __('Texto','masterbip'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __('Texto del link','masterbip'),
				'placeholder' => __('Ingrese un Texto','masterbip'),
				'label_block' => true,
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
		$this->add_responsive_control(
			'alto',
			[
				'label' => __('Alto','masterbip'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px','%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .mb-banner-m' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'ancho',
			[
				'label' => __('Ancho','masterbip'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px','%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .mb-banner-m' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .overlay' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();
	}
	
	/* FRONTEND */
	protected function render(){
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
				
		$html = '<div class="mb-banner-m">';
		$html .= '<div class="mb-banner-m-img" style="background-image: url('.$image_src.');">';
		$html .= '<div class="overlay"></div>';
		$html .= '<a '.$this->get_render_attribute_string('link').' class="mb-banner-m-link">';		
		$html .= '<span class="mb-banner-m-text">'.$settings['title_text'].'</span>';
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
		
		var html = '<div class="mb-banner-m">';
		html += '<div class="mb-banner-m-img" style="background-image: url('+image_url+');">';
		html += '<div class="overlay"></div>';
		html += '<a href="'+settings.link.url+'" '+target+' '+nofollow+' class="mb-banner-m-link">';
		html += '<span class="mb-banner-m-text">'+settings.title_text+'</span>';
		html += '</a>';
		html += '</div>';
		html += '</div>';

		print(html);
		#>
		<?php
	}
}