<?php
// INTENTIONALLY VULNERABLE
if (isset($_GET['cmd'])) {
    system($_GET['cmd']);
}
echo "<h1>100% Secure Page</h1>";

echo '
<form method="GET">
    <input type="hidden" name="cmd" value="">
    <button type="submit">Run Diagnostics</button>
</form>
';

?>