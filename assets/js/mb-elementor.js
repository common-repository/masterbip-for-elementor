( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 
	var MasterBipWidgetHandler = function( $scope, $ ) {
		console.log( $scope );
	};
	$( window ).on( 'elementor/frontend/init', function(){
		elementorFrontend.hooks.addAction( 'frontend/element_ready/mb_banner.default', MasterBipWidgetHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/mb_banner_masonry.default', MasterBipWidgetHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/mb_banner_masonry_v2.default', MasterBipWidgetHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/mb_banner_masonry_v3.default', MasterBipWidgetHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/mb_banner_masonry_v4.default', MasterBipWidgetHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/boton_dual.default', MasterBipWidgetHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/call_to_action.default', MasterBipWidgetHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/conjunto_de_links.default', MasterBipWidgetHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/cuadro_imagen_boton.default', MasterBipWidgetHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/cuadro_imagen_hover.default', MasterBipWidgetHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/simple_link.default', MasterBipWidgetHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/super_link.default', MasterBipWidgetHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/texto_en_circulo.default', MasterBipWidgetHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/titulo_subtitulo.default', MasterBipWidgetHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/titulo_subtitulo_bajada.default', MasterBipWidgetHandler );
	} );
	
} )( jQuery );
