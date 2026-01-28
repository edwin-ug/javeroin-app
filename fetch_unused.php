<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // Allow phone to access even if IP differs slightly

$conn = new mysqli("localhost", "root", "", "wifi_db");

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed"]));
}

// We now select the 'plan' and 'amount' columns directly from the database.
// No need to guess the plan name anymore!
$query = "SELECT code, plan, amount FROM vouchers WHERE is_used = 0 ORDER BY created_at DESC LIMIT 100";

$result = $conn->query($query);

$vouchers = [];
if ($result) {
    while($row = $result->fetch_assoc()) {
        $vouchers[] = $row;
    }
}

echo json_encode($vouchers);
?>