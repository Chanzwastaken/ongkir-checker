<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ongkir Checker</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
	<div class="container">
    <header>
        <img class="logo" src="Chanz..png">
    </header>
    <main>
	<img class="OC" src="OngkirChecker.png">
        <section class="pwned">
            <h2>Check your delivery cost</h2>
            <?php 
			// API GET (list of city)
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => array(
					"key: 8d923ad9ac9eb0ff0349a6885122d1f3"
				),
				CURLOPT_RETURNTRANSFER => true,
			));
			$json = curl_exec($curl);
			curl_close($curl);

			//convert json response into php array
			$data = json_decode($json, TRUE);
			$cityList = $data["rajaongkir"]["results"];
			
			// display raw data
			// print_r($list);
		?>
		
		<form method="post" action="result.php">
			<!-- display data become dropdown -->
			Origin
			<select name="origin_city">
				<?php foreach($cityList as $city):?>
				<option value="<?php echo $city["city_id"];?>"><?php echo $city["city_name"];?></option>
				<?php endforeach;?>
			</select>
			<br />

			<!-- display same data become other dropdown -->
			Destination
			<select name="destination_city">
				<?php foreach($cityList as $city):?>
				<option value="<?php echo $city["city_id"];?>"><?php echo $city["city_name"];?></option>
				<?php endforeach;?>
			</select>
			<br />
			<button>Display Cost</button>
		</form>

        </section>
    </main>
    <footer>
        <p>&copy; 2023 Chanz. All rights reserved.</p>
    </footer>
	</div>
    <script src="script.js"></script>
</body>
</html>