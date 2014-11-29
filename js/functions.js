function setContent(content){
	$('#content').html(content);
}
function getCoordinates(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(getLocations, scanError);
    }else{ 
        setContent('Der Browser unterstützt Geolocation nicht.');
    }
}
function getLocations(position){
	setContent('<div id="scanLoader"><img alt="Scanvorgang" src="/img/loader_scan.gif" /><p>Umgebung wird gescannt...</p></div>');
	$.ajax({
		url:'/ajax',
		type:'post',
		dataType:'json',
		data:{'action':'webCon','long':position.coords.longitude,'lat':position.coords.latitude},
		success:function(){
			
		},
		error:function(){
		
		}
	});
}
function scanError(error){
	switch(error.code){
		case error.PERMISSION_DENIED:
			setContent('Sie müssen Ihren Standort freigeben, um einen Umgebungsscan durchzuführen.');
			break;
		case error.POSITION_UNAVAILABLE:
			setContent('Ihr Standort konnte nicht ermittelt werden.');
			break;
		case error.TIMEOUT:
			setContent('Sie müssen Ihren Standort freigeben, um einen Umgebungsscan durchzuführen.');
			break;
		case error.UNKNOWN_ERROR:
			setContent('Es ist ein unerwarteter Fehler aufgetreten.');
			break;
	}
}