<?php
include_once $_SERVER['DOCUMENT_ROOT'] . \App\Core\Config::$sBaseUrl .'resources/Views/layouts/header.php';
?>


<h1>Hello world!</h1>
<p>The url argument is:<?php echo intval($data['pageID']); ?></p>


<?php
include_once $_SERVER['DOCUMENT_ROOT'] . \App\Core\Config::$sBaseUrl .'resources/Views/layouts/footer.php';
?>