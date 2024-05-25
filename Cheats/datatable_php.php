<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rechnungsdatenbank";

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Abrufen der Datensätze
$sql = "SELECT Rechnungen.RechnungsID, CONCAT(Kunden.Vorname, ' ', Kunden.Nachname) AS Kunde, Rechnungen.Rechnungsdatum, Rechnungen.Faelligkeitsdatum, Rechnungen.Gesamtbetrag, Rechnungen.Status FROM Rechnungen JOIN Kunden ON Rechnungen.KundenID = Kunden.KundenID";

// Verarbeitung der Server-Side DataTables-Anfragen
$request = $_REQUEST;

$columns = array(
    0 => 'RechnungsID',
    1 => 'Kunde',
    2 => 'Rechnungsdatum',
    3 => 'Faelligkeitsdatum',
    4 => 'Gesamtbetrag',
    5 => 'Status'
);

$sql .= " WHERE 1=1";

// Suchfunktion
if (!empty($request['search']['value'])) {
    $sql .= " AND (RechnungsID LIKE '%".$request['search']['value']."%' ";
    $sql .= " OR Kunden.Vorname LIKE '%".$request['search']['value']."%' ";
    $sql .= " OR Kunden.Nachname LIKE '%".$request['search']['value']."%' ";
    $sql .= " OR Rechnungsdatum LIKE '%".$request['search']['value']."%' ";
    $sql .= " OR Faelligkeitsdatum LIKE '%".$request['search']['value']."%' ";
    $sql .= " OR Gesamtbetrag LIKE '%".$request['search']['value']."%' ";
    $sql .= " OR Status LIKE '%".$request['search']['value']."%') ";
}

// Sortierfunktion
if (isset($request['order'])) {
    $sql .= " ORDER BY ".$columns[$request['order'][0]['column']]." ".$request['order'][0]['dir']." ";
} else {
    $sql .= " ORDER BY RechnungsID ASC ";
}

// Pagination
$start = $request['start'];
$length = $request['length'];
$sql .= " LIMIT $start, $length";

$query = $conn->query($sql);

$data = array();

while ($row = $query->fetch_assoc()) {
    $nestedData = array();
    $nestedData['RechnungsID'] = $row['RechnungsID'];
    $nestedData['Kunde'] = $row['Kunde'];
    $nestedData['Rechnungsdatum'] = $row['Rechnungsdatum'];
    $nestedData['Faelligkeitsdatum'] = $row['Faelligkeitsdatum'];
    $nestedData['Gesamtbetrag'] = $row['Gesamtbetrag'];
    $nestedData['Status'] = $row['Status'];
    $data[] = $nestedData;
}

// Gesamtdatensätze zählen
$totalData = $conn->query("SELECT COUNT(*) FROM Rechnungen")->fetch_row()[0];

// Gefilterte Datensätze zählen
$totalFiltered = $query->num_rows;

$json_data = array(
    "draw" => intval($request['draw']),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalData),
    "data" => $data
);

echo json_encode($json_data);

// Verbindung schließen
$conn->close();
?>
