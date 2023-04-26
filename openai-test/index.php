<?php
 
require 'vendor/autoload.php';
require 'src/OpenAi.php';
require 'src/Url.php';
    
    $prompt ="Svalbard, en øygruppe i Arktis, er kanskje mest kjent for sin villmark, sitt dyreliv og sine polarekspedisjoner. Men det er også et sted hvor kultur og underholdning trives, og klovner har spilt en spesiell rolle i Svalbards kulturelle landskap. Denne undervisningsartikkelen tar for seg historien, betydningen og kunsten bak klovneriet i Svalbard, og gir en innføring i hvordan denne særegne underholdningsformen har utviklet seg på øygruppen.Klovneriets historie i Svalbard kan spores tilbake til tidlige europeiske oppdagelsesreisende og hvalfangere som kom til øygruppen på 1600- og 1700-tallet. Disse sjøfolkene brakte med seg ulike kulturelle uttrykk, og klovneriet ble introdusert som en form for underholdning for å bryte opp monotonien i det isolerte arktiske livet. Klovneforestillinger ble derfor en viktig sosial aktivitet og et middel for samhold blant de tidlige bosetterne.Klovneriet har hatt en spesiell betydning for Svalbard, da det har fungert som et kulturelt bindeledd mellom folk fra forskjellige nasjonaliteter og bakgrunner som har bosatt seg på øygruppen. Gjennom humor, slapstick og fysiske krumspring har klovner vært i stand til å formidle historier og budskap som har krysset språk- og kulturgrenser. Dette har bidratt til å skape en felles identitet og et kulturelt fellesskap for Svalbards innbyggere.I dag er klovneriet en integrert del av Svalbards kulturelle landskap, og det finnes en rekke organiserte grupper og ensembler som fremfører klovneforestillinger både lokalt og internasjonalt. Klovner i Svalbard er også engasjert i ulike sosiale og miljømessige initiativer,som bidrar til å styrke samfunnet og øke bevisstheten rundt øygruppens unike utfordringer.Klovneriet i Svalbard er et levende og mangfoldig kulturelt fenomen som har en lang historie og en dyp betydning for øygruppens innbyggere. Klovner har ikke bare fungert som underholdere, men også som kulturelle brobyggere og samfunnsengasjerte aktører. Ved å lære om klovner i Svalbard, får vi et unikt innblikk i et samfunn som har klart å forene ulike kulturer og tradisjoner gjennom kunsten og kraften av humor.\n\nTl;dr";


    if (isset($_POST['from']) && $_POST['from'] == "yes") {
      
        $api_key = '<your openai key>';


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        $postFields = [
            "model" => "text-davinci-003",
            "prompt"=> "$prompt",
            "temperature"=> 0.7,
            "max_tokens"=> 500,
            "top_p"=> 1.0,
            "frequency_penalty"=> 0.0,
            "presence_penalty"=> 1
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
        $strng = 'Et kort sammendrag av artikkelen : <br><br>'.$data->choices[0]->text;
        
    }else{
        $strng  = '';
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Undervisningsartikkel</title>
    </head>
    <body>
        
        <h2>Tittel: Klovner på Svalbard: En fargerik og kulturell undervisningsartikkel</h2>
        <p>
            Svalbard, en øygruppe i Arktis, er kanskje mest kjent for sin villmark, sitt dyreliv og sine polarekspedisjoner. Men det er også et sted hvor kultur og underholdning trives, og klovner har spilt en spesiell rolle i Svalbards kulturelle landskap. Denne undervisningsartikkelen tar for seg historien, betydningen og kunsten bak klovneriet i Svalbard, og gir en innføring i hvordan denne særegne underholdningsformen har utviklet seg på øygruppen.<br><br>
            Klovneriets historie i Svalbard kan spores tilbake til tidlige europeiske oppdagelsesreisende og hvalfangere som kom til øygruppen på 1600- og 1700-tallet. Disse sjøfolkene brakte med seg ulike kulturelle uttrykk, og klovneriet ble introdusert som en form for underholdning for å bryte opp monotonien i det isolerte arktiske livet. Klovneforestillinger ble derfor en viktig sosial aktivitet og et middel for samhold blant de tidlige bosetterne.<br><br>
            Klovneriet har hatt en spesiell betydning for Svalbard, da det har fungert som et kulturelt bindeledd mellom folk fra forskjellige nasjonaliteter og bakgrunner som har bosatt seg på øygruppen. Gjennom humor, slapstick og fysiske krumspring har klovner vært i stand til å formidle historier og budskap som har krysset språk- og kulturgrenser. Dette har bidratt til å skape en felles identitet og et kulturelt fellesskap for Svalbards innbyggere.<br><br>
            I dag er klovneriet en integrert del av Svalbards kulturelle landskap, og det finnes en rekke organiserte grupper og ensembler som fremfører klovneforestillinger både lokalt og internasjonalt. Klovner i Svalbard er også engasjert i ulike sosiale og miljømessige initiativer,som bidrar til å styrke samfunnet og øke bevisstheten rundt øygruppens unike utfordringer.<br><br>
            Klovneriet i Svalbard er et levende og mangfoldig kulturelt fenomen som har en lang historie og en dyp betydning for øygruppens innbyggere. Klovner har ikke bare fungert som underholdere, men også som kulturelle brobyggere og samfunnsengasjerte aktører. Ved å lære om klovner i Svalbard, får vi et unikt innblikk i et samfunn som har klart å forene ulike kulturer og tradisjoner gjennom kunsten og kraften av humor.</p>
        <form action="index.php" method="post" >
            <input type="hidden" name="from" value = 'yes'/>
            <button id="summaryButton" type="submit">Vis sammendrag</button>
        </form>

        <br>
        <br>
        <p id="summary"><?php echo $strng; ?></p>
        <a href="practice.php">Øv oppgave</a>
    </body>
</html>