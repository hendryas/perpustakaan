/*
 Template Name: Drixo - Bootstrap 4 Admin Dashboard
 Author: Themesdesign
 Website: www.themesdesign.in
 File: Datatable js
 */

$(document).ready(function () {
	$("#datatable").DataTable({
		paging: false,
		scrollCollapse: true,
		scrollY: "200px",
	});

	//Buttons examples
	var table = $("#datatable-buttons").DataTable({
		lengthChange: false,
		buttons: ["copy", "excel", "pdf", "colvis"],
	});

	table
		.buttons()
		.container()
		.appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
});
