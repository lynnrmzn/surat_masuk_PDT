<?php
$dsn = "db_surat_2024"; // Data Source Name (ODBC DSN)
$username = "";   // Username, if required
$password = "";   // Password, if required

// Establish the ODBC connection
$con = odbc_connect($dsn, $username, $password);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tarikh_terima_surat = $_POST['tarikh_terima_surat'];
    $tajuk = $_POST['tajuk'];
    $no_rujukan = $_POST['no_rujukan'];
    $daripada = $_POST['daripada'];
    $tarikh_surat = $_POST['tarikh_surat'];
    $rujukan = $_POST['rujukan'];

    // Insert the new record into the database
    $sql = "INSERT INTO [info] (TARIKH_TERIMA_SURAT, TAJUK, NO_RUJUKAN, DARIPADA, TARIKH_SURAT, RUJUKAN)
            VALUES ('$tarikh_terima_surat', '$tajuk', '$no_rujukan', '$daripada', '$tarikh_surat', '$rujukan')";

    $result = odbc_exec($con, $sql);

    if ($result) {
        // If data is successfully entered, show a pop-up and redirect to carian.php
        echo "<script>
            alert('Data successfully entered into the database.');
            window.location.href = 'carian.php';
        </script>";
    } else {
        echo "<p>Error entering data: " . odbc_errormsg($con) . "</p>";
    }
}

// Close the connection
odbc_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Surat Menyurat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .logo {
            width: 100px;
            display: block;
            margin: 0 auto 20px auto;
        }
        .form-container {
            margin-bottom: 20px;
            background-color: #f6eca1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="logo.png" alt="Logo" class="logo"> 
        <h2 class="mt-3 text-center">DAFTAR SURAT PEJABAT DAERAH DAN TANAH SELAMA</h2>
        <form method="POST" action="" class="form-container">
            <div class="mb-3">
                <label for="tarikh_terima_surat" class="form-label">Tarikh Terima Surat</label>
                <input type="date" class="form-control" name="tarikh_terima_surat" id="tarikh_terima_surat" required>
            </div>
            <div class="mb-3">
                <label for="tarikh_surat" class="form-label">Tarikh Surat</label>
                <input type="date" class="form-control" name="tarikh_surat" id="tarikh_surat" required>
            </div>
            <div class="mb-3">
                <label for="tajuk" class="form-label">Tajuk</label>
                <input type="text" class="form-control" name="tajuk" id="tajuk" placeholder="Masukkan Tajuk" required>
            </div>
            <div class="mb-3">
                <label for="no_rujukan" class="form-label">No Rujukan</label>
                <input type="text" class="form-control" name="no_rujukan" id="no_rujukan" placeholder="Masukkan No Rujukan" required>
            </div>
            <div class="mb-3">
                <label for="rujukan" class="form-label">Rujukan</label>
                <input type="text" class="form-control" name="rujukan" id="rujukan" placeholder="Masukkan Rujukan" required>
            </div>
            <div class="mb-3">
                <label for="daripada" class="form-label">Daripada</label>
                <input type="text" class="form-control" name="daripada" id="daripada" placeholder="Masukkan Daripada" required>
            </div>
            <div class="d-flex gap-2 mt-3 mb-5">
                <button type="button" class="btn btn-warning" onclick="clearForm()">Clear</button>
                <button type="submit" class="btn btn-primary">Enter</button>
                <a href="carian.php" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>

    <script>
        function clearForm() {
            document.getElementById('tarikh_terima_surat').value = '';
            document.getElementById('tajuk').value = '';
            document.getElementById('no_rujukan').value = '';
            document.getElementById('rujukan').value = '';
            document.getElementById('daripada').value = '';
            document.getElementById('tarikh_surat').value = '';
        }
    </script>
</body>
</html>

