<?php
require "../models/EmployeeDAO.php";

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
$employeeInfo = '';
if (isset($_SESSION['verify_me']['info']) && !empty($_SESSION['verify_me']['info'])) {
    $employeeInfo =$_SESSION['verify_me']['info'];
}
if ($employeeInfo === '') {
    echo "身份验证错误";
    die();
}
$employeeNum = isset($employeeInfo['yb_employid']) ? trim($employeeInfo['yb_employid']) : '';
if (empty($employeeNum)) {
    echo "参数错误";
    die();
}
$employeeDAO = new EmployeeDAO();
$cardDataArray = $employeeDAO ->findCardAll($employeeNum);
if ($cardDataArray) {
    echo json_encode($cardDataArray);
    die();
}
echo "异常";