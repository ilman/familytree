<html>
<head>
	<title></title>

	<link rel="stylesheet" href="<?php echo asset('assets/css/tree.css') ?>" />
	<link rel="stylesheet" href="<?php echo asset('bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" />
	<script type="text/javascript" src="<?php echo asset('bower_components/jquery/dist/jquery.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo asset('bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo asset('bower_components/underscore/underscore-min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo asset('bower_components/jquery-sortable/source/js/jquery-sortable-min.js') ?>"></script>
	<script type="text/javascript">
		var server_url = '<?php echo url(''); ?>';
	</script>
</head>
<body>
	<div id="header">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="#"><strong>PRUDASS</strong></a>
				</div>
				<!-- navbar-header -->
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Silsilah</a></li>
						<li><a href="#">Anggota</a></li>
						<li><a href="#">Alamat</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Login</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	<!-- header -->
	<div id="content">
		<div class="container">
			<?php 
				if(isset($errors) && $errors->getbag('default')->count()){
					echo '<pre style="padding:10px; border:#ddd solid 1px; background:#eee; color:#999;">';
					print_r($errors->getbag('default')->getMessage());
					echo '</pre>';
				}
			?>
			<?php include(app_path().'/views/'.$content.'.php'); ?>
		</div>
	</div>
	<!-- content -->
	<div id="footer"></div>
	<!-- footer -->
</body>
</html>