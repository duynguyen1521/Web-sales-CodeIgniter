<!--Hiển thị thông báo trong toàn bộ các trang admin-->

<?php
    if(isset($message) && $message):
?>
<div class="nNote nInformation hideit">
    <p>
        <strong>Thông báo: </strong><?php echo $message; ?>
    </p>
</div>

<?php
    endif;
?>