$('#orders-route_id').on('change', function(e){
	var route = $(e.target).val();
	
	$.ajax({
		url: '/routes/get-route-distance',
		type: 'post',
		data: { 
			'route_id': route
		},
		success: function (res) {
			res = res ? res : 0;
			$('#route-distance-placeholder').text(res + ' км.');
		}
	});
  
});