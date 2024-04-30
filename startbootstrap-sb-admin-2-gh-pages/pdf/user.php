<?php
require('./files/fpdf.php');

// Membuat class PDF
class PDF extends FPDF
{
    // Fungsi untuk mengatur header halaman
    function Header()
    {
        // Select Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(50, 10, 'Data User Tabel', 1, 0, 'C');
        // Line break
        $this->Ln(20);
    }

    // Fungsi untuk mengatur footer halaman
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Fungsi untuk menghasilkan konten halaman PDF
    function Content($data)
    {
        // Select Arial regular 12
        $this->SetFont('Arial', '', 12);

        // Membuat header tabel
        $this->Cell(20, 10, 'ID', 1, 0, 'C');
        $this->Cell(50, 10, 'Nama Lengkap', 1, 0, 'C');
        $this->Cell(40, 10, 'Username', 1, 0, 'C');
        $this->Cell(50, 10, 'Email', 1, 0, 'C');
        $this->Cell(30, 10, 'Role', 1, 0, 'C');
        $this->Ln();

        // Loop through data and display it in the PDF
        foreach ($data as $row) {
            $this->Cell(20, 10, $row['iduser'], 1);
            $this->Cell(50, 10, $row['namalengkap'], 1);
            $this->Cell(40, 10, $row['username'], 1);
            $this->Cell(50, 10, $row['email'], 1);
            $this->Cell(30, 10, $row['role'], 1);
            $this->Ln();
        }
    }
}

// Membuat objek PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Mendapatkan data pengguna dari database (contoh)
include "../source/koneksi.php";
$query = "SELECT * FROM user";
$result = mysqli_query($koneksi, $query);

// Mengambil data pengguna dari hasil query
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Memanggil fungsi Content untuk menghasilkan konten halaman PDF
$pdf->Content($data);

$pdf->Output('F', 'user.pdf'); // Menggunakan 'F' untuk menyimpan file PDF

// Menghasilkan kode HTML untuk menampilkan file PDF di dalam elemen <div>
$pdfUrl = 'user.pdf';
