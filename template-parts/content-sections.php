<?php
the_content( sprintf(
    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'atlantis' ),
    get_the_title()
) );
?>
