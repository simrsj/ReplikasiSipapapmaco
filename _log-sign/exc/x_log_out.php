<?php
session_start();
$GLOBALS['idu'] = null;
session_destroy();
?>
<script>
	document.location.href = "?ls";
</script>