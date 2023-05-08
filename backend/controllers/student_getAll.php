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
$studentNum = isset($studentInfo['yb_studentid']) ? trim($studentInfo['yb_studentid']) : '';
// 调用对象方法，进行数据插入
$studentCard = new StudentCardDAO();
$cardDataArray = $studentCard->findCardAll($studentNum);
if ($cardDataArray) {
    echo json_encode($cardDataArray);
    die();
}
echo "异常";