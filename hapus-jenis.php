<?php 
require 'function.php';
$id = $_GET["id"];

    
if ( hapusjenis($id) > 0 ) {
		echo "
		<script>
			alert('Data Berhasil Dihapus')
			document.location.href= 'input_jenis.php'
		</script>
		";
	}else {
		echo "
		<script>
			alert('Data Gagal Dihapus')
			document.location.href= 'input_jenis.php'
		</script>
		";
	}

 ?>