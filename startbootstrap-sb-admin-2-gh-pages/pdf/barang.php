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
        $this->Cell(50, 10, 'Data Barang Tabel', 1, 0, 'C');
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
        $this->Cell(50, 10, 'Nama Barang', 1, 0, 'C');
        $this->Cell(40, 10, 'Kategori', 1, 0, 'C');
        $this->Cell(50, 10, 'Ukuran', 1, 0, 'C');
        $this->Cell(30, 10, 'Harga Satuan', 1, 0, 'C');
        $this->Cell(25, 10, 'Jumlah Stok', 1, 0, 'C');
        $this->Ln();

        // Loop through data and display it in the PDF
        foreach ($data as $row) {
            $this->Cell(50, 10, $row['nama_brg'], 1);
            $this->Cell(40, 10, $row['kategori'], 1);
            $this->Cell(50, 10, $row['ukuran'], 1);
            $this->Cell(30, 10, $row['harga'], 1);
            $this->Cell(25, 10, $row['jumlah'], 1);
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
$query = "SELECT * FROM view_barang_stok";
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
