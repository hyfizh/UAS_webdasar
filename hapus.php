<?php
include 'koneksi.php';

$nim = $_GET['nim'];
$sql = "DELETE FROM siswa WHERE nim='$nim'";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
