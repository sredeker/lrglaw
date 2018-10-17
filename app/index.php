<?php
  /**
  * The template for the homepage
  */
  ini_set('display_errors', 1);

  require("assets/php/functions.php");

  $pageId = "homepage";
  $cfEntryID = "3C6empAZ5YQWQakWeCcoES";
  $content = getContent($cfEntryID);
  $pageTitle = $content['items'][0]['fields']['pageTitle'];
  $metaKeywords = $content['items'][0]['fields']['metaKeywords'];
  $metaDescription = $content['items'][0]['fields']['metaDescription'];
  $entries = $content['includes']['Entry'];
  $slides = $content['items'][0]['fields']['heroCarouselSlides'];
  $whoWeAre = $content['items'][0]['fields']['whoWeAre'];
  $whatWeDo = $content['items'][0]['fields']['whatWeDo'];
  $getInTouch = $content['items'][0]['fields']['getInTouch'];
  $teamMembers = getTeamMembers($content, $entries);


// $servername = "sql5c38a.carrierzone.com";
// $username = "admin";
// $password = "echo312";

// // Create connection
// $conn = new mysqli($servername, $username, $password);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";


?>

<?php require("assets/templates/header.php"); ?>


<?php include "assets/templates/main-nav.php"; ?>



<script>
// console.log(<?php echo json_encode($content, true); ?>);
</script>



<section id="homepage-hero" class="section section-hero">
    <div class="hero-carousel">


      <?php foreach ($slides as $slide) {

        foreach ($entries as $entry) {
          if($slide['sys']['id'] == $entry['sys']['id']){
          ?>

          <div class="slide">
            <div class="hero-content">
                <div class="valign-block">
                    <div class="valign-centered container">
                        <h1><?php echo $entry['fields']['headline'] ?></h1>
                        <p><?php echo $entry['fields']['description'] ?></p>
                        <a class="btn btn-white" href="<?php echo $entry['fields']['actionLink'] ?>"><?php echo $entry['fields']['action'] ?></a>
                    </div>
                </div>
            </div>
            <div class="hero-background" style="background-image: url('<?php echo $entry['fields']['backgroundImage'] ?>')">
                <img src="<?php echo $entry['fields']['backgroundImage'] ?>" alt=""/>
            </div>
          </div>
      <?php } } } ?>
    </div>
</section>





<section class="section" id="who-we-are">
    <div class="container">
        <h2 class="section-title">Who we are</h2>


        <?php foreach ($entries as $entry) {
          if($whoWeAre[0]['sys']['id'] == $entry['sys']['id']){ ?>

            <h3 class="skinny"><?php echo $entry['fields']['headline'] ?></h3>
            <div class="multi-col two-col">
                <?php echo $entry['fields']['description'] ?>
            </div>
            <div id="facts">
                <div class="fact">
                    <i class="fa fa-clock-o"></i>
                    <span class="count"><?php echo $entry['fields']['fact1Value'] ?></span>
                    <span class="title"><?php echo $entry['fields']['fact1Text'] ?></span>
                </div>
                <div class="divider"></div>
                <div class="fact">
                    <i class="fa fa-trophy"></i>
                    <span class="count"><?php echo $entry['fields']['fact2Value'] ?></span>
                    <span class="title"><?php echo $entry['fields']['fact2Text'] ?></span>
                </div>
                <div class="divider"></div>
                <div class="fact">
                    <i class="fa fa-briefcase"></i>
                    <span class="count"><?php echo $entry['fields']['fact3Value'] ?></span>
                    <span class="title"><?php echo $entry['fields']['fact3Text'] ?></span>
                </div>
              </div>

        <?php } } ?>
    </div>
</section>


<section class="section" id="what-we-do">
    <div class="container">
        <h2 class="section-title">What we do</h2>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

          <?php foreach ($whatWeDo as $whatWeDoOption) {
            foreach ($entries as $entry) {
              if($whatWeDoOption['sys']['id'] == $entry['sys']['id']){
                $id = strtolower(str_replace(' ', '_', $entry['fields']['tabName']));
              ?>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="heading-<?php echo $id ?>">
                      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $id ?>" aria-expanded="true" aria-controls="collapse-<?php echo $id ?>"><?php echo $entry['fields']['tabName'] ?></a>
                  </div>
                  <div id="collapse-<?php echo $id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-<?php echo $id ?>">
                      <div class="panel-body">
                          <h3 class="panel-title">
                            <span class="icon"><img src="assets/images/<?php echo $entry['fields']['icon'] ?>" /></span>
                            <?php echo $entry['fields']['headline'] ?>
                          </h3>
                          <p class="panel-content"><?php echo $entry['fields']['description'] ?></p>
                      </div>
                  </div>
                </div>
          <?php } } } ?>
        </div>
    </div>
</section>

<?php require("assets/templates/footer.php"); ?>
