<?php
Class Book {
    private $code;
    private $title;
    private $desc;
    private $price;
    
   
    public function __construct($code, $title, $desc,$price) {
        $this->code = $code;
        $this->title = $title;
        $this->desc = $desc;
        $this->price = $price;
        
    
    }
    public function getBookId() {
        return $this->code;
    }
    public function getBookTitle() {
        return $this->title;
    }
    public function getDesc() {
        return $this->desc;
    }
    public function getprice(){
        return $this->price;
    }
}
class Customer{
    private $id;
    private $name;
    
    
    public function __construct($id, $name, $phone){
        $this->id = $id;
        $this->name = $name;
        
       
    }
 
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    
}

    Class Book {
    private $bookid;
    private $title;
    
    public function __construct($courseCode, $semesterCode) {
        $this->courseCode = $courseCode;
        $this->semesterCode = $semesterCode;
    }
    public function getCourseCode(){
        return $this->courseCode;
    }
    public function getSemesterCode(){
        return $this->semesterCode;
    }
}
Class Registration {
    private $studentId;
    private $courseCode;
    private $semesterCode;
    
    public function __construct($studentId, $courseCode, $semesterCode) {
        $this->studentId = $studentId;
        $this->courseCode = $courseCode;
        $this->semesterCode = $semesterCode;
    }
    
    public function getStudentId(){
        return $this->studentId;
    }
    public function getCourseCode(){
        return $this->courseCode;
    }
    public function getSemesterCode(){
        return$this->semesterCode;
    }
}
