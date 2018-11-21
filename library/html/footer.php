 <!-- Footer Section -->
    <section id="footer" class="content-section text-center footerCSS">
      <div class="container">
        <div class="row footerTitle">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <h6 class = "footerAdjust">About us</h6>
			  <ul class = "footerList" >
				  <li>
				  <a href="#" style="font-size: 0.8em;"><span style="font-family:'HelveticaBlkFile', sans-serif;font-size: 1.4em;color:white;">coffee</span><span id="fadelogostretch" style="font-family:'Helvetica45File', sans-serif;font-size: 1.4em;color:white;">break</span> Café International 
				  </a>
				  </li>
				  <hr width = "70%">
				  <small>
				  	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam maximus nisi non libero mollis, sed tempor lacus ultricies. Donec augue odio, pharetra eu dolor in, faucibus volutpat risuslore
				  </small>
			  </ul>
		  </div>
		  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			  <h6 class = "footerAdjust">Investor Relations</h6>
			  <ul class = "footerList" >
				  <li><a href = "about.php">Our Coffee Story</a></li>
				  <li><a href = "https://coffeebreak.ph/portal/">Partners</a></li>
				  <li><a href = "news.php">News</a></li>
				  <li><a href = "franchise.php">Franchise Program</a></li>
				  <li><a href = "careers.php">Be one of us!</a></li>
			  </ul>
		  </div>
		  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			  <h6 class = "footerAdjust">Quick Links</h6>
			  <ul class = "footerList" >
				  <li><a href = "menu.php">Menu</a></li>
				  <li><a href = "https://coffeebreak.ph/portal/">Coffee Club</a></li>
				  <li><a href = "store-locator.php">Store Locator</a></li>
				  <li><a href = "https://coffeebreak.ph/portal/">Wifi Access</a></li>
				  <li>
					  <?php if($user)
						{
					  ?>
					  	<a href = "cms.php">CMS</a>
				  	  <?php
						}
					  else
					  {
					  ?>
				  		<a href = "login.php">CMS</a>
					  <?php
						  
					  }
					  ?>
					  </li>
			  </ul>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			  <h6 class = "footerAdjust">Contact</h6>
			  <ul class = "footerList" >
				  <li>
					  <small>
						  <i class="fas fa-home"></i>&nbsp;
						  Door 5, Q.H.P. Business Center, Arsenal St. Iloilo City, 5000, Philippines
					  </small>
				  </li>
				  <li>
					  <small>
						  <i class="fas fa-phone"></i> &nbsp;
						  (033) 335 - 09 - 35
					  </small>
				  </li>
				  <li>
					  <small>
						  <i class="fas fa-envelope"></i> &nbsp;
						  customercare@coffeebreak.ph
					  </small>
				  </li>
				  <li>
					  <small>
						  <i class="fas fa-fax"></i> &nbsp;
						  (033) 335 - 00 - 26
					  </small>
				  </li>
				
			  </ul>
			
			<br>
			
			<span class = "pull-right">
				
			  	<a href = "https://fb.com/CoffeebreakCafe"><i class="fab fa-facebook-square" style = "font-size: 35px;"> </i></a>
				<a href = "https://twitter.com/iamcoffeebreak"><i class="fab fa-twitter-square" style = "font-size: 35px;"> </i></a>
				<a href = "https://instagram.com/coffeebreakph"><i class="fab fa-instagram" style = "font-size: 35px;"></i></a>
		
			</span>
       	
          </div>
        </div>
      </div>
    </section>

  
    <!-- Footer -->
    <footer style = "background-color:  black; color: white;">
      <div class="container text-center">
        <p>Coffeebreak Café International Inc., &copy; All Rights Reserved 2018</p>
      </div>
    </footer>
