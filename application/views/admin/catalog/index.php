<?php
    $this->load->view('admin/catalog/head');
?>


<div class="wrapper">
    <?php
    $this->load->view('admin/message');
    ?>
    <div class="widget">
        <div class="title">
            <span class="titleIcon">
                <div class="checker" id="uniform-titleCheck">
                    <span>
                        <input type="checkbox" id="titleCheck" name="titleCheck" style="opacity: 0;">
                    </span>
                </div>
            </span>
            <h6>Danh sách danh mục sản phẩm</h6>
            <div class="num f12">Tổng số: <b><?php echo $total; ?></b></div>
        </div>

        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
            <tr>
                <td style="width:10px;"><img src="<?php echo public_url('admin/images/icons/tableArrows.png'); ?>">
                </td>
                <td style="width:80px;">Mã số</td>
                <td>Thứ tự hiển thị</td>
                <td>Tên danh mục</td>
                <td>Danh mục cha</td>
                <td style="width:100px;">Hành động</td>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <td colspan="7">
                    <div class="list_action itemActions">
                        <a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('catalog/delete_all') ?>">
                            <span style="color:white;">Xóa các danh mục đã chọn</span>
                        </a>
                    </div>

                    <div class="pagination">
                    </div>
                </td>
            </tr>
            </tfoot>

            <tbody>
            <!-- Filter -->
            <?php foreach ($list as $row): ?>
                <tr class="row_<?php echo $row->id; ?>">
                    <td>
                        <div class="checker" id="uniform-undefined">
                        <span>
                            <input type="checkbox" name="id[]" value="<?php echo $row->id; ?>"
                                   style="opacity: 0;">
                        </span>
                        </div>
                    </td>

                    <td class="textC"><?php echo $row->id; ?></td>

                    <td class="textC">
                        <span class="tipS"
                              original-title="<?php echo $row->sort_order; ?>"><?php echo $row->sort_order; ?></span>
                    </td>

                    <td class="textC">
                        <span class="tipS"
                              original-title="<?php echo $row->name; ?>"><?php echo $row->name; ?></span>
                    </td>

                    <td class="textC">
                        <span class="tipS"
                              original-title="<?php echo $row->parent_id; ?>"><?php echo $row->parent_id; ?></span>
                    </td>

                    <td class="option">
                        <a href="<?php echo admin_url('catalog/edit/' . $row->id) ?>" class="tipS "
                           original-title="Chỉnh sửa">
                            <img src="<?php echo public_url('admin/images/icons/color/edit.png'); ?>">
                        </a>

                        <a href="<?php echo admin_url('catalog/delete/' . $row->id); ?>" class="tipS verify_action"
                           original-title="Xóa">
                            <img src="<?php echo public_url('admin/images/icons/color/delete.png'); ?>">
                        </a>
                    </td>
                </tr>

            <?php
            endforeach;
            ?>

            </tbody>
        </table>
    </div>
</div>


<div class="clear mt30"></div>
