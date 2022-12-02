<?php
if (isset($_SESSION['admin_data'])) {
    unset($_SESSION['admin_data']);
    session_destroy();
} else if (isset($_SESSION['user_data'])) {
    unset($_SESSION['user_data']);
    session_destroy();
}
?>
<script type="text/javascript">
    alert("logged out successfully.");
    window.location.href = 'login';
</script>