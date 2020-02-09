<?php

/** Exit if accessed directly. */
if(!defined('ABSPATH')) exit;

/** Get the parent theme directories. */
$theme_template = wp_get_theme()->template;
$theme_template_dir = get_theme_root() . "/{$theme_template}";

/** Include WordPress plugin functions. */
include_once(ABSPATH . 'wp-admin/includes/plugin.php');

/** Include SEEDS classes. */
include_once("{$theme_template_dir}/classes/admin.php");
include_once("{$theme_template_dir}/classes/login.php");
include_once("{$theme_template_dir}/classes/theme.php");
include_once("{$theme_template_dir}/classes/blocks.php");

/** Init classes. */
$Admin = new SEEDS\Admin;
$Theme = new SEEDS\Theme;
$Login = new SEEDS\Login;

/** Register menu locations. */
$Theme->RegisterMenuLocations(array(
    'primary_menu' => __('Header Navigation', 'seedscs'),
    'footer_menu'  => __('Footer Navigation', 'seedscs')
));