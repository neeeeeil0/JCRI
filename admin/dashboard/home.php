<style>
  .content-header small {
    display: block;
    color: #6c757d;
    font-size: 18px;
  }

  .content {
    padding: 30px;
  }

  .row {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
  }

  /* Ensure all items fit in a row on larger screens */
  .col-lg-3 {
    flex: 1 1 calc(25% - 20px); /* Ensure 4 items fit per row */
    max-width: calc(25% - 20px);
  }

  /* Card Styles */
  .small-box {
    padding: 25px;
    border-radius: 12px;
    color: white;
    text-align: center;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
  }

  .small-box:hover {
    transform: translateY(-5px);
    box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.2);
  }

  .small-box h3 {
    font-size: 40px;
    margin: 10px 0;
  }

  .small-box p {
    font-size: 18px;
    margin-bottom: 15px;
  }

  .small-box .icon {
    font-size: 50px;
    margin-bottom: 15px;
  }

  /* Make the whole box clickable */
  .small-box a {
    display: block;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
    text-decoration: none;
  }

  /* Background Color Variations */
  .bg-aqua {
    background: #17a2b8;
  }

  .bg-green {
    background: #28a745;
  }

  .bg-yellow {
    background: #ffc107;
  }

  .bg-red {
    background: #dc3545;
  }

  /* Responsive Adjustments */
  @media (max-width: 1200px) {
    .col-lg-3 {
      flex: 1 1 calc(33.33% - 20px); /* 3 items per row on medium screens */
      max-width: calc(33.33% - 20px);
    }
  }

  @media (max-width: 768px) {
    .col-lg-3 {
      flex: 1 1 calc(50% - 20px); /* 2 items per row on small screens */
      max-width: calc(50% - 20px);
    }
  }

  @media (max-width: 480px) {
    .col-lg-3 {
      flex: 1 1 100%; /* 1 item per row on extra small screens */
      max-width: 100%;
    }
  }
</style>

<section class="content-header">
  <h1>
    Control Panel
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="small-box bg-aqua">
        <a href="<?php echo web_root;?>/admin/company/"></a>
        <div class="inner">
          <h3 id="company-count">150</h3>
          <p>Company</p>
        </div>
        <div class="icon">
          <i class="ion ion-business"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="small-box bg-green">
        <a href="<?php echo web_root;?>/admin/category/"></a>
        <div class="inner">
          <h3 id="category-count">53</h3>
          <p>Classification</p>
        </div>
        <div class="icon">
          <i class="ion ion-filing"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="small-box bg-yellow">
        <a href="<?php echo web_root;?>/admin/vacancy/"></a>
        <div class="inner">
          <h3 id="vacancy-count">44</h3>
          <p>Vacancy</p>
        </div>
        <div class="icon">
          <i class="ion ion-briefcase"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="small-box bg-red">
        <a href="<?php echo web_root;?>/admin/applicants/"></a>
        <div class="inner">
          <h3 id="applicant-count">65</h3>
          <p>Applicants</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-stalker"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="small-box bg-purple">
        <a href="<?php echo web_root;?>/admin/acceptedapplicants/"></a>
        <div class="inner">
          <h3 id="hired-count">65</h3>
          <p>Hired Applicants</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-stalker"></i>
        </div>
      </div>
    </div>

  </div>
      
</section>
<script>
    // Function to update the count using AJAX
    function updateApplicantsCount() {
      $.ajax({
          url: '<?php echo web_root?>/admin/dashboard/ajax.php', // Replace with the actual path to your AJAX handler
          type: 'GET',
          dataType: 'json', // Expect JSON response
          success: function(data) {
              $('#company-count').html(data.company);
              $('#category-count').html(data.category);
              $('#vacancy-count').html(data.vacancy);
              $('#applicant-count').html(data.applicant);
              //$('#employee-count').html(data.applicant);
              $('#hired-count').html(data.hired);
          }
      });
  }

  // Initial call to update the count
  updateApplicantsCount();

  // Set an interval to update the count periodically (e.g., every 5 seconds)
  setInterval(updateApplicantsCount, 1000); 
</script>

  