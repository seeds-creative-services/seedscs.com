<?php

/** Exit if accessed directly. */
if(!defined('ABSPATH')) exit;

/** Include WordPress plugin functions. */
include_once(ABSPATH . 'wp-admin/includes/plugin.php');

/** Include SEEDS classes. */
include_once(get_theme_root()."/".wp_get_theme()->template."/classes/admin.php");
include_once(get_theme_root()."/".wp_get_theme()->template."/classes/login.php");
include_once(get_theme_root()."/".wp_get_theme()->template."/classes/theme.php");
include_once(get_theme_root()."/".wp_get_theme()->template."/classes/blocks.php");

/** Init classes. */
$Admin = new SEEDS\Admin;
$Theme = new SEEDS\Theme;
$Login = new SEEDS\Login;

/** Register menu locations. */
$Theme->RegisterMenuLocations(array(
    'primary_menu' => __('Header Navigation', 'seedscs'),
    'footer_menu'  => __('Footer Navigation', 'seedscs')
));