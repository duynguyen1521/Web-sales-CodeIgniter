<?php
    $this->load->view('admin/support/head');
?>

<div class="wrapper">
    <!-- Form -->
    <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url('admin/images/icons/dark/add.png'); ?>" class="titleIcon">
                    <h6>Cập nhật hỗ trợ viên</h6>
                </div>

                <ul class="tabs">
                    <li><a href="#tab1">Thông tin chung</a></li>
                </ul>

                <div class="tab_container">
                    <div id="tab1" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft" for="param_name">Tên hỗ trợ viên:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="name" id="param_name" _autocheck="true" type="text" value="<?php echo $support->name; ?>"></span>
                                <span name="name_autocheck" class="autocheck"></span>
                                <div name="name_error" class="clear error"><?php echo form_error('name'); ?></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="param_yahoo">Yahoo:</label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="yahoo" id="param_yahoo" _autocheck="true" type="text" value="<?php echo $support->yahoo; ?>"></span>
                                <span name="yahoo_autocheck" class="autocheck"></span>
                                <div name="yahoo_error" class="clear error"><?php echo form_error('yahoo'); ?></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="param_gmail">Gmail:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="gmail" id="param_gmail" _autocheck="true" type="text" value="<?php echo $support->gmail; ?>"></span>
                                <span name="gmail_autocheck" class="autocheck"></span>
                                <div name="gmail_error" class="clear error"><?php echo form_error('gmail'); ?></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="param_skype">Skype:</label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="skype" id="param_skype" _autocheck="true" type="text" value="<?php echo $support->skype; ?>"></span>
                                <span name="skype_autocheck" class="autocheck"></span>
                                <div name="skype_error" class="clear error"><?php echo form_error('skype'); ?></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="param_phone">Phone:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="phone" id="param_phone" _autocheck="true" type="text" value="<?php echo $support->phone; ?>"></span>
                                <span name="phone_autocheck" class="autocheck"></span>
                                <div name="phone_error" class="clear error"><?php echo form_error('phone'); ?></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="param_sort_order">Thứ tự hiển thị:</label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="sort_order" id="param_sort_order" _autocheck="true" type="text" value="<?php echo $support->sort_order; ?>"></span>
                                <span name="sort_order_autocheck" class="autocheck"></span>
                                <div name="sort_order_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow hide"></div>
                    </div>
                </div><!-- End tab_container-->

                <div class="formSubmit">
                    <input type="submit" value="Cập nhật" class="redB">
                    <input type="reset" value="Hủy bỏ" class="basic">
                </div>
                <div class="clear"></div>
            </div>
        </fieldset>
    </form>
</div>

<div class="clear mt30"></div>
