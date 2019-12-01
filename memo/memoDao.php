<?php
/**
 * Created by PhpStorm.
 * User: sds
 * Date: 2019-12-01
 * Time: 오후 9:50
 */

class memoDao
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=php_db","root","");
            $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->db->exec("set names utf8"); // 한글 깨짐 방지
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    //memo의 전체 레코드 반환
    public function selectMemo(){
        try {
            $query = $this->db->prepare("SELECT * FROM memo order by num desc");
            $query->execute();
            $numMsgs = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }

    //memo DB에 추가
    public function insertMemo($id,$name,$nick,$content,$regist_day){
        try {
            $query = $this->db->prepare("INSERT INTO memo (id,name,nick,content,regist_day) 
              VALUE (:id, :name, :nick, :content, :regist_day)");
            $query->bindValue(":id",$id,PDO::PARAM_STR);
            $query->bindValue(":name",$name,PDO::PARAM_STR);
            $query->bindValue(":nick",$nick,PDO::PARAM_STR);
            $query->bindValue(":content",$content,PDO::PARAM_STR);
            $query->bindValue(":regist_day",$regist_day,PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

}