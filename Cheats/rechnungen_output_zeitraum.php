<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechnungen nach Zeitraum</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Rechnungen nach Zeitraum</h1>
        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="startdatum">Startdatum:</label>
                    <input type="date" class="form-control" id="startdatum" name="startdatum" required>
                </div>
                <div class="form-group col-md-5">
                    <label for="enddatum">Enddatum:</label>
                    <input type="date" class="form-control" id="enddatum" name="enddatum" required>
                </div>
                <div class="form-group col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Anzeigen</button>
                </div>
            </div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['startdatum']) && !empty($_POST['enddatum'])) {
            $startdatum = $_POST['startdatum'];
            $enddatum = $_POST['enddatum'];

            // Datenbankverbindung
            $conn = new mysqli('localhost', 'root', '', 'rechnungen');

            // Überprüfen der Verbindung
            if ($conn->connect_error) {
                die("Verbindung fehlgeschlagen: " . $conn->connect_error);
            }

            // Rechnungen im angegebenen Zeitraum abrufen
            $sql = "SELECT r.RechnungsID, r.Rechnungsdatum, r.Faelligkeitsdatum, r.Gesamtbetrag, r.Status, 
                           CONCAT(k.Vorname, ' ', k.Nachname) AS Kunde 
                    FROM Rechnungen r
                    JOIN Kunden k ON r.KundenID = k.KundenID
                    WHERE r.Rechnungsdatum BETWEEN '$startdatum' AND '$enddatum'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h2 class='mt-5'>Rechnungen vom $startdatum bis $enddatum</h2>";
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>RechnungsID</th><th>Kunde</th><th>Rechnungsdatum</th><th>Fälligkeitsdatum</th><th>Gesamtbetrag</th><th>Status</th></tr></thead>";
                echo "<tbody>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['RechnungsID'] . "</td>";
                    echo "<td>" . $row['Kunde'] . "</td>";
                    echo "<td>" . $row['Rechnungsdatum'] . "</td>";
                    echo "<td>" . $row['Faelligkeitsdatum'] . "</td>";
                    echo "<td>" . $row['Gesamtbetrag'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p class='mt-5'>Keine Rechnungen im angegebenen Zeitraum gefunden.</p>";
            }

            // Verbindung schließen
            $conn->close();
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
