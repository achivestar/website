<?php
class surveyDao
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=kkameun","kkameun","qkagksmf1!");
            $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->db->exec("set names utf8"); // 한글 깨짐 방지
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }


    // 전체 게시글의 카운트 구하기
    public function countSurvey(){
        try {
            $query = $this->db->prepare("SELECT COUNT(*) FROM survey");
            $query->execute();
            $numMsgs = $query->fetchColumn();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }


    // 전체 게시글 모두 구하기
    public function selectSurvey(){
        try {
            $query = $this->db->prepare("SELECT * FROM survey order by num desc");
            $query->execute();
            $numMsgs = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }



    //선택된 항목의 포인트 증가
    public function update($num,$composer){
        try {
            $sql = "UPDATE survey SET ".$composer."=".$composer."+5 WHERE num = ".$num;
            $query = $this->db->prepare($sql);
            $query->bindValue(":composer",$composer,PDO::PARAM_STR);
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    //선택된 항목의 포인트 증가
    public function insert($subject,$class_name_0,$class_name_1,$class_name_2,$class_name_3,$chart){
        try {
            $sql = "INSERT INTO survey (subject,class_name_0,class_name_1,class_name_2,class_name_3,point_0,point_1,point_2,point_3,chart) VALUES (:subject,:class_name_0,:class_name_1,:class_name_2,:class_name_3,:point_0,:point_1,:point_2,:point_3,:chart)";
            $query = $this->db->prepare($sql);
            $query->bindValue(":subject",$subject,PDO::PARAM_STR);
            $query->bindValue(":class_name_0",$class_name_0,PDO::PARAM_STR);
            $query->bindValue(":class_name_1",$class_name_1,PDO::PARAM_STR);
            $query->bindValue(":class_name_2",$class_name_2,PDO::PARAM_STR);
            $query->bindValue(":class_name_3",$class_name_3,PDO::PARAM_STR);
            $query->bindValue(":point_0",5,PDO::PARAM_INT);
            $query->bindValue(":point_1",5,PDO::PARAM_INT);
            $query->bindValue(":point_2",5,PDO::PARAM_INT);
            $query->bindValue(":point_3",5,PDO::PARAM_INT);
            $query->bindValue(":chart",$chart,PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

}