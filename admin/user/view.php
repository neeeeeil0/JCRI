<?php  
if (!isset($_SESSION['ADMIN_USERID'])){
    redirect(web_root."admin/index.php");
}
if (!$_SESSION['ADMIN_ROLE'] == 'Administrator'){
    redirect(web_root."admin/index.php");
}
@$USERID = $_SESSION['ADMIN_USERID'];
if ($USERID == ''){
    redirect("index.php");
}
$user = New User();
$singleuser = $user->single_user($USERID);
?>
<div class="container">
    <div class="panel-body inf-content">
        <div class="row">
            <!-- Profile Section (Flexbox Container) -->
            <div class="col-md-12 d-flex align-items-start">
                <!-- Profile Image -->
                <div class="col-md-4">
                    <a data-target="#myModal" data-toggle="modal" href="" title="Click here to Change Image.">
                        <img alt="" 
                             style="width: 300px; height: 300px; border-radius: 50%; object-fit: cover;" 
                             class="img-circle img-thumbnail isTooltip" 
                             src="<?php echo web_root . 'admin/user/' . $singleuser->PICLOCATION; ?>" 
                             data-original-title="User">
                    </a>  
                </div>

                <!-- Profile Details Section -->
                <div class="col-md-6" style="padding: 30px; ">
                    <h2 style="font-size: 2rem; font-weight: bold; color: #333; text-align: center;">User Profile</h2>

                    <!-- Profile Display Information -->
                    <div id="profileDisplay" style="font-size: 1.6rem; color: #555; margin-top: 20px;">
                        <div style="margin-bottom: 15px;">
                            <p><strong>Employee ID:</strong> <span style="font-weight: normal;">JCRI202512312</span></p>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <p><strong>Name:</strong> <span style="font-weight: normal;"><?php echo $singleuser->FULLNAME; ?></span></p>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <p><strong>Username:</strong> <span style="font-weight: normal;"><?php echo $singleuser->USERNAME; ?></span></p>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <p><strong>Contact No.:</strong> <span style="font-weight: normal;">0912377123</span></p>
                        </div>
                        <div style="margin-bottom: 15px;">
                            <p><strong>Email:</strong> <span style="font-weight: normal;">Neil012@gmail.com</span></p>
                        </div>
                        <div style="margin-bottom: 20px;">
                            <p><strong>Role:</strong> <span style="font-weight: normal;"><?php echo $singleuser->ROLE; ?></span></p>
                        </div>
                        <button class="btn btn-primary" id="editProfileBtn" style="font-size: 1.6rem; padding: 12px 25px; border-radius: 5px; background-color: #007bff; border-color: #007bff; font-weight: bold;">Edit Profile</button>
                    </div>

                    <!-- Edit Profile Form (Initially Hidden) -->
                    <div id="profileEditForm" style="display: none; font-size: 1.6rem; color: #555; margin-top: 20px;">
                        <form class="form-horizontal span6" action="controller.php?action=edit&view=" method="POST">
                            <input id="USERID" name="USERID" type="hidden" value="<?php echo $singleuser->USERID; ?>">

                            <!-- Employee ID (Non-Editable) -->
                            <div class="form-group">
                                <label for="EMPLOYEEID" class="control-label">Employee ID:</label>
                                <input class="form-control input-sm" id="EMPLOYEEID" name="EMPLOYEEID" type="text" value="JCRI202512312" readonly style="background-color: #e9ecef; font-size: 1.6rem;">
                            </div>

                            <!-- Editable Fields -->
                            <div class="form-group">
                                <label for="U_NAME" class="control-label">Name:</label>
                                <input class="form-control input-sm" id="U_NAME" name="U_NAME" type="text" value="<?php echo $singleuser->FULLNAME; ?>" style="font-size: 1.6rem;">
                            </div>

                            <div class="form-group">
                                <label for="U_USERNAME" class="control-label">Username:</label>
                                <input class="form-control input-sm" id="U_USERNAME" name="U_USERNAME" type="text" value="<?php echo $singleuser->USERNAME; ?>" style="font-size: 1.6rem;">
                            </div>

                            <div class="form-group">
                                <label for="CONTACTNO" class="control-label">Contact No.:</label>
                                <input class="form-control input-sm" id="CONTACTNO" name="CONTACTNO" type="text" value="0912377123" style="font-size: 1.6rem;">
                            </div>

                            <div class="form-group">
                                <label for="EMAIL" class="control-label">Email:</label>
                                <input class="form-control input-sm" id="EMAIL" name="EMAIL" type="email" value="Neil012@gmail.com" style="font-size: 1.6rem;">
                            </div>

                            <div class="form-group">
                                <label for="U_PASS" class="control-label">Password:</label>
                                <input class="form-control input-sm" id="U_PASS" name="U_PASS" type="password" required placeholder="Enter a new password" style="font-size: 1.6rem;">
                            </div>

                            <div class="form-group">
                                <label for="U_ROLE" class="control-label">Role:</label>
                                <select class="form-control input-sm" id="U_ROLE" name="U_ROLE" style="font-size: 1.6rem;">
                                    <option value="Administrator" <?php echo ($singleuser->ROLE == 'Administrator') ? 'selected' : ''; ?>>Administrator</option>
                                    <option value="Staff" <?php echo ($singleuser->ROLE == 'Staff') ? 'selected' : ''; ?>>Staff</option>
                                </select>
                            </div>

                            <div style="text-align: center;">
                                <button class="btn btn-success" type="submit" name="save" style="width: 150px; padding: 10px;">Save</button>
                                <button class="btn btn-secondary" type="button" id="cancelEditBtn" style="width: 150px; padding: 10px; margin-left: 10px;">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Image Upload -->
    <div class="modal fade" id="myModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">×</button>
                    <h4 class="modal-title" id="myModalLabel">Choose Image</h4>
                </div>
                <form action="controller.php?action=photos" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                        <input id="photo" name="photo" type="file">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" name="savephoto" type="submit">Upload Photo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle between display and edit modes
    document.getElementById('editProfileBtn').addEventListener('click', function() {
        document.getElementById('profileDisplay').style.display = 'none';
        document.getElementById('profileEditForm').style.display = 'block';
    });

    document.getElementById('cancelEditBtn').addEventListener('click', function() {
        document.getElementById('profileEditForm').style.display = 'none';
        document.getElementById('profileDisplay').style.display = 'block';
    });
</script>
