<?php

require  '..\..\common\tools\db\PDOManager.php';

class WordDAO
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

    // 单个审核数据查询
    public function getCardOne(int $id) {
        $sql = "SELECT card_id,college_name,student_class,student_name,student_num,reissue_reason,employee_reason,reissue_status,reissue_create_time,reissue_update_time FROM reissue WHERE card_id =:p_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'p_id' => $id
        ]);
        $data = $stmt ->fetch();
        if(!isset($data)) {
            echo "NO";
            die();
        }
        $fileName = "${data['student_num']}-${data['student_name']}-${data['card_id']}.学生补办申请.docx";
        $filePath = $this->phpWord($data,$fileName);

        $this->down($filePath,$fileName);
    }
    // word文件处理(模板)
    public function phpWord ($array,$fileName) {

        require_once '../controllers/vendor/phpoffice/phpword/bootstrap.php';

        // 拷贝模板
        $moduleFile = "../../common/wordTemplate/学生补办学生证申请表模板.docx";
        $phpWord = new PhpOffice\PhpWord\TemplateProcessor($moduleFile);
        // 状态编辑
        $status = null;
        switch ($array['reissue_status']) {
            case 0 : $status = "待审核"; break;
            case 1 : $status = "审批通过"; break;
            case 2 : $status = "审批不通过"; break;
        }
        // 地点时间设置
        $workTime = "上午8:00-11:30 以及 下午2:30-5:00";
        $workplace = "综合楼11层1101";
        // 替换模板变量
        $phpWord->setValue("collegeName",$array["college_name"]);
        $phpWord->setValue("studentClass",$array["student_class"]);
        $phpWord->setValue("studentName",$array["student_name"]);
        $phpWord->setValue("studentNum",$array["student_num"]);
        $phpWord->setValue("status",$status);
        $phpWord->setValue("reissueReason",$array["reissue_reason"]);
        $phpWord->setValue("employeeName",$array["employee_name"]);
        $phpWord->setValue("employeeNum",$array["employee_num"]);
        $phpWord->setValue("employeeReason",$array["employee_reason"]);
        $phpWord->setValue("reissueTime",$array["reissue_create_time"]);
        $phpWord->setValue("workTime",$workTime);
        $phpWord->setValue("workplace",$workplace);
        var_dump($array);

        // 创建拷贝模板
        $filePath = "../web/complaintWord";
        $phpWord->saveAs("${fileName}");

        if (rename($fileName,"${filePath}/${fileName}")) {
            echo "ok";
        }
        return "${filePath}/${fileName}";
    }

    // 文件下载
    public function down($filePath,$name){
        header("Content-type:text/html;charset=utf-8");
        $file_path = iconv("utf-8","gbk",$filePath);
        $filename=iconv("utf-8","gbk",$name);

        if (!file_exists($file_path)){
            echo  "没有该文件";
            exit();
        } else {
            ob_clean();
            ob_start();
            $fp = fopen($file_path,"r");
            $file_size = filesize($file_path);
            Header("Content-type:application/octet-stream");
            Header("Accept-Ranges:bytes");
            Header("Accept-Length:".$file_size);
            header("Content-Disposition: attachment; filename*=UTF-8''".rawurlencode($name));
            $buffer=1024;
            $file_count=0;

            while (!feof($fp) && $file_count<$file_size ){
                $file_con=fread($fp,$buffer);
                $file_count +=$buffer;
                echo $file_con;
            }
            fclose($fp);
            ob_end_flush();
        }
    }
}