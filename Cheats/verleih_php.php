<?php
// Datenbankverbindung herstellen (Annahme: mysqli)
$conn = new mysqli('localhost', 'root', '', 'dvd_verleih');

// Überprüfen der Verbindung
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Formulardaten abrufen
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kunden_id = $_POST['kunden_id'];
    $dvd_id = $_POST['dvd_id'];

    // Ausleihdatum auf das aktuelle Datum setzen
    $ausleihdatum = date("Y-m-d");

    // SQL-Abfrage zum Einfügen der Ausleihinformationen in die Tabelle "Ausleihen"
    $sql = "INSERT INTO Ausleihen (KundenID, DVDID, Ausleihdatum) VALUES ('$kunden_id', '$dvd_id', '$ausleihdatum')";

    if ($conn->query($sql) === TRUE) {
        echo "DVD erfolgreich ausgeliehen";
    } else {
        echo "Fehler beim Ausleihen der DVD: " . $conn->error;
    }
}

// Datenbankverbindung schließen
$conn->close();
?>
