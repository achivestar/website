<?php
/**
 * Created by PhpStorm.
 * User: sds
 * Date: 2019-11-26
 * Time: 오후 7:56
 */

class membersDao
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

    //member DB에 추가
    public function insertMember($id, $pass, $name, $nick, $hp, $email, $regist_day, $level){
        try {
            $query = $this->db->prepare("INSERT INTO member (id,pass,name,nick,hp,email,regist_day,level) 
                      VALUE (:id, :pass, :name, :nick, :hp, :email, :regist_day,:level)");
            $regtime = date("Y-m-d H:i:s");
            $level = 9;
            $query->bindValue(":id",$id,PDO::PARAM_STR);
            $query->bindValue(":pass",$pass,PDO::PARAM_STR);
            $query->bindValue(":name",$name,PDO::PARAM_STR);
            $query->bindValue(":nick",$nick,PDO::PARAM_STR);
            $query->bindValue(":hp",$hp,PDO::PARAM_STR);
            $query->bindValue(":email",$email,PDO::PARAM_STR);
            $query->bindValue(":regist_day",$regtime,PDO::PARAM_STR);
            $query->bindValue(":level",$level,PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    // 회원의 아이디 있는지?
    public function selectMember($id){
        try {
            $query = $this->db->prepare("SELECT * FROM member WHERE id=:id");
            $query->bindValue(":id",$id,PDO::PARAM_STR);
            $query->execute();
            $id = $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $id;
    }

}