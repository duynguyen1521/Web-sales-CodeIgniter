<div class="box-center"><!-- The box-center product-->
    <div class="tittle-box-center">
        <h2>Thành viên đăng nhập</h2>
    </div>
    <div class="box-content-center login"><!-- The box-content-center -->
        <h3 style="color: red;"><?php echo form_error('login'); ?></h3>
        <form enctype="multipart/form-data" action="<?php echo base_url('user/login'); ?>" method="post" class="t-form form_action">
            <div class="form-row">
                <label class="form-label" for="param_email">Email:<span class="req">*</span></label>
                <div class="form-item">
                    <input type="text" value="" name="email" id="email" class="input">
                    <div class="clear"></div>
                    <div id="email_error" class="error"><?php echo form_error('email'); ?></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-row">
                <label class="form-label" for="param_password">Mật khẩu:<span class="req">*</span></label>
                <div class="form-item">
                    <input type="password" name="password" id="password" class="input">
                    <div class="clear"></div>
                    <div id="password_error" class="error"><?php echo form_error('password'); ?></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-row">
                <label class="form-label">&nbsp;</label>
                <div class="form-item">
                    <input type="submit" name="submit" value="Đăng nhập" class="button">
                </div>
            </div>
        </form>
    </div>
</div>
