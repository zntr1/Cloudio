<?php
//$mysqli = new mysqli("localhost", "meyer", "fortuna", "lebenslauf");
$mysqli = new mysqli("localhost", "root", "", "lebenslauf");

$mysqli->set_charset("utf8");
$stmt = $mysqli->prepare("SELECT * FROM daten WHERE vorname=? AND nachname=?");
$stmt->bind_param("ss", $_POST['vorname'], $_POST['nachname']);
$stmt->execute();
$stmt->bind_result($id, $vorname, $nachname, $email, $telefon, $skype, $bild_url, $beschreibung, $persoenliches, $ausbildung, $berufliches);

while ($stmt->fetch()) {
    echo "
    <!DOCTYPE html>
    <html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <title>$vorname $nachname</title>
    <link rel=\"stylesheet\" href=\"http://nasdus.selfhost.bz/itc/u3/lebenslauf.css\">
    <script src=\"$vorname$nachname.js\"></script>
    </head>
    <body>
    
    <div id=\"cvhead\">
    
        <img src=\"$bild_url\">
        <h1>$vorname $nachname</h1>
        <p>
            $beschreibung
        </p>
    
    </div>
    
    <div id=\"cvbody\">
        $persoenliches
        
        $ausbildung
        
        $berufliches
    
    <div id=\"cvfoot\">
        <p>
            $email
        </p>
    </div>
    </body>
    </html>";
}
?>

