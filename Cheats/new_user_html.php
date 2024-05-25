<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Customer</h2>
        <form action="new_user_php.php" method="post">
            <div class="form-group">
                <label for="vorname">Vorname:</label>
                <input type="text" class="form-control" id="vorname" name="vorname" required>
            </div>
            <div class="form-group">
                <label for="nachname">Nachname:</label>
                <input type="text" class="form-control" id="nachname" name="nachname" required>
            </div>
            <div class="form-group">
                <label for="strasse">Strasse:</label>
                <input type="text" class="form-control" id="strasse" name="strasse" required>
            </div>
            <div class="form-group">
                <label for="plz">PLZ:</label>
                <input type="text" class="form-control" id="plz" name="plz" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telefon">Telefon:</label>
                <input type="text" class="form-control" id="telefon" name="telefon" required>
            </div>
            <div class="form-group">
                <label for="geburtsdatum">Geburtsdatum:</label>
                <input type="date" class="form-control" id="geburtsdatum" name="geburtsdatum" required>
            </div>
            <div class="form-group">
                <label for="notizen">Notizen:</label>
                <textarea class="form-control" id="notizen" name="notizen"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Customer</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
