<?php
require '../models/StudentCardDAO.php';

if (!session_id()) {
    session_start();
}

// 验证是否认证
if (!isset($_SESSION['verify_me']) || empty($_SESSION['verify_me'])) {
    echo "身份验证错误";
    die();
}
$studentInfo = '';
if (isset($_SESSION['verify_me']['info']) && !empty($_SESSION['verify_me']['info'])) {
    $studentInfo =$_SESSION['verify_me']['info'];
}
if ($studentInfo === '') {
    echo "身份验证错误";
    die();
}

$id = isset($_GET['id']) ? trim($_GET['id']) : '';
if (!ctype_digit($id)) {
    echo "参数传递错误";
    die();
}
$studentNum = isset($studentInfo['yb_studentid']) ? trim($studentInfo['yb_studentid']) : '';
// 调用对象方法，进行数据插入
$studentCard = new StudentCardDAO();
$cardData = $studentCard->findCardOne($id,$studentNum);
if ($cardData) {
    echo json_encode($cardData);
    die();
}
echo "异常";
