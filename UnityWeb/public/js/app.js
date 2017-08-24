$('.input-group.date').datepicker({
	autoclose: true,
	format: "yyyy-mm-dd"
});

$(document).ready(function () {
	$('#slug-target').slugify('#slug-source');

	$('.destroy-btn').bind('ajax:success', function(e, data, status, xhr) {
	    $(e.target).closest('tr').remove();
	});

	$('.remove-btn').bind('ajax:success', function(e, data, status, xhr) {

	});

	tinymce.init({
		selector: "#textarea",
		height: 300,
		resize: true,
		relative_urls: false,
		plugins: ['autoresize', 'image', 'code', 'lists', 'example', 'link', 'textcolor'],
		indentation: '20pt',
		toolbar: [
			'undo redo | styleselect | bold italic | link image | alignleft aligncenter alignright | preview | spellchecker | forecolor backcolor | fontsizeselect'
		]
	});
});

