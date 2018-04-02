<?php
$this->load->view('admin/support/head');
?>

<div class="wrapper" id="main_support">
    <?php
        $this->load->view('admin/message');
    ?>
    <div class="widget">
        <div class="title">
            <span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
            <h6>Danh sách hỗ trợ viên </h6>
            <div class="num f12">Số lượng: <b><?php echo $total; ?></b></div>
        </div>

        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
            <thead>
                <tr>
                    <td style="width:21px;"><img src="<?php echo public_url('admin/images/icons/tableArrows.png'); ?>"></td>
                    <td style="width:60px;">Mã số</td>
                    <td>Tên hỗ trợ viên</td>
                    <td>Yahoo</td>
                    <td>Gmail</td>
                    <td>Skype</td>
                    <td>Phone</td>
                    <td>Thứ tự</td>
                    <td>Hành động</td>
                </tr>
            </thead>

            <tfoot class="auto_check_pages">
                <tr>
                    <td colspan="10">
                        <div class="list_action itemActions">
                            <a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('support/delete_all'); ?>">
                                <span style="color:white;">Xóa các mục đã chọn</span>
                            </a>
                        </div>
                    </td>
                </tr>
            </tfoot>

            <tbody class="list_item">
                <?php foreach ($list as $row): ?>
                    <tr class="row_<?php echo $row->id; ?>">
                        <td>
                            <input type="checkbox" name="id[]" value="<?php echo $row->id; ?>">
                        </td>
                        <td class="textC"><?php echo $row->id; ?></td>
                        <td class="textC"><?php echo $row->name; ?></td>
                        <td class="textC"><?php echo $row->yahoo; ?></td>
                        <td class="textC"><?php echo $row->gmail; ?></td>
                        <td class="textC"><?php echo $row->skype; ?></td>
                        <td class="textC"><?php echo $row->phone; ?></td>
                        <td class="textC"><?php echo $row->sort_order; ?></td>
                        <td class="option textC">
                            <a href="<?php echo admin_url('support/edit/') . $row->id; ?>" title="Chỉnh sửa" class="tipS">
                                <img src="<?php echo public_url('admin/images/icons/color/edit.png'); ?>">
                            </a>
                            <a href="<?php echo admin_url('support/delete/') . $row->id; ?>" title="Xóa" class="tipS verify_action">
                                <img src="<?php echo public_url('admin/images/icons/color/delete.png'); ?>">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
