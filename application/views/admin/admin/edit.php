<?php
$this->load->view('admin/admin/head');
?>

<div class="wrapper">
    <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url('admin/images/icons/dark/add.png'); ?>" class="titleIcon">
                    <h6>Chỉnh sửa thông tin admin</h6>
                </div>
                <div class="formRow">
                    <label class="formLeft" for="param_name">Tên admin:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="name" id="param_name" _autocheck="true" type="text" value="<?php echo $info->name; ?>">
                        </span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php echo form_error('name'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_username">Username:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="username" id="param_username" _autocheck="true" type="text" value="<?php echo $info->username; ?>">
                        </span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error"><?php echo form_error('username'); ?></div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_password">Password:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo">
                            <input name="password" id="param_password" _autocheck="true" type="password">
                            <p style="color: darkgreen;">Nếu thay đổi mật khẩu thì mới nhập trường này</p>
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
                    <input type="submit" value="Chỉnh sửa" class="redB">
                    <a href="<?php echo admin_url('admin');?>"><input type="button" value="Hủy bỏ"></a>
                </div>
                <div class="clear"></div>
            </div>
        </fieldset>
    </form>
</div>


