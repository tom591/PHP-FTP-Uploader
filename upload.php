<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$ftp_server = "FTP-SERVER"; 
$ftp_username = "FTP-SERVER-USERNAME";     
$ftp_password = "FTP-SERVER-PASSWORD"; 
$ftp_target_dir = "/www/your-uploads-folder/";

$base_url = "https://www.your-domain.com/uploads/"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    
    $ftp_conn = ftp_connect($ftp_server);
    if (!$ftp_conn || !ftp_login($ftp_conn, $ftp_username, $ftp_password)) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["error" => "Failed to connect to FTP server."]);
        exit;
    }

    $remote_file_path = $ftp_target_dir . basename($file["name"]);

    if (ftp_put($ftp_conn, $remote_file_path, $file["tmp_name"], FTP_BINARY)) {
        $file_url = $base_url . basename($file["name"]);
        echo json_encode(["success" => true, "file_url" => $file_url]);
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["error" => "Failed to upload file to FTP server."]);
    }

    ftp_close($ftp_conn);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="files/bootstrap.min.css">
<script src="files/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="files/style.css">
<title>PHP upload files</title>
</head>
<body>
<div class="center">
<h4>Upload file to folder</h4>
<form id="uploadForm" enctype="multipart/form-data">
<input type="file" name="file" required>
<button type="submit">Upload</button>
</form>
<div id="progressContainer" style="display:none;">
<progress id="progressBar" value="0" max="100" style="width:100%;"></progress>
<span id="progressText">0%</span>
</div>
<div id="fileLinkContainer" style="display:none;">
<p>The file was successfully uploaded! <a id="fileLink" href="#" target="_blank"></a></p>
</div>
<script>
const form = document.getElementById("uploadForm");
const progressContainer = document.getElementById("progressContainer");
const progressBar = document.getElementById("progressBar");
const progressText = document.getElementById("progressText");
const fileLinkContainer = document.getElementById("fileLinkContainer");
const fileLink = document.getElementById("fileLink");

form.addEventListener("submit", function(event) {
event.preventDefault();

const formData = new FormData(form);
const xhr = new XMLHttpRequest();

xhr.open("POST", "upload.php", true);
xhr.setRequestHeader("Accept", "application/json");

xhr.upload.addEventListener("progress", function(event) {
if (event.lengthComputable) {
const percentComplete = Math.round((event.loaded / event.total) * 100);
progressBar.value = percentComplete;
progressText.textContent = percentComplete + "%";
progressContainer.style.display = "block";
}
});

xhr.onload = function() {
progressContainer.style.display = "none";
if (xhr.status === 200) {
const response = JSON.parse(xhr.responseText);
if (response.success) {
fileLink.href = response.file_url;
fileLink.textContent = response.file_url;
fileLinkContainer.style.display = "block";
} else {
alert("Error: " + (response.error || "Unknown error"));
}
} else {
alert("Failed to upload file. Server error.");
}
};

xhr.send(formData);
});
</script>
</div>
</body>
</html>
