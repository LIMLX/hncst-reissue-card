<?php
class Classes{
    const  TABLE_NAME = 'classes'; //常量，标识数据表的名称
    private $classesId = '';
    private $counselorId = '';
    private $classesName = '';

    /**
     * @return string
     */
    public function getClassesId()
    {
        return $this->classesId;
    }

    /**
     * @param string $classesId
     */
    public function setClassesId($classesId)
    {
        $this->classesId = $classesId;
    }

    /**
     * @return string
     */
    public function getCounselorId()
    {
            return $this->counselorId;
    }

    /**
     * @param string $counselorId
     */
    public function setCounselorId($counselorId)
    {
        $this->counselorId = $counselorId;
    }

    /**
     * @return string
     */
    public function getClassesName()
    {
        return $this->classesName;
    }

    /**
     * @param string $classesName
     */
    public function setClassesName($classesName)
    {
        $this->classesName = $classesName;
    }

}