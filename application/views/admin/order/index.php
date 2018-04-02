<?php
$this->load->view('admin/order/head');
?>

<div class="wrapper">
    <?php
        $this->load->view('admin/message');
    ?>
    <div class="widget">
        <div class="title">
            <span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
            <h6>Danh sách đơn hàng</h6>
            <div class="num f12">Tổng số: <b><?php echo $total; ?></b></div>
        </div>

        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
            <thead class="filter">
            <tr>
                <td colspan="11">
                    <form class="list_filter form" action="<?php echo admin_url('order/index'); ?>" method="get">
                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                            <tr>
                                <td class="label" style="width:60px;"><label for="filter_id">Mã số</label></td>
                                <td class="item"><input name="id" value="<?php echo $this->input->get('id'); ?>" id="filter_id" type="text" style="width:95px;"></td>

                                <td class="label" style="width:60px;"><label for="filter_type">Đơn hàng</label></td>
                                <td class="item">
                                    <select name="payment">
                                        <option value=""></option>
                                        <option <?php if($this->input->get('payment') == '1') echo "selected"; ?> value="1">Đang chờ xử lý</option>
                                        <option <?php if($this->input->get('payment') == '2') echo "selected"; ?> value="2">Đã gửi hàng</option>
                                        <option <?php if($this->input->get('payment') == '3') echo "selected"; ?> value="3">Hủy bỏ</option>
                                    </select>
                                </td>

                                <td class="label" style="width:60px;"><label for="filter_created">Từ ngày</label></td>
                                <td class="item"><input name="created" value="" id="filter_created" type="text" class="datepicker"></td>

                                <td colspan="2" style="width:60px">
                                    <input type="submit" class="button blueB" value="Lọc">
                                    <input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('order/index'); ?>'; ">
                                </td>

                            </tr>

                            <tr>
                                <td class="label" style="width:60px;"><label for="filter_user">Thành viên</label></td>
                                <td class="item"><input name="user" value="" id="filter_user" class="tipS" title="Nhập mã thành viên" type="text"></td>

                                <td class="label"><label for="filter_status">Giao dịch</label></td>
                                <td class="item">
                                    <select name="status">
                                        <option></option>
                                        <option value="1">Đợi xử lý</option>
                                        <option value="2">Thành công</option>
                                        <option value="3">Hủy bỏ</option>
                                    </select>
                                </td>

                                <td class="label"><label for="filter_created_to">Đến ngày</label></td>
                                <td class="item"><input name="created_to" value="" id="filter_created_to" type="text" class="datepicker"></td>
                                <td class="label"></td>
                                <td class="item"></td>
                            </tr>

                            </tbody>
                        </table>
                    </form>
                </td>
            </tr>
            </thead>
            <thead>
                <tr>
                    <td style="width:10px;"><img src="<?php echo public_url('admin/images/icons/tableArrows.png'); ?>"></td>
                    <td style="width:30px;">Mã số</td>
                    <td style="width:125px;">Sản phẩm</td>
                    <td style="width:60px;">Giá</td>
                    <td style="width:50px;">Số lượng</td>
                    <td style="width:100px;">Số tiền</td>
                    <td style="width:75px;">Đơn hàng</td>
                    <td style="width:75px;">Giao dịch</td>
                    <td style="width:75px;">Ngày tạo</td>
                    <td style="width:55px;">Hành động</td>
                </tr>
            </thead>

            <tfoot class="auto_check_pages">
                <tr>
                    <td colspan="10">
                        <div class="list_action itemActions">
                            <a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('order/delete_all'); ?>">
                                <span style="color:white;">Xóa hết</span>
                            </a>
                        </div>

                        <div class="pagination">
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                    </td>
                </tr>
            </tfoot>

            <tbody class="list_item">
                <?php foreach ($orders as $row): ?>
                    <tr class="row_<?php echo $row->id; ?>">
                        <td><input type="checkbox" name="id[]" value="<?php echo $row->id; ?>"></td>
                        <td class="textC"><?php echo $row->id; ?></td>
                        <td>
                            <?php  ?>
                            <div class="image_thumb">
                                <img src="<?php echo base_url('upload/product/') . $row->product->image_link;?>" height="50">
                                <div class="clear"></div>
                            </div>
                            <a href="" class="tipS" title="" target="_blank">
                                <b><?php echo $row->product->name; ?></b>
                            </a>
                        </td>
                        <td class="textR">
                            <center><b><?php echo number_format($row->amount / $row->qty); ?> đ</b></center>
                        </td>
                        <td class="status textC">
                            <?php echo $row->qty; ?>
                        </td>
                        <td class="textC">
                            <?php echo number_format($row->amount); ?> đ
                        </td>
                        <td class="status textC">
                            <span class="pending">
                                <?php
                                    if ($row->status == 0){
                                        echo 'Đang chờ xử lý';
                                    }elseif ($row->status == 1){
                                        echo 'Đã gửi hàng';
                                    }else{
                                        echo 'Hủy bỏ';
                                    }
                                ?>
                            </span>
                        </td>
                        <td class="status textC">
                            <span class="pending">
                                <?php
                                if ($row->transaction->status == 0){
                                    echo 'Đang chờ xử lý';
                                }elseif ($row->transaction->status == 1){
                                    echo 'Thành công';
                                }else{
                                    echo 'Hủy bỏ';
                                }
                                ?>
                            </span>
                        </td>
                        <td class="textC"></td>
                        <td class="textC">
                            <a href="" class="lightbox">
                                <img src="<?php echo public_url('admin/images/icons/color/view.png');?>">
                            </a>
                            <a href="<?php echo admin_url('order/delete/'.$row->id); ?>" title="Xóa" class="tipS verify_action">
                                <img src="<?php echo public_url('admin/images/icons/color/delete.png');?>">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
