<?php
class galleryDao
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

    //이미지 삽입
    public function insertGallery($subject,$file_name_0,$file_copied_0){
        try {
            $query = $this->db->prepare("INSERT INTO gallery (subject,file_name_0,file_copied_0) 
                                        VALUES (:subject, :file_name_0, :file_copied_0)");
            $query->bindValue(":subject",$subject,PDO::PARAM_STR);
            $query->bindValue(":file_name_0",$file_name_0,PDO::PARAM_STR);
            $query->bindValue(":file_copied_0",$file_copied_0,PDO::PARAM_STR);

            $query->execute();

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }


    // 전체 게시글의 카운트 구하기
    public function countGallery(){
        try {
            $query = $this->db->prepare("SELECT COUNT(*) FROM gallery");
            $query->execute();
            $numMsgs = $query->fetchColumn();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }


    // 전체 게시글 모두 구하기
    public function selectGallery(){
        try {
            $query = $this->db->prepare("SELECT * FROM gallery  order by num desc");
            $query->execute();
            $numMsgs = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }





}