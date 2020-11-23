<?php
session_start();
session_destroy();
echo "
<script>alert('Log Out Successful!')</script>
<script>parent.location.href = 'login.php'</script>
";