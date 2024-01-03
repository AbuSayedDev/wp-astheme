<?php
/*
* This template for displaying the header
*/
?>

<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>" class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

<div class="header-area bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav id="navarea" class="navbar navbar-expand-lg navbar-light bg-light py-3 <?php echo get_theme_mod('astheme_menu_position'); ?>" >
                    <div class="container-fluid row">
                            <div class="col-6 col-md-3">
                                <a class="navbar-brand" href="#">
                                    <img src="<?php echo get_theme_mod( 'astheme_logo' ); ?>" alt="logo" width="120px" height="auto">
                                </a>
                            </div>
                        
                            <div class="col-6  col-md-9">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                                <?php wp_nav_menu( array(
                                    'theme_location' => 'primary_menu',
                                    'container' => false,
                                    'menu_class' => '',
                                    'fallback_cb' => '__return_false',
                                    'items_wrap' => '<ul id="bootstrap-navbar" class="navbar-nav mb-2 mb-lg-0 %2$s">%3$s</ul>',
                                    'depth' => 2,
                                    'walker' => new bootstrap_5_wp_nav_menu_walker()
                                ) ); ?>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>

