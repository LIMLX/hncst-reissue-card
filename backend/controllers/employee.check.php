<?php
require "../models/EmployeeDAO.php";
require "../models/Card.php";
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
$employeeName = isset($employeeInfo['yb_realname']) ? trim($employeeInfo['yb_realname']) : '';
$employeeId = isset($employeeInfo['yb_employid']) ? trim($employeeInfo['yb_employid']) : '';

if (!ctype_digit($employeeName) || !ctype_digit($employeeId)) {
    echo "身份数据错误";
    die();
}
// 数据获取
$id = isset($_POST['id']) ? trim($_POST['id']) : '';
$reason = isset($_POST['reason']) ? trim($_POST['reason']) : '';
$status = isset($_POST['status']) ? trim($_POST['status']) : '';
// 数据效验
if (!ctype_digit($id) || !ctype_digit($reason) || !ctype_digit($status)) {
    echo "参数传递错误";
    die();
}
// 状态值效验
if ($status != 1 || $status != 2) {
    echo "参数传递错误";
    die();
}
$employeeDAO = new EmployeeDAO();
$card = new Card();
$card->setEmployeeName($employeeName);
$card->setEmployeeNum($employeeId);
$card->setCardId($id);
$card->setReissueStatus($status);
$card->setReissueReason($reason);
$check = $employeeDAO ->cardCheck($card);
if ($card) {
    echo "succeed";
    die();
}
echo "异常";