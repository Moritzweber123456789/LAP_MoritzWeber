<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechnungen nach Kunden</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Rechnungen nach Kunden</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="kunden">Kunde auswählen:</label>
                <select class="form-control" id="kunden" name="kunden">
                    <option value="">-- Kunde auswählen --</option>
                    <?php
                    // Datenbankverbindung
                    $conn = new mysqli('localhost', 'root', '', 'rechnungen');

                    // Überprüfen der Verbindung
                    if ($conn->connect_error) {
                        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
                    }

                    // Kunden aus der Datenbank abrufen
                    $sql = "SELECT KundenID, CONCAT(Vorname, ' ', Nachname) AS Name FROM Kunden";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['KundenID'] . "'>" . $row['Name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Anzeigen</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['kunden'])) {
            $kundenID = $_POST['kunden'];

            // Rechnungen für den ausgewählten Kunden abrufen
            $sql = "SELECT r.RechnungsID, r.Rechnungsdatum, r.Faelligkeitsdatum, r.Gesamtbetrag, r.Status
                    FROM Rechnungen r
                    WHERE r.KundenID = $kundenID";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h2 class='mt-5'>Rechnungen</h2>";
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>RechnungsID</th><th>Rechnungsdatum</th><th>Fälligkeitsdatum</th><th>Gesamtbetrag</th><th>Status</th></tr></thead>";
                echo "<tbody>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['RechnungsID'] . "</td>";
                    echo "<td>" . $row['Rechnungsdatum'] . "</td>";
                    echo "<td>" . $row['Faelligkeitsdatum'] . "</td>";
                    echo "<td>" . $row['Gesamtbetrag'] . "</td>";
                    echo "<td>" . $row['Status'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p class='mt-5'>Keine Rechnungen gefunden.</p>";
            }
        }

        // Verbindung schließen
        $conn->close();
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
