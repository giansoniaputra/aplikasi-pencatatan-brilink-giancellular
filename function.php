<?php 
//koneksi
$host = "localhost";
$user = "root";
$pass = "";
$db = "giancellular";

$conn = mysqli_connect($host, $user, $pass, $db);

	if (!$conn) {
		die("Koneksi Gagal:".mysqli_connect_error());
	}

//function query
function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows [] = $row;

	}
	return $rows;
}

//function currency
function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah;
 
}

//function tanggal
function tanggal($date){
	// menggunakan class Datetime
	$tanggal = date('d F Y', strtotime($date));
	return $tanggal;
   }

//tanggal hari ini
    $hariIni = new DateTime();
    $tanggal = $hariIni->format('d F Y');
	$bulan = $hariIni->format('F Y');

//function terbilang

function penyebut($nilai) {
	$nilai = abs($nilai);
	$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	$temp = "";
	if ($nilai < 12) {
		$temp = " ". $huruf[$nilai];
	} else if ($nilai <20) {
		$temp = penyebut($nilai - 10). " belas";
	} else if ($nilai < 100) {
		$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
	} else if ($nilai < 200) {
		$temp = " seratus" . penyebut($nilai - 100);
	} else if ($nilai < 1000) {
		$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
	} else if ($nilai < 2000) {
		$temp = " seribu" . penyebut($nilai - 1000);
	} else if ($nilai < 1000000) {
		$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
	} else if ($nilai < 1000000000) {
		$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
	} else if ($nilai < 1000000000000) {
		$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
	} else if ($nilai < 1000000000000000) {
		$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
	}     
	return $temp;
}

function terbilang($nilai) {
	if($nilai<0) {
		$hasil = "minus ". trim(penyebut($nilai));
	} else {
		$hasil = trim(penyebut($nilai));
	}     		
	return $hasil;
}

//input jenis transaksi
function tambahJenis($data){
	global $conn;
	$jenis = htmlspecialchars(strtoupper($data["jenis_transaksi"]));
	$laba = htmlspecialchars($data["laba"]);
	
	$query = "INSERT INTO jenis_transaksi VALUES('','$jenis','$laba')";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

//input transaksi
function tambahTransaksi($data){
	global $conn;
	$nama = strtoupper($_POST['nama']);

	$query = mysqli_query($conn, "SELECT * FROM pelanggan WHERE nama_pelanggan = '$nama'");
	
   
	if($query->num_rows > 0) {
		$nama = htmlspecialchars(strtoupper($data["nama"]));
		$jenis = htmlspecialchars($data["jenis_transaksi"]);
		$bri = htmlspecialchars($data["bri"]);
		$tgl = htmlspecialchars($data["tanggal"]);
		$status = htmlspecialchars($data["status"]);
		$debit = htmlspecialchars($data["debit"]);
		$kredit = htmlspecialchars($data["kredit"]);
		$laba = htmlspecialchars($data["laba"]);
		$s_debit = $data["saldo_d"];
		$s_kredit = $data["saldo_k"];
		if($data["status"] == 'LUNAS(DEBIT)') {
			$saldo_d = $s_debit+$debit-$kredit;
			$saldo_k = $s_kredit-$debit+$kredit;
			$hutang = '0';
		}elseif ($data["status"] == 'LUNAS(KREDIT)') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit-$debit+$kredit;
			$hutang = '0';
		}elseif ($data["status"] == 'BELUM LUNAS') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit-$debit+$kredit;
			$hutang = $debit+$kredit;
		}elseif ($data["status"] == 'PINJAMAN') {
			$saldo_d = $s_debit-$debit;
			$saldo_k = $s_kredit;
			$hutang = $debit;
		}elseif ($data["status"] == 'LABA') {
			$saldo_d = $s_debit-$debit;
			$saldo_k = $s_kredit;
			$hutang = '0';
		}elseif ($data["status"] == 'PENAMBAHAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit+$kredit;
			$hutang = '0';
		}elseif ($data["status"] == 'PENGURANGAN') {
			$saldo_d = $s_debit-$debit;
			$saldo_k = $s_kredit-$kredit;
			$hutang = '0';
		}
	
		$query = "INSERT INTO transaksi VALUES('','$nama','$jenis','$bri','$tgl','$status','$debit','$kredit','$laba','$hutang')";
		$query2 = "UPDATE saldo SET saldo_d ='$saldo_d', saldo_k ='$saldo_k' WHERE id = '1'";
	
		mysqli_query($conn, $query);
		mysqli_query($conn, $query2);
		return mysqli_affected_rows($conn);
	} else {
		$nama = htmlspecialchars(strtoupper($data["nama"]));
		$jenis = htmlspecialchars($data["jenis_transaksi"]);
		$bri = htmlspecialchars($data["bri"]);
		$tgl = htmlspecialchars($data["tanggal"]);
		$status = htmlspecialchars($data["status"]);
		$debit = htmlspecialchars($data["debit"]);
		$kredit = htmlspecialchars($data["kredit"]);
		$laba = htmlspecialchars($data["laba"]);
		$s_debit = $data["saldo_d"];
		$s_kredit = $data["saldo_k"];
		if($data["status"] == 'LUNAS(DEBIT)') {
			$saldo_d = $s_debit+$debit-$kredit;
			$saldo_k = $s_kredit-$debit+$kredit;
			$hutang = '0';
		}elseif ($data["status"] == 'LUNAS(KREDIT)') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit-$debit+$kredit;
			$hutang = '0';
		}elseif ($data["status"] == 'BELUM LUNAS') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit-$debit+$kredit;
			$hutang = $debit+$kredit;
		}elseif ($data["status"] == 'PINJAMAN') {
			$saldo_d = $s_debit-$debit;
			$saldo_k = $s_kredit;
			$hutang = $debit;
		}elseif ($data["status"] == 'LABA') {
			$saldo_d = $s_debit-$debit;
			$saldo_k = $s_kredit;
			$hutang = '0';
		}elseif ($data["status"] == 'PENAMBAHAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit+$kredit;
			$hutang = '0';
		}elseif ($data["status"] == 'PENGURANGAN') {
			$saldo_d = $s_debit-$debit;
			$saldo_k = $s_kredit-$kredit;
			$hutang = '0';
		}
	
		$query = "INSERT INTO transaksi VALUES('','$nama','$jenis','$bri','$tgl','$status','$debit','$kredit','$laba','$hutang')";
		$query2 = "UPDATE saldo SET saldo_d ='$saldo_d', saldo_k ='$saldo_k' WHERE id = '1'";
		$query3 = "INSERT INTO pelanggan VALUES('','$nama')";
	
		mysqli_query($conn, $query);
		mysqli_query($conn, $query2);
		mysqli_query($conn, $query3);
		return mysqli_affected_rows($conn);
	}


	
}

function tambahModal($data) {
	global $conn;
	$modal = htmlspecialchars($data["modal"]);
	$query = "UPDATE modal SET modal ='$modal' WHERE id = '1'";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function edit($data){
	global $conn;
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$jenis = htmlspecialchars($data["jenis_transaksi"]);
	$tgl = htmlspecialchars($data["tanggal"]);
	$bri = htmlspecialchars($data["bri"]);
	$status = htmlspecialchars($data["status"]);
	$s_baru = htmlspecialchars($data["statusbaru"]);
	$debit = htmlspecialchars($data["debit"]);
	$d_baru= htmlspecialchars($data["debitbaru"]);
	$kredit = htmlspecialchars($data["kredit"]);
	$k_baru= htmlspecialchars($data["kreditbaru"]);
	$laba = htmlspecialchars($data["laba"]);
	$s_debit = $data["saldo_d"];
	$s_kredit = $data["saldo_k"];

	if($data["statusbaru"] == 'LUNAS(DEBIT)') {
		if($data["status"] == 'LUNAS(DEBIT)') {
			$saldo_d = $s_debit-$debit+$kredit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'LUNAS(KREDIT)') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'BELUM LUNAS') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = $debit+$kredit;
		}elseif ($data["status"] == 'PINJAMAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit;
			// $hutang = $debit;
		}elseif ($data["status"] == 'LABA') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'PENAMBAHAN') {
			$saldo_d = $s_debit-$debit;
			$saldo_k = $s_kredit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'PENGURANGAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit+$kredit;
			// $hutang = '0';
		}
		$saldo_db = $saldo_d+$d_baru-$k_baru;
		$saldo_kb = $saldo_k-$d_baru+$k_baru;
		$hutang = '0';
	}elseif ($data["statusbaru"] == 'LUNAS(KREDIT)') {
		if($data["status"] == 'LUNAS(DEBIT)') {
			$saldo_d = $s_debit-$debit+$kredit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'LUNAS(KREDIT)') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'BELUM LUNAS') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = $debit+$kredit;
		}elseif ($data["status"] == 'PINJAMAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit;
			// $hutang = $debit;
		}elseif ($data["status"] == 'LABA') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'PENAMBAHAN') {
			$saldo_d = $s_debit-$debit;
			$saldo_k = $s_kredit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'PENGURANGAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit+$kredit;
			// $hutang = '0';
		}
		$saldo_db = $saldo_d;
		$saldo_kb = $saldo_k-$d_baru+$k_baru;
		$hutang = '0';
	}elseif ($data["statusbaru"] == 'BELUM LUNAS') {
		if($data["status"] == 'LUNAS(DEBIT)') {
			$saldo_d = $s_debit-$debit+$kredit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'LUNAS(KREDIT)') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'BELUM LUNAS') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = $debit+$kredit;
		}elseif ($data["status"] == 'PINJAMAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit;
			// $hutang = $debit;
		}elseif ($data["status"] == 'LABA') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'PENAMBAHAN') {
			$saldo_d = $s_debit-$debit;
			$saldo_k = $s_kredit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'PENGURANGAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit+$kredit;
			// $hutang = '0';
		}
		$saldo_db = $saldo_d;
		$saldo_kb = $saldo_k-$d_baru+$k_baru;
		$hutang = $d_baru+$k_baru;
	}elseif ($data["statusbaru"] == 'PINJAMAN') {
		if($data["status"] == 'LUNAS(DEBIT)') {
			$saldo_d = $s_debit-$debit+$kredit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'LUNAS(KREDIT)') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'BELUM LUNAS') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = $debit+$kredit;
		}elseif ($data["status"] == 'PINJAMAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit;
			// $hutang = $debit;
		}elseif ($data["status"] == 'LABA') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'PENAMBAHAN') {
			$saldo_d = $s_debit-$debit;
			$saldo_k = $s_kredit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'PENGURANGAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit+$kredit;
			// $hutang = '0';
		}
		$saldo_db = $saldo_d-$d_baru;
		$saldo_kb = $saldo_k;
		$hutang = $d_baru;
	}elseif ($data["statusbaru"] == 'LABA') {
		if($data["status"] == 'LUNAS(DEBIT)') {
			$saldo_d = $s_debit-$debit+$kredit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'LUNAS(KREDIT)') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'BELUM LUNAS') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = $debit+$kredit;
		}elseif ($data["status"] == 'PINJAMAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit;
			// $hutang = $debit;
		}elseif ($data["status"] == 'LABA') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'PENAMBAHAN') {
			$saldo_d = $s_debit-$debit;
			$saldo_k = $s_kredit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'PENGURANGAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit+$kredit;
			// $hutang = '0';
		}
		$saldo_db = $saldo_d-$d_baru;
		$saldo_kb = $saldo_k;
		$hutang = '0';
	}elseif ($data["statusbaru"] == 'PENAMBAHAN') {
		if($data["status"] == 'LUNAS(DEBIT)') {
			$saldo_d = $s_debit-$debit+$kredit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'LUNAS(KREDIT)') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'BELUM LUNAS') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = $debit+$kredit;
		}elseif ($data["status"] == 'PINJAMAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit;
			// $hutang = $debit;
		}elseif ($data["status"] == 'LABA') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'PENAMBAHAN') {
			$saldo_d = $s_debit-$debit;
			$saldo_k = $s_kredit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'PENGURANGAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit+$kredit;
			// $hutang = '0';
		}
		$saldo_db = $saldo_d+$d_baru;
		$saldo_kb = $saldo_k+$k_baru;
		$hutang = '0';
	}elseif ($data["statusbaru"] == 'PENGURANGAN') {
		if($data["status"] == 'LUNAS(DEBIT)') {
			$saldo_d = $s_debit-$debit+$kredit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'LUNAS(KREDIT)') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'BELUM LUNAS') {
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit+$debit-$kredit;
			// $hutang = $debit+$kredit;
		}elseif ($data["status"] == 'PINJAMAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit;
			// $hutang = $debit;
		}elseif ($data["status"] == 'LABA') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'PENAMBAHAN') {
			$saldo_d = $s_debit-$debit;
			$saldo_k = $s_kredit-$kredit;
			// $hutang = '0';
		}elseif ($data["status"] == 'PENGURANGAN') {
			$saldo_d = $s_debit+$debit;
			$saldo_k = $s_kredit+$kredit;
			// $hutang = '0';
		}
		$saldo_db = $saldo_d-$d_baru;
		$saldo_kb = $saldo_k-$k_baru;
		$hutang = '0';
	}

	$query = "UPDATE transaksi SET nama='$nama',jenis='$jenis',jenis2 = '$bri',tanggal='$tgl',status='$s_baru',debit='$d_baru',kredit='$k_baru',laba='$laba',hutang='$hutang' WHERE id = $id";
	$query2 = "UPDATE saldo SET saldo_d ='$saldo_db', saldo_k ='$saldo_kb' WHERE id = '1'";
	

	mysqli_query($conn, $query);
	mysqli_query($conn, $query2);
	return mysqli_affected_rows($conn);
}

function hapus($id) {
	global $conn;
	//memilih debit kredit dari tabel transaksi
	$data = mysqli_query($conn, "SELECT * FROM transaksi WHERE id = $id");
	$mhs = mysqli_fetch_assoc($data);
	$debit = $mhs["debit"];
	$kredit = $mhs["kredit"];

	//memilih saldo debit kredit dari tabel saldo
    $data2 = mysqli_query($conn, "SELECT * FROM saldo WHERE id = '1'");
	$mhs2 = mysqli_fetch_assoc($data2);
    $saldo_d = $mhs2["saldo_d"];
    $saldo_k = $mhs2["saldo_k"];

	//mengembalikan saldo ke semula
	if($mhs["status"] == 'LUNAS(DEBIT)') {
		$sd_semula = $saldo_d-$debit+$kredit;
		$sk_semula = $saldo_k+$debit-$kredit;
		// $hutang = '0';
	}elseif ($mhs["status"] == 'LUNAS(KREDIT)') {
		$sd_semula = $saldo_d;
		$sk_semula = $saldo_k+$debit-$kredit;
		// $hutang = '0';
	}elseif ($mhs["status"] == 'BELUM LUNAS') {
		$sd_semula = $saldo_d;
		$sk_semula = $saldo_k+$debit-$kredit;
		// $hutang = $debit+$kredit;
	}elseif ($mhs["status"] == 'PINJAMAN') {
		$sd_semula = $saldo_d+$debit;
		$sk_semula = $saldo_k;
		// $hutang = $debit;
	}elseif ($mhs["status"] == 'LABA') {
		$sd_semula = $saldo_d+$debit;
		$sk_semula = $saldo_k;
		// $hutang = '0';
	}elseif ($mhs["status"] == 'PENAMBAHAN') {
		$sd_semula = $saldo_d-$debit;
		$sk_semula = $saldo_k-$kredit;
		// $hutang = '0';
	}elseif ($mhs["status"] == 'PENGURANGAN') {
		$sd_semula = $saldo_d+$debit;
		$sk_semula = $saldo_k+$kredit;
		// $hutang = '0';
	}

	$query = "UPDATE saldo SET saldo_d ='$sd_semula', saldo_k ='$sk_semula' WHERE id = '1'";
	mysqli_query($conn, $query);
	mysqli_query($conn, "DELETE FROM transaksi WHERE id = $id");
	return mysqli_affected_rows($conn);


	}		

	function lunas_d($id){
		global $conn;
		//memilih debit kredit dari tabel transaksi
		$data = mysqli_query($conn, "SELECT * FROM transaksi WHERE id = $id");
		$mhs = mysqli_fetch_assoc($data);
		$id = $mhs["id"];
		$nama = $mhs["nama"];
		$jenis = $mhs["jenis"];
		$tgl = $mhs["tanggal"];
		$status = $mhs["status"];
		$debit = $mhs["debit"];
		$kredit = $mhs["kredit"];
		$laba = $mhs["laba"];
		$hutang = $mhs["hutang"];

		//memilih saldo dari tabel saldo
		$data2 = mysqli_query($conn, "SELECT * FROM saldo WHERE id = '1'");
		$mhs2 = mysqli_fetch_assoc($data2);
		$s_debit = $mhs2["saldo_d"];
		$s_kredit = $mhs2["saldo_k"];
		//melunasi transaksi
		if($mhs["status"] == 'BELUM LUNAS'){
			$saldo_d = $s_debit+$debit-$kredit;
			$saldo_k = $s_kredit;
			$status_b = 'LUNAS(DEBIT)';
			$hutang_b = '0';
		}elseif($mhs["status"] == 'PINJAMAN'){
			$saldo_d = $s_debit+$debit-$kredit;
			$saldo_k = $s_kredit;
			$status_b = 'LUNAS(DEBIT)';
			$hutang_b = '0';
		}elseif($mhs["status"] == 'LUNAS(DEBIT)'){
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit;
			$status_b = $status;
			$hutang_b = $hutang;
		}elseif($mhs["status"] == 'LUNAS(KREDIT)'){
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit;
			$status_b = $status;
			$hutang_b = $hutang;
		}elseif($mhs["status"] == 'LABA'){
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit;
			$status_b = $status;
			$hutang_b = $hutang;
		}elseif($mhs["status"] == 'PENAMBAHAN'){
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit;
			$status_b = $status;
			$hutang_b = $hutang;
		}elseif($mhs["status"] == 'PENGURANGAN'){
			$saldo_d = $s_debit;
			$saldo_k = $s_kredit;
			$status_b = $status;
			$hutang_b = $hutang;
		}
		$query = "UPDATE transaksi SET nama='$nama',jenis='$jenis',tanggal='$tgl',status='$status_b',debit='$debit',kredit='$kredit',laba='$laba',hutang='$hutang_b' WHERE id = $id";
		$query2 = "UPDATE saldo SET saldo_d ='$saldo_d', saldo_k ='$saldo_k' WHERE id = '1'";
		mysqli_query($conn, $query);
		mysqli_query($conn, $query2);
		return mysqli_affected_rows($conn);


	}
function editkredit($data){
	global $conn;
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$jenis = htmlspecialchars($data["jenis"]);
	$bri = htmlspecialchars($data["bri"]);
	$tgl = htmlspecialchars($data["tanggal"]);
	$status = 'LUNAS(KREDIT)';
	$debit = htmlspecialchars($data["debit"]);
	$k_baru= htmlspecialchars($data["kreditbaru"]);
	$laba = '0';
	$s_debit = $data["saldo_d"];
	$s_kredit = $data["saldo_k"];

	$saldo_kb = $s_kredit+$k_baru;
	$hutang = '0';

	$query = "UPDATE transaksi SET nama='$nama',jenis='$jenis',jenis2 = '$bri',tanggal='$tgl',status='$status',debit='$debit',kredit='$k_baru',laba='$laba',hutang='$hutang' WHERE id = $id";
	$query2 = "UPDATE saldo SET saldo_d ='$s_debit', saldo_k ='$saldo_kb' WHERE id = '1'";
	

	mysqli_query($conn, $query);
	mysqli_query($conn, $query2);
	return mysqli_affected_rows($conn);
	}

function editjenis($data){
	global $conn;
	$id = $data["id"];
	$jenis = $data["jenis_transaksi"];
	$laba = $data["laba"];

	$query = "UPDATE jenis_transaksi SET jenis_transaksi='$jenis', laba='$laba' WHERE id = $id";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function hapusjenis($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM jenis_transaksi WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function registrasi($data){
	global $conn;
	$nama = ucwords(strtolower(htmlspecialchars($data["nama_user"])));
	$user = strtolower(stripslashes($data["username"]));
	$email = htmlspecialchars($data["email"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$hp = htmlspecialchars($data["no_hp"]);
	$pass = mysqli_real_escape_string($conn,$data["password"]);
	$pass2 = mysqli_real_escape_string($conn,$data["password2"]);

	$gambar = upload();
	if(!$gambar){
		return false;
	}

	//cek username

	$cek = mysqli_query($conn, "SELECT username FROM user WHERE username = '$user'");
		if(mysqli_fetch_assoc($cek)) {
			echo "
            <script>
                alert('Username Sudah Terdafar');
            </script>
        ";
		return false;
		}
	//cek password confirm

	if($pass !== $pass2){
		echo "
            <script>
                alert('Konfirmasi Password Tidak Sama');
            </script>
        ";
		return false;
	}

	//enkripsi password
	$pass = password_hash($pass, PASSWORD_DEFAULT);

	//tambahkan userbaru ke database
		mysqli_query($conn, "INSERT INTO user VALUES('','$nama','$user','$email','$alamat','$hp','$pass','$gambar')");

		return mysqli_affected_rows($conn);

}

//Function Upload Gambar
function upload() {
	global $conn;
	$namaFile= $_FILES['gambar']['name'];
	$ukuran = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmp = $_FILES['gambar']['tmp_name'];

	//cek gambar yang di upload

	if($error === 4){
	echo "
		<script>
			alert('Pilih gambar terlebih dahulu')
		</script>
		";
	return false;
	}

	$eks = ['jpg', 'jpeg', 'png'];
	$eksgambar = explode('.', $namaFile);
	$eksgambar = strtolower(end($eksgambar));

	if(!in_array($eksgambar, $eks)) {
		echo "
		<script>
			alert('Mohon Upload Gambar')
		</script>
		";
	return false;
	}

	if ($ukuran > 2000000) {
		echo "
		<script>
			alert('Ukuran Gambar Max 2Mb!');
		</script>
		";
		return false;
	}

	//lolos pengecekan file
	//generate nama baru

	$gambarbaru = uniqid();
	$gambarbaru .= '.';
	$gambarbaru .= $eksgambar;

	move_uploaded_file($tmp, '../gambar/' . $gambarbaru);
	return $gambarbaru; 
	}

	function edit_user($data){
		global $conn;
		$id = $data["id"];
		$nama = ucwords(strtolower(htmlspecialchars($data["nama_user"])));
		$user = strtolower(stripslashes($data["username"]));
		$pass = $data["password"];
		$email = htmlspecialchars($data["email"]);
		$alamat = htmlspecialchars($data["alamat"]);
		$hp = htmlspecialchars($data["no_hp"]);
		$gambar = $data["gambar"];
		$query = "UPDATE user SET nama_user='$nama',username='$user',email='$email',alamat='$alamat',no_hp='$hp', password = '$pass', gambar = '$gambar' WHERE id = $id";
		
		
	
		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	function ubah_pass($data){
		global $conn;
		$id = $data["id"];
		$pass = $data["password"];
		$npass = $data["password_baru"];
		$npass2 = $data["password_baru2"];
		

		$cek = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
		$cek2 = mysqli_fetch_assoc($cek);
		
		if($pass = password_verify($pass,$cek2["password"])){
			if($npass !== $npass2){
				echo "
					<script>
						alert('Konfirmasi Password Tidak Sama!');
					</script>
				";
				return false;
			}
	
			$npass = password_hash($npass, PASSWORD_DEFAULT);
	
			$nama = $cek2["nama_user"];
			$user = $cek2["username"];
			$email = $cek2["email"];
			$alamat = $cek2["alamat"];
			$hp = $cek2["no_hp"];
			$gambar = $cek2["gambar"];
	
			$insert = "UPDATE user SET nama_user='$nama',username='$user',email='$email',alamat='$alamat',no_hp='$hp',password='$npass',gambar='$gambar' WHERE id = $id";
			mysqli_query($conn, $insert);
			return mysqli_affected_rows($conn);
		} else {
			echo "
				<script>
					alert('Password Lama Tidak Sesuai!');
				</script>
				";
		}

		

	}

	function change_pic($data){
		global $conn;
		$id = $data["id"];

		
		$cek = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
		$cek2 = mysqli_fetch_assoc($cek);
		$nama = $cek2["nama_user"];
		$user = $cek2["username"];
		$email = $cek2["email"];
		$alamat = $cek2["alamat"];
		$hp = $cek2["no_hp"];
		$pass = $cek2["password"];
		$gambar = upload(); 
		if(!$gambar){
			return false;
		}
	
			$insert = "UPDATE user SET nama_user='$nama',username='$user',email='$email',alamat='$alamat',no_hp='$hp',password='$pass',gambar='$gambar' WHERE id = $id";
			mysqli_query($conn, $insert);
			return mysqli_affected_rows($conn);
	}

?>
