<?php
$dsn = "db_surat_2024"; // Data Source Name (ODBC DSN)
$username = "";   // Username
$password = "";   // Password

// Establish the ODBC connection
$con = odbc_connect($dsn, $username, $password);

// Initialize search variables
$tarikh_terima_surat = isset($_GET['tarikh_terima_surat']) ? $_GET['tarikh_terima_surat'] : '';
$tajuk = isset($_GET['tajuk']) ? $_GET['tajuk'] : '';
$no_rujukan = isset($_GET['no_rujukan']) ? $_GET['no_rujukan'] : '';
$daripada = isset($_GET['daripada']) ? $_GET['daripada'] : '';
$tarikh_surat = isset($_GET['tarikh_surat']) ? $_GET['tarikh_surat'] : '';
$rujukan = isset($_GET['rujukan']) ? $_GET['rujukan'] : '';

// Construct SQL query with search conditions
$sql = "SELECT * FROM [info] WHERE 1=1";

if ($tarikh_terima_surat != '') {
    $sql .= " AND [TARIKH_TERIMA_SURAT] LIKE '%" . $tarikh_terima_surat . "%'";
}
if ($tajuk != '') {
    $sql .= " AND [TAJUK] LIKE '%" . $tajuk . "%'";
}
if ($no_rujukan != '') {
    $sql .= " AND [NO_RUJUKAN] LIKE '%" . $no_rujukan . "%'";
}
if ($daripada != '') {
    $sql .= " AND [DARIPADA] LIKE '%" . $daripada . "%'";
}
if ($tarikh_surat != '') {
    $sql .= " AND [TARIKH_SURAT] LIKE '%" . $tarikh_surat . "%'";
}
if ($rujukan != '') {
    $sql .= " AND [RUJUKAN] LIKE '%" . $rujukan . "%'";
}

$result = odbc_exec($con, $sql);

// Check if the query was successful
if (!$result) {
    die("Error executing query: " . odbc_errormsg($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carian Surat Menyurat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
        }

        .search-form, .add-data-button {
            margin-bottom: 20px;
            background-color: #f6eca1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 100px;
            display: block;
            margin: 0 auto 20px auto;
        }

        table {
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="logo.png" alt="Logo" class="logo"> 
        <h2 class="mt-3 text-center">CARIAN SURAT PEJABAT DAERAH DAN TANAH SELAMA</h2>

        <div class="search-form">
            <form method="get" action="">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="tarikh_terima_surat" class="form-label">TARIKH TERIMA SURAT:</label>
                        <input type="text" class="form-control" name="tarikh_terima_surat" id="tarikh_terima_surat" value="<?php echo htmlspecialchars($tarikh_terima_surat); ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="tajuk" class="form-label">TAJUK:</label>
                        <input type="text" class="form-control" name="tajuk" id="tajuk" value="<?php echo htmlspecialchars($tajuk); ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="no_rujukan" class="form-label">NO RUJUKAN:</label>
                        <input type="text" class="form-control" name="no_rujukan" id="no_rujukan" value="<?php echo htmlspecialchars($no_rujukan); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="daripada" class="form-label">DARIPADA:</label>
                        <input type="text" class="form-control" name="daripada" id="daripada" value="<?php echo htmlspecialchars($daripada); ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="tarikh_surat" class="form-label">TARIKH SURAT:</label>
                        <input type="text" class="form-control" name="tarikh_surat" id="tarikh_surat" value="<?php echo htmlspecialchars($tarikh_surat); ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="rujukan" class="form-label">RUJUKAN:</label>
                        <input type="text" class="form-control" name="rujukan" id="rujukan" value="<?php echo htmlspecialchars($rujukan); ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
                <button type="button" class="btn btn-secondary" onclick="clearForm()">Clear</button>
            </form>
        </div>

        <div class="add-data-button">
            <form method="get" action="daftar.php">
                <input type="submit" class="btn btn-success" value="Add New Data">
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>BIL</th>
                        <th>TARIKH TERIMA SURAT</th>
                        <th>TAJUK</th>
                        <th>NO RUJUKAN</th>
                        <th>DARIPADA</th>
                        <th>TARIKH SURAT</th>
                        <th>RUJUKAN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch and display the data row by row
                    while ($row = odbc_fetch_array($result)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['BIL']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['TARIKH_TERIMA_SURAT']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['TAJUK']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['NO_RUJUKAN']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['DARIPADA']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['TARIKH_SURAT']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['RUJUKAN']) . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <script>
            function clearForm() {
                // Reset the form inputs
                document.getElementById('tarikh_terima_surat').value = '';
                document.getElementById('tajuk').value = '';
                document.getElementById('no_rujukan').value = '';
                document.getElementById('daripada').value = '';
                document.getElementById('tarikh_surat').value = '';
                document.getElementById('rujukan').value = '';
            }
        </script>
    </div>
</body>
</html>

<?php
// Close the connection
odbc_close($con);
?>
