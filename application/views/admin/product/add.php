<?php
$this->load->view('admin/product/head');
?>

<div class="wrapper">
    <!-- Form -->
    <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <img src="<?php echo public_url('admin/images/icons/dark/add.png'); ?>" class="titleIcon">
                    <h6>Thêm mới Sản phẩm</h6>
                </div>

                <ul class="tabs">
                    <li><a href="#tab1">Thông tin chung</a></li>
                    <li><a href="#tab2">SEO Onpage</a></li>
                    <li><a href="#tab3">Bài viết</a></li>
                </ul>

                <div class="tab_container">
                    <div id="tab1" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft" for="param_name">Tên:<span class="req">*</span></label>
                            <div class="formRight">
                                <span class="oneTwo"><input name="name" id="param_name" _autocheck="true" type="text" value="<?php echo set_value('name'); ?>"></span>
                                <span name="name_autocheck" class="autocheck"></span>
                                <div name="name_error" class="clear error"></div>
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

                        <div class="formRow">
                            <label class="formLeft">Ảnh kèm theo:</label>
                            <div class="formRight">
                                <div class="left"><input type="file" id="image_list" name="image_list[]" multiple="">
                                </div>
                                <div name="image_list_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <!-- Price -->
                        <div class="formRow">
                            <label class="formLeft" for="param_price">Giá :<span class="req">*</span>
                            </label>
                            <div class="formRight">
                                <span class="oneTwo">
                                    <input name="price" style="width:100px" id="param_price" class="format_number" _autocheck="true" type="text" value="<?php echo set_value('price'); ?>">
                                    <img class="tipS" title="Giá bán sử dụng để giao dịch" style="margin-bottom:-8px" src="<?php echo public_url('admin/crown/images/icons/notifications/information.png'); ?>">
                                </span>
                                <span name="price_autocheck" class="autocheck"></span>
                                <div name="price_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <!-- discount-->
                        <div class="formRow">
                            <label class="formLeft" for="param_discount">Số tiền giảm giá (VNĐ)<span></span>:</label>
                            <div class="formRight">
                                <span>
                                    <input name="discount" style="width:100px" id="param_discount" class="format_number" type="text" value="<?php echo set_value('discount'); ?>">
                                    <img class="tipS" title="Số tiền giảm giá" style="margin-bottom:-8px"
                                         src="<?php echo public_url('admin/crown/images/icons/notifications/information.png'); ?>">
                                </span>
                                <span name="discount_autocheck" class="autocheck"></span>
                                <div name="discount_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <!-- catalog-->
                        <div class="formRow">
                            <label class="formLeft" for="param_cat">Thể loại:<span class="req">*</span></label>
                            <div class="formRight">
                                <select name="catalog" class="left">
                                    <option value=""></option>
                                    <?php foreach ($catalogs as $catalog): ?>
                                        <!-- kiem tra danh muc co danh muc con hay khong -->
                                        <?php if(count($catalog->subs) > 0): ?>
                                            <optgroup label="<?php echo $catalog->name; ?>">
                                                <?php foreach ($catalog->subs as $sub): ?>
                                                    <option value="<?php echo $sub->id; ?>" <?php echo ($this->input->get('catalog') == $sub->id) ? 'selected' : ''; ?>><?php echo $sub->name; ?></option>
                                                <?php endforeach; ?>
                                            </optgroup>
                                        <?php else: ?>
                                            <option value="<?php echo $catalog->id; ?>" <?php echo ($this->input->get('catalog') == $catalog->id) ? 'selected' : ''; ?> ><?php echo $catalog->name; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <span name="cat_autocheck" class="autocheck"></span>
                                <div name="cat_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <!-- warranty -->
                        <div class="formRow">
                            <label class="formLeft" for="param_warranty">Bảo hành :</label>
                            <div class="formRight">
                                <span class="oneFour"><input name="warranty" id="param_warranty" type="text" value="<?php echo set_value('warranty'); ?>"></span>
                                <span name="warranty_autocheck" class="autocheck"></span>
                                <div name="warranty_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <!-- gifts -->
                        <div class="formRow">
                            <label class="formLeft" for="param_gifts">Tặng quà:</label>
                            <div class="formRight">
                                <span class="oneTwo"><textarea name="gifts" id="param_gifts" rows="4" cols="" value="<?php echo set_value('gifts'); ?> style="margin: 0px; height: 50px; width: 368px;"></textarea></span>
                                <span name="gifts_autocheck" class="autocheck"></span>
                                <div name="gifts_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow hide"></div>
                    </div>

                    <!-- Tab SEO -->
                    <div id="tab2" class="tab_content pd0">
                        <div class="formRow">
                            <label class="formLeft" for="param_site_title">Title:</label>
                            <div class="formRight">
                                <span class="oneTwo"><textarea name="site_title" id="param_site_title" _autocheck="true" rows="4" cols=""></textarea></span>
                                <span name="site_title_autocheck" class="autocheck"></span>
                                <div name="site_title_error" class="clear error"></div>
                            </div>
                            <div class="clear"></div>
                        </div>

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
                            <label class="formLeft">Nội dung:</label>
                            <div class="formRight">
                                <textarea name="content" id="param_content" class="editor" value="<?php echo set_value('content'); ?>></textarea>
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
