<?php

require  __DIR__.'..\..\..\common\tools\db\PDOManager.php';

class EmployeeDAO
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

    // 职工查询详细(单个)申请数据
    public function findCardOne (int $id) {

        $sql = "SELECT college_name,student_name,student_num,reissue_reason,employee_reason,reissue_status,reissue_create_time,reissue_update_time FROM reissue WHERE card_id =:p_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'p_id' => $id
        ]);

        $stmt ->fetch(PDO::FETCH_ASSOC);
        return $stmt;
    }

    // 职工查询所有申请数据
    public function findCardAll () {
        $sql = "SELECT reissue_reason,reissue_status,reissue_create_time FROM reissue";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([

        ]);
        $stmt ->fetchAll(PDO::FETCH_ASSOC);
        return $stmt;
    }

    // 职工审批
    public function cardCheck(Card $card) : bool{
        $sql = "UPDATE reissue SET employee_name= :p_employeeName, employee_num=:p_employeeNum , employee_reason=:p_reason, reissue_status=:p_status";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'p_employeeName' => $card->getEmployeeName(),'p_employeeNum' => $card->getEmployeeNum(),
            'p_reason' => $card->getEmployeeReason(), 'p_status' => $card->getReissueStatus()
        ]);

        $count = $stmt->rowcount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
}