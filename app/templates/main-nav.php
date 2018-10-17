<header id="header">
    <div class="container">
        <a href="index.php" id="lrgr-logo"><img src="assets/images/lrgr_logo.png" alt="Lefkoff, Rubin, Gleason, & Russo, P.C. Attorney's at law" /></a>

        <button type="button" class="menu-toggle">
            <i class="fa fa-bars fa-lg"></i>
        </button>

        <nav id="site-nav">
            <div class="nav-inner">
            <ul>
                <li><a href="index.php" <?php if($pageId == "homepage"){ ?>class="active"<?php } ?>>Home</a></li>
                <li>
                  <i class="fa fa-chevron-down collapsed" data-toggle="collapse" data-target="#teamMembersNav"></i>
                  <a href="our-team.php" <?php if($pageId == "our-team"){ ?>class="active"<?php } ?>>Our Team</a>
                  <?php if($teamMembers){ ?>
                    <ul id="teamMembersNav" class="subnav collapse">
                    <?php foreach ($teamMembers as $key => $teamMember) { ?>
                      <li><a href="our-team.php#<?php echo $teamMember['fields']['tag'] ?>"><?php echo $teamMember['fields']['name'] ?></a></li>
                    <?php } ?>
                    </ul>
                  <?php } ?>
                </li>
                <li><a href="our-mission.php" <?php if($pageId == "our-mission"){ ?>class="active"<?php } ?>>Our Mission</a></li>
                <li><a href="contact-us.php" <?php if($pageId == "contact-us"){ ?>class="active"<?php } ?>>Contact Us</a></li>
            </ul>
            </div>
        </nav>
    </div>
</header>


