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
            if($query->execute()){
                echo "1";
            }else{
                echo "2";
            }



        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }


    }

    //memoRipple DB에 추가
    public function insertMemoRipple($num,$id,$name,$nick,$content,$regist_day){
        try {
            $query = $this->db->prepare("INSERT INTO memo_ripple (parent,id,name,nick,content,regist_day) 
              VALUE (:num,:id, :name, :nick, :content, :regist_day)");
            $query->bindValue(":num",$num,PDO::PARAM_INT);
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


    //memo DB에서 삭제
    public function  deleteMemo($num){
        try {

            $query = $this->db->prepare("DELETE FROM memo WHERE num = :num");
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();


        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }


    //memo_ripple DB에서 삭제
    public function  delete_rippleMemo($num){
        try {
            $query = $this->db->prepare("DELETE FROM memo_ripple WHERE num = :num");
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    //memo_ripple DB에서 삭제
    public function  delete_rippleMemos($num){
        try {
            $query = $this->db->prepare("DELETE FROM memo_ripple WHERE parent = :num");
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    //memo의 전체 레코드 반환
    public function selectMemoRipple($num){
        try {
            $query = $this->db->prepare("SELECT * FROM memo_ripple where parent = :num  order by num desc LIMIT 3");
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();
            $numMemoRipple = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMemoRipple;
    }




    public function getCommentMsgs($lastMsg,$parent){
        try {
            $numMsgs = "";
            $query = $this->db->prepare("SELECT * FROM memo_ripple where num < :lastmsg and parent = :parent order by num desc LIMIT 3");
            $query->bindValue(":lastmsg",$lastMsg,PDO::PARAM_INT);
            $query->bindValue(":parent",$parent,PDO::PARAM_INT);
            $query->execute();
            $numMsgs = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }

    // 메모장의 리플 전체 글 수(전체 레코드 수) 반환
    public function getNumRippleMsgs($parent){
        try {
            $query = $this->db->prepare("SELECT COUNT(*) FROM memo_ripple WHERE parent = :parent");
            $query->bindValue(":parent",$parent,PDO::PARAM_INT);
            $query->execute();
            $numMsgs = $query->fetchColumn();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }

    // 메모장의 전체 글 수(전체 레코드 수) 반환
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


    // $start번부터 $rows 개의 게시글 데이터 반환 (2차원배열)
    public function getManyMsgs($start, $rows){
        try {
            $query = $this->db->prepare("SELECT * FROM memo order by num desc LIMIT :start , :rows");
            $query->bindValue(":start",$start,PDO::PARAM_INT);
            $query->bindValue(":rows",$rows,PDO::PARAM_INT);
            $query->execute();
            $msgs = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $msgs;
    }

}