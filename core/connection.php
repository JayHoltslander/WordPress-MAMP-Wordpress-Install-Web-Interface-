<?
    // Create connection
    $mamp_host      = '127.0.0.1:3306';
    $mamp_user      = 'root';
    $mamp_pass      = 'root';
    $mamp_dbname    = 'WP_MAMP';

    $conn = mysqli_connect($mamp_host, $mamp_user, $mamp_pass);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create database
    $sql_db = "CREATE DATABASE IF NOT EXISTS WP_MAMP";

    if (mysqli_query($conn, $sql_db)) {
        //echo "Database created successfully";

    } else {
        //echo "Error creating database: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>

<?
    $db_conn = mysqli_connect($mamp_host, $mamp_user, $mamp_pass, $mamp_dbname);

    if (!$db_conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql_table = "CREATE TABLE settings (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    cookie VARCHAR(30) NOT NULL,
    version VARCHAR(30) NOT NULL,
    reg_date TIMESTAMP
    )";

    if ($db_conn->query($sql_table) === TRUE) {
        //echo "Table settings created successfully";
    } else {
        //echo "Error creating table: " . $db_conn->error;
    }
    mysqli_close($db_conn);
?>