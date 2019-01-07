<?php
/**
 * Template Name: Sections Body
 *
 * @package Atlantis
 * @subpackage Atlantis_Templates
 * @since Atlantis Templates 1.0
 * The template for displaying the page by widgets
 */

get_header(); ?>
    <article class="container-fluid no_padding no_margin">
		<?php if ( have_posts() ):
			the_post();
			$style_val = get_post_meta( $post->ID, 'atlantis_style_page', true );
			$class_val = get_post_meta( $post->ID, 'atlantis_class_page', true );
			$style_val = ! empty( $style_val ) ? 'style="' . $style_val . '"' : '';
			$class_val = ! empty( $class_val ) ? ' ' . $class_val . ' ' : '';
			?>
            <div class="row no_margin no_padding <?php echo $class_val; ?>" <?php echo $style_val; ?>>
				<?php the_content() ?>
            </div>
		<?php endif; ?>
		<?php
		$args   = array(
			'post_type'      => 'page',
			'posts_per_page' => - 1,
			'post_parent'    => $post->ID,
			'order'          => 'ASC',
			'orderby'        => 'menu_order'
		);
		$parent = new WP_Query( $args );
		if ( $parent->have_posts() ) :
			while ( $parent->have_posts() ) :
				$parent->the_post();
				$style_val = get_post_meta( $post->ID, 'atlantis_style_page', true );
				$class_val = get_post_meta( $post->ID, 'atlantis_class_page', true );
				$script_val = get_post_meta( $post->ID, 'atlantis_script_page', true );
				$style_val = ! empty( $style_val ) ? 'style="' . $style_val . '"' : '';
				$class_val = ! empty( $class_val ) ? ' ' . $class_val . ' ' : '';
				?>
                <div class="row no_margin no_padding <?php echo $class_val; ?>" <?php echo $style_val; ?>>
					<?php
					$title = the_title( '', '', false );
					if ( $title != "" && strtolower( $title ) != "none" ) :
						?>
                        <div class="container-fluid">
                            <h1 class="text-center fw_600"><?php echo $title; ?></h1>
                        </div>
					<?php endif; ?>
                    <div class="container-fluid container-child-<?php echo get_the_ID(); ?>"
                         id="container-child--<?php echo get_the_ID(); ?>">
						<?php the_content(); ?>
                        <script type="text/javascript">
                            <?php echo $script_val; ?>
                        </script>
                    </div>
                </div>
			<?php
			endwhile;
		endif; ?>
    </article>
<?php get_footer();