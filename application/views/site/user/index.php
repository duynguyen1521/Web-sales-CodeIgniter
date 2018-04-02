<style>
    table td {
        padding: 10px;
        border: 1px solid #ccc;
    }

    .button {
        padding: 10px;
        background: #6587a0;
        float: right;
        border-radius: 4px;
    }
</style>

<div class="box-center"><!-- The box-center product-->
    <div class="tittle-box-center">
        <h2>Thông tin thành viên</h2>
    </div>
    <div class="box-content-center login"><!-- The box-content-center -->
        <table>
            <tr>
                <td>Họ tên</td>
                <td><?php echo $user->name; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $user->email; ?></td>
            </tr>
            <tr>
                <td>Địa chỉ</td>
                <td><?php echo $user->address; ?></td>
            </tr>
            <tr>
                <td>Điện thoại</td>
                <td><?php echo $user->phone; ?></td>
            </tr>
        </table>
        <a href="<?php echo base_url('user/edit'); ?>" class="button">Sửa thông tin</a>
    </div>
</div>