<?php
$servername = "localhost";
$username = "root"; // Dein Datenbank-Benutzername
$password = ""; // Dein Datenbank-Passwort
$dbname = "User"; // Deine Datenbank

// Erstelle Verbindung zur Datenbank
$conn = new mysqli($servername, $username, $password, $dbname);

// Überprüfe die Verbindung
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hole Daten aus dem POST-Request
$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];
$strasse = $_POST['strasse'];
$plz = $_POST['plz'];
$email = $_POST['email'];
$telefon = $_POST['telefon'];
$geburtsdatum = $_POST['geburtsdatum'];
$notizen = $_POST['notizen'];

// Bereite das SQL-Statement vor
$sql = "INSERT INTO kunde (vorname, nachname, strasse, plz, email, telefon, geburtsdatum, notizen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $vorname, $nachname, $strasse, $plz, $email, $telefon, $geburtsdatum, $notizen);

// Führe das Statement aus und überprüfe auf Fehler
if ($stmt->execute()) {
    echo "New customer added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Schließe die Verbindung
$stmt->close();
$conn->close();
?>
