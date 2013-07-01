		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Thông tin sinh viên</h1>
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
							<a href="<?php echo base_url() ?>admin">Root</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Xuất danh sách sinh viên</a>
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
									<i class="icon-filter"></i>
									Tìm kiếm dữ liệu sinh viên
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content">
								<form action="#" method="POST" class='form-vertical'>
									<div class="row-fluid">
										<div class="span3">
											<div class="control-group">
												<label for="" class="control-label">Bậc</label>
												<div class="control controls-row">
													<select id="" class="chosen-select">
														<option value="0" selected="true">Đại học</option>
														<option value="1">Trung cấp chuyên nghiệp</option>
													</select>
												</div>
											</div>
										</div>
										<div class="span4">
											<div class="control-group">
												<label	for="" class="control-label">Khoa</label>
												<div class="control controls-row">
													<select id="" class="chosen-select">
														<option value="A">Kiến trúc</option>
														<option value="C">Kinh tế thương mại</option>
														<option value="D">Du lịch</option>
														<option value="F">Tài chính ngân hàng</option>
														<option value="H">Mỹ thuật công nghiệp</option>
														<option value="I">Nhiệt lạnh</option>
														<option value="K">Kế toán - Kiểm toán</option>
														<option value="M">Công nghệ môi trường</option>
														<option value="N">Ngoại ngữ</option>
														<option value="P">Quan hệ công chúng</option>
														<option value="Q">Quản trị kinh doanh</option>
														<option value="S">Công nghệ sinh học</option>
														<option value="T">Công nghệ thông tin</option>
														<option value="X">Xây dựng</option>
													</select>
												</div>
											</div>
										</div>
										<div class="span2">
											<div class="control-group">
												<label for="" class="control-label">Lớp</label>
												<div class="control controls-row">
													<select id="" class="chosen-select">
														<option value="" selected="true">Tất cả</option>
														<option value="">K15A1</option>
														<option value="">K15A2</option>
														<option value="">K15A3</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row-fluid">
										<div class="span9">
											<div class="control-group">
												<label for="" class="control-label">Thông tin còn thiếu</label>
												<div class="control controls-row">
													<select id="" multiple="multiple" class="chosen-select">
														<option value="">Số điện thoại bàn</option>
														<option value="">Số điện thoại di động</option>
														<option value="">Địa chỉ email</option>
														<option value="">Địa chỉ liên hệ</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row-fluid">
										<div class="span12">
											<div class="control-group">
												<button type="submit" class="btn btn-primary">Tiến hành tìm kiếm</button>
												<button type="reset" class="btn">Huỷ</button>
											</div>
										</div>
									</div>
									
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-list"></i>
									Danh sách sinh viên
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-fixedcolumn dataTable-scroll-x dataTable-scroll-y dataTable-tools">
									<thead>
										<tr>
											<th>#ID</th>
											<th>MSSV</th>
											<th>Họ</th>
											<th>Tên</th>
											<th>Lớp</th>
											<th>Điện thoại bàn</th>
											<th>Điện thoại di động</th>
											<th>Email</th>
											<th>Địa chỉ</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Lorem ipsum.</td>
											<td>Perferendis molestiae.</td>
											<td>Voluptates pariatur.</td>
											<td>Laudantium repudiandae.</td>
											<td>Ipsum officiis?</td>
											<td>Corporis architecto?</td>
											<td>Minima totam.</td>
											<td>Debitis accusamus.</td>
										</tr>
										<tr>
											<td>2</td>
											<td>Lorem ipsum.</td>
											<td>Qui beatae.</td>
											<td>Ea eius!</td>
											<td>Sapiente est.</td>
											<td>Incidunt in.</td>
											<td>Dolorem ducimus!</td>
											<td>Porro animi.</td>
											<td>Ut quia!</td>
										</tr>
										<tr>
											<td>3</td>
											<td>Lorem ipsum.</td>
											<td>Asperiores sit.</td>
											<td>Placeat commodi.</td>
											<td>Hic rem.</td>
											<td>Voluptatibus dolor.</td>
											<td>Nam vitae!</td>
											<td>Recusandae quaerat.</td>
											<td>Odio rerum.</td>
										</tr>
										<tr>
											<td>4</td>
											<td>Lorem ipsum.</td>
											<td>Officia voluptate.</td>
											<td>Velit dolor.</td>
											<td>Aliquam in!</td>
											<td>Culpa eum.</td>
											<td>Voluptates doloremque.</td>
											<td>Repellat aliquam.</td>
											<td>Quia iusto.</td>
										</tr>
										<tr>
											<td>5</td>
											<td>Lorem ipsum.</td>
											<td>Aliquid hic.</td>
											<td>Rerum dignissimos.</td>
											<td>Minima officia.</td>
											<td>Dolores exercitationem.</td>
											<td>Illo totam?</td>
											<td>Architecto nam!</td>
											<td>Minus cumque.</td>
										</tr>
										<tr>
											<td>6</td>
											<td>Lorem ipsum.</td>
											<td>Placeat quis!</td>
											<td>Animi non.</td>
											<td>Debitis aliquid.</td>
											<td>Praesentium voluptate!</td>
											<td>Sit rem!</td>
											<td>Ullam distinctio.</td>
											<td>Ea sequi.</td>
										</tr>
										<tr>
											<td>7</td>
											<td>Lorem ipsum.</td>
											<td>Obcaecati voluptates?</td>
											<td>Ut delectus.</td>
											<td>Voluptatibus maxime.</td>
											<td>Impedit voluptatem!</td>
											<td>Assumenda soluta!</td>
											<td>Nam nemo.</td>
											<td>Eius dolore!</td>
										</tr>
										<tr>
											<td>8</td>
											<td>Lorem ipsum.</td>
											<td>Maiores eius.</td>
											<td>Perferendis suscipit!</td>
											<td>Cumque pariatur!</td>
											<td>Deleniti voluptates.</td>
											<td>Quasi sapiente!</td>
											<td>Quam aut.</td>
											<td>Suscipit nisi.</td>
										</tr>
										<tr>
											<td>9</td>
											<td>Lorem ipsum.</td>
											<td>Cumque reiciendis.</td>
											<td>Iure ipsa.</td>
											<td>Perspiciatis ea.</td>
											<td>Vitae eaque!</td>
											<td>Eveniet id.</td>
											<td>A ullam!</td>
											<td>Sed facere.</td>
										</tr>
										<tr>
											<td>10</td>
											<td>Lorem ipsum.</td>
											<td>Quo repellat.</td>
											<td>Inventore nesciunt?</td>
											<td>Nam minima!</td>
											<td>A iure!</td>
											<td>Placeat odio!</td>
											<td>Aspernatur vel.</td>
											<td>Impedit porro.</td>
										</tr>
										<tr>
											<td>11</td>
											<td>Lorem ipsum.</td>
											<td>Ex quasi.</td>
											<td>Doloribus temporibus.</td>
											<td>Quaerat vel.</td>
											<td>Laudantium placeat.</td>
											<td>Tempora eius.</td>
											<td>Pariatur quibusdam.</td>
											<td>Deleniti nesciunt.</td>
										</tr>
										<tr>
											<td>12</td>
											<td>Lorem ipsum.</td>
											<td>Asperiores fugiat.</td>
											<td>Fugit consequuntur.</td>
											<td>Quibusdam adipisci!</td>
											<td>Animi illum!</td>
											<td>Dolor ipsa?</td>
											<td>Vitae maiores.</td>
											<td>Minima assumenda.</td>
										</tr>
										<tr>
											<td>13</td>
											<td>Lorem ipsum.</td>
											<td>Debitis aperiam!</td>
											<td>Sit dicta?</td>
											<td>Ducimus nobis.</td>
											<td>Officia quam?</td>
											<td>Voluptatem dolor.</td>
											<td>In odio!</td>
											<td>Eum obcaecati.</td>
										</tr>
										<tr>
											<td>14</td>
											<td>Lorem ipsum.</td>
											<td>Vero beatae!</td>
											<td>Blanditiis repellat!</td>
											<td>Ipsum quas!</td>
											<td>Rerum optio!</td>
											<td>Error veniam.</td>
											<td>Dicta ducimus!</td>
											<td>Inventore natus?</td>
										</tr>
										<tr>
											<td>15</td>
											<td>Lorem ipsum.</td>
											<td>Recusandae doloribus.</td>
											<td>Nisi sequi!</td>
											<td>Vel ad.</td>
											<td>Eum eveniet.</td>
											<td>Odit sapiente.</td>
											<td>Tempora consectetur.</td>
											<td>Provident explicabo!</td>
										</tr>
										<tr>
											<td>16</td>
											<td>Lorem ipsum.</td>
											<td>Laudantium odit.</td>
											<td>Placeat quibusdam.</td>
											<td>Accusamus commodi.</td>
											<td>Numquam deleniti!</td>
											<td>Debitis odit!</td>
											<td>Nemo magnam.</td>
											<td>Quo animi?</td>
										</tr>
										<tr>
											<td>17</td>
											<td>Lorem ipsum.</td>
											<td>Distinctio ducimus.</td>
											<td>Adipisci iusto?</td>
											<td>Corrupti nostrum.</td>
											<td>Quasi voluptatem!</td>
											<td>Culpa eveniet?</td>
											<td>Fugit quis.</td>
											<td>Cum ducimus.</td>
										</tr>
										<tr>
											<td>18</td>
											<td>Lorem ipsum.</td>
											<td>Fugit explicabo.</td>
											<td>Itaque quas!</td>
											<td>Hic eos.</td>
											<td>Hic omnis.</td>
											<td>Laudantium voluptate.</td>
											<td>Magnam expedita?</td>
											<td>Ab itaque.</td>
										</tr>
										<tr>
											<td>19</td>
											<td>Lorem ipsum.</td>
											<td>Quo dolor?</td>
											<td>In placeat.</td>
											<td>Maxime eveniet.</td>
											<td>Ab qui.</td>
											<td>Omnis quas!</td>
											<td>Aperiam facilis?</td>
											<td>Similique architecto!</td>
										</tr>
										<tr>
											<td>20</td>
											<td>Lorem ipsum.</td>
											<td>Earum dolorem!</td>
											<td>Aliquam architecto?</td>
											<td>Temporibus non.</td>
											<td>In autem.</td>
											<td>Animi culpa!</td>
											<td>In ipsa?</td>
											<td>Quos ab!</td>
										</tr>
										<tr>
											<td>21</td>
											<td>Lorem ipsum.</td>
											<td>Esse suscipit.</td>
											<td>Ea harum.</td>
											<td>Sequi officia?</td>
											<td>Molestias nisi!</td>
											<td>Cupiditate sequi.</td>
											<td>Debitis quia.</td>
											<td>Harum fuga!</td>
										</tr>
										<tr>
											<td>22</td>
											<td>Lorem ipsum.</td>
											<td>Aspernatur rem!</td>
											<td>Cupiditate labore?</td>
											<td>Temporibus culpa.</td>
											<td>Sequi ut.</td>
											<td>Sequi aperiam!</td>
											<td>Dolor quasi.</td>
											<td>Laboriosam facilis!</td>
										</tr>
										<tr>
											<td>23</td>
											<td>Lorem ipsum.</td>
											<td>Alias quas!</td>
											<td>Unde non.</td>
											<td>Veniam nemo.</td>
											<td>Harum non.</td>
											<td>Id perspiciatis.</td>
											<td>Obcaecati explicabo.</td>
											<td>Magnam eligendi!</td>
										</tr>
										<tr>
											<td>24</td>
											<td>Lorem ipsum.</td>
											<td>Labore perferendis!</td>
											<td>Quibusdam dicta.</td>
											<td>Inventore deleniti.</td>
											<td>Dolorum iure!</td>
											<td>Voluptates iusto.</td>
											<td>Perferendis ad.</td>
											<td>Accusamus ex!</td>
										</tr>
										<tr>
											<td>25</td>
											<td>Lorem ipsum.</td>
											<td>Maiores minima?</td>
											<td>Perspiciatis temporibus.</td>
											<td>Doloremque maiores.</td>
											<td>Corporis iusto.</td>
											<td>Earum soluta.</td>
											<td>Asperiores facilis.</td>
											<td>Necessitatibus sint!</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
