<?php 

/* Envoi d'une requete WP */
/* arguments de la query */
$args = [
    'post_type' => 'post',
];
$posts = get_posts($args); /* renvoie un tableau de résultats */
?>

<ul class="post-list">
    <?php foreach($posts as $p){ ?>
        <li>
            <a href="<?= get_permalink($p) ?>"> 
                <?= $p->post_title ?> 
                <time><?= wp_date('j F Y', strtotime($p->post_date) )  ?></time> 
            </a>
        </li>
    <?php } ?>
</ul>