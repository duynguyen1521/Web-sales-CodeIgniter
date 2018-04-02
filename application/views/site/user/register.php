<div class="box-center"><!-- The box-center product-->
    <div class="tittle-box-center">
        <h2>Đăng kí thành viên</h2>
    </div>
    <div class="box-content-center register"><!-- The box-content-center -->
        <form enctype="multipart/form-data" action="<?php echo base_url('user/register'); ?>" method="post" class="t-form form_action">
            <div class="form-row">
                <label class="form-label" for="param_email">Email:<span class="req">*</span></label>
                <div class="form-item">
                    <input type="text" value="<?php echo set_value('email'); ?>" name="email" id="email" class="input">
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
                <label class="form-label" for="param_re_password">Gõ lại mật khẩu:<span class="req">*</span></label>
                <div class="form-item">
                    <input type="password" name="re_password" id="re_password" class="input">
                    <div class="clear"></div>
                    <div id="re_password_error" class="error"><?php echo form_error('re_password'); ?></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-row">
                <label class="form-label" for="param_name">Họ và tên:<span class="req">*</span></label>
                <div class="form-item">
                    <input type="text" value="<?php echo set_value('name'); ?>" name="name" id="name" class="input">
                    <div class="clear"></div>
                    <div id="name_error" class="error"><?php echo form_error('name'); ?></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-row">
                <label class="form-label" for="param_phone">Số điện thoại:<span class="req">*</span></label>
                <div class="form-item">
                    <input type="text" value="<?php echo set_value('phone'); ?>" name="phone" id="phone" class="input">
                    <div class="clear"></div>
                    <div id="phone_error" class="error"><?php echo form_error('phone'); ?></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-row">
                <label class="form-label" for="param_address">Địa chỉ:<span class="req">*</span></label>
                <div class="form-item">
                    <textarea name="address" id="address" class="input"><?php echo set_value('address'); ?></textarea>
                    <div class="clear"></div>
                    <div id="address_error" class="error"><?php echo form_error('address'); ?></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-row">
                <label class="form-label">&nbsp;</label>
                <div class="form-item">
                    <input type="submit" name="submit" value="Đăng ký" class="button">
                </div>
            </div>
        </form>
    </div>
</div>
