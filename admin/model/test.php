<?php
	include ("khoahoc.php");
	$khoahoc = new KhoaHoc();
	$dskhoahoc = $khoahoc->getKhoaHocQuaVien('CNTT&TT');
	foreach ($dskhoahoc as $key => $value) {
		print "$key: $value";
	}
?>