 
<style type="text/css">
#content {
	min-height: 500px; 
}
#content .panel {
	padding: 10px;
}

 .panel-body label {
    padding: 5px 25px;
 	font-size: 25px; 
 }
 .panel-body input {
 	font-size: 15px;
 }
 .panel-body .btn {
    padding: 5px 25px;
 }

  .panel-body > .row {
  	margin-bottom:10px;
  }
</style>
<form action="index.php?q=result&searchfor=advancesearch" method="POST"> 
 <section id="content">
	<div class="container content">
		<div class="col-sm-1"></div>
		<div class="col-md-10">
					<div class="panel">
						<div class="panel-header"></div>
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-12 search1">
									<label class="col-sm-2">SEARCH:</label>
									<div class="col-sm-7">
										<input class="searchbar form-control" type="" name="SEARCH" placeholder="Enter a Keyword...">
									</div>
                                    <div class="col-sm-3">
										 <input type="submit" name="submit" class="btn btn-success">
									</div>
								</div>
							</div>    
								 
						</div>
					</div> 
		</div>
		<div class="col-sm-1"></div> 
	</div>
 </section>
 </form>