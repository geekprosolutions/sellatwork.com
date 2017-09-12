if (navigator.geolocation) 
{
navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
}

//Get the latitude and the longitude;
function successFunction(position) {
var lat = position.coords.latitude;
var lng = position.coords.longitude;
localStorage['authorizedGeoLocation'] = 1;
codeLatLng(lat, lng);

}
function errorFunction(){
    localStorage['authorizedGeoLocation'] = 0;
	
	$.ajax
	({
		url : "backpages/setLocation.php", //set default location
		type : 'post',
		success: function(response)
		{
			//alert(response);
			//console.log(response);
		}
	});
}

function codeLatLng(lat, lng)
{
	var geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(lat, lng);
	
	geocoder.geocode({'latLng': latlng}, function(results, status) 
		{
			
		  if (status == google.maps.GeocoderStatus.OK) 
		  {
			if (results[1]) 
			{
				var indice=0;
				for (var j=0; j<results.length; j++)
				{
					if (results[j].types[0]=='locality')
						{
							indice=j;
							break;
						}
				}
					 // alert('The good number is: '+j);
					//alert(JSON.stringify(results[j].address_components));
					for (var i=0; i<results[j].address_components.length; i++)
					{
						if (results[j].address_components[i].types[0] == "locality") {
								//this is the object you are looking for
								city = results[j].address_components[i];
							}
						if (results[j].address_components[i].types[0] == "administrative_area_level_1") {
								//this is the object you are looking for
								region = results[j].address_components[i];
							}
						if (results[j].address_components[i].types[0] == "country") {
								//this is the object you are looking for
								country = results[j].address_components[i];
							}
					}

					var cityName=city.long_name;
					var stateName=region.long_name;
					var countryName=country.short_name+" , "+country.long_name ;
					var user_location=city.long_name + ", " + region.long_name + ", " + country.long_name;
					var data = 
						{ 
							"latitude" : lat,
							"longitude" : lng,
							"city" : cityName,
							"state" : stateName,
							"countryName" : countryName,
							"user_location" : user_location,
						}
						$.ajax
						({
							url : "backpages/setLocation.php",
							type : 'post',
							data : data,
							success: function(response)
							{
								//alert(response);
								//console.log(response);
							}
						});


				} 
			
		  } 
	});
}

function checkauthorizedGeoLocation()
{ // you can use this function to know if geoLocation was previously allowed
    if(typeof localStorage['authorizedGeoLocation'] == "undefined" || localStorage['authorizedGeoLocation'] == 0 ) 
	{
		//alert(localStorage['authorizedGeoLocation']);
		//alertify.alert("Sell At Work", "This App Require your Geolocation to perform certain task, or certain features may not work properly. So Please  Allow Permission." , "Closable: false").set('closable', false);
	}
	
}
checkauthorizedGeoLocation();
