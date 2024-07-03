<?php
include 'koneksi.php';

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];

$foto = $_FILES['foto']['name'];
$target = "uploads/" . basename($foto);

if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
    $sql = "INSERT INTO siswa (nim, nama, tanggal_lahir, jenis_kelamin, alamat, foto)
            VALUES ('$nim', '$nama', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$foto')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error uploading file.";
}

$conn->close();
?>
