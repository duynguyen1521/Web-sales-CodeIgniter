<?php
$this->load->view('admin/transaction/head');
?>

<div class="wrapper">
    <?php
        $this->load->view('admin/message');
    ?>
    <div class="widget">
        <div class="title">
            <span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
            <h6>Danh sách Giao dịch</h6>
            <div class="num f12">Tổng số: <b><?php echo $total; ?></b></div>
        </div>

        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">
            <thead class="filter">
                <tr>
                    <td colspan="9">
                        <form class="list_filter form" action="<?php echo admin_url('transaction/index'); ?>" method="get">
                            <table cellpadding="0" cellspacing="0" width="100%">
                                <tbody>
                                <tr>
                                    <td class="label" style="width:60px;"><label for="filter_id">Mã số</label></td>
                                    <td class="item"><input name="id" value="<?php echo $this->input->get('id'); ?>" id="filter_id" type="text" style="width:95px;"></td>

                                    <td class="label" style="width:60px;"><label for="filter_type">Hình thức</label></td>
                                    <td class="item">
                                        <select name="payment">
                                            <option value=""></option>
                                            <option <?php if($this->input->get('payment') == 'nganluong') echo "selected"; ?> value="nganluong">Ngân lượng</option>
                                            <option <?php if($this->input->get('payment') == 'baokim') echo "selected"; ?> value="baokim">Bảo kim</option>
                                            <option <?php if($this->input->get('payment') == 'offline') echo "selected"; ?> value="offline">Tại nhà</option>
                                        </select>
                                    </td>

                                    <td class="label" style="width:60px;"><label for="filter_created">Từ ngày</label></td>
                                    <td class="item"><input name="created" value="" id="filter_created" type="text" class="datepicker"></td>

                                    <td colspan="2" style="width:60px">
                                        <input type="submit" class="button blueB" value="Lọc">
                                        <input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('transaction/index'); ?>'; ">
                                    </td>

                                </tr>

                                <tr>
                                    <td class="label" style="width:60px;"><label for="filter_user">Thành viên</label></td>
                                    <td class="item"><input name="user" value="" id="filter_user" class="tipS" title="Nhập mã thành viên" type="text"></td>

                                    <td class="label"><label for="filter_status">Giao dịch</label></td>
                                    <td class="item">
                                        <select name="status">
                                            <option></option>
                                            <option <?php if($this->input->get('status') == '1') echo "selected"; ?> value="1">Đang chờ xử lý</option>
                                            <option <?php if($this->input->get('status') == '2') echo "selected"; ?> value="2">Thành công</option>
                                            <option <?php if($this->input->get('status') == '3') echo "selected"; ?> value="3">Hủy bỏ</option>
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
                    <td style="width:60px;">Mã số</td>
                    <td style="width:175px;">Thành viên</td>
                    <td style="width:90px;">Số tiền</td>
                    <td>Hình thức</td>
                    <td style="width:100px;">Giao dịch</td>
                    <td style="width:75px;">Ngày tạo</td>
                    <td style="width:55px;">Hành động</td>
                </tr>
            </thead>

            <tfoot class="auto_check_pages">
                <tr>
                    <td colspan="8">
                        <div class="list_action itemActions">
                            <a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('transaction/delete_all'); ?>">
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
                <?php foreach ($transactions as $row): ?>
                    <tr class="row_<?php echo $row->id; ?>">
                        <td><input type="checkbox" name="id[]" value="<?php echo $row->id; ?>"></td>
                        <td class="textC"><?php echo $row->id; ?></td>
                        <td class="textC">
                            <?php echo $row->user_name; ?>
                            <span style="color: #cc4a22; font-size: 11px;">
                                <?php echo ($row->user_id == 0) ? '(Khách)' : '(User)'; ?>
                            </span>
                        </td>
                        <td class="textR red"><?php echo number_format($row->amount); ?> đ</td>
                        <td><center><?php echo $row->payment; ?></td></center>
                        <td class="status textC">
                                <span class="pending">
                                    <?php
                                        if ($row->status == 0){
                                            echo 'Đang chờ xử lý';
                                        }elseif ($row->status == 1){
                                            echo 'Thành công';
                                        }else{
                                            echo 'Hủy bỏ';
                                        }
                                    ?>
                                </span>
                        </td>
                        <td class="textC"><?php echo get_date($row->created, FALSE); ?></td>
                        <td class="textC">
                            <a href="" class="lightbox">
                                <img src="<?php echo public_url('admin/images/icons/color/view.png');?>">
                            </a>
                            <a href="<?php echo admin_url('transaction/delete/'.$row->id); ?>" title="Xóa" class="tipS verify_action">
                                <img src="<?php echo public_url('admin/images/icons/color/delete.png');?>">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
