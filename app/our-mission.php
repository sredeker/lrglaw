<?php
  /**
  * The template for the homepage
  */
  ini_set('display_errors', 1);

  require("assets/php/functions.php");

  $pageId = "our-mission";
  $cfEntryID = "DzbXXZV5gyGIeYuWsyMI";
  $content = getContent($cfEntryID);
  $pageTitle = $content['items'][0]['fields']['pageTitle'];
  $metaKeywords = $content['items'][0]['fields']['metaKeywords'];
  $metaDescription = $content['items'][0]['fields']['metaDescription'];
  $entries = $content['includes']['Entry'];
  $getInTouch = $content['items'][0]['fields']['getInTouch'];
  $teamMembers = getTeamMembers($content, $entries);
?>

<?php require("assets/templates/header.php"); ?>

<?php include "assets/templates/main-nav.php"; ?>

<?php require("assets/templates/generic-hero.php"); ?>



<section class="section">
    <div class="container">
        <h3><?php echo $content['items'][0]['fields']['headline'] ?></h3>
        <ul class="mission-list"><?php echo $content['items'][0]['fields']['missionList'] ?></ul>
    </div>
</section>



<?php require("assets/templates/footer.php"); ?>
