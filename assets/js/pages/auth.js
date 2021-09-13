/* ------------------------------------------------------------------------------
*
*  # Auth module
*
*  Specific JS code additions for login and registration pages
*
*  Version: 1.0
*  Latest update: Jun 13, 2016
*
* ---------------------------------------------------------------------------- */
$(document).ready(function() {
	$('.styled').uniform();

	var loginForm = $('#login');
	if (loginForm.length)
	{
		loginForm.on('submit', function(e) {
			e.preventDefault();

			var blockElem = $('.panel', loginForm);
				App.blockUI({
				target: blockElem,
				animate: true
			});

			$.ajax({
				url:		loginForm.attr('action'),
				data:		loginForm.serialize(),
				type:		'POST',
				dataType:	'json',
				timeout:	5000,
				success:	function(response) {
					if (!response.success) {
						App.unblockUI(blockElem);
						$('input, button', loginForm).removeAttr('disabled');
						if (response.message)
							toastr['error'](response.message);
					} else {
						if (response.message)
							toastr['success'](response.message);
					}
					if (response.redirect) {
						var redirect = setTimeout(function() {
							window.location = response.redirect;
							clearTimeout(redirect);
						}, 3000);
					}
				}
			});
			$('input, button', loginForm).attr('disabled', true);
		});
	}

	var registerForm = $('#register');
	if (registerForm.length)
	{
		registerForm.on('submit', function(e) {
			e.preventDefault();

			var blockElem = $('.panel', registerForm);
				App.blockUI({
				target: blockElem,
				animate: true
			});

			$.ajax({
				url:		registerForm.attr('action'),
				data:		registerForm.serialize(),
				type:		'POST',
				dataType:	'json',
				timeout:	5000,
				success:	function(response) {
					if (!response.success) {
						App.unblockUI(blockElem);
						$('input, button', registerForm).removeAttr('disabled');
						if (response.message)
							toastr['error'](response.message);
					} else {
						if (response.message)
							toastr['success'](response.message);
					}
					if (response.redirect) {
						var redirect = setTimeout(function() {
							window.location = response.redirect;
							clearTimeout(redirect);
						}, 3000);
					}
				}
			});
			$('input, button', registerForm).attr('disabled', true);
		});
	}

	var forgotForm = $('#forgot');
	if (forgotForm.length)
	{
		forgotForm.on('submit', function(e) {
			e.preventDefault();

			var blockElem = $('.panel', forgotForm);
			App.blockUI({
				target: blockElem,
				animate: true
			});

			$.ajax({
				url:		forgotForm.attr('action'),
				data:		forgotForm.serialize(),
				type:		'POST',
				dataType:	'json',
				timeout:	5000,
				success:	function(response) {
					if (!response.success) {
						App.unblockUI(blockElem);
						$('input, button', forgotForm).removeAttr('disabled');
						if (response.message)
							toastr['error'](response.message);
					} else {
						if (response.message)
							toastr['success'](response.message);
					}
					if (response.redirect) {
						var redirect = setTimeout(function() {
							window.location = response.redirect;
							clearTimeout(redirect);
						}, 3000);
					}
				}
			});
			$('input, button', forgotForm).attr('disabled', true);
		});
	}
});
