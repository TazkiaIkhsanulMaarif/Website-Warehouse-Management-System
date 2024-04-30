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
        $this->Cell(50, 10, 'Data Delivery Tabel', 1, 0, 'C');
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
        $this->Cell(50, 10, 'ID _Pengiriman', 1, 0, 'C');
        $this->Cell(50, 10, 'Alamat', 1, 0, 'C');
        $this->Cell(40, 10, 'Tanggal', 1, 0, 'C');
        $this->Cell(50, 10, 'Kode Transaksi', 1, 0, 'C');
        $this->Ln();

        // Loop through data and display it in the PDF
        foreach ($data as $row) {
            $this->Cell(50, 10, $row['id_pengiriman'], 1);
            $this->Cell(50, 10, $row['alamat'], 1);
            $this->Cell(40, 10, $row['tgl'], 1);
            $this->Cell(50, 10, $row['kodetransaksi'], 1);
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
$query = "SELECT * FROM daftar_pengiriman";
$result = mysqli_query($koneksi, $query);

// Mengambil data pengguna dari hasil query
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Memanggil fungsi Content untuk menghasilkan konten halaman PDF
$pdf->Content($data);

$pdf->Output('F', 'daftar_pengiriman.pdf'); // Menggunakan 'F' untuk menyimpan file PDF

// Menghasilkan kode HTML untuk menampilkan file PDF di dalam elemen <div>
$pdfUrl = 'daftar_pengiriman.pdf';
