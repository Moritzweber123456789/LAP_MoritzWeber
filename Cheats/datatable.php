<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechnungen Übersicht</title>
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Rechnungen Übersicht</h1>
        <table id="rechnungenTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>RechnungsID</th>
                    <th>Kunde</th>
                    <th>Rechnungsdatum</th>
                    <th>Fälligkeitsdatum</th>
                    <th>Gesamtbetrag</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verbindung zur Datenbank herstellen
                $conn = new mysqli('localhost', 'root', '', 'rechnungen');
                if ($conn->connect_error) {
                    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
                }

                // Abrufen der Datensätze
                $sql = "SELECT Rechnungen.RechnungsID, CONCAT(Kunden.Vorname, ' ', Kunden.Nachname) AS Kunde, Rechnungen.Rechnungsdatum, Rechnungen.Faelligkeitsdatum, Rechnungen.Gesamtbetrag, Rechnungen.Status 
                        FROM Rechnungen 
                        JOIN Kunden ON Rechnungen.KundenID = Kunden.KundenID";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['RechnungsID']}</td>
                            <td>{$row['Kunde']}</td>
                            <td>{$row['Rechnungsdatum']}</td>
                            <td>{$row['Faelligkeitsdatum']}</td>
                            <td>{$row['Gesamtbetrag']}</td>
                            <td>{$row['Status']}</td>
                        </tr>";
                    }
                }

                // Verbindung schließen
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#rechnungenTable').DataTable();
    });
    </script>
</body>
</html>
