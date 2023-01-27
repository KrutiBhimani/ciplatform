<?php if (!isset($_SESSION['user_data'])) {
    $row = 4;
    $where = [
        'slug' => 'policy'
    ];
    $selectData = $this->SelectData12('cms_page', $where);
    $pages = $selectData['Data'];
    echo '<!DOCTYPE html>';
    include 'mvc/Views/home/header.php';
    include 'mvc/Views/home/policy.php';
    include 'mvc/Views/footer.php';
}
else{
    $user_id = $_SESSION['user_data']->user_id;
    $where = [
        'user_id' => $user_id
    ];
    $selectData = $this->SelectData1('user', $where);
    $user = $selectData['Data'];
    $row = 4;
    $where = [
        'slug' => 'policy'
    ];
    $selectData = $this->SelectData12('cms_page', $where);
    $pages = $selectData['Data'];
    if (isset($_POST['contact'])) {
        $insert_data = [
            'user_id' => $user->user_id,
            'subject' => $_POST['subject'],
            'message' => $_POST['message']
        ];
        $insertEx = $this->InsertData('contact', $insert_data);
    }
    echo '<!DOCTYPE html>';
    include 'mvc/Views/home/header.php';
    include 'mvc/Views/home/header1.php';
    include 'mvc/Views/home/policy.php';
    include 'mvc/Views/home/footer.php';
}

?>