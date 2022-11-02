<?php 
include '../function.php';
if (isset($_POST["register"])) {
    if(registrasi($_POST) > 0){
        echo "
            <script>
                alert('Data Brrhasil di Tambahkan');
                document.location.href= './';
            </script>
        ";
    } else {
        echo "<script>
        document.location.href= 'register.php';
        </script>";
    }



}

?>