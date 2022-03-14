
<?php
include("crud.php");
ini_set('max_execution_time', 0);  
$url="https://smreader.net/vibespublica/PHP-CRUD-REST-API/api/get-all-products.php";

$ch = curl_init();

 error_log("Failed to connect to database!", 0);

// Disable SSL verification

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Will return the response, if false it print the response

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Set the url

curl_setopt($ch, CURLOPT_URL,$url);

// Execute

$result=curl_exec($ch);

// Closing

curl_close($ch);

// decode JSON

$json = json_decode($result, true);




deleteMobile();
if($json['alldata']){
    

foreach ($json['alldata'] as $value) {
    
   addMobile($value);
    
   
}
}

	 function deleteMobile(){
		
		
			$query = 'TRUNCATE products';
			$crud = new Crud();
	 
$res = $crud->deletes($query); 

		
	}
	
	
	 function addMobile($Dat){

		$data=$Dat;
		
	

$product_name = $data["product_name"]; 
 
$manufacturer = $data["manufacturer"]; 
$short_description = $data["short_description"]; 
$price = $data["price"]; 
$crud = new Crud();
$sql = "insert into products (product_name,manufacturer,short_description,price,upload_date) values ('$product_name','$manufacturer','$short_description','$price',NOW())";
$res = $crud->create($sql); 


	}


?>