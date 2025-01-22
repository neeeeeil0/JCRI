<div class="modal fade" id="myModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 450px;">
        <div class="modal-content" style="background-color: rgba(255, 255, 255, 0.95); padding: 40px; border-radius: 10px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);">
            <div class="modal-header" style="border-bottom: none; padding-bottom: 0; text-align: center;">
            <img src="plugins/home-plugins/img/slides/logo2.png" alt="Login Logo" style="width: 200px; margin-bottom: 10px; filter: drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.25));">
                <hr style="border-top: 2px solid #eee; margin-bottom: 35px;">
            </div>
            <div class="modal-body" style="padding-top: 0;">
                <p style="color: #d9534f; text-align: center; margin-bottom: 20px;"></p>
                <form action="" method="post">
                    <div class="form-group" style="margin-bottom: 25px;">
                        <input type="text" class="form-control" placeholder="Username" name="user_email" id="user_email" style="padding: 12px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; width: 100%; font-size: 16px;">
                    </div>
                    <div class="form-group" style="margin-bottom: 30px;">
                        <input type="password" class="form-control" placeholder="Password" name="user_pass" id="user_pass" style="padding: 12px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; width: 100%; font-size: 16px;">
                    </div>
                    <div class="row">
                        <div class="col-xs-12" style="text-align: center;">
                            <button type="submit" name="btnLogin" id="btnlogin" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; padding: 12px 25px; border-radius: 5px; width: 100%; display: inline-block; font-size: 16px; font-weight: 500; transition: background-color 0.3s ease;">Login</button>
                        </div>
                    </div>
                </form>
                <div style="text-align: center; margin-top: 25px; color: #777;">
                    <a href="<?php echo web_root; ?>index.php?q=register" class="text-center" style="color: #007bff;">Register a new membership</a>
                </div>
            </div>
        </div>
    </div>
</div>
