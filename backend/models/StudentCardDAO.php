<?php

require  '..\..\common\tools\db\PDOManager.php';
require 'Card.php';

class StudentCardDAO
{
    private $db; //PDO对象

    /**
     * 构造方法,创建PDO对象。
     * @param null
     * @return null
     */
    public function __construct(){
        $PDO = PDOManager::getInstance();
        $this->db = $PDO->getDB();
    }

    // 学生申请数据
    public function addReissueCard (Card $card) : bool {
        try{
            $sql = "INSERT INTO reissue (college_name,student_name,student_num,student_class,reissue_reason) VALUES (:p_collegeName,:p_studentName,:p_studentNum,:p_studentClass,:p_reissueReason)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'p_collegeName' => $card->getCollegeName(),'p_studentName' => $card->getStudentName(),
                'p_studentNum' => $card->getStudentNum(),'p_studentClass'=>$card->getStudentClass(),
                'p_reissueReason' =>$card->getReissueReason()
            ]);

            $count = $stmt->rowcount();
            if ($count > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // 异常处理代码
            echo "执行 SQL 语句出现异常：" . $e->getMessage();
            return false;
        }
    }

    // 访问学生的详细(单个)申请数据
    public function findCardOne (int $id,string $studentNum) {
        try {
            $sql = "SELECT college_name,student_name,student_num,reissue_reason,employee_reason,reissue_status,reissue_create_time,reissue_update_time FROM reissue WHERE card_id =:p_id AND student_num = :p_studentNum";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'p_id' => $id,'p_studentNum'=>$studentNum
            ]);
            $cardData = $stmt ->fetch(PDO::FETCH_ASSOC);
            if (!$stmt->rowCount()) {
                return false;
            }
            return $cardData;
        } catch (PDOException $e) {
            // 异常处理代码
            echo "执行 SQL 语句出现异常：" . $e->getMessage();
            return false;
        }
    }

    // 访问学生的所有申请数据
    public function findCardAll (string $studentNum) {
        $sql = "SELECT reissue_reason,reissue_status,reissue_create_time FROM reissue WHERE student_num = :p_studentNum";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'p_studentNum' => $studentNum
        ]);
        $cardDataArr = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        if (!$stmt->rowCount()) {
            return false;
        }
        return $cardDataArr;
    }
}