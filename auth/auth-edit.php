<?php 

include '../function.php';

if (isset($_POST["submit"])) {
	if (edit_user($_POST) > 0) {
		echo "
		<script>
			alert('Data Berhasil Diubah')
			document.location.href= '../profile.php'
		</script>
		";
	}else {
		echo "
		<script>
			document.location.href= '../profile.php'
		</script>
		";
	}
}


?>