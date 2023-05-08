<?php

class Card
{
    private $cardId;
    private $collegeName;
    private $studentName;
    private $studentNum;
    private $studentClass;
    private $reissueReason;
    private $employeeName;
    private $employeeNum;
    private $employeeReason;
    private $reissueStatus;
    private $reissueCreateTime;
    private $reissueUpdateTime;

    /**
     * @return mixed
     */
    public function getCardId()
    {
        return $this->cardId;
    }

    /**
     * @param mixed $cardId
     */
    public function setCardId($cardId): void
    {
        $this->cardId = $cardId;
    }

    /**
     * @return mixed
     */
    public function getCollegeName()
    {
        return $this->collegeName;
    }

    /**
     * @param mixed $collegeName
     */
    public function setCollegeName($collegeName): void
    {
        $this->collegeName = $collegeName;
    }

    /**
     * @return mixed
     */
    public function getStudentName()
    {
        return $this->studentName;
    }

    /**
     * @param mixed $studentName
     */
    public function setStudentName($studentName): void
    {
        $this->studentName = $studentName;
    }

    /**
     * @return mixed
     */
    public function getStudentNum()
    {
        return $this->studentNum;
    }

    /**
     * @param mixed $studentNum
     */
    public function setStudentNum($studentNum): void
    {
        $this->studentNum = $studentNum;
    }

    /**
     * @return mixed
     */
    public function getReissueReason()
    {
        return $this->reissueReason;
    }

    /**
     * @param mixed $reissueReason
     */
    public function setReissueReason($reissueReason): void
    {
        $this->reissueReason = $reissueReason;
    }

    /**
     * @return mixed
     */
    public function getEmployeeReason()
    {
        return $this->employeeReason;
    }

    /**
     * @param mixed $employeeReason
     */
    public function setEmployeeReason($employeeReason): void
    {
        $this->employeeReason = $employeeReason;
    }

    /**
     * @return mixed
     */
    public function getReissueStatus()
    {
        return $this->reissueStatus;
    }

    /**
     * @param mixed $reissueStatus
     */
    public function setReissueStatus($reissueStatus): void
    {
        $this->reissueStatus = $reissueStatus;
    }

    /**
     * @return mixed
     */
    public function getReissueCreateTime()
    {
        return $this->reissueCreateTime;
    }

    /**
     * @param mixed $reissueCreateTime
     */
    public function setReissueCreateTime($reissueCreateTime): void
    {
        $this->reissueCreateTime = $reissueCreateTime;
    }

    /**
     * @return mixed
     */
    public function getReissueUpdateTime()
    {
        return $this->reissueUpdateTime;
    }

    /**
     * @param mixed $reissueUpdateTime
     */
    public function setReissueUpdateTime($reissueUpdateTime): void
    {
        $this->reissueUpdateTime = $reissueUpdateTime;
    }

    /**
     * @return mixed
     */
    public function getEmployeeName()
    {
        return $this->employeeName;
    }

    /**
     * @param mixed $employeeName
     */
    public function setEmployeeName($employeeName): void
    {
        $this->employeeName = $employeeName;
    }

    /**
     * @return mixed
     */
    public function getEmployeeNum()
    {
        return $this->employeeNum;
    }

    /**
     * @param mixed $employeeNum
     */
    public function setEmployeeNum($employeeNum): void
    {
        $this->employeeNum = $employeeNum;
    }

    /**
     * @return mixed
     */
    public function getStudentClass()
    {
        return $this->studentClass;
    }

    /**
     * @param mixed $studentClass
     */
    public function setStudentClass($studentClass): void
    {
        $this->studentClass = $studentClass;
    }

}