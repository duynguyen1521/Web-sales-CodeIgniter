<?php
$this->load->view('admin/user/head');
?>

<div class="wrapper">
    <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url('admin/images/icons/dark/add.png'); ?>" class="titleIcon">
                    <h6>Thêm mới thành viên</h6>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_name">Tên thành viên:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="name" id="param_name" _autocheck="true" type="text" value="<?php echo set_value('name'); ?>">
                        </span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php echo form_error('name'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_email">Email:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="email" id="param_email" _autocheck="true" type="text" value="<?php echo set_value('email'); ?>">
                        </span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php echo form_error('email'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_phone">Số điện thoại:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="phone" id="param_phone" _autocheck="true" type="text" value="<?php echo set_value('phone'); ?>">
                        </span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php echo form_error('phone'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_address">Địa chỉ:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="address" id="param_address" _autocheck="true" type="text" value="<?php echo set_value('address'); ?>">
                        </span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php echo form_error('address'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_password">Password:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="password" id="param_password" _autocheck="true" type="password">
                        </span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php echo form_error('password'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_re_password">Nhập lại password:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="re_password" id="param_re_password" _autocheck="true" type="password">
                        </span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php echo form_error('re_password'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formSubmit">
                    <input type="submit" value="Thêm mới" class="redB">
                    <a href="<?php echo admin_url('user');?>"><input type="button" value="Hủy bỏ"></a>
                </div>
                <div class="clear"></div>
            </div>
        </fieldset>
    </form>
</div>


