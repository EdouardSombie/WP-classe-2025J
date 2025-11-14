<?php

/**
 * Plugin Name: ESGI Plugin
 * Plugin URI: https://www.esgi.fr/
 * Description: Plugin personnalisé pour ESGI - Fonctionnalités spécifiques au CMS WordPress
 * Version: 1.0.0
 * Author: ESGI
 * Author URI: https://www.esgi.fr/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ESGI
 * Domain Path: /languages
 */

// Empêcher l'accès direct au fichier
if (!defined('ABSPATH')) {
    exit;
}

// esgi_displayDuplicateLink() sur les hooks de type filter post_row_actions et page_row_actions

add_filter('post_row_actions', 'esgi_displayDuplicateLink', 100, 2);
add_filter('page_row_actions', 'esgi_displayDuplicateLink', 100, 2);

function esgi_displayDuplicateLink($actions, $post)
{
    // var_dump($actions);
    if (!current_user_can('edit_post', $post->ID)) {
        return $actions;
    }
    // génération de l'url de duplication
    $url = wp_nonce_url(
        add_query_arg(
            [
                'action' => 'esgi_duplicate_post',
                'post' => $post->ID,
            ],
            'admin.php'
        )
    );
    $actions['duplicate'] = '<a href="' . $url . '">Dupliquer</a>';

    return $actions;
}

add_action('admin_action_esgi_duplicate_post', 'esgi_duplicate_post');
function esgi_duplicate_post()
{
    // Vérifier qu'il existe bien un paramètre GET nommé 'post'
    if (!isset($_GET['post']) || empty($_GET['post'])) {
        wp_die('Aucun post spécifié pour la duplication.');
    }
    // Vérifier le nonce pour la sécurité
    if (!wp_verify_nonce($_GET['_wpnonce'])) {
        wp_die('Erreur de sécurité : nonce invalide.');
    }
    // Créer un nouveau post

    $originalPost = get_post($_GET['post']);
    var_dump($originalPost);

    $args = [
        'post_title' => $originalPost->post_title,
        'post_content' => $originalPost->post_content,
        'post_date' => date('Y-m-d H:i:s'),
        'post_status' => 'publish',
        'post_type' => $originalPost->post_type,
    ];

    $idNew = wp_insert_post($args);

    // Utiliser l'idNew pour lui ajouter le thumbnail et les différentes taxonomies de l'original


    // Redirection vers la liste des articles si l'original est un article, sinon vers les pages
    if ($originalPost->post_type == 'post') {
        wp_redirect(admin_url('edit.php?duplicate'));
    } else {
        wp_redirect(admin_url('edit.php?post_type=page&duplicate'));
    }
    exit;
}

// Affichage d'un message de succès après duplication
add_action('admin_notices', 'esgi_admin_notices');
function esgi_admin_notices()
{
    if (isset($_GET['duplicate'])) {
        echo '<div class="notice notice-success is-dismissible"><p>Publication dupliquée avec succès</p></div>';
    }
}
