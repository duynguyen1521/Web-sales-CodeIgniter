<div class="box-center"><!-- The box-center product-->
    <div class="tittle-box-center">
        <h2>Chỉnh sửa thông tin thành viên</h2>
    </div>
    <div class="box-content-center register"><!-- The box-content-center -->
        <form enctype="multipart/form-data" action="<?php echo base_url('user/edit'); ?>" method="post" class="t-form form_action">
            <div class="form-row">
                <label class="form-label" for="param_email">Email:<span class="req">*</span></label>
                <div class="form-item">
                    <?php echo $user->email; ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-row">
                <label class="form-label" for="param_password">Mật khẩu:</label>
                <div class="form-item">
                    <input type="password" name="password" id="password" class="input">
                    <div class="clear"></div>
                    <p>Nếu thay đổi mật khẩu thì sửa trường này</p>
                    <div id="password_error" class="error"><?php echo form_error('password'); ?></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-row">
                <label class="form-label" for="param_re_password">Gõ lại mật khẩu:</label>
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
                    <input type="text" value="<?php echo $user->name; ?>" name="name" id="name" class="input">
                    <div class="clear"></div>
                    <div id="name_error" class="error"><?php echo form_error('name'); ?></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="form-row">
                <label class="form-label" for="param_phone">Số điện thoại:<span class="req">*</span></label>
                <div class="form-item">
                    <input type="text" value="<?php echo $user->phone; ?>" name="phone" id="phone" class="input">
                    <div class="clear"></div>
                    <div id="phone_error" class="error"><?php echo form_error('phone'); ?></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-row">
                <label class="form-label" for="param_address">Địa chỉ:<span class="req">*</span></label>
                <div class="form-item">
                    <textarea name="address" id="address" class="input"><?php echo $user->address; ?></textarea>
                    <div class="clear"></div>
                    <div id="address_error" class="error"><?php echo form_error('address'); ?></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-row">
                <div class="form-item">
                    <input type="submit" name="submit" value="Cập nhật" class="button">
                </div>
            </div>
        </form>
    </div>
</div>
