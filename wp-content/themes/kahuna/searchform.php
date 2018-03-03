<?php
/**
 * The template for displaying the searchform
 *
 * @package Kahuna
 */
?>

<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _e( 'Search for:', 'kahuna' ); ?></span>
		<input type="search" class="s" placeholder="<?php echo esc_attr_e( 'To search type and press enter', 'kahuna' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="searchsubmit"><span class="screen-reader-text"><?php echo _e( 'Search', 'kahuna' ); ?></span><i class="icon-search"></i></button>
</form>
