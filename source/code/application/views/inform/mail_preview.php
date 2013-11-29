		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Thông tin gửi mail</h1>
					</div>
					<div class="pull-right">
						<ul class="stats">
							<li class='lightred'>
								<i class="icon-calendar"></i>
								<div class="details">
									<span class="big">February 22, 2013</span>
									<span>Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo base_url('admin') ?>">Root</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url('inform') ?>">Thông báo</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Xem trước</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-pencil"></i>
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
				<div class="row-fluid" style="height:100px">
				
				</div>
			</div>
		</div>
