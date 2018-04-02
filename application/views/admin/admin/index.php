<?php                           //Day la trang quan ly cac admin
    $this->load->view('admin/admin/head');
?>

<div class="wrapper">
    <?php
        $this->load->view('admin/message');
    ?>
    <div class="widget">
        <div class="title">
            <h6>Danh sách Admin</h6>
            <div class="num f12">Tổng số: <b><?php echo $total; ?></b></div>
        </div>

        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
            <tr>
                <td style="width:80px;">Mã số</td>
                <td>Họ tên</td>
                <td>Username</td>
                <td style="width:100px;">Hành động</td>
            </tr>
            </thead>

            <tbody>
            <!-- Filter -->
            <?php
                foreach ($list as $row):
                    ?>
                    <tr>
                        <td class="textC"><?php echo $row->id; ?></td>

                        <td>
                            <span class="tipS" original-title="<?php echo $row->name; ?>"><?php echo $row->name; ?></span>
                        </td>
                        <td>
                            <span class="tipS" original-title=""><?php echo $row->username; ?></span>
                        </td>

                        <td class="option">
                            <a href="<?php echo admin_url('admin/edit/' . $row->id) ?>" class="tipS " original-title="Chỉnh sửa">
                                <img src="<?php echo public_url('admin/images/icons/color/edit.png'); ?>">
                            </a>

                            <a href="<?php echo admin_url('admin/delete/' . $row->id); ?>" class="tipS verify_action" original-title="Xóa">
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