<?php
session_start();

	if (empty($_SESSION['pcmb_namauser'])) {
    echo "<h1>Illegal access!! Exiting...</h1>";
	exit;
  } else {
    include '../../inc/inc.koneksi.php';
	include '../../inc/fungsi_indotgl.php';
	$ruang	= $_POST['ruang'];
	$palok	= $_POST['palok'];
	$jur	= $_POST['jurusan'];

	
    $query = mysql_query("SELECT 
                            * 
					      FROM 
						    pmb
						  WHERE 
						  ruangujian ='$ruang' AND
						  palon = '$palok' AND
						  kelompok = '$jur'
						  LIMIT 
						    1");
    if (@mysql_num_rows($query)>0) {
      $i = 0;
      $no_daftar	= mysql_result($query,$i,"nodaftar");
	  
						   
      define('FPDF_FONTPATH','../font/');
      require('fpdf.php');
	  
	  class PDF extends FPDF
      {
	   
	   
	   function FancyTable($data){
	    //$w=array(10,22,80,22,28,28);
	    //$this->SetFillColor(229,229,229);
        //Data
        //$fill=false;
        foreach($data as $row){
	      //$fill = !($fill);
	      $this->Cell($w[0],6,$row[0],1,0,'C',$fill);
          $this->Cell($w[1],6,$row[1],1,0,'C',$fill);
          $this->Cell($w[2],6,$row[2],1,0,'L',$fill);
          $this->Cell($w[3],6,$row[3],1,0,'C',$fill);
		  if ($row[4] % 2 == 1) {
		    $this->Cell($w[4],6,$row[4],'LTR',0,'L',$fill);
			$this->Cell($w[5],6,'','LR',0,'L',$fill);
		  } else {
		    $this->Cell($w[4],6,'','LR',0,'L',$fill);
			$this->Cell($w[5],6,$row[5],'LBR',0,'L',$fill);
		  }
          $this->Ln();  
        }
        $this->Cell(array_sum($w),0,'','T');
      }       
	  }
      //Instanciation of inherited class
	  $A4[0]=210;
	  $A4[1]=297;
	  $Q[0]=216;
	  $Q[1]=279;
      $pdf=new PDF('P','mm',$A4);
      $pdf->Open();
      $pdf->AliasNbPages();
      $pdf->AddPage();
      $pdf->SetTitle('KARTU UJIAN CALOM MAHASISWA BARU 2011/2012');
      $pdf->SetAuthor('(c) Puskom'.$y);
      $pdf->SetCreator('puskom.iainbanten.ac.id with fpdf');
	  $pdf->SetLineWidth(.3);
	  $pdf->SetXY(6,6);
	  $pdf->Cell(96,120,'',1,0,'C');
	  $pdf->Cell(6,120,'',0,0,'C');
	  $pdf->Cell(96,120,'',1,1,'C');
	  $pdf->SetLineWidth(.1);	  
	  $pdf->SetXY(7,7);
	  $pdf->Cell(94,10,'',1,0,'C');

	  //$pdf->Image('images/logo_untirta.jpg',8,8,15,15);
	  $pdf->Image('images/logo_untirta.jpg',10,8,8,8);
	  $pdf->SetXY(6,8);
	  $pdf->SetFont('Arial','B',9);
      $pdf->Cell(106,4,'TANDA BUKTI PENDAFTARAN',0,1,'C');
	  $pdf->Cell(96,4,'UJIAN MASUK MANDIRI UNTIRTA 2011',0,1,'C');
//	  $pdf->Ln();
	  $pdf->SetFont('Arial','B',8);
	  
	  $pdf->Ln(4);

	  $pdf->Cell(35,4,'NOMOR PENDAFTARAN',0,0,'L',false);
	  $pdf->Cell(5,4,':',0,0,'C',false);
//	  $pdf->SetFont('Arial','B',8);
	  $pdf->Cell(61,4,$no_daftar,0,1,'L',false);

	  $pdf->Cell(35,4,'NOMOR PESERTA',0,0,'L',false);
	  $pdf->Cell(5,4,':',0,0,'C',false);
//	  $pdf->SetFont('Arial','B',8);
	  $pdf->Cell(61,4,$noujian,0,1,'L',false);
	  
//	  $pdf->SetFont('Arial','B',8);
	  $pdf->Cell(35,4,'NAMA PESERTA',0,0,'L',false);
	  $pdf->Cell(5,4,':',0,0,'C',false);
	  $pdf->Cell(61,4,$nama,0,1,'L',false);

//	  $pdf->SetFont('Arial','B',8);
	  $pdf->Cell(35,4,'KELOMPOK UJIAN',0,0,'L',false);
	  $pdf->Cell(5,4,':',0,0,'C',false);
	  $pdf->Cell(61,4,$kelompok,0,1,'L',false);
	  
//	  $pdf->SetFont('Arial','B',8);
	  $pdf->Cell(35,4,'TAHUN IJAZAH',0,0,'L',false);
	  $pdf->Cell(5,4,':',0,0,'C',false);
	  $pdf->Cell(61,4,$tahun,0,1,'L',false);
	  
	  $pdf->Ln(2);
	  $pdf->SetFont('Arial','B',8);	  
	  $pdf->Cell(15,3,'ALAMAT',0,0,'L',false);
	  $pdf->SetFont('Arial','',7);	  
	  $pdf->Cell(61,3,$alamat,0,1,'L',false);
	  $pdf->Cell(61,3,$k.'  '.$kodepos,0,1,'L',false);

	  $pdf->Ln(2);
	  $pdf->SetFont('Arial','B',8);	  	  
	  $pdf->Cell(10,3,'PILIHAN PROGRAM STUDI',0,1,'L',false);
	  $pdf->Cell(61,3,$Jur1.' - '.$jurusan1,0,1,'L',false);
	  $pdf->Cell(61,3,$Jur2.' - '.$jurusan2,0,1,'L',false);

	  $pdf->Ln(2);
	  $pdf->SetFont('Arial','B',8);	  	  
	  $pdf->Cell(10,3,'LOKASI UJIAN',0,1,'L',false);
	  $pdf->SetFont('Arial','',7);	  	  
	  $pdf->Cell(61,3,'Sub Panlok :'. $palok,0,1,'L',false);
	  $pdf->Cell(61,3,'Ruang :' .$noruang,0,1,'L',false);
	  $pdf->Cell(61,3,'Lokasi :' .$lokasi,0,1,'L',false);
	  $pdf->Cell(61,3,'Alamat :' .$alamat_l.' '.$kodepos1,0,1,'L',false);
	  
	  $pdf->Ln(10);
	  $pdf->Cell(40,3,'',0,0);
	  $pdf->Cell(56,3,$kota_1.', '.$tgl,0,1,'C');
	  $pdf->Cell(40,3,'',0,0);
	  $pdf->Cell(56,3,'Peserta,',0,1,'C');
	  $pdf->Ln(20);
	  $pdf->SetFont('','B');
	  $pdf->Cell(40,2,'',0,0);
	  $pdf->Cell(56,2,$nama,0,1,'C');
	  $pdf->Cell(40,2,'',0,0);
	  $pdf->Cell(56,2,'-------------------------------------',0,1,'C');
	  $pdf->Cell(40,2,'',0,0);
	  $pdf->SetFont('','I');
	  $pdf->Cell(56,2,'Nama Jelas & Tanda Tangan',0,1,'C');
	  
	  //$pdf->SetXY(12,77);
	  $pdf->Image('../../foto/'.$foto,12,77,35,43);
	  //$pdf->SetLineWidth(.1);
	  //$pdf->Cell(35,43,'Pas Foto 4 x 6',1,1,'C');
	  
	  $pdf->SetXY(108,8);
	  $pdf->SetFont('','B');
	  $pdf->Cell(96,3,'JADWAL UJIAN',0,1,'C');
	  $pdf->Ln(4);
	  $pdf->SetFont('Arial','B',8);
	  $pdf->SetX(108);
	  $pdf->Cell(96,3,'TES TULIS',0,1,'C');
	  $pdf->Ln(4);
	  $pdf->SetFillColor(229,229,229);
      $pdf->SetFont('Helvetica','',7);
	  $pdf->SetX(113);
	  $pdf->Cell(84,3,'PROGRAM STRATA 1 (S1)',0,1,'L');
	  $pdf->SetX(114);
	  $pdf->SetFont('Helvetica','B',7);
	  $pdf->Cell(5,5,'No',1,0,'C',true);
	  $pdf->Cell(45,5,'Mata Ujian',1,0,'C',true);
	  $pdf->Cell(17,5,'Tanggal',1,0,'C',true);
	  $pdf->Cell(19,5,'Waktu',1,1,'C',true);
	  $pdf->SetX(114);
	  $pdf->SetFont('Helvetica','',7);
	  $pdf->Cell(5,3,'1.','LR',0,'C');
	  $pdf->Cell(45,3,'Pengetahuan Agama (Tafsir, Hadits, ','LR',0,'L');
	  $pdf->Cell(17,3,'12 Juli 2011','LR',0,'L');
	  $pdf->Cell(19,3,'08.00 s/d 10.00','LR',1,'C');
	  $pdf->SetX(114);
	  $pdf->Cell(5,3,'','LR',0,'C');
	  $pdf->Cell(45,3,'Tauhid, Fiqh dan Sejarah ','LR',0,'L');
	  $pdf->Cell(17,3,'','LR',0,'L');
	  $pdf->Cell(19,3,'','LR',1,'C');
	  $pdf->SetX(114);
	  $pdf->Cell(5,3,'','LBR',0,'C');
	  $pdf->Cell(45,3,'Kebudayaan Islam)','LBR',0,'L');
	  $pdf->Cell(17,3,'','LBR',0,'L');
	  $pdf->Cell(19,3,'','LBR',1,'C');
	  $pdf->SetX(114);
	  $pdf->Cell(5,3,'2.','LR',0,'C');
	  $pdf->Cell(45,3,'Pengetahuan Umum (PPKn, Bhs. ','LR',0,'L');
	  $pdf->Cell(17,3,'12 Juli 2011','LR',0,'L');
	  $pdf->Cell(19,3,'10.30 s/d 12.30','LR',1,'C');
	  $pdf->SetX(114);
	  $pdf->Cell(5,3,'','LBR',0,'C');
	  $pdf->Cell(45,3,'Indonesia, IPS, IPA, dan Matematika) ','LBR',0,'L');
	  $pdf->Cell(17,3,'','LBR',0,'L');
	  $pdf->Cell(19,3,'','LBR',1,'C');
	  
	  $pdf->SetX(114);
	  $pdf->Cell(5,3,'3.','LBR',0,'C');
	  $pdf->Cell(45,3,'Bahasa Arab','LBR',0,'L');
	  $pdf->Cell(17,3,'13 Juli 2011','LBR',0,'L');
	  $pdf->Cell(19,3,'08.00 s/d 10.00','LBR',1,'C');
	  
	  $pdf->SetX(114);
	  $pdf->Cell(5,3,'4.','LBR',0,'C');
	  $pdf->Cell(45,3,'Bahasa Inggris','LBR',0,'L');
	  $pdf->Cell(17,3,'13 Juli 2011','LBR',0,'L');
	  $pdf->Cell(19,3,'10.30 s/d 12.30','LBR',1,'C');
	  
	  $pdf->Ln(10);
	  $pdf->SetX(110);
	  $pdf->SetFont('Helvetica','B',7);
	  $pdf->Cell(96,3,'PERLENGKAPAN YANG HARUS DIBAWA PADA SAAT UJIAN',0,1,'L');
	  $pdf->SetFont('Helvetica','B',6);
	  $pdf->SetX(110);	  
	  $pdf->Cell(96,3,'1. Kartu Bukti Pendaftaran ini.',0,1,'L');
	  $pdf->SetX(110);	  
	  $pdf->Cell(96,3,'2. Foto copy ijazah yang telah dilegalisir atau tanda lulus asli.',0,1,'L');	  
	  $pdf->SetX(110);	  
	  $pdf->Cell(96,3,'3. Pensil 2B secukupnya, karet penghapus, peraut pensil (jika diperlukan).',0,1,'L');	  
		  
	  $pdf->Ln(15);
	  
	  $pdf->SetX(114);
	  $pdf->SetFont('Helvetica','B',7);
	  $pdf->Cell(40,3,'',0,0);
	  $pdf->Cell(44,3,'Ketua Panitia UMM 2011',0,1,'C');
	  $pdf->Ln(8);
	  $pdf->SetX(114);
	  $pdf->Cell(40,3,'',0,0);
	  $pdf->Cell(44,3,'Ttd,',0,1,'C');
	  $pdf->Ln(8);
	  $pdf->SetX(114);
	  $pdf->SetFont('Helvetica','BU',7);
	  $pdf->Cell(40,3,'',0,0);
	  $pdf->Cell(44,3,'Drs.H.M.Syadeli Hanafi,M.Pd.',0,1,'C');
	  $pdf->SetX(114);
	  $pdf->SetFont('Helvetica','B',7);
	  $pdf->Cell(40,3,'',0,0);
	  $pdf->Cell(44,3,'NIP. 19560820 198503 1002',0,1,'C');
	  
	  $pdf->Ln(15);
	  $pdf->SetX(0);
	  $pdf->SetFont('Times','I',7);
	  $pdf->MultiCell(210,4,'--------------------------------------------------------------------------------------------------------------------- potong di sini ---------------------------------------------------------------------------------------------------------------------');

	  
	  $pdf->Output('KARTU_UJIAN_'.$_POST['no_daftar'].'.pdf','D');
    } else {
      echo "<h1>Maaf, data tidak ditemukan";
    }
  }
?>