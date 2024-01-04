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
	<img class="OC-result" src="OngkirChecker.png">
        <section class="pwned-result">
            <h2>Delivery Cost Result:</h2>
            <table>
        <thead>
            <tr class="ndas">
                <th>Courier</th>
                <th>Service</th>
                <th>Description</th>
                <th>Cost</th>
                <th>Delivery time (day)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // get data from previous screen
            $origin_city = $_POST["origin_city"];
            $destination_city = $_POST["destination_city"];

            // List of couriers
            $couriers = array("jne", "tiki", "pos");

            // API POST (display delivery cost)
            foreach ($couriers as $courier) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_HTTPHEADER => array(
                        "key: 8d923ad9ac9eb0ff0349a6885122d1f3",
                        "content-type: application/x-www-form-urlencoded"
                    ),
                    // put data origin, destination & courier in this line
                    CURLOPT_POSTFIELDS => "origin=".$origin_city."&destination=".$destination_city."&weight=100&courier=".$courier,
                    CURLOPT_RETURNTRANSFER => true,
                ));
                $json = curl_exec($curl);
                curl_close($curl);

                // convert json response into php array
                $data = json_decode($json, TRUE);
                $costList = $data["rajaongkir"]["results"][0]["costs"];

                // display delivery cost
                foreach($costList as $cost){
                    echo "<tr>";
                    echo "<td>".strtoupper($courier)."</td>";
                    echo "<td>".$cost["service"]."</td>";
                    echo "<td>".$cost["description"]."</td>";
                    echo "<td>Rp. ".$cost["cost"][0]["value"]."</td>";
                    echo "<td>".$cost["cost"][0]["etd"]."</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>

        </section>
        <a class="back" href="index.php">Back</a>
    </main>
    <footer>
        <p>&copy; 2023 Chanz. All rights reserved.</p>
    </footer>
	</div>
    <script src="script.js"></script>
</body>
</html>