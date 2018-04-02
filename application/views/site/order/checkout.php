<div class="box-center"><!-- The box-center product-->
    <div class="tittle-box-center">
        <h2>Thông tin nhận hàng của thành viên</h2>
    </div>
    <div class="box-content-center register"><!-- The box-content-center -->
        <form enctype="multipart/form-data" action="<?php echo base_url('order/checkout'); ?>" method="post" class="t-form form_action">
            <div class="form-row">
                <label class="form-label" for="param_name">Tổng số tiền thanh toán: </label>
                <div class="form-item">
                    <b style="color: red;"><?php echo number_format($total_amount); ?> đ</b>
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-row">
                <label class="form-label" for="param_email">Email:<span class="req">*</span></label>
                <div class="form-item">
                    <input type="text" value="<?php echo isset($user->email) ? $user->email : ''; ?>" name="email" id="email" class="input">
                    <div class="clear"></div>
                    <div id="email_error" class="error"><?php echo form_error('email'); ?></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-row">
                <label class="form-label" for="param_name">Họ và tên:<span class="req">*</span></label>
                <div class="form-item">
                    <input type="text" value="<?php echo isset($user->name) ? $user->name : ''; ?>" name="name" id="name" class="input">
                    <div class="clear"></div>
                    <div id="name_error" class="error"><?php echo form_error('name'); ?></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-row">
                <label class="form-label" for="param_phone">Số điện thoại:<span class="req">*</span></label>
                <div class="form-item">
                    <input type="text" value="<?php echo isset($user->phone) ? $user->phone : ''; ?>" name="phone" id="phone" class="input">
                    <div class="clear"></div>
                    <div id="phone_error" class="error"><?php echo form_error('phone'); ?></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-row">
                <label class="form-label" for="param_message">Ghi chú:<span class="req">*</span></label>
                <div class="form-item">
                    <textarea name="message" id="message" class="input"></textarea>
                    <p>Nhập địa chỉ và thời gian nhận hàng</p>
                    <div class="clear"></div>
                    <div id="message_error" class="error"><?php echo form_error('message'); ?></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-row">
                <label class="form-label" for="param_phone">Thanh toán bằng:<span class="req">*</span></label>
                <div class="form-item">
                    <select name="payment">
                        <option value="">--- Chọn phương thức thanh toán ---</option>
                        <option value="offline">Thanh toán khi nhận hàng</option>
                        <option value="nganluong">Ngân lượng</option>
                        <option value="baokim">Bảo kim</option>
                    </select>
                    <div class="clear"></div>
                    <div id="phone_error" class="error"><?php echo form_error('phone'); ?></div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="form-row">
                <div class="form-item">
                    <input type="submit" name="submit" value="Thanh toán" class="button">
                </div>
            </div>
        </form>
    </div>
</div>
