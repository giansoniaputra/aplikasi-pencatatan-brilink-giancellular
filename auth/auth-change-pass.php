<?php 
include '../function.php';
if (isset($_POST["change_pass"])) {
    if(ubah_pass($_POST) > 0){
        echo "
            <script>
                alert('Password Berhasil Diubah!');
                document.location.href= 'session-destroy.php';
            </script>
        ";
    } else {
        echo "<script>
        document.location.href= 'change-password.php?id=$_POST[id]';
        </script>";
    }



}

?>