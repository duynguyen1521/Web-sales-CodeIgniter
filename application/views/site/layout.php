<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			$this->load->view('site/head');
		?>	
	</head>
	<body>
		<a href="#" id="back_to_top">
			<img src="<?php echo public_url('site/images/top.png'); ?>">
	  	</a>
	  	<div class="wrapper">
	  		<div class="header">
	  			<?php $this->load->view('site/header'); ?>
	  		</div>
			<div id="container">
				<div class="left">
					<?php $this->load->view('site/left'); ?>
				</div>
				<div class="content">
                    <?php if(isset($message)): ?>
                        <h3 style="color: red;"><?php echo $message; ?></h3>
                    <?php endif; ?>
                    <?php $this->load->view($temp); ?>
				</div>
				<div class="right">
					<?php $this->load->view('site/right'); ?>
				</div>
				<div class="clear"></div>
			</div>
			<center>
				<img src="<?php echo public_url('site/images/bank.png'); ?>"> 
		  	</center>
		  	<div class="footer">
		  		<?php $this->load->view('site/footer'); ?>
		  	</div>
	  	</div>
	  	<script async="" type="text/javascript" src="http://s4.histats.com/stats/2138481.php?2138481&amp;@f16&amp;@g1&amp;@h0&amp;@i0&amp;@j0&amp;@k0&amp;@l0&amp;@mH%E1%BB%8Dc%20l%E1%BA%ADp%20tr%C3%ACnh%20website%20v%E1%BB%9Bi%20PHP%20v%C3%A0%20MYSQL&amp;@n0&amp;@o1000&amp;@q0&amp;@r0&amp;@s401&amp;@ten-US&amp;@u1366&amp;@vfile%3A%2F%2F%2FD%3A%2FWEB%2FPHP%2FCodeIgniter%20-%20Web%20b%C3%A1n%20h%C3%A0ng%2FT%C3%A0i%20li%E1%BB%87u%2F%5Bfreetuts_net%5D_shopping_part_3.rar%2Ftemplate%2Fsite%2Findex.html&amp;@w"></script>
	  	<ul class="ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all" role="listbox" aria-activedescendant="ui-active-menuitem" style="z-index: 1; top: 0px; left: 0px; display: none;"></ul>
	  	<script async="" type="text/javascript" src="http://s10.histats.com/counters/cc_401.js"></script>
	</body>
</html>