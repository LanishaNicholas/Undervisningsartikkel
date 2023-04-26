<?php
	require 'vendor/autoload.php';
	require 'src/OpenAi.php';
	require 'src/Url.php';


	if (isset($_POST['option'])) {
		$api_key = '<your openai key>';
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $postFields = [
            "model" => "text-davinci-003",
            "prompt"=> 'Q: Hva er den primære betydningen av klovneriet i Svalbards historie og kultur?\n\nA) Klovner ble introdusert som en form for underholdning for å bryte opp monotonien i det isolerte arktiske livet.(false)\n\nB) Klovneriet har fungert som et kulturelt bindeledd mellom folk fra forskjellige nasjonaliteter og bakgrunner på Svalbard.(correct)\n\nC) Klovner i Svalbard er engasjert i ulike sosiale og miljømessige initiativer.\n\nD) Klovneriet i Svalbard er et levende og mangfoldig kulturelt fenomen som har en lang historie og en dyp betydning for øygruppens innbyggere.\n\n',
            "temperature"=> 0,
            "max_tokens"=> 100,
            "top_p"=> 1.0,
            "frequency_penalty"=> 0.0,
            "presence_penalty"=> 0.0
        ];

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postFields));

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer ' . $api_key;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $data = json_decode($result);
        //print_r($data);
        if($_POST['option'] == "1"){
            $strng = 'Svaret ditt er riktig: <br><br>'.$data->choices[0]->text;
        }else if($_POST['option'] == "0"){
            $strng = 'Svaret ditt er ikke riktig og det riktige svaret er: <br><br>'.$data->choices[0]->text;
        }else{
            $strng  = '';
        }
        
        
    }else{
        $strng  = '';
    }
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Undervisningsartikkel</title>
</head>
<body>
    <form action="practice.php" method="post" >
	    <p>
		      Hva er den primære betydningen av klovneriet i Svalbards historie og kultur?
            <br>
            <input type="radio" name="option" id="optionA" value="0" />
            A) Klovner ble introdusert som en form for underholdning for å bryte opp monotonien i det isolerte arktiske livet.
            <br>
            <input type="radio" name="option" id="optionB" value="1" />
            B) Klovneriet har fungert som et kulturelt bindeledd mellom folk fra forskjellige nasjonaliteter og bakgrunner på Svalbard.
            <br>
            <input type="radio" name="option" id="optionC" value="0" />
            C) Klovner i Svalbard er engasjert i ulike sosiale og miljømessige initiativer.
            <br>
            <input type="radio" name="option" id="optionD" value="0" />
            D) Klovneriet i Svalbard er et levende og mangfoldig kulturelt fenomen som har en lang historie og en dyp betydning for øygruppens innbyggere.
	     </p>
    
        <button id="summaryButton" type="submit">Submit</button>
    </form>
        <br>
        <br>
        <p id="summary"><?php echo $strng; ?></p>
</body>
</html>