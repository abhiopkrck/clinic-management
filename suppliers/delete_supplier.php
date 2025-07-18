<?php
include('../db.php');
$id = $_GET['id'];
$conn->query("DELETE FROM suppliers WHERE supplier_id = $id");
header("Location: view_suppliers.php");
?>
