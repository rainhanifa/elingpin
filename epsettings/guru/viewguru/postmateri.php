<?php

include "../modelguru/backgurucode.php";

$con = backgurucode::connecttodb();

$opsi = $_POST['submateri'];

$sql_submateri = "SELECT * FROM detail_materi WHERE materi = '$opsi' ";
$qry_submateri = mysqli_query($con, $sql_submateri);
while($dta_submateri = mysqli_fetch_array($qry_submateri, MYSQLI_ASSOC)){
    $datasubmateri[]=$dta_submateri;
}

foreach($datasubmateri as $key){
    echo '<option value="'.$key['submateri'].'">'.$key['submateri'].'</option>';
}
?>