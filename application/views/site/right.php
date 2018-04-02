<!-- The Support -->
<div class="box-right">
    <div class="title tittle-box-right">
        <h2> Hỗ trợ trực tuyến </h2>
    </div>
    <div class="content-box">
        <!-- goi ra phuong thuc hien thi danh sach ho tro -->
        <div class="support">
            <?php foreach ($supports as $row): ?>
                <strong><img style="margin-bottom:-3px" src="<?php echo public_url('site/images/support.ico'); ?>"><?php echo $row->name; ?></strong>
                <p><img style="margin-bottom:-3px" src="<?php echo public_url('site/images/phone.png'); ?>"> <?php echo $row->phone; ?></p>
                <p><img style="margin-bottom:-3px" src="<?php echo public_url('site/images/email.png'); ?>"> <?php echo $row->gmail; ?></p>
                <p><img style="margin-bottom:-3px" src="<?php echo public_url('site/images/skype.png'); ?>"> Skype:
                    <?php echo $row->skype; ?>
                </p>
                <hr>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- End Support -->

<!-- The news -->
<div class="box-right">
    <div class="title tittle-box-right">
        <h2> Bài viết mới </h2>
    </div>
    <div class="content-box">
        <ul class="news">
            <?php foreach ($news_list as $row): ?>
                <li>
                    <a href="" title="Mỹ tăng cường không kích Iraq">
                        <img style="height: 25px; width: 25px;"
                             src="<?php echo base_url('upload/news/' . $row->image_link); ?>">
                        <?php echo $row->title; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>        <!-- End news -->

<!-- The Ads -->
<div class="box-right">
    <div class="title tittle-box-right">
        <h2> Quảng cáo </h2>
    </div>
    <div class="content-box">
        <a href="">
            <img src="<?php echo public_url('site/images/ads.png'); ?>">
        </a>
    </div>
</div>
<!-- End Ads -->

<!-- The Fanpage -->
<div class="box-right">
    <div class="title tittle-box-right">
        <h2> Fanpage </h2>
    </div>
    <div class="content-box">

        <iframe src="http://www.facebook.com/plugins/likebox.php?href=https://www.facebook.com/nobitacnt&amp;width=190&amp;height=300&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color&amp;header=true"
                scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:190px; height:300px;"
                allowtransparency="true">
        </iframe>

    </div>
</div>
<!-- End Fanpage -->

<!-- The Fanpage -->
<div class="box-right">
    <div class="title tittle-box-right">
        <h2> Thống kê truy cập </h2>
    </div>
    <div class="content-box">
        <center>
            <!-- Histats.com  START  (standard)-->
            <script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
            <script src="http://s10.histats.com/js15.js" type="text/javascript"></script>
            <a href="http://www.histats.com" target="_blank" title="hit counter">
                <script type="text/javascript">
                    try {
                        Histats.start(1, 2138481, 4, 401, 118, 80, "00011111");
                        Histats.track_hits();
                    } catch (err) {
                    }
                    ;
                </script>
                <div id="histats_counter_4182" style="display: block;"><a
                            href="http://www.histats.com/viewstats/?sid=2138481&amp;ccid=401" target="_blank">
                        <canvas id="histats_counter_4182_canvas" width="119" height="81"></canvas>
                    </a></div>
            </a>
            <noscript>&lt;a href="http://www.histats.com" target="_blank"&gt;&lt;img
                src="http://sstatic1.histats.com/0.gif?2138481&amp;101" alt="hit counter" border="0"&gt;&lt;/a&gt;
            </noscript>
            <!-- Histats.com  END  -->
        </center>
    </div>
</div>
<!-- End Fanpage -->