<?php
namespace ElementorMbElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Controls_Stack;


if (! defined('ABSPATH')) exit;

class MB_Banner extends Widget_Base{
	public function get_name(){
		return 'banner';
	}
	/*
	* Widget Titulo
	*/
	public function get_title(){
		return __('Banner','masterbip');
	}
	/*
	* Widget Icono
	*/
	public function get_icon(){
		return 'eicon-button';
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
				'label' => __('Banner de Imagen con Texto','masterbip'),
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __('Seleccionar Imagen','masterbip'),
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
				'label' => __('Titulo','masterbip'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __('Texto','masterbip'),
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
		$this->end_controls_section();
	}
	
	/* FRONTEND */
	protected function render(){
		$settings = $this->get_settings_for_display();

		$html = '<div class="mbbanner">';		
// LINK
		$this->add_render_attribute('link','href',$settings['link']['url']);
		if ($settings['link']['is_external']){
			$this->add_render_attribute('link','target','_blank');
		}
		if (!empty($settings['link']['nofollow'])){
			$this->add_render_attribute('link','rel','nofollow');
		}
		$html .= '<a '.$this->get_render_attribute_string('link').' class="mbbanner-link">';		
// IMAGEN
		if (!empty( $settings['image']['url'])){
			$this->add_render_attribute('image','src',$settings['image']['url']);
			$this->add_render_attribute('image','alt',\Elementor\Control_Media::get_image_alt($settings['image']));
			$this->add_render_attribute('image','title',\Elementor\Control_Media::get_image_title($settings['image']));

			$html .= \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings,'thumbnail','image');
		}
// TEXTO
		$html .= '<span class="mbbanner-overlay"></span>';
		$html .= '<span class="mbbanner-text">'.$settings['title_text'].'</span>';
		$html .= '</a>';
		$html .= '</div>';
		
		echo $html;
	}
	
	/* EDITOR */
	protected function content_template(){
		?>
		<#
		var html = '<div class="mbbanner">';
		html += '<a href="'+settings.link.url+'">';
		var image = {
			id: settings.image.id,
			url: settings.image.url,
			size: settings.thumbnail_size,
			dimension: settings.thumbnail_custom_dimension,
			model: view.getEditModel()
		};
		var image_url = elementor.imagesManager.getImageUrl(image);
		html += '<img src="'+image_url+'"/>';
		html += '<span class="mbbanner-overlay"></span>';
		html += '<span class="mbbanner-text">'+settings.title_text+'</span>';
		html += '</a>';
		html += '</div>';

		print(html);
		#>
		<?php
	}
}