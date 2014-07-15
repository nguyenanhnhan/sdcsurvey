		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Thông tin gửi mail</h1>
					</div>
					<div class="pull-right">
						<ul class="stats">
							<li class='lightred'>
								<i class="fa fa-calendar"></i>
								<div class="details">
									<span class="big" id="date">February 22, 2013</span>
									<span id="clock">Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo base_url('admin') ?>">Root</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url('inform') ?>">Thông báo</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Xem trước</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-pencil"></i>
									Mẫu thông báo gửi các sinh viên
								</h3>
							</div>
							<div class="box-content">
								<?php for ($i=0,$len=count($preview);$i<$len;$i++) {?>
								<div><?php echo $preview[$i]; ?></div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
