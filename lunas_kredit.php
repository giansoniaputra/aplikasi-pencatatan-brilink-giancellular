<?php 
require 'function.php';

//ambil data
$id = $_GET['id'];
$trx = query("SELECT * FROM transaksi WHERE id = $id")[0];

    if($trx["status"] == 'BELUM LUNAS'){
		echo "
		<script>
			document.location.href= 'editkredit.php?id=$id'
		</script>
		";
	}elseif($trx["status"] == 'PINJAMAN'){
		echo "
		<script>
			document.location.href= 'editkredit.php?id=$id'
		</script>
		";
	}
    else {
		echo "
		<script>
			alert('Data Sudah Lunas')
			document.location.href= 'transaksi.php'
		</script>
		";
	}

?>

