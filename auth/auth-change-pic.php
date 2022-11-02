<?php 
include '../function.php';
if (isset($_POST["change_pic"])) {
    if(change_pic($_POST) > 0){
        echo "
            <script>
                alert('Gambar Berhasil Diubah!');
                document.location.href= '../profile.php';
            </script>
        ";
    } else {
        echo "<script>
        alert('Gambar Gagal Diubah!!');
        document.location.href= 'change-picture.php?id=$_POST[id]';
        </script>";
    }



}

?>