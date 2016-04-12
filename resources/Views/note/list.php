<?php include_once $_SERVER['DOCUMENT_ROOT'] . \App\Core\Config::$sBaseUrl . 'resources/views/layouts/header.php'; ?>


<h1>Guest Book</h1>
<div class="component">
    <?php
    foreach ($data['notes'] as $aNote) {
        echo '<div class="article">';
        echo '<h1>' . $aNote->name . '</h1>';
        echo '<a href="mailto:' . $aNote->email . '">' . $aNote->email . '</a><br>';
        echo '<a href="' . $aNote->website . '">' . $aNote->website . '</a><br>';
        echo '<p>' . $aNote->message . '</p>';
        echo '</div>';
    }
    ?>
</div>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . \App\Core\Config::$sBaseUrl . 'resources/views/layouts/footer.php'; ?>


