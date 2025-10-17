<article class="identity-card">
    <?php 
    if (has_custom_logo()) 
        {
            the_custom_logo();
        }
    ?>
    <h1><?= get_bloginfo('name') ?></h1>
    <h2><?= get_bloginfo('description') ?></h2>

    <ul class="social-list">
        <li><a href="#"><?= esgi_getIcon('twitter'); ?></a></li>
        <li><a href="#"><?= esgi_getIcon('facebook'); ?></a></li>
        <li><a href="#"><?= esgi_getIcon('google'); ?></a></li>
        <li><a href="#"><?= esgi_getIcon('linkedin'); ?></a></li>
    </ul>

</article>