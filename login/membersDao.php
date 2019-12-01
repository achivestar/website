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

    // 멤버 수(전체 레코드 수) 반환
    public function getNumMsgs(){
        try {
            $query = $this->db->prepare("SELECT COUNT(*) FROM memo");
            $query->execute();

            $numMsgs = $query->fetchColumn();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }

        return $numMsgs;
    }


    // 회원의 아이디 이미 있는지?
    public function selectMember($id){
        try {
            $query = $this->db->prepare("SELECT * FROM member WHERE id = :id");
            $query->bindValue(":id",$id,PDO::PARAM_STR);
            $query->execute();
            $id = $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $id;
    }

    public function selectNick($nick){
        try {
            $query = $this->db->prepare("SELECT * FROM member WHERE nick = :nick");
            $query->bindValue(":nick",$nick,PDO::PARAM_STR);
            $query->execute();
            $nick = $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $nick;
    }

    // 회원정보 수정하기
    public function updateMember($id,$pass,$name,$nick,$hp,$email,$regist_day){

        try{
            $query = $this->db->prepare("UPDATE member SET pass=:pass, name=:name, nick=:nick, hp=:hp, email=:email, regist_day=:regist_day WHERE id = :id ");
                $query->bindValue(":pass",$pass);
                $query->bindValue(":name",$name);
                $query->bindValue(":nick",$nick);
                $query->bindValue(":hp",$hp);
                $query->bindValue(":email",$email);
                $query->bindValue(":regist_day",$regist_day);
                $query->bindValue(":id",$id);
                $query->execute();
        }catch(PDOException $exception){
            exit($exception->getMessage());
        }
    }


}