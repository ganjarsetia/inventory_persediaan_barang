<?
  function to_indonesian_date($date) {
    $Tbulan = array("01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");
	$e_date = explode("-",$date);
	$thn = $e_date[0];
	$bln = $e_date[1];
	$tgl = $e_date[2];
	return $tgl.' '.$Tbulan[$bln].' '.$thn;
  }
  function to_english_date($date) {
    $Tbulan = array("01"=>"January","02"=>"February","03"=>"March","04"=>"April","05"=>"Mei","06"=>"June","07"=>"July","08"=>"August","09"=>"September","10"=>"October","11"=>"November","12"=>"December");
	$e_date = explode("-",$date);
	$thn = $e_date[0];
	$bln = $e_date[1];
	$tgl = $e_date[2];
	return $Tbulan[$bln].' '.$tgl.', '.$thn;
  }
?>