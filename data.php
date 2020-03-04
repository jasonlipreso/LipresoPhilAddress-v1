<?php

/*

Author: Jason Lipreso
Date Time: Febuary 04, 2020 04:14 PM
Email: jasonlipreso@gmail.com

*/

class lipreso_philadds{
	public function ConnectDB(){
		$PhilAdds = new mysqli("localhost", "root", "", "db_lip_geo");
		if($PhilAdds->connect_error)
		{
			die("Connection Error". $PhilAdds->error);
		}
		else{
			return $PhilAdds;
		}
	}

	public function Returner($ReturnType, $PHPArrays){
		if($ReturnType == "PHPARRAY"){
			return $PHPArrays;
		}
		else if($ReturnType == "JSONARRAY"){
			header("Content-type: application/json");
			return json_encode($PHPArrays);
		}
		else{

		}
	}

	public function getRegion($ReturnType){

		$Connection = lipreso_philadds::ConnectDB();

		$SQL = "SELECT * FROM `refregion` ORDER BY `id` ASC ";
		$RES = $Connection->query($SQL);
		if($RES->num_rows>0){
			while($ROW = $RES->fetch_assoc()){
				$RETURN_ARRAY[] = array(
					"id"		=> $ROW['id'],
					"psgcCode" 	=> $ROW['psgcCode'],
					"regDesc" 	=> strtoupper($ROW['regDesc']),
					"regCode" 	=> $ROW['regCode']
				);
			}

				return lipreso_philadds::Returner($ReturnType, $RETURN_ARRAY);
		}
		else{
				$RETURN_ARRAY[] = array(
					"id"		=> null,
					"psgcCode" 	=> null,
					"regDesc" 	=> null,
					"regCode" 	=> null
				);

				return lipreso_philadds::Returner($ReturnType, $RETURN_ARRAY);
		}
	}

	public function getProvinceByRegion($ReturnType, $Region){
		
		$Connection = lipreso_philadds::ConnectDB();

		$SQL = "SELECT * FROM `refprovince` WHERE `regCode` = '$Region' ORDER BY `id` ASC ";
		$RES = $Connection->query($SQL);
		if($RES->num_rows>0){
			while($ROW = $RES->fetch_assoc()){
				$RETURN_ARRAY[] = array(
					"id"		=> $ROW['id'],
					"psgcCode" 	=> $ROW['psgcCode'],
					"provDesc"	=> strtoupper($ROW['provDesc']),
					"regCode" 	=> $ROW['regCode'],
					"provCode"	=> $ROW['provCode']
				);
			}

				return lipreso_philadds::Returner($ReturnType, $RETURN_ARRAY);
		}
		else{
				$RETURN_ARRAY[] = array(
					"id"		=> null,
					"psgcCode" 	=> null,
					"provDesc"	=> null,
					"regCode" 	=> null,
					"provCode"	=> null
				);

				return lipreso_philadds::Returner($ReturnType, $RETURN_ARRAY);
		}
	}

	public function getCityMunicipalityByProvinceCode($ReturnType, $ProvinceCode){
		
		$Connection = lipreso_philadds::ConnectDB();

		$SQL = "SELECT * FROM `refcitymun` WHERE `provCode` = '$ProvinceCode' ORDER BY `citymunDesc` ASC ";
		$RES = $Connection->query($SQL);
		if($RES->num_rows>0){
			while($ROW = $RES->fetch_assoc()){
				$RETURN_ARRAY[] = array(
					"id" 			=> $ROW['id'],
					"psgcCode" 		=> $ROW['psgcCode'],
					"citymunDesc" 	=> strtoupper($ROW['citymunDesc']),
					"regDesc" 		=> $ROW['regDesc'],
					"provCode" 		=> $ROW['provCode'],
					"citymunCode" 	=> $ROW['citymunCode']
				);
			}

				return lipreso_philadds::Returner($ReturnType, $RETURN_ARRAY);
		}
		else{
				$RETURN_ARRAY[] = array(
					"id" 			=> null,
					"psgcCode" 		=> null,
					"citymunDesc" 	=> null,
					"regDesc" 		=> null,
					"provCode" 		=> null,
					"citymunCode" 	=> null
				);

				return lipreso_philadds::Returner($ReturnType, $RETURN_ARRAY);
		}
	}

	public function getBarangayByCityCode($ReturnType, $CityCode){
		
		$Connection = lipreso_philadds::ConnectDB();

		$SQL = "SELECT * FROM `refbrgy` WHERE `citymunCode` = '$CityCode' ORDER BY `brgyDesc` ASC ";
		$RES = $Connection->query($SQL);
		if($RES->num_rows>0){
			while($ROW = $RES->fetch_assoc()){
				$RETURN_ARRAY[] = array(
					"id" 			=> $ROW['id'],
					"brgyCode" 		=> $ROW['brgyCode'],
					"brgyDesc" 		=> strtoupper($ROW['brgyDesc']),
					"regCode" 		=> $ROW['regCode'],
					"provCode" 		=> $ROW['provCode'],
					"citymunCode" 	=> $ROW['citymunCode'],
				);
			}

				return lipreso_philadds::Returner($ReturnType, $RETURN_ARRAY);
		}
		else{
				$RETURN_ARRAY[] = array(
					"id" 			=> null,
					"brgyCode" 		=> null,
					"brgyDesc" 		=> null,
					"regCode" 		=> null,
					"provCode" 		=> null,
					"citymunCode" 	=> null
				);

				return lipreso_philadds::Returner($ReturnType, $RETURN_ARRAY);
		}
	}
}


if(isset($_GET['getRegion'])){

	/* data.php?getRegion */

	echo lipreso_philadds::getRegion("JSONARRAY"); 								
}
else if(isset($_GET['getProvinceByRegion'])){

	/* 	getProvinceByRegion&Region=08 	*/

	echo lipreso_philadds::getProvinceByRegion("JSONARRAY", $_GET['Region']); 					
}
else if(isset($_GET['getCityMunicipalityByProvinceCode'])){

	/*	getCityMunicipalityByProvinceCode&ProvinceCode=0722	*/

	echo lipreso_philadds::getCityMunicipalityByProvinceCode("JSONARRAY", $_GET['ProvinceCode']);
}
else if(isset($_GET['getBarangayByCityCode'])){

	/* data.php?getBarangayByCityCode&CityCode=072251 */

	echo lipreso_philadds::getBarangayByCityCode("JSONARRAY", $_GET['CityCode']);
}

?>