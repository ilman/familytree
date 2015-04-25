var $sorted_data = _($data).chain().sortBy(function($data) {
	return $data.parent_id;
}).sortBy(function($data) {
	return $data.order;
}).value();


var template_person;
var template_node_control;


function loop_parent($data, family_id){
	var output = '';
			
	for(var i=0; i<$data.length; i++){
		var $row = $data[i];
		if($row.family_id === family_id){
			output += template_person($row);
		}
	}
	
	return output;
}

function loop_children($data, parent_id){
	var output = '';
	
	for(var i=0; i<$data.length; i++){
		var $row = $data[i];
		if($row.parent_id === parent_id){
			output += '<li>';
				output += '<div class="parent" data-id="'+$row.id+'">';	
				output += loop_parent($data, $row.family_id);
				output += '</div>';
				output += '<ul class="children">';	
				output += loop_children($data, $row.family_id)
				output += '</ul>';
			output += '</li>';
		}
	}
	
	return output;
}

jQuery(document).ready(function($){

	template_person = _.template($('#person').html());
	template_node_control = _.template($('#node-control').html());

	var $tree = $('.tree');
	var $modal_form_person = $('#modal-form-person');
	
	$tree.html('<ul>'+loop_children($sorted_data, 0)+'</ul>');
	$tree.sortable({
		handle: '.person'
	});
	
	$tree.on('click','.parent', function($event){
		$event.preventDefault();
      $event.stopPropagation();

		var $this = $(this);
		var this_id = $this.data('id');
		var $node_control = $this.find('.node-control');

		if($node_control.length >= 1){
			$node_control.remove();
		}
		else{
			$this.append(template_node_control({id: this_id}));
			$this.off('click');
		}

	}).on('click','.node-control a', function($event){
		$event.preventDefault();
		$event.stopPropagation();

		var $this = $(this);
		var $parent = $this.closest('.parent');
		var parent_id = $parent.data('id')

		var max = _.max($data, function($data){ return $data.id; });
		var new_id = parseInt(max.id) + 1;

		var $target = $($event.target);
		var $form_person = $('#form-person');

		$modal_form_person.modal('toggle');

		if($target.hasClass('add-child')){
			$form_person.find('#id').val(new_id);
			$form_person.find('#family-id').val(new_id);
			$form_person.find('#parent-id').val(parent_id);
			$form_person.find('#child-id').val(0);
		}
		else if($target.hasClass('add-couple')){
			$form_person.find('#id').val(new_id);
			$form_person.find('#family-id').val(parent_id);
			$form_person.find('#parent-id').val(9999);
			$form_person.find('#child-id').val(0);
		}
		else if($target.hasClass('add-parent')){
			$form_person.find('#id').val(new_id);
			$form_person.find('#family-id').val(new_id);
			$form_person.find('#parent-id').val(0);
			$form_person.find('#child-id').val(parent_id);
		}

		$form_person.find('#name').val('');

	
	});

	$('#modal-form-person').on('click', '#save', function($event){
		var input_id = parseInt($('input#id').val());
		var input_family_id = $('input#family-id').val();
		var input_parent_id = $('input#parent-id').val();
		var input_child_id = $('input#child-id').val();
		var input_name = $('input#name').val();

		if(input_family_id == 'false'){
			input_family_id = false;
		}
		else{
			input_family_id = parseInt(input_family_id);
		}

		if(input_parent_id == 'false'){
			input_parent_id = false;
		}
		else{
			input_parent_id = parseInt(input_parent_id);
		}

		if(input_child_id == 'false'){
			input_child_id = false;
		}
		else{
			input_child_id = parseInt(input_child_id);
		}

		var $row = {id: input_id, name: input_name, family_id: input_family_id, parent_id: input_parent_id, order:0 };
		var $row_save = {name: input_name, parent_id: input_parent_id };

		if(input_family_id != input_id){
			$row_save.family_id = input_family_id;
		}

		if(!input_parent_id && input_child_id){
			var $row_child = _.findWhere($data, {id: input_child_id});
			var index_row_child = $data.indexOf($row_child);

			$data[index_row_child].parent_id = input_id;
			$row_save.child_id = input_child_id;
		}

		// save data to database
		$.ajax({
			type: 'POST',
			url: server_url + '/member/silsilah/add',
			data: $row_save,
			success: function($response){

			},
			error: function($response){
				
			},
			complete: function(){
				$modal_form_person.modal('hide');
			}
		});


		// repopulate data for tree render

		$data.push($row);

		$sorted_data = _($data).chain().sortBy(function($data) {
			return $data.parent_id;
		}).sortBy(function($data) {
			return $data.order;
		}).value();

		$('.tree').html('<ul>'+loop_children($sorted_data, 0)+'</ul>');

		console.log($sorted_data);
	});


});