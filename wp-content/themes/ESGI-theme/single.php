<?php
// template des articles seuls
// WP définit une variable $post

?>

<?php get_header() ?>

<main class="post">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>
                    <?php
                    echo the_title(); // on fait passer le titre dans le filtre the_title  
                    ?>
                </h1>
                <div class="post-meta">
                    <div class="post-author">
                        <img src="<?= get_avatar_url($post->post_author) ?>">
                        <?= get_the_author_meta('nickname', $post->post_author) ?>
                    </div>
                    <time>
                        <?= wp_date('j F Y', strtotime($post->post_date)); ?>
                    </time>
                </div>
                <?php
                the_post_thumbnail('large'); // affiche l'image de couverture en grand
                ?>
                <?php
                the_content(); // affiche le post_content après l'avoir fait passer dans le filtre the_content
                ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer() ?>