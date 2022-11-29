<?php
// Listening submit button
if (isset($_POST['submit'])) {

// The curl function is included in the project
    $curl = curl_init();
// Curl array is created
curl_setopt_array($curl, [
    // API information is entered
    CURLOPT_URL => "https://phonenumbervalidatefree.p.rapidapi.com/ts_PhoneNumberValidateTest.jsp?number=%2B".$_POST['number']."&country=".$_POST['country'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: phonenumbervalidatefree.p.rapidapi.com", // 
        "X-RapidAPI-Key: 4af258ff08mshe7fe29f940c5294p12e13ejsn5a3d8ec6077e"
        // Please sign up and get API key from the link I gave in the description. Otherwise the API will not work.
    ],
]);

// With the curl function, the API query is executed and kept in the variable.
$response = curl_exec($curl);
//The error description that occurs as a result of the query executed is kept in the variable.
$err = curl_error($curl);
//The curl function is terminated
curl_close($curl);
// If an error has occurred, an if is entered, otherwise the process continues.
if ($err) {
    // The error message for the resulting error value is kept in the message variable and printed on the screen.
    $request = "<div class='alert alert-danger container mt-5' role='alert'>* The entered number is fake or does not work. ! Error request: ".$err."</div>";
} 
else {
    // Informed that the query has run successfully
     $request = "<div class='alert alert-success container mt-5' role='alert'>*The number entered is real and working</div>";
     // The query result returns json, this data is decoded for ease of access.
     $values = json_decode($response, FALSE);
     // Sending fake numbers into the query is checked.
     if($values->phoneNumberEntered == '')
       $request = "<div class='alert alert-danger container mt-5' role='alert'>* The entered number is fake or does not work. ! Error request: ".$err."</div>";
    }
}
?>

<!-- Default form head -->
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<!-- Default form input -->
<body class="bg-dark text-white" >
    <div class="container">
        <!-- Notifications are made, such as error messages resulting from the query. -->
        <?php echo $request;?>
        <form class="text-center p-5" action="" method="Post">

            <p class="h4 mb-4">Number Check</p>

            <!-- Number -->
            <input type="number" name="number" class="form-control mb-4" placeholder="Number" required>

            <!-- Country -->
                <select class="form-control mb-4" name="country">
                    <option value="NA" selected>Please Select Number Country</option>
                    <option value="TR">Turkey</option>
                    <option value="USA">United States</option>
                </select>
            <!-- Check button -->
            <button class="btn btn-info btn-block my-4" name="submit" type="submit">Check</button>
        </form>
  <!-- Check Result -->
  <div class='alert alert-success container mt-5' role='alert'>
      <b>Entered Number: </b><?php echo $values->phoneNumberEntered; ?><br>
      <b>Country Code: </b><?php echo $values->countryCode; ?><br>
      <b>Default Country Entered: </b><?php echo $values->defaultCountryEntered; ?><br>
      <b>Phone Number Region: </b><?php echo $values->phoneNumberRegion; ?><br>
      <b>Location: </b><?php echo $values->location; ?><br>
      <b>Time Zone: </b><?php echo $values->timeZone_s; ?><br>
      <b>Carrier: </b><?php echo $values->carrier; ?><br>
  </div>

</div>

<!-- Required javascript libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>
<footer>
    <div class="container-fluid footer fixed-bottom border-top border-white p-3 text-center mt-5">
        Designed by <b ><a href="https://github.com/ycanga" style="color:#131313; text-decoration: none;">Yunus Emre Canğa</a> | <a href="https://4lphasoftware.com" style="color:#ffb600; text-decoration: none;">4LPHA Software</a></b>
    </div>
</footer>