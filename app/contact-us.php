<?php
  /**
  * The template for the homepage
  */
  ini_set('display_errors', 1);

  require("assets/php/functions.php");

  $pageId = "contact-us";
  $cfEntryID = "3phoyrzmjYcOo6s0kqQaUw";
  $content = getContent($cfEntryID);
  $pageTitle = $content['items'][0]['fields']['pageTitle'];
  $metaKeywords = $content['items'][0]['fields']['metaKeywords'];
  $metaDescription = $content['items'][0]['fields']['metaDescription'];
  $entries = $content['includes']['Entry'];
  $getInTouch = $content['items'][0]['fields']['getInTouch'];
  $teamMembers = getTeamMembers($content, $entries);
  $copyright;
  $contactInfoId;
  $phoneNumbers;
  $socialLinks;
  $location;
  $contactEmail = "";
  $address1;
  $address2;
  $city;
  $state;
  $zip;

  foreach ($entries as $entry) {
    if($getInTouch['sys']['id'] == $entry['sys']['id']){
      $copyright = $entry['fields']['copyright'];
      $contactInfoId = $entry['fields']['contactInfo']['sys']['id'];
    }
  }

  foreach ($entries as $entry) {
    if($contactInfoId == $entry['sys']['id']){
      $phoneNumbers = $entry['fields']['phoneNumbers'];
      $socialLinks = $entry['fields']['socialLinks'];
      $location = $entry['fields']['location'];
      $contactEmail = $entry['fields']['email'];
      $address1 = $entry['fields']['addressLine1'];
      $address2 = $entry['fields']['addressLine2'];
      $city = $entry['fields']['city'];
      $state = $entry['fields']['state'];
      $zip = $entry['fields']['zipcode'];
    }
  }
?>

<?php require("assets/templates/header.php"); ?>

<?php include "assets/templates/main-nav.php"; ?>

<?php require("assets/templates/generic-hero.php"); ?>



<section class="section">
    <div class="container">


      <div id="get-in-touch">
          <?php foreach ($entries as $entry) { ?>
            <?php if($getInTouch['sys']['id'] == $entry['sys']['id']){
              $copyright = $entry['fields']['copyright'];
              $contactInfoId = $entry['fields']['contactInfo']['sys']['id'];
            ?>
            <h2 class="section-title"><?php echo $entry['fields']['headline'] ?></h2>
            <p><?php echo $entry['fields']['message'] ?></p>
          <?php } } ?>



              <a href="mailto:<?php echo $contactEmail ?>" class="btn">Email Us</a>



          <div class="phone-numbers">
            <div class="phone-wrapper img-wrapper"><img src="assets/images/icon_phone.png"></div>
            <div class="phone-wrapper img-wrapper"><img src="assets/images/icon_fax.png"></div>
            <?php foreach ($phoneNumbers as $phoneNumber) {
              foreach ($entries as $entry) {
                if($phoneNumber['sys']['id'] == $entry['sys']['id']){
                ?>
                <div class="phone-wrapper">
                  <span class="type"><?php echo $entry['fields']['description'] ?></span>
                  <span class="number"><?php echo $entry['fields']['number'] ?></span>
                </div>
            <?php } } }?>
          </div>


          <div>
              <p>Or follow us on:</p>
              <ul class="social-links">
                <?php foreach ($socialLinks as $socialLink) {
                  foreach ($entries as $entry) {
                    if($socialLink['sys']['id'] == $entry['sys']['id']){
                      $tag = strtolower(str_replace(' ', '', $entry['fields']['platform']));
                    ?>
                    <li><a href="<?php echo $entry['fields']['url'] ?>" target="_blank"><i class="fa fa-<?php echo $tag ?>"></i></a></li>
                <?php } } }?>
              </ul>
            </div>
      </div>
    </div>
</section>

<section class="section section-bleed" id="map-wrapper">
    <div id="map-canvas" data-lat="<?php echo $location['lat'] ?>" data-lon="<?php echo $location['lon'] ?>"></div>
    <div id="place-card">
      <div class="name">Lefkoff, Rubin, Gleason &amp; Russo, P.C.</div>
      <div class="address"><?php echo $address1 ?>, <?php echo $address2 ?><br/><?php echo $city ?>, <?php echo $state ?></div>
      <a class="directions" href="https://www.google.com/maps/dir//Lefkoff+Rubin+Gleason+%26+Russo,+<?php echo str_replace(' ', '+', $address1) ?>+<?php echo str_replace(' ', '+', $address2) ?>,+<?php echo str_replace(' ', '+', $city) ?>,+<?php echo str_replace(' ', '+', $state) ?>+<?php echo str_replace(' ', '+', $zip) ?>,+United+States/@<?php echo $location['lat'] ?>,<?php echo $location['lon'] ?>,15z" target="_blank">Directions</a>
    </div>
</section>



<?php require("assets/templates/footer.php"); ?>
