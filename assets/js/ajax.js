function ajax_province_by_island(id) {
	$("#province").select2("val", null);
	$("#city").select2("val", null);
	$("#branch").select2("val", null);
	
	var uri = base_url + "ajax/province-by-island";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		url: uri ,
		data: $.param({ island:id }),
		success: function(msg) {
			if(msg == ''){
				$("#province").html('<option></option>');
			}
			else {
				$("#province").removeAttr('disabled');
				$("#province").html(msg);
			}                                                                     
		}
	}); 
}

function ajax_city_by_province(id) {
	$("#city").select2("val", null);
	$("#branch").select2("val", null);
	
	var uri = base_url + "ajax/city-by-province";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		url: uri ,
		data: $.param({ province:id }),
		success: function(msg) {
			if(msg == ''){
				$("#city").html('<option></option>');
			}
			else {
				$("#city").removeAttr('disabled');
				$("#city").html(msg);
			}                                                                     
		}
	}); 
}

function ajax_branch_by_city(id) {
	$("#branch").select2("val", null);
	
	var uri = base_url + "ajax/branch-by-city";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		url: uri ,
		data: $.param({ city:id }),
		success: function(msg) {
			if(msg == ''){
				$("#branch").html('<option></option>');
			}
			else {
				$("#branch").removeAttr('disabled');
				$("#branch").html(msg);
			}                                                                     
		}
	}); 
}

function badge_manpower() {
	var uri = base_url + "ajax/badge-manpower";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		//data: $.param({ value:value, student:student, onlinecourses:onlinecourses }),
		url: uri ,
		success: function(msg) {
			$("#badge_manpower").html(msg);                                                                      
		}
	}); 
}

function count_manpower() {
	var uri = base_url + "ajax/count-manpower";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		url: uri ,
		success: function(msg) {
			$("#count_manpower").html(msg);                                                                      
		}
	}); 
}

function badge_leave() {
	var uri = base_url + "ajax/badge-leave";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		//data: $.param({ value:value, student:student, onlinecourses:onlinecourses }),
		url: uri ,
		success: function(msg) {
			$("#badge_leave").html(msg);                                                                      
		}
	}); 
}

function count_leave() {
	var uri = base_url + "ajax/count-leave";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		url: uri ,
		success: function(msg) {
			$("#count_leave").html(msg);                                                                      
		}
	}); 
}

function badge_request() {
	var uri = base_url + "ajax/badge-request";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		//data: $.param({ value:value, student:student, onlinecourses:onlinecourses }),
		url: uri ,
		success: function(msg) {
			$("#badge_request").html(msg);                                                                      
		}
	}); 
}

function count_request() {
	var uri = base_url + "ajax/count-request";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		url: uri ,
		success: function(msg) {
			$("#count_request").html(msg);                                                                      
		}
	}); 
}

function badge_checking() {
	var uri = base_url + "ajax/badge-checking";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		//data: $.param({ value:value, student:student, onlinecourses:onlinecourses }),
		url: uri ,
		success: function(msg) {
			$("#badge_checking").html(msg);                                                                      
		}
	}); 
}

function count_checking() {
	var uri = base_url + "ajax/count-checking";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		url: uri ,
		success: function(msg) {
			$("#count_checking").html(msg);                                                                      
		}
	}); 
}

function badge_recruit() {
	var uri = base_url + "ajax/badge-recruit";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		//data: $.param({ value:value, student:student, onlinecourses:onlinecourses }),
		url: uri ,
		success: function(msg) {
			$("#badge_recruit").html(msg);                                                                      
		}
	}); 
}

function count_recruit() {
	var uri = base_url + "ajax/count-recruit";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		url: uri ,
		success: function(msg) {
			$("#count_recruit").html(msg);                                                                      
		}
	}); 
}

function badge_apply() {
	var uri = base_url + "ajax/badge-apply";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		//data: $.param({ value:value, student:student, onlinecourses:onlinecourses }),
		url: uri ,
		success: function(msg) {
			$("#badge_apply").html(msg);                                                                      
		}
	}); 
}

function count_apply() {
	var uri = base_url + "ajax/count-apply";
	
	$.ajax({
		type: "POST",
		dataType: "html",
		url: uri ,
		success: function(msg) {
			$("#count_apply").html(msg);                                                                      
		}
	}); 
}