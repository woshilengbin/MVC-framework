<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>打包工具</title>
	<!-- begin引入公共css文件-->
	<?php $this->load->view("common/header-top")?>
	<!-- end引入公共css文件-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<?php $this->load->view("common/header")?>
	<!-- Left side column. contains the logo and sidebar -->
	<?php $this->load->view("common/sidebar")?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				我的资料
				<small>

				</small>

			</h1>
			<ol class="breadcrumb">
				<li><a href="<?=site_url();?>"><i class="fa fa-dashboard"></i> 主页</a></li>
				<li class="active">我的资料</li>
			</ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<!-- Small boxes (Stat box) -->
			<!-- /.row -->
			<!-- Main row -->
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title with-border">

							</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="panel  panel-info" style="min-height: 500px;">
								<div class="panel-body">
									<div class="row">
										<div class="col-xs-12">
											<h4><?=$myadmin['cname']?>
												<?php if (isset($optKey['goRtx']['name'])) {?>
													(<a href="#"  class="text-danger" onclick="allRtx()">点击唤起打包系统RTX群</a>)
												<?php }?>
												<br>
											</h4>
											<div class="well">
												<table class="table table-borderless">
													<tbody>
													<tr>
														<td class="col-xs-3">用户名 :</td>
														<td><?=$myadmin['username']?></td>
													</tr>
													<tr>
														<td class="col-xs-3">真实姓名 :</td>
														<td><?=$myadmin['cname']?></td>
													</tr>
													<tr>
														<td class="col-xs-3">Email :</td>
														<td><?=$myadmin['email']?></td>
													</tr>
													<tr>
														<td class="col-xs-3">联系电话 :</td>
														<td><?=$myadmin['phone']?></td>
													</tr>
													</tbody>
												</table>
											</div>
											<h4>联系地址</h4>
											<div class="well">
												<address>
													<strong>Boyaa Interactive, Inc.</strong><br>
												</address>
												<address>
													<strong><?=$myadmin['username']?></strong><br>
													<a href="mailto:<?=$myadmin['email']?>"><?=$myadmin['email']?></a>
												</address>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row (main row) -->

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<?php $this->load->view("common/footer")?>
</div>
<!-- ./wrapper -->

<!-- begin modal-->
<!-- end modal-->

<!-- begin引入公共js文件-->
<?php $this->load->view("common/footer-top")?>
<!-- end引入公共js文件-->
<script type="text/javascript">
	function allRtx()
	{
		if(window.confirm("确认唤起打包系统RTX群")) {
			$.post("<?=site_url('c=common&m=allRtx')?>", {},
				function (data) {
				}, 'json');
		}
	}
</script>

</body>
</html>
