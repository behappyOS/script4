<?php


$mysqli = new mysqli("url", "user", "pass", "database");
mysqli_set_charset($mysqli, 'utf8');
set_time_limit(0);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$le = 'laudo.txt';

$handle = fopen( $le, 'r' );

$ler = fread( $handle, filesize($le) );

$OprFrmAuto = explode(',', $ler );

$sql = mysqli_query($mysqli,"SELECT OprFrmTipo FROM azoprfrm WHERE OprFrmAuto='$OprFrmAuto'");

    foreach ($OprFrmAuto as $auto) {

            $data = file_get_contents("https://shaka.exametoxicologico.com.br/gerarlaudo/{$auto}/D");

            $obj = json_decode($data, true);

            echo "<pre>";
            var_dump($obj);

            echo "Data Imported Sucessfully from JSON! $obj";
        }

fclose($handle);

?>
