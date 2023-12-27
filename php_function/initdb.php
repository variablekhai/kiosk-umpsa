<?php 
// Define the path to your .env file
//$envFilePath = __DIR__ . '/.env';
$envFilePath =  dirname(__DIR__) . '/.env';

// Check if the .env file exists
if (file_exists($envFilePath)) {
    // Read the file line by line
    $lines = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Iterate through each line and process variables
    foreach ($lines as $line) {
        // Ignore lines that start with # (comments) or empty lines
        if (strpos(trim($line), '#') !== 0 && strpos(trim($line), '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            // Set the environment variable
            putenv("$key=$value");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

$conn = mysqli_connect($_ENV["DB_URL"], $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"], $_ENV["DB_NAME"]);
if(!$conn) {
    echo "". mysqli_connect_error();
    exit();
}
$GLOBALS["conn"] = $conn;

?>