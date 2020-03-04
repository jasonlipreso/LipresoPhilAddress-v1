<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src = "jquery-3.3.1.js"></script>
	<script type="text/javascript" src = "lipreso-philadds.js"></script>
</head>
<body>

<table>
	<tr>
		<td><span>Region List</span></td>
		<td><select id = "sel-region"></select></td>
	</tr>
	<tr>
		<td><span>Province</span></td>
		<td><select id = "sel-province"></select></td>
	</tr>
	<tr>
		<td><span>Municipality</span></td>
		<td><select id = "sel-municipality"></select></td>
	</tr>
	<tr>
		<td><span>Barangay</span></td>
		<td><select id = "sel-barangay"></select></td>
	</tr>
</table>
</body>
</html>

<script type="text/javascript">

	var defaults = {
		"province":"07",
		"municipality":"0722",
		"barangay":"072251"
	};

	LipPhilAdd.appendRegionList("#sel-region");
	LipPhilAdd.appendProvinceByRegion("#sel-province", defaults.province);
	LipPhilAdd.appendMunicipalityByProvince("#sel-municipality", defaults.municipality);
	LipPhilAdd.appendBarangayByMunicipality("#sel-barangay", defaults.barangay);

	$("#sel-region").change(function () {
		var region = $(this).val();
		LipPhilAdd.appendProvinceByRegion("#sel-province",region);
	});

	$("#sel-province").change(function () {
		var province = $(this).val();
		LipPhilAdd.appendMunicipalityByProvince("#sel-municipality",province);
	});

	$("#sel-municipality").change(function () {
		var municipality = $(this).val();
		LipPhilAdd.appendBarangayByMunicipality("#sel-barangay", municipality);
	});

</script>