<?php
namespace Elementor;

function category_elementor_init(){
    Plugin::instance()->elements_manager->add_category(
        'masterbip-ecat',
        [
            'title'  => 'MasterBip',
        ],
        1
    );
}
add_action('elementor/init', 'Elementor\category_elementor_init');