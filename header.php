<?php
/**
*
* @package wfs-wingad
*
**/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php bloginfo( 'name' ); wp_title(); ?></title>
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if( is_singular() && pings_open( get_queried_object() ) ): ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header>
      <nav class="navbar navbar-blue">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-logo" href="/"></a>
          </div> <!-- /.navbar-header -->
          <div class="collapse navbar-collapse" id="navbar-collapse">
            <?php 
              wp_nav_menu( array(
                'menu' => 'top-header',
                'container' => '',
                'menu_class' => 'nav navbar-nav'
            ) );
            ?>
          </div> <!-- /.collapse -->
        </div> <!-- /.container -->
      </nav> <!-- /.navbar -->
    </header>
    <div class="container section main">
