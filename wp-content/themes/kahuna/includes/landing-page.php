<?php
/**
 * Landing page functions
 * Used in front-page.php
 *
 * @package Kahuna
 */

 /**
  * slider builder
  */
 if ( ! function_exists('kahuna_lpslider' ) ):
 function kahuna_lpslider() {
 	$options = cryout_get_option( array( 'kahuna_lpslider', 'kahuna_lpsliderimage', 'kahuna_lpslidertitle', 'kahuna_lpslidertext', 'kahuna_lpslidershortcode', 'kahuna_lpsliderserious', 'kahuna_lpslidercta1text', 'kahuna_lpslidercta1link', 'kahuna_lpslidercta2text', 'kahuna_lpslidercta2link'  ) );
	?>
 	<section class="lp-slider">
	<?php
 	if ( $options['kahuna_lpslider'] )
 		switch ( $options['kahuna_lpslider'] ):
 			case 1:
 				if ( is_string( $options['kahuna_lpsliderimage'] ) ) {
 					$image = $options['kahuna_lpsliderimage'];
 				}
 				else {
 					list( $image, ) = wp_get_attachment_image_src( $options['kahuna_lpsliderimage'], 'full' );
 				}
 				kahuna_lpslider_output( array(
 					'image' => $image,
 					'title' => $options['kahuna_lpslidertitle'],
 					'content' => $options['kahuna_lpslidertext'],
 					'lpslidercta1text' => $options['kahuna_lpslidercta1text'],
 					'lpslidercta1link' => $options['kahuna_lpslidercta1link'],
 					'lpslidercta2text' => $options['kahuna_lpslidercta2text'],
 					'lpslidercta2link' => $options['kahuna_lpslidercta2link'],
 				) );
 			break;
 			case 2:
 				?> <div class="lp-dynamic-slider"> <?php
 				echo do_shortcode( $options['kahuna_lpslidershortcode'] );
 				?> </div> <!-- lp-dynamic-slider --> <?php
 			break;
 			case 3:
 				// header image
 			break;
 			case 4:
 				?> <div class="lp-dynamic-slider"> <?php
 					if ( ! empty( $options['kahuna_lpsliderserious'] ) ) {
 						echo do_shortcode( '[serious-slider id="' . $options['kahuna_lpsliderserious'] . '"]' );
 					}
 				?> </div> <!-- lp-dynamic-slider --> <?php
 			break;

 			default:
 			break;
 		endswitch; ?>
 		</section>
		<?php
 } //  kahuna_lpslider()
 endif;

 /**
  * slider output
  */
 if ( ! function_exists( 'kahuna_lpslider_output' ) ):
 function kahuna_lpslider_output( $data ){
 	extract($data);
	if ( empty( $image ) && empty( $title ) && empty( $content ) && empty( $lpslidercta1text ) && empty( $lpslidercta2text ) ) return; ?>

 		<section class="lp-staticslider">
 			<?php if ( ! empty( $image ) ) { ?>
 				<img class="lp-staticslider-image" alt="<?php echo esc_attr( $title ) ?>" src="<?php echo esc_url( $image ); ?>">
 			<?php } ?>
 			<div class="staticslider-caption">
                <div class="staticslider-caption-inside">
     				<?php if ( ! empty( $title ) ) { ?> <h2 class="staticslider-caption-title"><span><?php echo do_shortcode( wp_kses_post( $title ) ) ?></span></h2><?php } ?>
     				<?php if ( ! empty( $title ) && ! empty( $content ) )	{ ?><span class="staticslider-sep"></span><?php } ?>
     				<?php if ( ! empty( $content ) ) { ?> <div class="staticslider-caption-text"><span><?php echo do_shortcode( wp_kses_post( $content ) ) ?></span></div><?php } ?>
                    <div class="staticslider-caption-buttons">
         				<?php if ( ! empty( $lpslidercta1text ) ) { echo '<a class="staticslider-button" href="' . esc_url( $lpslidercta1link ) . '">' . esc_html( $lpslidercta1text ) . '</a>'; } ?>
         				<?php if ( ! empty( $lpslidercta2text ) ) { echo '<a class="staticslider-button" href="' . esc_url( $lpslidercta2link ) . '">' . esc_html( $lpslidercta2text ) . '</a>'; } ?>
                    </div>
                </div>
 			</div>
 		</section><!-- .lp-staticslider -->

 <?php
 } // kahuna_lpslider_output()
 endif;


/**
 * blocks builder
 */
if ( ! function_exists( 'kahuna_lpblocks' ) ):
function kahuna_lpblocks() {
	$maintitle = cryout_get_option('kahuna_lpblockmaintitle');
	$maindesc = cryout_get_option('kahuna_lpblockmaindesc');
	$pageids = cryout_get_option( array( 'kahuna_lpblockone', 'kahuna_lpblocktwo', 'kahuna_lpblockthree', 'kahuna_lpblockfour') );
	$icon = cryout_get_option( array( 'kahuna_lpblockoneicon', 'kahuna_lpblocktwoicon', 'kahuna_lpblockthreeicon', 'kahuna_lpblockfouricon' ) );
	$blockscontent = cryout_get_option( 'kahuna_lpblockscontent' );
	$blocksclick = cryout_get_option( 'kahuna_lpblocksclick' );
	$count = 1;
	$pagecount = count (array_filter( $pageids ) );
	if ( empty( $pagecount ) ) return;
	?>
	<section class="lp-blocks lp-blocks-rows-<?php echo absint( $pagecount ) ?>" id="lp-blocks">
		<?php if(  ! empty( $maintitle ) || ! empty( $maindesc ) ) { ?>
			<div class="lp-section-header">
                <?php if( ! empty( $maindesc ) ) { ?><div class="lp-section-desc"> <?php echo do_shortcode( wp_kses_post( $maindesc ) ) ?></div><?php } ?>
				<?php if( ! empty( $maintitle ) ) { ?><h2 class="lp-section-title"> <?php echo do_shortcode( wp_kses_post( $maintitle ) ) ?></h2><?php } ?>
			</div>
		<?php } ?>
		<div class="lp-blocks-inside">
			<?php foreach ( $pageids as $key => $pageid ) {
				$pageid = cryout_localize_id( $pageid );
				if ( !empty( $pageid ) ) {
					$page = get_post( $pageid );

					switch ( $blockscontent ) {
						case '0': $text = ''; break;
						case '1': default: if (has_excerpt( $pageid )) $text = get_the_excerpt( $pageid ); else $text = kahuna_custom_excerpt( $page->post_content ); break;
						case '2': $text = apply_filters( 'the_content', get_post_field( 'post_content', $pageid ) );
					};

					$data[$count] = array(
						'title' => get_the_title( $pageid ),
						'text'	=> $text,
						'icon'	=> ( ( $icon[$key . 'icon'] != 'no-icon' ) ? $icon[$key . 'icon'] : '' ),
						'link'	=> get_permalink( $pageid ),
						'click'	=> $blocksclick,
						'id' 	=> $count,
					);
					kahuna_lpblock_output( $data[$count] );
					$count++;
				}
			} ?>
		</div>
	</section>
<?php } //kahuna_lpblocks()
endif;

/**
 * blocks output
 */
if ( ! function_exists( 'kahuna_lpblock_output' ) ):
function kahuna_lpblock_output( $data ) { ?>
	<?php foreach ( $data as $key => $value ) { ${"$key"} = $value; } ?>
			<div class="lp-block block<?php echo absint( $id ); ?>">
				<?php if ( $click ) { ?><a href="<?php echo esc_url( $link ); ?>"><?php } ?>
					<?php if ( ! empty ( $icon ) )	{ ?> <i class="blicon-<?php echo esc_attr( $icon ); ?>"></i><?php } ?>
				<?php if ( $click ) { ?></a> <?php } ?>
					<div class="lp-block-content">
						<?php if ( ! empty ( $title ) ) { ?><h4 class="lp-block-title"><?php echo do_shortcode( $title ) ?></h4><?php } ?>
						<?php if ( ! empty ( $text ) ) { ?><div class="lp-block-text"><?php echo do_shortcode( $text ) ?></div><?php } ?>
						<?php /*<a class="lp-block-readmore" href="<?php echo esc_url( $link ); ?>" <?php echo esc_attr( $target ); ?>> <?php echo wp_kses_post( $readmore ); ?> </a>*/ ?>
					</div>
			</div><!-- lp-block -->
	<?php
} // kahuna_lpblock_output()
endif;


/**
 * boxes builder
 */
if ( ! function_exists( 'kahuna_lpboxes' ) ):
function kahuna_lpboxes( $sid = 1 ) {
	$options = cryout_get_option(
				array(
					 'kahuna_lpboxmaintitle' . $sid,
					 'kahuna_lpboxmaindesc' . $sid,
					 'kahuna_lpboxcat' . $sid,
					 'kahuna_lpboxrow' . $sid,
					 'kahuna_lpboxcount' . $sid,
					 'kahuna_lpboxlayout' . $sid,
					 'kahuna_lpboxmargins' . $sid,
					 'kahuna_lpboxanimation' . $sid,
					 'kahuna_lpboxreadmore' . $sid,
					 'kahuna_lpboxlength' . $sid,
				 )
			 );
	if ( ( $options['kahuna_lpboxcount' . $sid] <= 0 ) || ( $options['kahuna_lpboxcat' . $sid] == '-' ) ) return;

 	$box_counter = 1;
	$animated_class = "";
	if ( $options['kahuna_lpboxanimation' . $sid] == 1 ) $animated_class = 'lp-boxes-animated';
	if ( $options['kahuna_lpboxanimation' . $sid] == 2 ) $animated_class = 'lp-boxes-static';
    $custom_query = new WP_query();
    if ( ! empty( $options['kahuna_lpboxcat' . $sid] ) ) $cat = $options['kahuna_lpboxcat' . $sid]; else $cat = '';

	$args = array(
		'showposts' => $options['kahuna_lpboxcount' . $sid],
		'cat' => cryout_localize_cat( $cat ),
		'ignore_sticky_posts' => 1,
		'lang' => cryout_localize_code()
	);

    $custom_query->query( $args );
    if ( $custom_query->have_posts() ) : ?>
		<section class="lp-boxes lp-boxes-<?php echo absint( $sid ) ?> <?php  echo esc_attr( $animated_class ) ?> lp-boxes-rows-<?php echo absint( $options['kahuna_lpboxrow' . $sid] ); ?>" id="lp-boxes-<?php echo absint( $sid ) ?>">
			<?php if( $options['kahuna_lpboxmaintitle' . $sid] || $options['kahuna_lpboxmaindesc' . $sid] ) { ?>
				<div class="lp-section-header">
                    <?php if ( ! empty( $options['kahuna_lpboxmaindesc' . $sid] ) ) { ?><div class="lp-section-desc"> <?php echo do_shortcode( wp_kses_post( $options['kahuna_lpboxmaindesc' . $sid] ) ) ?></div><?php } ?>
					<?php if ( ! empty( $options['kahuna_lpboxmaintitle' . $sid] ) ) { ?> <h2 class="lp-section-title"> <?php echo do_shortcode( wp_kses_post( $options['kahuna_lpboxmaintitle' . $sid] ) ) ?></h2><?php } ?>
				</div>
			<?php } ?>
			<div class="<?php if ( $options['kahuna_lpboxlayout' . $sid] == 2 ) { echo 'lp-boxes-inside'; } else { echo 'lp-boxes-outside'; }?>
						<?php if ( $options['kahuna_lpboxmargins' . $sid] == 2 ) { echo 'lp-boxes-margins'; }?>
						<?php if ( $options['kahuna_lpboxmargins' . $sid] != 2 &&  $options['kahuna_lpboxmargins' . $sid] != 2 ) { echo 'lp-boxes-padding'; }?>">
    		<?php while ( $custom_query->have_posts() ) :
		            $custom_query->the_post();
					if ( has_excerpt() ) {
						$excerpt = kahuna_custom_excerpt( get_the_excerpt(), $options['kahuna_lpboxlength' . $sid] );
					} else {
						$excerpt = kahuna_custom_excerpt( get_the_content(), $options['kahuna_lpboxlength' . $sid] );
					};
		            $box = array();
		            $box['colno'] = $box_counter++;
		            $box['counter'] = $options['kahuna_lpboxcount' . $sid];
		            $box['title'] = get_the_title();
		            $box['content'] = $excerpt;
		            list( $box['image'], ) = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'kahuna-lpbox-' . $sid );
		            $box['link'] = get_permalink();
					$box['readmore'] = $options['kahuna_lpboxreadmore' . $sid];
		            $box['target'] = ''; // unused for now

					$box['image'] = apply_filters('kahuna_preview_img_src', $box['image']);

            		kahuna_lpbox_output( $box );
        		endwhile; ?>
			</div>
		</section><!-- .lp-boxes -->
<?php endif;
	wp_reset_postdata();
} //  kahuna_lpboxes()
endif;

/**
 * boxes output
 */
if ( ! function_exists( 'kahuna_lpbox_output' ) ):
function kahuna_lpbox_output( $data ) {
	$randomness = array ( 6, 8, 1, 5, 2, 7, 3, 4 );
	extract($data); ?>
			<div class="lp-box box<?php echo absint( $colno ); ?> ">
					<div class="lp-box-image lpbox-rnd<?php echo $randomness[$colno%8]; ?>">
                        <a class="lp-box-imagelink" <?php if( ! empty( $link ) ) { ?> href="<?php echo esc_url( $link ); ?>" <?php echo esc_attr( $target ); } ?>></a>
						<?php if( ! empty( $image ) ) { ?><img alt="<?php echo esc_attr( $title ) ?>" src="<?php echo esc_url( $image ) ?>" /> <?php } ?>
                        <span class="box-overlay"></span>
					</div>
					<div class="lp-box-content">
						<?php if ( ! empty( $title ) ) : ?>
                            <a class="lp-box-titlelink" href="<?php if( ! empty( $link ) ) { echo esc_url( $link ); } ?>" <?php echo esc_attr( $target ); ?>>
                                <h5 class="lp-box-title"><?php echo do_shortcode( $title ) ?></h5>
                            </a>
                        <?php endif; ?>
						<div class="lp-box-text">
							<?php if ( ! empty( $content ) ) { ?>
								<div class="lp-box-text-inside"> <?php echo do_shortcode( $content ) ?> </div>
							<?php } ?>
    						<?php if( ! empty( $readmore ) ) { ?>
    							<a class="lp-box-readmore" href="<?php if( ! empty( $link ) ) { echo esc_url( $link ); } ?>" <?php echo esc_attr( $target ); ?>> <?php echo do_shortcode( wp_kses_post( $readmore ) ) ?></a>
    						<?php } ?>
                        </div>
					</div>
			</div><!-- lp-box -->
	<?php
} // kahuna_lpbox_output()
endif;


/**
 * text area builder
 */
if ( ! function_exists( 'kahuna_lptext' ) ):
function kahuna_lptext( $what = 'one' ) {
	$pageid = cryout_get_option( 'kahuna_lptext' . $what );
	$pageid = cryout_localize_id( $pageid );
	if ( ! empty( $pageid ) ) {
		$page = get_post( $pageid );
		$data = array(
			'title' => get_the_title( $pageid ),
			'text'	=> apply_filters( 'the_content', get_post_field( 'post_content', $pageid ) ),
			'id' 	=> $what,
		);
		list( $data['image'], ) = wp_get_attachment_image_src( get_post_thumbnail_id( $pageid ), 'full' );
		kahuna_lptext_output( $data );
	}
} // kahuna_lptext()
endif;

/**
 * text area output
 */
if ( ! function_exists( 'kahuna_lptext_output' ) ):
function kahuna_lptext_output( $data ){ ?>
	<section class="lp-text" id="lp-text-<?php echo esc_attr( $data['id'] ); ?>" >
	<?php if( ! empty( $data['image'] ) ) { ?>
        <div class="lp-text-image">
            <img alt="<?php echo esc_attr( $data['title'] ) ?>" src="<?php echo esc_url( $data['image'] ); ?>">
        </div>
    <?php } ?>
			<div class="lp-text-inside">
				<?php if( ! empty( $data['title'] ) ) { ?><h3 class="lp-text-title"><?php echo do_shortcode( $data['title'] ) ?></h3><?php } ?>
				<?php if( ! empty( $data['text'] ) ) { ?><div class="lp-text-content"><?php echo do_shortcode( $data['text'] ) ?></div><?php } ?>
			</div>

	</section><!-- .lp-text-<?php echo esc_attr( $data['id'] ); ?> -->
<?php
} // kahuna_lptext_output()
endif;

/**
 * page or posts output, also used when landing page is disabled
 */
if ( ! function_exists( 'kahuna_lpindex' ) ):
function kahuna_lpindex() {

	$kahuna_lpposts = cryout_get_option ('kahuna_lpposts');

	switch ($kahuna_lpposts) {

		case 2: // static page

			if ( have_posts() ) :
					?><section id="lp-page"> <div class="lp-page-inside"><?php
					get_template_part( 'content/content', 'page' );
					?></div> </section><!-- #lp-posts --><?php
			endif;

		break;

		case 1: // posts

			if ( get_query_var('paged') ) $paged = get_query_var('paged');
			elseif ( get_query_var('page') ) $paged = get_query_var('page');
			else $paged = 1;
			$custom_query = new WP_query( array('posts_per_page'=>get_option('posts_per_page'),'paged'=>$paged) );

			if ( $custom_query->have_posts() ) :  ?>
				<section id="lp-posts"> <div class="lp-posts-inside">
				<div id="content-masonry" class="content-masonry" <?php cryout_schema_microdata( 'blog' ); ?>> <?php
					while ( $custom_query->have_posts() ) : $custom_query->the_post();
						get_template_part( 'content/content', get_post_format() );
					endwhile; ?>
				</div> <!-- content-masonry -->
				</div> </section><!-- #lp-posts -->
				<?php kahuna_pagination();
				wp_reset_postdata();
			else :
				get_template_part( 'content/content', 'notfound' );
			endif;

		break;

		case 0: // disabled
		default: break;
	}

} // kahuna_lpindex()
endif;

// FIN
