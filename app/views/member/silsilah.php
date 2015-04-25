<script type="text/javascript">
	var $data = <?php echo json_encode($result) ?>;
</script>

<script type="text/javascript" src="<?php echo asset('assets/js/script.js') ?>"></script>

<div class="tree"></div>

<div style="height:100px;"></div>

<!-- start modal-form-person -->
<div class="modal fade" id="modal-form-person">
<div class="modal-dialog">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" id="myModalLabel">Modal title</h4>
</div>
<div class="modal-body">

<!-- ********* -->

<form class="form-horizontal" role="form" id="form-person">
	<div class="">
		<div class="form-group">
			<label class="col-sm-2 control-label">ID</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="id" id="id"></div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Group ID</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="family_id" id="family-id"></div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Parent ID</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="parent_id" id="parent-id"></div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Child ID</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="child_id" id="child-id"></div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Nama</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="name" id="name"></div>
	</div>
	<!-- <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default" id="save">Simpan</button>
		</div>
	</div> -->
</form>

<!-- ********* -->

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary" id="save">Save changes</button>
</div>

</div>
</div>
</div>
<!-- end modal-form-person -->

<script type="text/template" id="person">
<div class="person" data-id="<%= id %>">
	<div class="body">
		<div class="name">
			<strong><%= name %></strong>
		</div>
	</div>
</div>
</script>

<script type="text/template" id="node-control">
<div class="node-control">
	<a class="add-child">+anak</a>
	<a class="add-couple">+suami/istri</a>
	<a class="add-parent">+orang tua</a>
</div>
</script>