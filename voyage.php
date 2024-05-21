<?php

/**
 * Package Voyage
 * Version 1.0.0
 */
/*
Plugin name: Voyage
Plugin uri: https://github.com/eddytuto
Version: 1.0.0
Description: Permet d'afficher les destinations qui répondent à certains critères
*/
function mcd_voyage_enqueue()
{
  // filemtime // retourne en milliseconde le temps de la dernière modification
  // plugin_dir_path // retourne le chemin du répertoire du plugin
  // __FILE__ // le fichier en train de s'exécuter
  // wp_enqueue_style() // Intègre le link:css dans la page
  // wp_enqueue_script() // intègre le script dans la page
  // wp_enqueue_scripts // le hook

  $version_css = filemtime(plugin_dir_path(__FILE__) . "style.css");
  $version_js = filemtime(plugin_dir_path(__FILE__) . "js/voyage.js");
  wp_enqueue_style(
    'em_plugin_voyage_css',
    plugin_dir_url(__FILE__) . "style.css",
    array(),
    $version_css
  );

  wp_enqueue_script(
    'em_plugin_voyage_js',
    plugin_dir_url(__FILE__) . "js/voyage.js",
    array(),
    $version_js,
    true
  );
}
add_action('wp_enqueue_scripts', 'mcd_voyage_enqueue');
/* Création de la liste des destinations en HTML */
function creation_destinations()
{
  $categories = get_categories();
  $contenu = '';
  foreach ($categories as $category) {
    $category_link = $category->term_id;
    $category_name = $category->name;
    $contenu .= '<button class="bouton_categorie" id="cat_'
      . $category_link .
      '">'
      . $category_name .
      '</button>';
  }
  $contenu .= '<div class="contenu__restapi"></div>';
  return $contenu;
}

add_shortcode('em_destination', 'creation_destinations');
