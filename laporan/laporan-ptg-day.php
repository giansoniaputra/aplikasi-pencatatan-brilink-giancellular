<?php
include"../function.php";
require_once ("../fpdf/fpdf.php");
class PDF extends FPDF
{
// Membuat Page header
function Header()
{
 // Menambahkan Logo
 $this->Image('logo.png',10,6,20);
 // Menambahkan judul header
 $this->SetFont('Arial','B',13);
 $this->Cell(30);
 $this->Cell(140,5,'GIAN CELLULAR',0,1,'C');

 $this->SetFont('Arial','B',18);
 $this->SetTextColor(255,0,0);
 $this->Cell(30);
 $this->Cell(140,9,'BRILINK',0,1,'C');

 $this->SetFont('Arial','',10);
 $this->SetTextColor(0);
 $this->Cell(30);
 $this->Cell(140,5,'CITEREWES KEL.BUNGURSARI KEC.BUNGURSARI KOTA TASIKMALAYA',0,1,'C');
 $this->Cell(30);
 $this->Cell(140,5,'WHATSAPP : 082321634181',0,1,'C');

 // Menambahkan garis header
 $this->SetLineWidth(1);
 $this->Line(10,36,200,36);
 $this->SetLineWidth(0);
 $this->Line(10,37,200,37);
 $this->Ln();
}
// Membuat page footer
function Footer()
{

 $this->SetY(-15);
 $this->SetFont('Arial','I',8);
 $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();

//tampilkan judul laporan

$pdf->SetFont('Arial','B','16');
$pdf->Cell(0,20, 'LAPORAN PIUTANG '.$tanggal, '0', 1, 'C');
$pdf->SetFont('Arial','B','11');

//Membuat kolom judul tabel
$pdf->SetFont('Arial','','8');
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
$pdf->Cell(8, 7, 'No', 1, '0','C', true);
$pdf->Cell(32, 7, 'Nama', 1, '0','C', true);
$pdf->Cell(40, 7, 'Jenis Transaksi', 1, '0','C', true);
$pdf->Cell(29, 7, 'Tanggal Transaksi', 1, '0','C', true);
$pdf->Cell(29, 7, 'Status', 1, '0','C', true);
$pdf->Cell(27, 7, 'Debit', 1, '0','C', true);
$pdf->Cell(27, 7, 'Kredit', 1, '0','C', true);
$pdf->Ln();


//Membuat kolom isi tabel
$pdf->SetFont('Arial','','8');
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$i=0;
$tampil=mysqli_query($conn,"SELECT * FROM transaksi WHERE tanggal=curdate() AND status = 'BELUM LUNAS' OR tanggal=curdate() AND status = 'PINJAMAN' order by tanggal DESC");
while($data=mysqli_fetch_array($tampil)){
 $i++;
 $pdf->Cell(8, 7, $i, 1, '0','C', true);
 $pdf->Cell(32, 7, $data['nama'], 1, '0','L', true);
 $pdf->Cell(40, 7, $data['jenis'], 1, '0','L', true);
 $pdf->Cell(29, 7,
tanggal($data['tanggal']), 1, '0','L',
true);
 $pdf->Cell(29, 7, $data['status'], 1, '0','L', true);
 $pdf->Cell(27, 7, rupiah($data['debit']), 1, '0','L', true);
 $pdf->Cell(27, 7, rupiah($data['kredit']), 1, '0','L', true);
 $pdf->Ln();
 }
// Menampilkan output file PDF
$pdf->Output('i','Laporan Piutang GIAN CELLULAR ('.$tanggal.').pdf','false');
?>