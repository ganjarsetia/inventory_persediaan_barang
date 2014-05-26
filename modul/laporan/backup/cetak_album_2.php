<?php 
//session_start();	
  include_once('../../../config/koneksi.php');
	
						
	define('FPDF_FONTPATH','../font/');
      require('fpdf.php');
	
	
	class PDF extends FPDF
	{
	

		//Colored table
		function tabel_ri32_color()
		{
			$ruang	= $_POST['ruang'];
			$palok	= $_POST['palok'];
			$jur	= $_POST['jurusan'];


			$sql ="SELECT * FROM pmb WHERE ruangujian ='$ruang' AND lokasi = '$palok' AND kelompok = '$jur'";
			
			$db_query = mysql_query($sql) or die("Query gagal");
			
			$ko =0;
			while($data=mysql_fetch_array($db_query))
			{
				$this->SetLineWidth(.1);	  
	  			$this->SetXY(7,7);
	  			$this->Cell(94,60,'',1,0,'C');
				$this->Ln(3);
			
				if ($data['foto']=='') {
					$foto = '../../../peserta/foto/nopic.jpg';
				}else{
					$foto = '../../../peserta/foto/'.$data['foto'];
				}
				
				$this->Cell(30,5,'Nomor Peserta','',0,'L');
				$this->Cell(3,5,':','',0,'L');
				$this->Cell(20,5,$data['noujian'],'',1,'L');
				
				$this->Cell(30,5,'Nama','',0,'L');
				$this->Cell(3,5,':','',0,'L');
				$this->Cell(20,5,$data['nama'],'',1,'L');

				$this->Cell(30,5,'Kelompok','',0,'L');
				$this->Cell(3,5,':','',0,'L');
				$this->Cell(20,5,$data['kelompok'],'',1,'L');

				$this->Cell(30,5,'Ruang','',0,'L');
				$this->Cell(3,5,':','',0,'L');
				$this->Cell(20,5,$data['ruangujian'],'',1,'L');

				$this->Image($foto,12,30,25,33);
				
				$this->SetXY(40,33);
				$this->Cell(40,5,'Tanda Tangan','',0,'L');
				$this->SetXY(40,33);
				$this->Cell(55,13,'',1,0,'C');

				$this->SetXY(40,50);
				$this->Cell(40,5,'Tanda Tangan','',0,'L');
				$this->SetXY(40,50);
				$this->Cell(55,13,'',1,0,'C');
				
				$ko=$ko+50;
			}
			//$this->Cell(array_sum($w),0,'','T');
		}
	}
	
	$pdf=new PDF('P','mm','A4');
	$pdf->Open();
    $pdf->AliasNbPages();
    $pdf->AddPage();	
	$title='Laporan Data Anggota';
	$pdf->SetTitle($title);
	$pdf->SetAuthor('Deddy Rusdiansyah');
	
//	$pdf->SetFont('Arial','B',12);
//	$pdf->Cell(0,4,'CETAK ALBUM / ABSENSI',0,1,'C');
//    $pdf->SetFont('Arial','',11);
//    $pdf->SetFont('','');
//	$pdf->Ln(2);
//    $pdf->Ln(10);
//
//	//memanggil fungsi table
	$pdf->Ln(5);
	$pdf->SetLineWidth(.3);
	$pdf->SetFont('Arial','',10);
	$pdf->tabel_ri32_color();
	$pdf->Ln(5);
	$pdf->SetLineWidth(.1);	
	$pdf->Output('Cetak_Album.pdf','D');

?>
