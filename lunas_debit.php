<?php 
require 'function.php';
$id = $_GET["id"];

$data3 = mysqli_query($conn, "SELECT * FROM transaksi WHERE id = $id");
$mhs3 = mysqli_fetch_assoc($data3);
$status = $mhs3["status"];
    
if ( lunas_d($id) > 0 ) {
    if($status == 'BELUM LUNAS'){
            echo "
            <script>
                document.location.href= 'laporan/laporan-piutang-month.php'
            </script>
            ";
        }elseif($status == 'PINJAMAN'){
            echo "
            <script>
                alert('Transaksi Ini Tidak Bisa Dilunaskan!')
                document.location.href= 'laporan/laporan-piutang-month.php'
            </script>
            ";
        }elseif($status == 'LUNAS(DEBIT)'){
            echo "
            <script>
                alert('Transaksi Ini Tidak Bisa Dilunaskan!')
                document.location.href= 'laporan/laporan-piutang-month.php'
            </script>
            ";
        }elseif($status == 'LUNAS(KREDIT)'){
            echo "
            <script>
                alert('Transaksi Ini Tidak Bisa Dilunaskan!')
                document.location.href= 'laporan/laporan-piutang-month.php'
            </script>
            ";
        }
        elseif($status == 'LABA'){
            echo "
            <script>
                alert('Transaksi Ini Tidak Bisa Dilunaskan!')
                document.location.href= 'laporan/laporan-piutang-month.php'
            </script>
            ";
        }elseif($status == 'PENAMBAHAN'){
            echo "
            <script>
                alert('Transaksi Ini Tidak Bisa Dilunaskan!')
                document.location.href= 'laporan/laporan-piutang-month.php'
            </script>
            ";
        }elseif($status == 'PENGURANGAN'){
            echo "
            <script>
                alert('Transaksi Ini Tidak Bisa Dilunaskan!')
                document.location.href= 'laporan/laporan-piutang-month.php'
            </script>
            ";
        }

	}else{
		echo "
		<script>
			alert('Transaksi Ini Tidak Bisa Dilunaskan!')
			document.location.href= 'laporan/laporan-piutang-month.php'
		</script>
		";
	}

 ?>