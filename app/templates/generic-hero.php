<?php
/**
 * The template for displaying the generic hero
 */
?>

<section class="section section-hero">

    <div class="hero-content">
        <div class="valign-block">
            <div class="valign-centered">
                <h1 class="hero-title"><?php echo $pageTitle ?></h1>
            </div>
        </div>
    </div>

    <div class="hero-background" style="background-image: url('<?php echo $content['items'][0]['fields']['backgroundImage'] ?>')">
        <img src="<?php echo $content['items'][0]['fields']['backgroundImage'] ?>" />
    </div>

</section>
