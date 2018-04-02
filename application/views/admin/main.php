<!--
    Day la master layout
    left.php la left
    rightSide la content
-->

<!doctype html>
<html lang="vi">
<head>
    <?php $this->load->view('admin/head'); ?>
</head>
<body>
    <div id="left_content">
        <?php $this->load->view('admin/left'); ?>
    </div>

    <div id="rightSide">
        <?php $this->load->view('admin/header');      //topNav ?>

<!--        Content     -->
        <?php
            $this->load->view($temp);
        ?>

        <?php $this->load->view('admin/footer'); ?>
    </div>

    <div class="clear"></div>
</body>
</html>