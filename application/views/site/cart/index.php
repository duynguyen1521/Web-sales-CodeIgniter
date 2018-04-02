<style>
    table#cart_content th, td
    {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    .but {
        padding: 10px;
        background: #6587a0;
        float: right;
        border-radius: 4px;
        cursor: pointer;
        border-width: 2px;
        border-style: outset;
        border-color: buttonface;
        border-image: initial;
    }

    table#cart_content tr:last-child td
    {
        border: #faffff;
    }
</style>

<div class="box-center"><!-- The box-center product-->
    <div class="tittle-box-center">
        <h2>Thông tin giỏ hàng <?php echo " ($total_items sản phẩm)"; ?></h2>
    </div>
    <div class="box-content-center product"><!-- The box-content-center -->
        <?php if($total_items > 0): ?>
        <form action="<?php echo base_url('cart/update'); ?>" method="post">
            <table id="cart_content">
                <thead>
                    <th>Sản phẩm</th>
                    <th>Giá 1 sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Thao tác</th>
                </thead>
                <tbody>
                    <?php $total_amount = 0; ?>
                    <?php foreach ($carts as $row): ?>
                        <?php $total_amount += $row['subtotal']; ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo number_format($row['price']); ?> đ</td>
                            <td>
                                <input size="5" name="qty_<?php echo $row['id']; ?>" value="<?php echo $row['qty']; ?>" />
                            </td>
                            <td><?php echo number_format($row['subtotal']); ?></td>
                            <td><a href="<?php echo base_url('cart/delete/'. $row['id']); ?>">Xóa</a></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="5">Tổng số tiền:
                            <span style="color: red; font-weight: bold; font-size: 17px;">
                                <?php echo number_format($total_amount); ?> đ
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="1"><a class="but" href="<?php echo base_url('cart/delete'); ?>">Xóa toàn bộ</a></td>
                        <td colspan="1"><button class="but" type="submit">Cập nhật giỏ hàng</button></td>
                        <td colspan="3"><a class="but" href="<?php echo base_url('order/checkout'); ?>">Mua hàng</a></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <?php else: ?>
            <h4>Giỏ hàng rỗng</h4>
        <?php endif; ?>
    </div>
</div>