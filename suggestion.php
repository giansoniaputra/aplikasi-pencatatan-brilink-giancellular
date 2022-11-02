<?php 

header("Content-Type: application/json; charset=UTF-8");
  include 'function.php';
  
  if(isset($_GET["query"])){
    $key = "%".$_GET["query"]."%";
    $query = "SELECT * FROM pelanggan WHERE nama LIKE ? LIMIT 10";
    $dewan1 = $db1->prepare($query);
    $dewan1->bind_param('s', $key);
    $dewan1->execute();
    $res1 = $dewan1->get_result();
 
    while ($row = $res1->fetch_assoc()) {
        $output['suggestions'][] = [
            'value' => $row['nama_pelanggan'],
            'nama'  => $row['nama_pelanggan']
        ];
    }
 
    if (! empty($output)) {
        echo json_encode($output);
    }
  }


?>