<?php
session_start();

function require_role($allowed_roles) {
    if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], $allowed_roles)) {
        echo "<div class='container'><h3>⛔ Access Denied</h3><p>You do not have permission to access this page.</p></div>";
        exit;
    }
}
?>
