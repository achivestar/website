<?php
class latestDao
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

    // 해당 테이블의 데이터들 반환
    public function get_latest($table,$loop){
        try {
            $sql = "SELECT * FROM $table ORDER BY num desc LIMIT $loop";
            $query = $this->db->prepare($sql);
           /* $query->bindValue(":tables",$table,PDO::PARAM_STR);
            $query->bindValue(":loop",$loop,PDO::PARAM_INT);*/
            $query->execute();
            $msgs = $query->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }

        return $msgs;
    }

    // 해당 테이블의 데이터들 반환
    public function get_latest_survey($table,$loop){
        try {
            $sql = "SELECT * FROM $table ORDER BY num desc LIMIT $loop";
            $query = $this->db->prepare($sql);
            /* $query->bindValue(":tables",$table,PDO::PARAM_STR);
             $query->bindValue(":loop",$loop,PDO::PARAM_INT);*/
            $query->execute();
            $msgs = $query->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }

        return $msgs;
    }

    // 해당 테이블의 데이터들 반환
    public function get_latest_gallery_first($table){
        try {
            $sql = "SELECT * FROM $table  ORDER BY num desc LIMIT 1";
            $query = $this->db->prepare($sql);
            $query->execute();
            $msgs = $query->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }

        return $msgs;
    }

    // 해당 테이블의 데이터들 반환
    public function get_latest_gallery_last($table){
        try {
            $sql = "SELECT * FROM $table  ORDER BY num desc LIMIT 1,3";
            $query = $this->db->prepare($sql);
            $query->execute();
            $msgs = $query->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }

        return $msgs;
    }
}