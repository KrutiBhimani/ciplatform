<html>
<head></head>
<body>
    <form method="post" id="report_filter" action="<?= $_SERVER['PHP_SELF']; ?>">
        <select name="name" onchange="document.getElementById('report_filter').submit();">
            <option value="--">Filter by:</option>
            <option value="1">Andi</option>
            <option value="2">Katy</option>
            <option value="3">Max</option>
        </select>
        <?
        if (isset($_POST['name'])) 
            $mem->StaffTodayFilterSummary($_POST['name']);
        else 
            $mem->StaffToday();
        
        ?>
    </form>
</body>

</html>
l