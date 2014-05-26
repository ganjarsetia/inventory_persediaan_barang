<?php
//$maxkerja =10;
function carihadir($bulan,$tahun,$tglabsen,$nik) {
	$sql_hadir 	= "SELECT msabsen.*, TIMEDIFF(jam_pulang,jam_masuk) as jam
				FROM msabsen 
				WHERE bulan_periode='$bulan' AND tahun_periode='$tahun' AND tgl_abasen='$tglabsen' AND nik='$nik'";
	$r_hadir	= mysql_fetch_array(mysql_query($sql_hadir));
	//$hadir		= $r_hadir['status']."(".substr($r_hadir['jam'],0,5).")";
	$row		= mysql_num_rows(mysql_query($sql_hadir));
	if ($row>0){
		$hadir		= $r_hadir['status'];
	}else{
		$hadir		= '';
	}
	return $hadir;
}

function carilembur($bulan,$tahun,$tglabsen,$nik){
	$maxkerja =10;
	$sql_lembur	= "SELECT bulan_periode,tahun_periode,tgl_abasen,nik,
				jam_masuk,jam_pulang, TIMEDIFF(jam_pulang,jam_masuk) as jam,substr(TIMEDIFF(jam_pulang,jam_masuk),1,2)-10 as lembur
				from msabsen
				WHERE bulan_periode='$bulan' AND tahun_periode='$tahun' AND tgl_abasen='$tglabsen' AND nik='$nik' AND status='H'";
	$r_lembur	= mysql_fetch_array(mysql_query($sql_lembur));
	$row	= mysql_num_rows(mysql_query($sql_lembur));
	if ($row>0){
		if ($r_lembur['lembur']>0){
			$lembur		= $r_lembur['lembur'];
		}else{
			$lembur		= 0;
		}
	}else{
		$lembur		=0;
	}
	return $lembur;

}

function totallembur($bulan,$tahun,$tglabsen){
	$maxkerja =10;
	$sql_lembur	= "SELECT bulan_periode,tahun_periode,tgl_abasen,nik,
				jam_masuk,jam_pulang, TIMEDIFF(jam_pulang,jam_masuk) as jam,substr(TIMEDIFF(jam_pulang,jam_masuk),1,2)-10 as lembur
				from msabsen
				WHERE bulan_periode='$bulan' AND tahun_periode='$tahun' AND tgl_abasen='$tglabsen' AND status='H'";
	$r_lembur	= mysql_query($sql_lembur);
	$row	= mysql_num_rows(mysql_query($sql_lembur));
	if ($row>0){
		$lembur =0;
		while($r=mysql_fetch_array($r_lembur)){
			if ($r_lembur['lembur']>0){
				$lembur		= $lembur+$r['lembur'];
			}else{
				$lembur		= 0;
			}
		}
	}else{
		$lembur		=0;
	}
	return $lembur;

}

function jamlembur($bulan,$tahun,$nik){
	$maxkerja =10;
	$sql_lembur	= "SELECT bulan_periode,tahun_periode,tgl_abasen,nik,
				jam_masuk,jam_pulang, TIMEDIFF(jam_pulang,jam_masuk) as jam,substr(TIMEDIFF(jam_pulang,jam_masuk),1,2)-10 as lembur
				from msabsen
				WHERE bulan_periode='$bulan' AND tahun_periode='$tahun' AND nik='$nik' AND status='H'";
	$r_lembur	= mysql_query($sql_lembur);
	$row	= mysql_num_rows(mysql_query($sql_lembur));
	if ($row>0){
		$lembur =0;
		while($r=mysql_fetch_array($r_lembur)){
			if ($r_lembur['lembur']>0){
				$lembur		= $lembur+$r['lembur'];
			}else{
				$lembur		= 0;
			}
		}
	}else{
		$lembur		=0;
	}
	return $lembur;

}
function totalhadir($bulan,$tahun,$nik){
	$sql	= "SELECT bulan_periode,tahun_periode,nik,status
				from msabsen
				WHERE bulan_periode='$bulan' AND tahun_periode='$tahun' AND nik='$nik' AND status='H'";
	$data	= mysql_query($sql);
	$row	= mysql_num_rows($data);
	if ($row>0){
		$hasil	= $row;
	}else{
		$hasil	=0;
	}
	return $hasil;

}

function premihadir($bulan,$tahun,$nik){
	$sql	= "SELECT bulan_periode,tahun_periode,nik,status
				from msabsen
				WHERE bulan_periode='$bulan' AND tahun_periode='$tahun' AND nik='$nik' AND status<>'H'";
	$data	= mysql_query($sql);
	$row	= mysql_num_rows($data);
	if ($row>0){
		$hasil	= 0;
	}else{
		$hasil	= 50000;
	}
	return $hasil;

}

function ptkp($k){
	$pajak  = 1320000*12;
	$istri	= 1320000;
	$anak	= 1320000;
	if ($k=='K1'){
		$hasil = $pajak+$istri+$anak;
	}elseif($k=='K2'){
		$hasil = $pajak+$istri+$anak+$anak;		
	}elseif($k=='K3'){
		$hasil = $pajak+$istri+$anak+$anak+$anak;		
	}else{
		$hasil = $pajak;
	}
	return $hasil;
}

function kasbon($bulan,$tahun,$nik){
	$sql	= "SELECT bulan_periode,tahun_periode,nik,sum(jumlah) as total
				from mspotongan
				WHERE bulan_periode='$bulan' AND tahun_periode='$tahun' AND nik='$nik' ";
	$data	= mysql_query($sql);
	$row	= mysql_num_rows($data);
	$r_data	= mysql_fetch_array($data);
	if ($row>0){
		$hasil	= $r_data['total'];
	}else{
		$hasil	= 0;
	}
	return $hasil;

}
?>