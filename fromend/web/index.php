<?php

if (!session_id()) {
    session_start();
}

// 学生端
//$_SESSION['stuVisitor'] = '102';
//$_SESSION['userName'] = "门";
//$_SESSION['collegeName'] = "";
//$_SESSION['class'] = "21软件303";
//$_SESSION['stuVisitor'] = "2021013428";

// 教师端
$_SESSION['eacherVisitor'] = 1;
$_SESSION['userName'] = "x老师";
$_SESSION['teacherVisitor'] = "123456";

// 获取session数据，为空时，拦截访问
if (!isset($_SESSION['stuVisitor']) && !isset($_SESSION['eacherVisitor'])) {
    die('<script>alert("身份验证错误，请进行身份认证后访问本应用");</script>');
}

// 学生端获取
if (isset($_SESSION['stuVisitor']) || !empty($_SESSION['stuVisitor'])) {
    echo "学生端";
    $verify_me = [
        "status" => "success",
        "info" => [
            "yb_realname" => $_SESSION['userName'],
            "yb_collegename" => $_SESSION['collegeName'],
            "yb_classname" => $_SESSION['class'],
            "yb_studentid" => $_SESSION['stuVisitor']
        ]
    ];
}
// 教师端访问
else if (isset($_SESSION['eacherVisitor']) || !empty($_SESSION['eacherVisitor'])) {
    echo "教师端";
    $verify_me = [
        "status" => "success",
        "info" => [
            "yb_realname" =>$_SESSION['userName'],
            "yb_employid" => $_SESSION['teacherVisitor']
        ]
    ];
}

if ($verify_me['status'] != "success") {
    die('<script>alert("网络连接错误");</script>');
}

// 存入session
$_SESSION['verify_me'] = $verify_me;
?>

