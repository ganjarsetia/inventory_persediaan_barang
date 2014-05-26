<?
  include_once('../init/init.php');
  
  $select = "SELECT 
               no_daftar,
			   nim,
			   nama,
			   tempat_lahir,
			   tanggal_lahir,
			   tgl_ujian_teori
			 FROM 
			   tb_daftar
			 WHERE 
			   lulus='1' 
			 AND 
			   aktif='1' 
			 ORDER BY 
			   tgl_ujian_teori";
  
  $qrLulus = mysql_query($select,$nResult);
  $barisLulus = @mysql_num_rows($qrLulus);
  if ($barisLulus > 0) {
    // load library
    require 'php-excel.class.php';
	include('to_indonesian_date.php');
  
    //siapkan array
    $str_data = "array(1 => ";
	$data = "";
	$i = 0;
	while ($i<$barisLulus) {
	  $line = "array(";
	  $no_daftar = mysql_result($qrLulus,$i,"no_daftar");
	  $nim = mysql_result($qrLulus,$i,"nim");
	  $nama = mysql_result($qrLulus,$i,"nama");
	  $tempat_lahir = mysql_result($qrLulus,$i,"tempat_lahir");
	  $tanggal_lahir = mysql_result($qrLulus,$i,"tanggal_lahir");
	  $tgl_ujian_teori = mysql_result($qrLulus,$i,"tgl_ujian_teori");
	  
	  $txtSkor = "SELECT 
	                ujian_ke,
				    total_skor_teori, 
				    date_format(now(),'%Y-%m-%d') as tgl_sekarang
				  FROM 
				    tb_skor
				  WHERE
				    ujian_ke IN
				    (
					 SELECT 
					   max(ujian_ke) 
					 FROM 
					   tb_skor 
					 WHERE 
					   no_daftar=\"$no_daftar\"
					)
				  AND
				    no_daftar = \"$no_daftar\"";
	  $qrSkor = mysql_query($txtSkor,$nResult);
	  if (@mysql_num_rows($qrSkor)>0) {
	    $total_skor_teori = mysql_result($qrSkor,0,"total_skor_teori");
		$tgl_sekarang = mysql_result($qrSkor,0,"tgl_sekarang");
		if ($total_skor_teori >= 80) {
		  $predikat = 'Sangat Baik';
		  $terjemah = 'Very Good';
		} else {
		  $predikat = 'Baik';
		  $terjemah = 'Good';
		}  
		$line .= "'".$nim."','".str_replace("'","''",$nama)."','".to_indonesian_date($tanggal_lahir)."','".to_english_date($tanggal_lahir)."','".str_replace("'","''",$tempat_lahir)."','".to_indonesian_date($tgl_ujian_teori)."','".to_english_date($tgl_ujian_teori)."','".$predikat."','".$terjemah."','".to_indonesian_date($tgl_sekarang)."','".to_english_date($tgl_sekarang)."'),";
		$data .= $line;
	  } else {
	    echo "<h2>Error!!!<br><br></h2>";
	  }
	  $i++;
	}
	//$data = str_replace("\n","",$data);
    $data = substr($data,0,strlen($data)-1).");";
    $str_data .= $data;
    //echo $str_data;
  
    // Evaluate data
    eval("\$data = $str_data");
    // generate file (constructor parameters are optional)
    $xls = new Excel_XML('UTF-8', false, 'Konsideran_Sertifikat_IT');
    $xls->addArray($data);
    $xls->generateXML('Konseideran_Sertifikat_IT');
  } else {
    echo "<h2>Data tidak ditemukan!!<br></h2>";
  }
?>