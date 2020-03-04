
/*

Author: Jason Lipreso
Date Time: Febuary 04, 2020 04:14 PM
Email: jasonlipreso@gmail.com

*/


(function (window) {
	'use strict'
	function lipreso_philadds() {

		var LipPhilAdd = {};
		var mainPath = "";

		LipPhilAdd.appendRegionList = function (selectElem){
			$.getJSON("data.php?getRegion", function (data) {
				$(selectElem).html("");
				$(selectElem).append("<select value = 'SELECT'>SELECT</select>");
				$.each(data, function (i) {

					var id = data[i].id;
					var psgcCode = data[i].psgcCode;
					var regDesc = data[i].regDesc;
					var regCode = data[i].regCode;

					$(selectElem).append("<option value = '"+regCode+"'>"+regDesc+"</option>");
				});
			});
		};

		LipPhilAdd.appendProvinceByRegion = function(selectElem, RegionCode) {
			$.getJSON("data.php?getProvinceByRegion&Region="+RegionCode, function (data) {
				$(selectElem).html("");
				$(selectElem).append("<select value = 'SELECT'>SELECT</select>");
				$.each(data, function (i) {

					var id = data[i].id;
					var psgcCode = data[i].psgcCode;
					var provDesc = data[i].provDesc;
					var provCode = data[i].provCode;
					var regCode = data[i].regCode;
		
					$(selectElem).append("<option value = '"+provCode+"'>"+provDesc+"</option>");
				});
			});
		};

		LipPhilAdd.appendMunicipalityByProvince = function(selectElem, ProvinceCode) {
			$.getJSON("data.php?getCityMunicipalityByProvinceCode&ProvinceCode="+ProvinceCode, function (data) {
				$(selectElem).html("");
				$(selectElem).append("<select value = 'SELECT'>SELECT</select>");
				$.each(data, function (i) {

					var id 			= data[i].id;
					var psgcCode 	= data[i].psgcCode;
					var citymunDesc = data[i].citymunDesc;
					var citymunCode = data[i].citymunCode;
					var regDesc 	= data[i].regDesc;
					var provCode 	= data[i].provCode;
		
					$(selectElem).append("<option value = '"+citymunCode+"'>"+citymunDesc+"</option>");
				});
			});
		};

		LipPhilAdd.appendBarangayByMunicipality = function(selectElem, Municipality) {
			$.getJSON("data.php?getBarangayByCityCode&CityCode="+Municipality, function (data) {
				$(selectElem).html("");
				$(selectElem).append("<select value = 'SELECT'>SELECT</select>");
				$.each(data, function (i) {

					var id 			= data[i].id;
					var brgyCode 	= data[i].brgyCode;
					var brgyDesc 	= data[i].brgyDesc;
					var regCode 	= data[i].regCode;
					var provCode 	= data[i].provCode;
					var citymunCode = data[i].citymunCode;
		
					$(selectElem).append("<option value = '"+brgyCode+"'>"+brgyDesc+"</option>");
				});
			});
		};

		return LipPhilAdd;
	};

	if(typeof(LipPhilAdd) === 'undefined'){
		window.LipPhilAdd = lipreso_philadds();
	}

}) (window);