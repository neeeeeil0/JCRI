 
<section id="content">
	
	<div class="container">
		<div class="row"> 
			<div class="col-md-12">
				<div class="about-logo">
					<h3>Company Address</h3>
					<p style="font-size: 16px;">Room 529, 531 & 533 5th Floor, J & T Bldg, 3894 
						Magsaysay Blvd, Santa Mesa, Manila, 1008 Metro Manila, Manila, Philippines</p><br>
					<h3>Contact Number</h3>
					<p style="font-size: 16px;">0995 785 9809</p><br>
					<h3>Email</h3>
					<p style="font-size: 16px;">careers.jobconnect@gmail.com</p>
				</div>  
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">

				<form action="process.php?action=sendmail" method="POST" name="sentMessage" id="contactForm" novalidate class="max-w-lg mx-auto p-6 bg-white shadow-lg rounded-2xl space-y-4">
					<h3 class="text-2xl font-bold text-gray-800 ">Contact Me</h3>
						
					<div class="control-group">
						<div class="controls">
							<label for="name" class="block text-sm font-medium text-gray-600 mb-1">Full Name</label>
							<input type="text" name="fullname" class="form-control w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
								placeholder="Enter your full name" id="name" required
								data-validation-required-message="Please enter your name" />
							<p class="help-block text-sm text-red-500 mt-1"></p>
						</div>
					</div> 

					<div class="control-group">
						<div class="controls">
							<label for="email" class="block text-sm font-medium text-gray-600 mb-1">Email</label>
							<input type="email" name="email" class="form-control w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
								placeholder="Enter your email" id="email" required
								data-validation-required-message="Please enter your email" />
							<p class="help-block text-sm text-red-500 mt-1"></p>
						</div>
					</div> 
						
					<div class="control-group">
						<div class="controls">
							<label for="message" class="block text-sm font-medium text-gray-600 mb-1">Message</label>
							<textarea rows="5" name="message" class="form-control w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
								placeholder="Enter your message" id="message" required
								data-validation-required-message="Please enter your message" minlength="5" 
								data-validation-minlength-message="Min 5 characters" maxlength="999" style="resize:none"></textarea>
							<p class="help-block text-sm text-red-500 mt-1"></p>
						</div>
					</div> 

					<div id="success" class="text-center text-green-500 text-sm"></div> <!-- For success/fail messages -->
					
					<button type="submit" name="submit" class="btn btn-primary w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">Send</button>
				</form>
			</div>

			<div class="col-md-6">
				<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

				<div style="overflow:hidden;height:500px;width:600px;">
					<div id="gmap_canvas" style="height:500px;width:600px;">

					</div>
					<style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
					<a class="google-map-code" href="http://www.trivoo.net" id="get-map-data">trivoo</a>
				</div>
				<script type="text/javascript"> 
					function init_map(){var myOptions = {
						zoom:14,center:new google.maps.LatLng(14.6021584,121.0083393),
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};

					map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
					marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(14.6021584,121.0083393)});
					infowindow = new google.maps.InfoWindow({content:"<b>Santa Mesa</b><br/>Manila<br/> Philippines" });
					google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});
					infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);
				</script>
			</div>
		</div>
							
	</div>
 
</section>
 