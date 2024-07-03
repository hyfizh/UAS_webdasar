<?php
require('fpdf/fpdf.php');
include 'koneksi.php';

class PDF extends FPDF
{
    // Header
    function Header()
    {
        // Logo
        $this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'Laporan Data Siswa',0,1,'C');
        // Line break
        $this->Ln(20);
    }

    // Footer
    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }
}

// Create instance of FPDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

// Menentukan lebar kolom untuk setiap header
$pdf->Cell(30,10,'NIM',1,0,'C');
$pdf->Cell(50,10,'Nama',1,0,'C');
$pdf->Cell(35,10,'Tanggal Lahir',1,0,'C');
$pdf->Cell(20,10,'JK',1,0,'C');
$pdf->Cell(50,10,'Alamat',1,0,'C');
$pdf->Ln();

// Mengambil data dari database
$sql = "SELECT * FROM siswa";
$result = $conn->query($sql);

// Menambahkan data siswa ke dalam tabel PDF
while ($row = $result->fetch_assoc()) {
    // Menambahkan NIM
    $pdf->Cell(30,10,$row['nim'],1,0,'C');

    // Menambahkan Nama
    $pdf->Cell(50,10,$row['nama'],1,0,'L');

    // Menambahkan Tanggal Lahir
    $pdf->Cell(35,10,$row['tanggal_lahir'],1,0,'C');

    // Menambahkan Jenis Kelamin
    $pdf->Cell(20,10,$row['jenis_kelamin'],1,0,'C');

    // Menambahkan Alamat (gunakan MultiCell untuk membungkus teks panjang)
    $pdf->MultiCell(50,10,$row['alamat'],1,'L');
}

// Menampilkan output PDF
$pdf->Output();
?>
