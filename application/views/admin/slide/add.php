<?php
$this->load->view('admin/slide/head');
?>

<div class="wrapper">
    <!-- Form -->
    <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url('admin/images/icons/dark/add.png'); ?>" class="titleIcon">
                    <h6>Thêm mới slide</h6>
                </div>

                <ul class="tabs">
                    <li><a href="#tab1">Thông tin chung</a></li>
                </ul>

                <div class="tab_container">
                    <div id="tab1" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft" for="param_name">Tên slide:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="name" id="param_name" _autocheck="true" type="text" value="<?php echo set_value('name'); ?>"></span>
                                <span name="name_autocheck" class="autocheck"></span>
                                <div name="name_error" class="clear error"><?php echo form_error('name'); ?></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="param_link">Link:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="link" id="param_link" _autocheck="true" type="text" value="<?php echo set_value('link'); ?>"></span>
                                <span name="link_autocheck" class="autocheck"></span>
                                <div name="link_error" class="clear error"><?php echo form_error('link'); ?></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="param_sort_order">Thứ tự hiển thị:</label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="sort_order" id="param_sort_order" _autocheck="true" type="text" value="<?php echo set_value('sort_order'); ?>"></span>
                                <span name="sort_order_autocheck" class="autocheck"></span>
                                <div name="sort_order_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="param_info">Mô tả:</label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="info" id="param_info" _autocheck="true" type="text" value="<?php echo set_value('info'); ?>"></span>
                                <span name="info_autocheck" class="autocheck"></span>
                                <div name="info_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft">Hình ảnh:<span class="req">*</span></label>
                            <div class="formRight">
                                <div class="left">
                                    <input type="file" id="image" name="image">
                                </div>
                                <div name="image_error" class="clear error"><?php echo form_error('image'); ?></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow hide"></div>
                    </div>
                </div><!-- End tab_container-->

                <div class="formSubmit">
                    <input type="submit" value="Thêm mới" class="redB">
                    <input type="reset" value="Hủy bỏ" class="basic">
                </div>
                <div class="clear"></div>
            </div>
        </fieldset>
    </form>
</div>

<div class="clear mt30"></div>
