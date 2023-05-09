<?php

require  __DIR__.'..\..\..\common\tools\db\PDOManager.php';
require_once 'Classes.php';

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
        $sql = "SELECT college_name,student_name,student_num,student_class,reissue_reason,employee_reason,reissue_status,reissue_create_time,reissue_update_time FROM reissue WHERE card_id =:p_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'p_id' => $id
        ]);
        $cardData = $stmt ->fetch(PDO::FETCH_ASSOC);
        if (!$stmt->rowCount()) {
            return false;
        }
        return $cardData;
    }

    // 职工查询所有申请数据
    public function findCardAll (string $employeeId) {
        $arrs =$this->getManagerialClasses($employeeId);
        $classNameArr = array();
        $i=0;
        foreach ($arrs as $arr){
            $classNameArr[$i] = $arr->getclassesName();
            $i++;
        }
        $sql = "SELECT reissue_reason,reissue_status,reissue_create_time FROM reissue WHERE student_class IN (:p_classArr)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'p_classArr' => implode(',',$classNameArr)
        ]);
        $data = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    // 职工审批
    public function cardCheck(Card $card) : bool{
        $sql = "UPDATE reissue SET employee_name= :p_employeeName, employee_num=:p_employeeNum , employee_reason=:p_reason, reissue_status=:p_status WHERE card_id = :p_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'p_employeeName' => $card->getEmployeeName(),'p_employeeNum' => $card->getEmployeeNum(),
            'p_reason' => $card->getEmployeeReason(), 'p_status' => $card->getReissueStatus(),
            'p_id' => $card->getCardId()
        ]);

        $count = $stmt->rowcount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    // 获取职工管理班级
    public function getManagerialClasses($id){
        $classesArray=array();                           //存储多个classes对象的数组
        $sql = 'SELECT * FROM classes where counselor_id like :p_id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['p_id' => '%'.$id.'%']);
        $i=0;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $classes = new Classes();
            $classes->setclassesID($row['classes_id']) ;
            $classes->setclassesName($row['classes_name']) ;
            $classes->setCounselorId($row['counselor_id']) ;
            $classesArray[$i] = $classes;
            $i++;
        }
        return $classesArray;
    }
}