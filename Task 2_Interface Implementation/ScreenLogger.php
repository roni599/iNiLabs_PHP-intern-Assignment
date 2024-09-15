<?php

class ScreenLogger implements LoggerInterface {
    public function log($message) {
        echo "<div class='log-message'>$message</div>";
    }
}
?>
