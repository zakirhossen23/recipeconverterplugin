<?php

/**
 * Plugin Name: Recipe Converter
 * Version: 1.0.0
 * Plugin URI: https://www.https://miseitmakeit.ca/
 * Description: This is Recipe Converter plugin.
 * Author: Suzanne Lejeune
 * Author URI: https://www.https://miseitmakeit.ca/
 * Text Domain: recipeconverter
 *
 * @package WordPress
 * @author Suzanne Lejeune
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}


add_filter('template_include', 'recipe_converter_page_template', 99);
function recipe_converter_page_template($template)
{
    if (is_page('recipe-converter')) {
        $new_template = locate_template(array('portfolio-page-template.php'));
        return plugin_dir_path(__FILE__) . "includes/custompage/customrecipe.php";
    }
    return $template;
}
