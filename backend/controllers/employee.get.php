<?php
if (!session_id()) {
    session_start();
}

// 验证是否认证
if (!isset($_SESSION['verify_me']) || empty($_SESSION['verify_me'])) {
    echo "身份验证错误";
    die();
}
// 职工端权限验证
if (!isset($_SESSION['verify_me']['info']['yb_employid']) || empty($_SESSION['verify_me']['info']['yb_employid'])) {
    echo "身份权限错误";
    die();
}
$employeeInfo = isset($_SESSION['verify_me']['info']) ? trim($_SESSION['verify_me']['info']) : '';
if ($employeeInfo === '') {
    echo "身份验证错误";
    die();
}
