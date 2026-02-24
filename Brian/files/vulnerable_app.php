<?php
    echo "<h1>System Diagnostics Dashboard</h1>";
    echo "<p>Enter a hostname or IP to check connectivity:</p>";

    // The vulnerability: shell_exec() takes user input directly
    if(isset($_GET['host'])) {
        $target = $_GET['host'];
        
        echo "<h3>Ping Results for: " . htmlspecialchars($target) . "</h3>";
        echo "<pre>";
        // command injection vulnerability
        echo shell_exec("ping -c 4 " . $target);
        echo "</pre>";
    } else {
        echo "<form method='GET'>";
        echo "  <input type='text' name='host' placeholder='8.8.8.8'>";
        echo "  <input type='submit' value='Run Diagnostic'>";
        echo "</form>";
        echo "<br><hr>";
        echo "<p>Example usage: <code>?host=8.8.8.8; whoami</code></p>";
    }
?>