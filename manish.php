<?php

// Enable debug logging
$debug_access_log = true;

// GET / POST Options
$phone_login = $_POST["phone_login"] ?? $_GET["phone_login"] ?? "";
$phone_pass = $_POST["phone_pass"] ?? $_GET["phone_pass"] ?? "";
$server_ip = $_POST["server_ip"] ?? $_GET["server_ip"] ?? "";
$codecs = $_POST["codecs"] ?? $_GET["codecs"] ?? "";
$options = $_POST["options"] ?? $_GET["options"] ?? "";

// Ensure required fields are present
if (empty($phone_login) || empty($phone_pass) || empty($server_ip)) {
    die("Missing required parameters (phone_login, phone_pass, server_ip)");
}

// Encryption check
$referring_url = $_SERVER['HTTP_REFERER'] ?? "https://dialer.one";
$ref_url_array = parse_url($referring_url);
$base_referring_url = $ref_url_array['scheme'] . "://" . $ref_url_array['host'] . $ref_url_array['path'];

// Log access
$log_string = date("Y-m-d H:i:s") . "\t" . ($_SERVER['REMOTE_ADDR'] ?? '') . "\t" . $base_referring_url . "\t" . ($_SERVER['HTTP_USER_AGENT'] ?? '') . "\n";
if ($debug_access_log) {
    file_put_contents("debug/webphone_access.log", $log_string, FILE_APPEND);
}

// Ensure HTTPS is used
if ($ref_url_array['scheme'] != 'https') {
    die("<script>alert('Referring URL ($base_referring_url) is not encrypted. Use HTTPS.');</script>");
}

// SIP Connection Info
$cid_name = $phone_login;
$sip_uri = "$phone_login@$server_ip";
$auth_user = $phone_login;
$password = $phone_pass;

// WebRTC WebSocket URL (Modify if needed)
$ws_server = "wss://$server_ip:8089/ws";

// Whether debug should be enabled
$debug_enabled = in_array("DEBUG", explode("--", $options));

// Load the WebPhone UI template
require_once('cp_template.php');

?>
