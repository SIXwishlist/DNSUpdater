$(function() {

	// Functions for Resultmessages
	function showResult(textp, time) {
		textp.text(time + ' sec');
		textp.css('color', 'green');
		textp.stop( true, true ).fadeIn(0).fadeOut( 3500 );
	}

	function showError(textp) {
		textp.text('Error');
		textp.css('color', 'red');
		textp.stop( true, true ).fadeIn(0).fadeOut( 3500 );
	}

	// Get responsetime for selected service
	$('#ip-service, #ip-service-fallback').change(function() {
		var thisselct = $(this);
		thisselct.attr('disabled',true);
		var service = $(this).val();
		OCP.AppConfig.setValue('dnsupdater', thisselct.attr('id'), service);
		var option = {};
		OCP.AppConfig.getValue('dnsupdater', thisselct.attr('id'), option);
		console.log(option);
		var baseUrl = OC.generateUrl('/apps/dnsupdater/time/' + service);
		var messagep = $(this).next();
		$.post( baseUrl)
			.done(function( data ) {
				if ( data.time == 0) {
					showError(messagep);
				}
				else {
					showResult(messagep, data.time);
				}
			}).fail(function (data) {
				showError(messagep);
			})  .always(function() {
				thisselct.attr('disabled',false);
			});
	});

	// On Change of DNS Settings
	$('.entry select, .entry input').change(function(){
	    var iddiv = $(this).closest('.entry');
		var id = parseInt(iddiv.attr('id').replace(/entry/, ''));
	    var valueObj = {
	        id: id,
	        provider: iddiv.find('select[name=provider]').val(),
	        user: iddiv.find('input[name=username]').val(),
	        password: iddiv.find('input[name=password]').val(),
	        domain: iddiv.find('input[name=domain]').val(),
			params: iddiv.find('input[name=params]').val(),
	        https: iddiv.find('input[name=usehttps]').prop( 'checked' ),
	    };
	    console.log(valueObj);
		OCP.AppConfig.setValue('dnsupdater', id, JSON.stringify(valueObj));
	});


	$('#dyndnsaddentry').click(function() {
		var id = 0;
		$('#dyndns-entries > div').each(function () {
			id++;
		});
		$('#entrytemplate #entry.entry')
			.clone(true, true)
			.attr('id','entry' + id)
			.appendTo( "#dyndns-entries" );

	});



	$('#dyndnssave').click(function() {
		var allEntries = new Object();
		var id = 0;
		$('#dyndns-entries > div').each(function () {
			allEntries[id] = new Object();
			console.log($(this).find('input'));
			$(this).find('input').each(function (){
				allEntries[id][$(this).attr("name")] = $(this).val();
			});
			allEntries[id].provider = $(this).find('select').val();
			id++;
		});
		var baseUrl = OC.generateUrl('/apps/dnsupdater/savedns');
		console.log(JSON.stringify(allEntries));
	});

});
