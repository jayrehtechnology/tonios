<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<?php
header('Content-Type: application/json');
// API endpoint and token
$url = "https://ocs-api.telco-vision.com:7443/ocs-custo/main/v1?token=X20hTfhxgrec3Yj9rVkWxrCN";

// Request body
$data = [
    "listPrepaidPackageTemplate" => [
        "resellerId" => 620
    ]
];

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url); // Set the URL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response
curl_setopt($ch, CURLOPT_POST, true); // Use POST method
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json', // Set content type to JSON
]); 
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Attach the JSON body

// Execute cURL request
$response = curl_exec($ch);

// Handle errors
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    // Output response
     echo 'Response: ' . $response;
}

// Close cURL session
curl_close($ch);
?>



</body>
</html>
