<?php include_once $_SERVER['DOCUMENT_ROOT'] . \App\Core\Config::$sBaseUrl . 'resources/views/layouts/header.php'; ?>


<h1>Guest Book</h1>
<form action="<?php echo \App\Core\Config::$sBaseUrl . 'notes/add'?>" method="POST">
    <p>Name:</p>
    <input type="text" name="name">
    <p>Email:</p>
    <input type="text" name="email">
    <p>Homepage</p>
    <input type="text" name="website">
    <p>Message</p>
    <textarea name="message"></textarea><br>
    <button class="flat-btn" type="submit">Save</button>
</form>


<?php include_once $_SERVER['DOCUMENT_ROOT'] . \App\Core\Config::$sBaseUrl  . 'resources/views/layouts/footer.php'; ?>

