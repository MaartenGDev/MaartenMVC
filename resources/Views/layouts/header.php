<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Website</title>
    <link href="http://<?php echo $_SERVER['SERVER_NAME'] . \App\Core\Config::$sBaseUrl.'app/public/css/style.css'?>" rel="stylesheet" >
</head>
<body>

<?php
$aFlash = \App\Models\Flash::get();

if(count($aFlash) . 0){
    echo '<div class="flash-module flash-' .$aFlash['type'].'">';
    foreach($aFlash['data'] as $sFlash){
        echo '<p>'.$sFlash.'</p>';
    }
    echo '</div>';
}
?>