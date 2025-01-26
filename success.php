<section id="content">
    <div class="container content">  
		<div class="alert alert-success alert-dismissible clearfix">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<div class="mg-alert-icon"><i class="fa fa-check"></i></div>
			<h3 class="mg-alert-payment"><?php check_message()?></h3>
		</div>
	</div>
</section>

<script>
        // Redirect to another page after 5 seconds
        setTimeout(function() {
            window.location.href = "applicant/index.php?view=appliedjobs";  // Replace with your target URL
        }, 3000); // 1000 milliseconds = 1 second
</script>