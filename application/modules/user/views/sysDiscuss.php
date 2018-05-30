<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>打包工具</title>
	<!-- begin引入公共css文件-->
	<?php $this->load->view("common/header-top")?>
	<!-- end引入公共css文件-->
	<link href="./public/css/discuss.css" rel="stylesheet"  type="text/css">
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
				系统讨论
				<small>

				</small>

			</h1>
			<ol class="breadcrumb">
				<li><a href="<?=site_url();?>"><i class="fa fa-dashboard"></i> 主页</a></li>
				<li class="active">系统讨论</li>
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
							<div class="panel  panel-info" style="min-height: 700px;background: #fefefe;">
								<div class="panel-body discuss-subject">
									<div>
										<span class="board-count pull-left">共计<?=$count?>条</span>
										<span class="board-sort pull-left">
											<a href="<?=site_url('c=user&m=sysDiscuss');?>" <?php if ($flag == "") {?> class="active" <?php }?>>最新</a>
											<a href="<?=site_url('c=user&m=sysDiscuss&flag=mord');?>" <?php if ($flag == "mord") {?> class="active" <?php }?>>最早</a>
											<a href="<?=site_url('c=user&m=sysDiscuss&flag=hot');?>" <?php if ($flag == "hot") {?> class="active" <?php }?>>最热</a>
										</span>
										<button class="btn btn-info btn-lg pull-right" type="button" data-toggle="modal" data-target="#main_modal"><span class="glyphicon glyphicon-pencil"></span>&nbsp;发表帖子</button>
									</div>
									<p class="clearfix"></p>
									<ul class="list-unstyled">
										<?php foreach ($listItem as $k => $v) {?>
											<li>
												<div class="header">
													<strong><?=($k + 1)?></strong>
													<?php if ($v['add_user'] == $this->session->userdata('username')) {?>
														<span><a href="###" onclick="del('<?=$v['id']?>')">删除</a></span>
													<?php }?>
												</div>
												<div class="content-dis"><?=$v['content']?></div>
												<div class="info"><?=$v['add_user']?> 发表于<?=$v['add_time']?> </div>
												<div class="clearfix"></div>
												<div class="button">
													<p class="pull-left">
														<a href="###" class="btn btn-default-self btn-sm up_count <?php if ($v['upZan'] == 1) {?> color-b<?php }?>" self-data-id="<?=$v['id']?>"><span class="glyphicon glyphicon-thumbs-up"></span><span><?=$v['up_count']?></span></a>
														<a href="###" class="btn btn-default-self btn-sm down_count <?php if ($v['downZan'] == 1) {?> color-b<?php }?>" self-data-id="<?=$v['id']?>"><span class="glyphicon glyphicon-thumbs-down"></span><span><?=$v['down_count']?></span></a>
													</p>
													<p class="pull-right">
														<a class="btn btn-default reply btn-sm6" self-data-id="<?=$v['id']?>"><span class="glyphicon glyphicon-pencil"></span>评论 <?=$v['commend_num']?></a>
													</p>
													<div class="clearfix"></div>
												</div>
												<div class="hide">

												</div>
											</li>
										<?php }?>
									</ul>
									<?=$page;?>
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
<div class="modal fade in" id="main_modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form id="save_form" name="save_form" class="form-horizontal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">发表帖子</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="content" class="col-md-1 control-label">内容</label>
						<div class="col-md-10">
							<textarea class="form-control" id="content" name="content"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-primary" id="save_submit">发表</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end modal-->

<!-- begin引入公共js文件-->
<?php $this->load->view("common/footer-top")?>
<!-- end引入公共js文件-->
<script charset="utf-8" src="./public/js/ckeditor/ckeditor.js"></script>
<script charset="utf-8" src="./public/js/ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">
	function allRtx()
	{
		if(window.confirm("确认唤起打包系统RTX群")) {
			$.post("<?=site_url('c=common&m=allRtx')?>", {},
				function (data) {
				}, 'json');
		}
	}
	CKEDITOR.replace( 'content' ,{
		height : 200,
		customConfig: './custom-config.js'
	} );

	$(".reply").click(function(){
		var obj = $(this).parent().parent().next("div");
		if(obj.hasClass('hide'))
		{
			var pid = $(this).attr("self-data-id");
			$.post("<?=site_url('c=user&m=getChildContent');?>", { 'pid':pid},
				function(data){
					if(data)
					{
						obj.html("");
						obj.append(data);
						obj.removeClass("hide").addClass('show');
					}
				});

		}else{
			obj.removeClass("show").addClass("hide");
		}
	});
	$(".up_count").click(function(){
		var obj = $(this);
		var id = obj.attr("self-data-id");
		$.post("<?=site_url('c=user&m=upCount');?>", { 'id':id},
			function(data){
				if(data.code == 1)
				{
					obj.find("span").last().html(data.resVal);
					if(data.flag == 1)
					{
						obj.addClass("color-b");
					}else{
						obj.removeClass("color-b");
					}
				}
			},'json');
	});

	$(".down_count").click(function(){
		var obj = $(this);
		var id = obj.attr("self-data-id");
		$.post("<?=site_url('c=user&m=downCount');?>", { 'id':id},
			function(data){
				if(data.code == 1)
				{
					obj.find("span").last().html(data.resVal);
					if(data.flag == 1)
					{
						obj.addClass("color-b");
					}else{
						obj.removeClass("color-b");
					}
				}
			},'json');
	});


	$(".discuss-subject").on('click', '.answer_save' ,function() {
		var tag = $(this).attr("self-data-tag");
		var jsonData = $(".answer_form_"+tag).serializeArray();
		var flag = false;
		$.each(jsonData, function(i, field){
			if(field.name == 'content')
			{
				if(!field.value)
				{
					flag = true;
				}
			}
		});
		if(flag)
		{
			alert("内容不允许为空");
			return false;
		}
		$.post("<?=site_url('c=user&m=saveDiscussAjax');?>", jsonData,
			function(data){
				if(data.code == 1)
				{
					alert("回复发表成功");
					window.location.reload();
				}else{
					alert("回复发表失败");
				}
			}, "json");
	});


	$("#save_submit").click(function (){
		var content = CKEDITOR.instances.content.getData();
		if(!$.trim(content))
		{
			alert("内容不允许为空");
			return false;
		}
		$.post("<?=site_url('c=user&m=saveDiscussAjax');?>", { 'content':content},
			function(data){
				if(data.code == 1)
				{
					$('#main_modal').modal('hide');
					window.location.reload();
				}else{
					alert("帖子发表失败");
				}
			}, "json");
	});

	function del(id)
	{
		if(window.confirm("确定要删除此帖子？")){
			$.post("<?=site_url('c=user&m=delDiscuss');?>", { "id": id},
				function(data){
					if(data.code == 1)
					{
						window.location.reload();
					}
				}, "json");
		}else{
			return false;
		}
	}
</script>
</body>
</html>
