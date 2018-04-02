<?php
$this->load->view('admin/news/head');
?>

<div class="wrapper">
    <!-- Form -->
    <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url('admin/images/icons/dark/add.png'); ?>" class="titleIcon">
                    <h6>Thêm mới bài viết</h6>
                </div>

                <ul class="tabs">
                    <li><a href="#tab1">Thông tin chung</a></li>
                    <li><a href="#tab2">SEO Onpage</a></li>
                    <li><a href="#tab3">Nội dung</a></li>
                </ul>

                <div class="tab_container">
                    <div id="tab1" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft" for="param_title">Tiêu đề:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="title" id="param_title" _autocheck="true" type="text" value="<?php echo set_value('title'); ?>"></span>
                                <span name="title_autocheck" class="autocheck"></span>
                                <div name="title_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft">Hình ảnh:<span class="req">*</span></label>
                            <div class="formRight">
                                <div class="left">
                                    <input type="file" id="image" name="image">
                                </div>
                                <div name="image_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow hide"></div>
                    </div>

                    <!-- Tab SEO -->
                    <div id="tab2" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft" for="param_meta_desc">Meta description:</label>
                            <div class="formRight">
                                <span class="oneTwo"><textarea name="meta_desc" id="param_meta_desc" _autocheck="true" rows="4" cols=""></textarea></span>
                                <span name="meta_desc_autocheck" class="autocheck"></span>
                                <div name="meta_desc_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="formRow">
                            <label class="formLeft" for="param_meta_key">Meta keywords:</label>
                            <div class="formRight">
                                <span class="oneTwo"><textarea name="meta_key" id="param_meta_key" _autocheck="true" rows="4" cols=""></textarea></span>
                                <span name="meta_key_autocheck" class="autocheck"></span>
                                <div name="meta_key_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow hide"></div>
                    </div>

                    <!-- Tab content -->
                    <div id="tab3" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft">Nội dung bài viết:</label>
                            <div class="formRight">
                                <textarea name="content" id="param_content" class="editor" value="<?php echo set_value('content'); ?>"></textarea>
                                <div name="content_error" class="clear error"></div>
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
