<?php
/**
 * Customizer Typography Control
 * @package Amble
 * @since 2.0.0
 * 
 * Taken from Kirki.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( ! class_exists( 'Amble_Typography_Control' ) ) {
    
    class Amble_Typography_Control extends WP_Customize_Control {
    
    	public $tooltip = '';
    	public $js_vars = array();
    	public $output = array();
    	public $option_type = 'theme_mod';
    	public $type = 'typography';
    
    	/**
    	 * Refresh the parameters passed to the JavaScript via JSON.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function to_json() {
    		parent::to_json();
    
    		if ( isset( $this->default ) ) {
    			$this->json['default'] = $this->default;
    		} else {
    			$this->json['default'] = $this->setting->default;
    		}
    		$this->json['js_vars'] = $this->js_vars;
    		$this->json['output']  = $this->output;
    		$this->json['value']   = $this->value();
    		$this->json['choices'] = $this->choices;
    		$this->json['link']    = $this->get_link();
    		$this->json['tooltip'] = $this->tooltip;
    		$this->json['id']      = $this->id;
    		$this->json['l10n']    = apply_filters( 'amble-typography-control/il8n/strings', array(
    			'on'                 => esc_attr__( 'ON', 'amble' ),
    			'off'                => esc_attr__( 'OFF', 'amble' ),
    			'all'                => esc_attr__( 'All', 'amble' ),
    			'cyrillic'           => esc_attr__( 'Cyrillic', 'amble' ),
    			'cyrillic-ext'       => esc_attr__( 'Cyrillic Extended', 'amble' ),
    			'devanagari'         => esc_attr__( 'Devanagari', 'amble' ),
    			'greek'              => esc_attr__( 'Greek', 'amble' ),
    			'greek-ext'          => esc_attr__( 'Greek Extended', 'amble' ),
    			'khmer'              => esc_attr__( 'Khmer', 'amble' ),
    			'latin'              => esc_attr__( 'Latin', 'amble' ),
    			'latin-ext'          => esc_attr__( 'Latin Extended', 'amble' ),
    			'vietnamese'         => esc_attr__( 'Vietnamese', 'amble' ),
    			'hebrew'             => esc_attr__( 'Hebrew', 'amble' ),
    			'arabic'             => esc_attr__( 'Arabic', 'amble' ),
    			'bengali'            => esc_attr__( 'Bengali', 'amble' ),
    			'gujarati'           => esc_attr__( 'Gujarati', 'amble' ),
    			'tamil'              => esc_attr__( 'Tamil', 'amble' ),
    			'telugu'             => esc_attr__( 'Telugu', 'amble' ),
    			'thai'               => esc_attr__( 'Thai', 'amble' ),
    			'serif'              => _x( 'Serif', 'font style', 'amble' ),
    			'sans-serif'         => _x( 'Sans Serif', 'font style', 'amble' ),
    			'monospace'          => _x( 'Monospace', 'font style', 'amble' ),
    			'font-family'        => esc_attr__( 'Font Family', 'amble' ),
    			'font-size'          => esc_attr__( 'Font Size', 'amble' ),
    			'font-weight'        => esc_attr__( 'Font Weight', 'amble' ),
    			'line-height'        => esc_attr__( 'Line Height', 'amble' ),
    			'font-style'         => esc_attr__( 'Font Style', 'amble' ),
    			'letter-spacing'     => esc_attr__( 'Letter Spacing', 'amble' ),
    			'text-align'         => esc_attr__( 'Text Align', 'amble' ),
    			'text-transform'     => esc_attr__( 'Text Transform', 'amble' ),
    			'none'               => esc_attr__( 'None', 'amble' ),
    			'uppercase'          => esc_attr__( 'Uppercase', 'amble' ),
    			'lowercase'          => esc_attr__( 'Lowercase', 'amble' ),
    			'top'                => esc_attr__( 'Top', 'amble' ),
    			'bottom'             => esc_attr__( 'Bottom', 'amble' ),
    			'left'               => esc_attr__( 'Left', 'amble' ),
    			'right'              => esc_attr__( 'Right', 'amble' ),
    			'center'             => esc_attr__( 'Center', 'amble' ),
    			'justify'            => esc_attr__( 'Justify', 'amble' ),
    			'color'              => esc_attr__( 'Color', 'amble' ),
    			'select-font-family' => esc_attr__( 'Select a font-family', 'amble' ),
    			'variant'            => esc_attr__( 'Variant', 'amble' ),
    			'style'              => esc_attr__( 'Style', 'amble' ),
    			'size'               => esc_attr__( 'Size', 'amble' ),
    			'height'             => esc_attr__( 'Height', 'amble' ),
    			'spacing'            => esc_attr__( 'Spacing', 'amble' ),
    			'ultra-light'        => esc_attr__( 'Ultra-Light 100', 'amble' ),
    			'ultra-light-italic' => esc_attr__( 'Ultra-Light 100 Italic', 'amble' ),
    			'light'              => esc_attr__( 'Light 200', 'amble' ),
    			'light-italic'       => esc_attr__( 'Light 200 Italic', 'amble' ),
    			'book'               => esc_attr__( 'Book 300', 'amble' ),
    			'book-italic'        => esc_attr__( 'Book 300 Italic', 'amble' ),
    			'regular'            => esc_attr__( 'Normal 400', 'amble' ),
    			'italic'             => esc_attr__( 'Normal 400 Italic', 'amble' ),
    			'medium'             => esc_attr__( 'Medium 500', 'amble' ),
    			'medium-italic'      => esc_attr__( 'Medium 500 Italic', 'amble' ),
    			'semi-bold'          => esc_attr__( 'Semi-Bold 600', 'amble' ),
    			'semi-bold-italic'   => esc_attr__( 'Semi-Bold 600 Italic', 'amble' ),
    			'bold'               => esc_attr__( 'Bold 700', 'amble' ),
    			'bold-italic'        => esc_attr__( 'Bold 700 Italic', 'amble' ),
    			'extra-bold'         => esc_attr__( 'Extra-Bold 800', 'amble' ),
    			'extra-bold-italic'  => esc_attr__( 'Extra-Bold 800 Italic', 'amble' ),
    			'ultra-bold'         => esc_attr__( 'Ultra-Bold 900', 'amble' ),
    			'ultra-bold-italic'  => esc_attr__( 'Ultra-Bold 900 Italic', 'amble' ),
    			'invalid-value'      => esc_attr__( 'Invalid Value', 'amble' ),
    		) );
    
    		$defaults = array( 'font-family'=> false );
    
    		$this->json['default'] = wp_parse_args( $this->json['default'], $defaults );
    	}
    
    	/**
    	 * Enqueue scripts and styles.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function enqueue() {
    		wp_enqueue_style( 'amble-typography', get_template_directory_uri() . '/inc/customizer/custom-controls/typography/typography.css', null );
            /*
    		 * JavaScript
    		 */
            wp_enqueue_script( 'jquery-ui-core' );
    		wp_enqueue_script( 'jquery-ui-tooltip' );
    		wp_enqueue_script( 'jquery-stepper-min-js' );
    		
    		// Selectize
    		wp_enqueue_script( 'selectize', get_template_directory_uri() . '/inc/js/selectize.js', array( 'jquery' ), false, true );
    
    		// Typography
    		wp_enqueue_script( 'amble-typography', get_template_directory_uri() . '/inc/customizer/custom-controls/typography/typography.js', array(
    			'jquery',
    			'selectize'
    		), false, true );
    
    		$google_fonts   = Amble_Fonts::get_google_fonts();
    		$standard_fonts = Amble_Fonts::get_standard_fonts();
    		$all_variants   = Amble_Fonts::get_all_variants();
    
    		$standard_fonts_final = array();
    		foreach ( $standard_fonts as $key => $value ) {
    			$standard_fonts_final[] = array(
    				'family'      => $key,
    				'label'       => $value['label'],
    				'is_standard' => true,
    				'variants'    => array(
    					array(
    						'id'    => 'regular',
    						'label' => $all_variants['regular'],
    					),
    					array(
    						'id'    => 'italic',
    						'label' => $all_variants['italic'],
    					),
    					array(
    						'id'    => '700',
    						'label' => $all_variants['700'],
    					),
    					array(
    						'id'    => '700italic',
    						'label' => $all_variants['700italic'],
    					),
    				),
    			);
    		}
    
    		$google_fonts_final = array();
    
    		if ( is_array( $google_fonts ) ) {
    			foreach ( $google_fonts as $family => $args ) {
    				$label    = ( isset( $args['label'] ) ) ? $args['label'] : $family;
    				$variants = ( isset( $args['variants'] ) ) ? $args['variants'] : array( 'regular', '700' );
    
    				$available_variants = array();
    				foreach ( $variants as $variant ) {
    					if ( array_key_exists( $variant, $all_variants ) ) {
    						$available_variants[] = array( 'id' => $variant, 'label' => $all_variants[ $variant ] );
    					}
    				}
    
    				$google_fonts_final[] = array(
    					'family'   => $family,
    					'label'    => $label,
    					'variants' => $available_variants
    				);
    			}
    		}
    
    		$final = array_merge( $standard_fonts_final, $google_fonts_final );
    		wp_localize_script( 'amble-typography', 'amble_all_fonts', $final );
    	}
    
    	/**
    	 * An Underscore (JS) template for this control's content (but not its container).
    	 *
    	 * Class variables for this control class are available in the `data` JS object;
    	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
    	 *
    	 * I put this in a separate file because PhpStorm didn't like it and it fucked with my formatting.
    	 *
    	 * @see    WP_Customize_Control::print_template()
    	 *
    	 * @access protected
    	 * @return void
    	 */
    	protected function content_template() { ?>
    		<# if ( data.tooltip ) { #>
                <a href="#" class="tooltip hint--left" data-hint="{{ data.tooltip }}"><span class='dashicons dashicons-info'></span></a>
            <# } #>
            
            <label class="customizer-text">
                <# if ( data.label ) { #>
                    <span class="customize-control-title">{{{ data.label }}}</span>
                <# } #>
                <# if ( data.description ) { #>
                    <span class="description customize-control-description">{{{ data.description }}}</span>
                <# } #>
            </label>
            
            <div class="wrapper">
                <# if ( data.default['font-family'] ) { #>
                    <# if ( '' == data.value['font-family'] ) { data.value['font-family'] = data.default['font-family']; } #>
                    <# if ( data.choices['fonts'] ) { data.fonts = data.choices['fonts']; } #>
                    <div class="font-family">
                        <h5>{{ data.l10n['font-family'] }}</h5>
                        <select id="typography-font-family-{{{ data.id }}}" placeholder="{{ data.l10n['select-font-family'] }}"></select>
                    </div>
                    <div class="variant variant-wrapper">
                        <h5>{{ data.l10n['style'] }}</h5>
                        <select class="variant" id="typography-variant-{{{ data.id }}}"></select>
                    </div>
                <# } #>   
                
            </div>
            <?php
    	}
    
    }
}