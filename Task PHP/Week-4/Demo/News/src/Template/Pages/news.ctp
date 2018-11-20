<!-- CONTAINER-LEFT -->
<div class="container--left">
  <!-- HOME -->
  <div class="home">
	  <div class="content">
      <?php
        if (isset($data)) {
          foreach ($data['listType'] as $type) {
            echo "<p class='title title-list uppercase'>".$type['name']."</p>";
            foreach ($data['listNew'] as $row) {
              if ($row['type_of_news_id'] ==  $type['id']) {
                echo "
                <div class='row'>
                  <img src='img/".$row['image']."' alt='image'>
                  <a class='label' href='#'>".$row['title']."</a>
                  <p>".$row['content']."</p>
                </div>";
              }
            }
          }
        } else {
          echo "<h1>Không có dữ liệu để hiển thị.</h1>";
        }
      ?>
	  </div>
  	<img class="home-logo" src="img/test/confidential-logo.gif" alt="daily_celebrity_logo">
  </div>
  <!-- /HOME -->
</div>
<!-- /CONTAINER-LEFT -->

<!-- CONTAINER-RIGHT -->
<div class="container--right">
  <img src="img/test/Entertainment.gif" alt="entertaiment_logo">
  <div class="search">
  	<input class="input" type="text" name="txtSearch">
  	<input class="btn-search uppercase" type="submit" name="btnSearch" value="search"></button>
  </div>
</div>
<!-- /CONTAINER-RIGHT -->

<!-- CONTAINER-OPTIONS -->
<div class="container__options">
  <a class="options__item" href="#">
  	<img src="img/test/phone.GIF" alt="new_mobile">
  	New on your mobile
  </a>
  <a class="options__item" href="#">
  	<img class="margin-top-14" src="img/test/wave.GIF" alt="rss_feeds">
  	RSS feeds
  </a>
  <a class="options__item" href="#">
  	<img src="img/test/letter.GIF" alt="new_letter">
  	Newsletters
  </a>
  <a class="options__item" href="#">
  	<img class="margin-top-14" src="img/test/circle.GIF" alt="send_stories">
  	Send your new stories
  </a>
  <a class="options__item" href="#">
  	<img class="margin-top-20" src="img/test/camera.GIF" alt="send_photos">
  	Send your news photos
  </a>
</div>
<!-- /CONTAINER-OPTIONS -->

<!-- FOOTER -->
<div class="footer">
  <div class="footer__contact">
    <ul class="contact-list">
    	<li><a href="#">Help</a></li>
    	<li><a href="#">Contact Us</a></li>
    	<li><a href="#">Advertise with Us</a></li>
    	<li><a href="#">Job Opportunities</a></li>
    	<li><a href="#">Terms & Conditions</a></li>
    	<li><a href="#">Privacy Policy</a></li>
    	<li><a href="#">Accessibility</a></li>
    	<li><a href="#">Sitemap</a></li>
    	<li><a href="#">News Headlines from Our Partners</a></li>
    </ul>
    <p>Copyright 2008 Limited. All times AEST (GM +10).</p>
  </div>
  <a href="#">Back to top</a>
</div>
<!-- /FOOTER -->