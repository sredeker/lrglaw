<?php
  /**
  * The template for the homepage
  */
  ini_set('display_errors', 1);

  require("assets/php/functions.php");

  $pageId = "our-team";
  $cfEntryID = "5AiIbnB6HSa2SK4MyYmS2M";
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



<script>
  // console.log(<?php echo json_encode($teamMembers, true); ?>);
</script>

<?php require("assets/templates/generic-hero.php"); ?>



<?php if($teamMembers){ ?>
  <section id="member-nav">
    <nav>
      <ul class="nav nav-tabs">
        <?php foreach ($teamMembers as $key => $teamMember) { ?>
          <li><a href="#<?php echo $teamMember['fields']['tag'] ?>"><?php echo $teamMember['fields']['name'] ?></a></li>
        <?php } ?>
      </ul>
    </nav>
  </section>

  <?php foreach ($teamMembers as $key => $teamMember) { ?>
      <section id="<?php echo $teamMember['fields']['tag'] ?>" class="section member-profile">
        <div class="container">
            <div class="overview">
                <!-- <div class="photo"><img src="assets/images/member-profile-pick.jpg" /></div> -->
                <div class="info">
                  <h2 class="name"><?php echo $teamMember['fields']['name'] ?></h2>
                  <h3 class="role"><?php echo $teamMember['fields']['title'] ?></h3>
                  <ul class="social-links">
                      <?php if($teamMember['fields']['email'] != undefined && $teamMember['fields']['email'] != ""){ ?><li><a target="_blank" href="mailto:<?php echo $teamMember['fields']['email'] ?>"><i class="fa fa-envelope-o"></i></a></li><?php } ?>
                      <?php if($teamMember['fields']['linkedInProfile'] != undefined && $teamMember['fields']['linkedInProfile'] != ""){ ?><li><a target="_blank" href="<?php echo $teamMember['fields']['linkedInProfile'] ?>"><i class="fa fa-linkedin"></i></a></li><?php } ?>
                  </ul>
                </div>
            </div>
            <div class="bio">
                <?php if( $teamMember['fields']['education'] && $teamMember['fields']['education'] != ""){ ?>
                <h4 class="title">Education</h4>
                <ul class="education-list"><?php echo $teamMember['fields']['education'] ?></ul>
                <?php } ?>

                <?php if( $teamMember['fields']['specialization'] && $teamMember['fields']['specialization'] != ""){ ?>
                <h4 class="title">Specialization</h4>
                <p><?php echo $teamMember['fields']['specialization'] ?></p>
                <?php } ?>

                <?php if( $teamMember['fields']['notables'] && $teamMember['fields']['notables'] != ""){ ?>
                <h4 class="title">Notables</h4>
                <p><?php echo $teamMember['fields']['notables'] ?></p>
                <?php } ?>

                <?php if( $teamMember['fields']['affiliations'] && $teamMember['fields']['affiliations'] != ""){ ?>
                <h4 class="title">Affiliations</h4>
                <p><?php echo $teamMember['fields']['affiliations'] ?></p>
                <?php } ?>
            </div>
        </div>
    </section>

<?php } }  ?>




<?php require("assets/templates/footer.php"); ?>
