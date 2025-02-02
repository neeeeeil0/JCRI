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
        <a href="<?php echo web_root;?>/admin/inbox/"></a>
        <div class="inner">
          <h3 id="inbox-count">65</h3>
          <p>Inbox</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-stalker"></i>
        </div>
      </div>
    </div>

  </div>
      <!-- /.row -->
      <!-- Main row 
      <div class="row">
        
        <section class="col-lg-7 connectedSortable">
          
          <div class="nav-tabs-custom">
            
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
              <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
            </ul>
            <div class="tab-content no-padding">
              
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            </div>
          </div>
       

      
          <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-comments-o"></i>

              <h3 class="box-title">Chat</h3>

              <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                <div class="btn-group" data-toggle="btn-toggle">
                  <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                </div>
              </div>
            </div>
            <div class="box-body chat" id="chat-box">
              
              <div class="item">
                <img src="dist/img/user4-128x128.jpg" alt="user image" class="online">

                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                    Mike Doe
                  </a>
                  I would like to meet you to discuss the latest news about
                  the arrival of the new theme. They say it is going to be one the
                  best themes on the market
                </p>
                <div class="attachment">
                  <h4>Attachments:</h4>

                  <p class="filename">
                    Theme-thumbnail-image.jpg
                  </p>

                  <div class="pull-right">
                    <button type="button" class="btn btn-primary btn-sm btn-flat">Open</button>
                  </div>
                </div>
                
              </div>
              
              <div class="item">
                <img src="dist/img/user3-128x128.jpg" alt="user image" class="offline">

                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                    Alexander Pierce
                  </a>
                  I would like to meet you to discuss the latest news about
                  the arrival of the new theme. They say it is going to be one the
                  best themes on the market
                </p>
              </div>
              
              <div class="item">
                <img src="dist/img/user2-160x160.jpg" alt="user image" class="offline">

                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                    Susan Doe
                  </a>
                  I would like to meet you to discuss the latest news about
                  the arrival of the new theme. They say it is going to be one the
                  best themes on the market
                </p>
              </div>
              
            </div>
           
            <div class="box-footer">
              <div class="input-group">
                <input class="form-control" placeholder="Type message...">

                <div class="input-group-btn">
                  <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                </div>
              </div>
            </div>
          </div>
         
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">To Do List</h3>

              <div class="box-tools pull-right">
                <ul class="pagination pagination-sm inline">
                  <li><a href="#">&laquo;</a></li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
          
            <div class="box-body">
              <ul class="todo-list">
                <li>
                
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                
                  <input type="checkbox" value="" name="">
                 
                  <span class="text">Design a nice theme</span>
                  
                  <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                 
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="" name="">
                  <span class="text">Make the theme responsive</span>
                  <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="" name="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="" name="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="" name="">
                  <span class="text">Check your messages and notifications</span>
                  <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
                <li>
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  <input type="checkbox" value="" name="">
                  <span class="text">Let theme shine like a star</span>
                  <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                  <div class="tools">
                    <i class="fa fa-edit"></i>
                    <i class="fa fa-trash-o"></i>
                  </div>
                </li>
              </ul>
            </div>
           
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
            </div>
          </div>
       

          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
           
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
          
            </div>
            <div class="box-body">
              <form action="#" method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </form>
            </div>
            <div class="box-footer clearfix">
              <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                <i class="fa fa-arrow-circle-right"></i></button>
            </div>
          </div>

        </section>
        
        <section class="col-lg-5 connectedSortable">

          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">
        
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range">
                  <i class="fa fa-calendar"></i></button>
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
           

              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">
                Visitors
              </h3>
            </div>
            <div class="box-body">
              <div id="world-map" style="height: 250px; width: 100%;"></div>
            </div>
  
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-1"></div>
                  <div class="knob-label">Visitors</div>
                </div>
             
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-2"></div>
                  <div class="knob-label">Online</div>
                </div>
  
                <div class="col-xs-4 text-center">
                  <div id="sparkline-3"></div>
                  <div class="knob-label">Exists</div>
                </div>
                
              </div>
              
            </div>
          </div>
          
          <div class="box box-solid bg-teal-gradient">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Sales Graph</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
              <div class="chart" id="line-chart" style="height: 250px;"></div>
            </div>
   
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">Mail-Orders</div>
                </div>
         
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">Online</div>
                </div>
               
                <div class="col-xs-4 text-center">
                  <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">In-Store</div>
                </div>
             
              </div>
          
            </div>
         
          </div>
         
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendar</h3>
           
              <div class="pull-right box-tools">
            
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#">Add new event</a></li>
                    <li><a href="#">Clear events</a></li>
                    <li class="divider"></li>
                    <li><a href="#">View calendar</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            
            </div>
        
            <div class="box-body no-padding">
       
              <div id="calendar" style="width: 100%"></div>
            </div>
       
            <div class="box-footer text-black">
              <div class="row">
                <div class="col-sm-6">
                
                  <div class="clearfix">
                    <span class="pull-left">Task #1</span>
                    <small class="pull-right">90%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #2</span>
                    <small class="pull-right">70%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                  </div>
                </div>
          
                <div class="col-sm-6">
                  <div class="clearfix">
                    <span class="pull-left">Task #3</span>
                    <small class="pull-right">60%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #4</span>
                    <small class="pull-right">40%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                  </div>
                </div>
                
              </div>
              
            </div>
          </div>
          

        </section>
      
      </div>-->
      
</section>
<script>
    // Function to update the count using AJAX
    function updateApplicantsCount() {
      $.ajax({
          url: 'ajax.php', // Replace with the actual path to your AJAX handler
          type: 'GET',
          dataType: 'json', // Expect JSON response
          success: function(data) {
              $('#company-count').html(data.company);
              $('#category-count').html(data.category);
              $('#vacancy-count').html(data.vacancy);
              $('#applicant-count').html(data.applicant);
              //$('#employee-count').html(data.applicant);
              $('#inbox-count').html(data.inbox);
          }
      });
  }

  // Initial call to update the count
  updateApplicantsCount();

  // Set an interval to update the count periodically (e.g., every 5 seconds)
  setInterval(updateApplicantsCount, 1000); 
</script>

  