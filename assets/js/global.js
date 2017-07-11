function link_new_tab(url) {
	uri = url;	
	window.open(uri,'_blank', 'directories=0,titlebar=0,toolbar=0,location=0,status=0,menubar=0,scrollbars=no,resizable=no, width=770, height=500, top=20, left=80');
}

function link_to(url) {
	location.href = base_url + url;
}

function link_detail(url, id) {
	location.href = base_url + url + "/detail-data/" + id;
}

function link_preview(url, id) {
	uri = base_url + url + "/preview-data/" + id;	
	window.open(uri,'_blank', 'directories=0,titlebar=0,toolbar=0,location=0,status=0,menubar=0,scrollbars=no,resizable=no, width=770, height=500, top=20, left=80');
}

function link_pdf(url) {
	location.href = base_url + "report/" + url + "/export-to-pdf";
}

function link_excel(url) {
	location.href = base_url + "report/" + url + "/export-to-excel";
}

function link_download(url, file) {
	uri = base_url + 'assets/uploads/' + url + '/' + file;	
	window.open(uri,'_self', 'directories=0,titlebar=0,toolbar=0,location=0,status=0,menubar=0,scrollbars=no,resizable=no, width=600, height=400, top=20, left=80');
}

function link_add(url) {
	location.href = base_url + url + "/add-data";
}

function link_edit(url, id) {
	location.href = base_url + url + "/edit-data/" + id;
}

function link_delete(url, id) {
	location.href = base_url + url + "/delete-data/" + id;
}

function link_delete_detail(url, id, detail) {
	location.href = base_url + url + "/delete-detail-" + detail + "/" + id;
}

function edit_data(url, id) {
	$('#modal-edit').modal()                      
	$('#modal-edit').modal({ keyboard: false })   
	$('#modal-edit').modal('show')                
	
	$('#edit-yes').click(
		function() {
			link_edit(url, id);
		}
	);
	
	return false;
}

function delete_data(url, id) {
	$('#modal-delete').modal()                      
	$('#modal-delete').modal({ keyboard: false })   
	$('#modal-delete').modal('show')                
	
	$('#delete-yes').click(
		function() {
			link_delete(url, id);
		}
	);
	
	return false;
}

function delete_detail_data(url, id, detail) {
	$('#modal-delete').modal()                      
	$('#modal-delete').modal({ keyboard: false })   
	$('#modal-delete').modal('show')                
	
	$('#delete-yes').click(
		function() {
			link_delete_detail(url, id, detail);
		}
	);
}

function show_message(message) {
	$("#validate-message").html(message);
	
	$('#modal-message').modal()                      
	$('#modal-message').modal({ keyboard: false })   
	$('#modal-message').modal('show')                
}

function delete_to(url, id) {
	$('#modal-delete').modal()                      
	$('#modal-delete').modal({ keyboard: false })   
	$('#modal-delete').modal('show')                
	
	$('#delete-yes').click(
		function() {
			link_to(url);
		}
	);
	
	return false;
}

function add_position(id) {
	$("#manpower").val(id);
	
	$('#modal-add-position').modal()                      
	$('#modal-add-position').modal({ keyboard: false })   
	$('#modal-add-position').modal('show')                
	
	return false;
}

function add_mpp(id) {
	$("#manpower_mpp").val(id);
	
	$('#modal-add-mpp').modal()                      
	$('#modal-add-mpp').modal({ keyboard: false })   
	$('#modal-add-mpp').modal('show')                
	
	return false;
}

function edit_mpp(id) {
	ajax_actual_manpower(id);
	
	$("#manpower_detail").val(id);
	
	$('#modal-edit-mpp').modal()                      
	$('#modal-edit-mpp').modal({ keyboard: false })   
	$('#modal-edit-mpp').modal('show')                
	
	return false;
}

function ajax_actual_manpower(id) {
	var uri = base_url + "ajax/actual-manpower";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		url: uri ,
		data: $.param({ id:id }),
		success: function(msg) {
			$("#manpower_actual").fadeIn( 3000 ); 
			$("#manpower_actual").html(msg);                                                                     
		}
	}); 
}



function delete_to(url, id) {
	$('#modal-delete').modal()                      
	$('#modal-delete').modal({ keyboard: false })   
	$('#modal-delete').modal('show')                
	
	$('#delete-yes').click(
		function() {
			link_to(url);
		}
	);
	
	return false;
}

function edit_position(id) {
	var uri = base_url + "ajax/detail-manpower";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		url: uri ,
		data: $.param({ id:id }),
		success: function(msg) {
			$("#detail_manpower").html(msg);                                                                 
		}
	}); 
	
	$("#manpower_detail").val(id);
	
	$('#modal-edit-position').modal()                      
	$('#modal-edit-position').modal({ keyboard: false })   
	$('#modal-edit-position').modal('show')                
	
	return false;
}

function link_process(url) {
	$('#modal-process').modal()                      
	$('#modal-process').modal({ keyboard: false })   
	$('#modal-process').modal('show')                
	
	$('#process-yes').click(
		function() {
			link_to(url);
		}
	);
	
	return false;
}

function edit_detail_leave(id) {
	var uri = base_url + "ajax/detail-leave";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		url: uri ,
		data: $.param({ id:id }),
		success: function(msg) {
			$("#detail_leave").html(msg);                                                                 
		}
	}); 
	
	$("#leave_detail").val(id);
	
	$('#modal-edit-leave').modal()                      
	$('#modal-edit-leave').modal({ keyboard: false })   
	$('#modal-edit-leave').modal('show')                
	
	return false;
}

function edit_detail_recruit(id) {
	var uri = base_url + "ajax/detail-recruit";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		url: uri ,
		data: $.param({ id:id }),
		success: function(msg) {
			$("#detail_recruit").html(msg);                                                                 
		}
	}); 
	
	$("#recruit_detail").val(id);
	
	$('#modal-edit-recruit').modal()                      
	$('#modal-edit-recruit').modal({ keyboard: false })   
	$('#modal-edit-recruit').modal('show')                
	
	return false;
}

function edit_detail_apply(id) {
	var uri = base_url + "ajax/detail-apply";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		url: uri ,
		data: $.param({ id:id }),
		success: function(msg) {
			$("#detail_apply").html(msg);                                                                 
		}
	}); 
	
	$("#apply_detail").val(id);
	
	$('#modal-edit-apply').modal()                      
	$('#modal-edit-apply').modal({ keyboard: false })   
	$('#modal-edit-apply').modal('show')                
	
	return false;
}