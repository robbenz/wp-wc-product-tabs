<?php


add_filter( 'woocommerce_product_tabs', 'benz_new_product_tabs' );

/*** ADD TABS & TAB TITLES ***/
function benz_new_product_tabs( $tabs ) {
  global $post;
  $benz_tab_count = get_post_meta( $post->ID, '_wcj_custom_product_tabs_local_total_number', true );
  for ( $x = 0; $x < $benz_tab_count; $x++ ) {
    $y=$x+1;
    $benz_tab_title = get_post_meta( $post->ID, "_wcj_custom_product_tabs_title_local_$y", true );
    $benz_tab_title_clean = preg_replace('/\s+/', '-', $benz_tab_title);
    $benz_tab_content = get_post_meta( $post->ID, "_wcj_custom_product_tabs_content_local_$y", true );

    if ( strlen($benz_tab_title) > 0 && strlen($benz_tab_content) > 0 ) {
      $tabs[$benz_tab_title_clean] = array(
        'title'   	=> __( $benz_tab_title, 'woocommerce' ),
        'priority' 	=> $y+50,
        'callback' 	=> 'benz_new_product_tab_content',
        'args'      => '_wcj_custom_product_tabs_content_local_' . $y
      );
    } // end foreach
  }
  return $tabs;
}
/*** END ***/


/*** DYNAMICALLY LOAD TAB CONTENT ***/
function benz_new_product_tab_content($param, $args) {
  global $post;
  $table = end($args);
  $benz_tab_content = get_post_meta( $post->ID, $table, true );
     echo $benz_tab_content;
}
/*** END ***/
