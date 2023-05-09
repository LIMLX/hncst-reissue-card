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
// 获取数据
$reissueReason = isset($_POST['reissueReason']) ? trim($_POST['reissueReason']) : '';
$collegeName   = isset($studentInfo['yb_collegename']) ? trim($studentInfo['yb_collegename']) : '';
$studentName   = isset($studentInfo['yb_realname']) ? trim($studentInfo['yb_realname']) : '';
$studentNum    = isset($studentInfo['yb_studentid']) ? trim($studentInfo['yb_studentid']) : '';
$studentClass  = isset($studentInfo['yb_classname']) ? trim($studentInfo['yb_classname']) : '';
// 验证是否获取是否成功
if ( $collegeName === '' || $studentName === '' || $studentNum === '' || $studentClass === '') {
    echo "身份数据获取错误";
    die();
}
if ($reissueReason === '') {
    echo "数据填写错误";
    die();
}
// 将数据存入对象内
$card = new Card();
$card->setReissueReason($reissueReason);
$card->setCollegeName($collegeName);
$card->setStudentName($studentName);
$card->setStudentNum($studentNum);
$card->setStudentClass($studentClass);
// 调用对象方法，进行数据插入
$studentCard = new StudentCardDAO();
$status = $studentCard->addReissueCard($card);

if ($status) {
    echo "succeed";
}