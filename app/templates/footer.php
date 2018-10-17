<?php
/**
 * The template for displaying the footer
 */

$copyright;
$contactInfoId;
$socialLinks;

?>

    <footer>
        <div class="col bg-image" style="background-image:url(assets/images/footer.jpg)"><img src="assets/images/footer.jpg" alt=""/></div>

        <div class="col get-in-touch">

            <?php foreach ($entries as $entry) { ?>
              <?php if($getInTouch['sys']['id'] == $entry['sys']['id']){
                $copyright = $entry['fields']['copyright'];
                $contactInfoId = $entry['fields']['contactInfo']['sys']['id'];
              ?>
              <h2 class="section-title"><?php echo $entry['fields']['headline'] ?></h2>
              <p><?php echo $entry['fields']['message'] ?></p>
              <a class="btn" href="contact-us.php">Contact us</a>
            <?php } } ?>



            <?php foreach ($entries as $entry) {
              if($contactInfoId == $entry['sys']['id']){
                $socialLinks = $entry['fields']['socialLinks'];
              }
            }?>



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





            <div class="legal">
                <?php echo $copyright ?>
            </div>
        </div>
    </footer>



    <!-- import jQuery -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="assets/lib/jquery-validation/jquery.validate.min.js"></script>

    <!-- include bootstrap.js for component functionality -->
    <script src="assets/lib/bootstrap/js/bootstrap.min.js"></script>

    <!-- include slick js for carousel functionality -->
    <script src="assets/lib/slick/slick.min.js"></script>

    <!-- include google maps sdk -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>



    <!-- include custom functionality -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/contact.js"></script>
  </body>
</html>
