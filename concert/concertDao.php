<?php
class concertDao
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

    //가입인사 insert
    public function insertConcert($id,$name,$nick,$subject,$content,$regist_day,$hit,$is_html,$file_name_0,$file_name_1,
        $file_name_2, $file_copied_0, $file_copied_1, $file_copied_2){
        try {
            $query = $this->db->prepare("INSERT INTO concert (id,name,nick,subject,content,regist_day,
                                        hit,is_html,file_name_0,file_name_1,file_name_2,file_copied_0,file_copied_1,file_copied_2) 
                                        VALUES (:id, :name, :nick, :subject, :content, :regist_day,
                                            :hit, :is_html, :file_name_0, :file_name_1, :file_name_2, :file_copied_0, :file_copied_1, :file_copied_2)");
            $query->bindValue(":id",$id,PDO::PARAM_STR);
            $query->bindValue(":name",$name,PDO::PARAM_STR);
            $query->bindValue(":nick",$nick,PDO::PARAM_STR);
            $query->bindValue(":subject",$subject,PDO::PARAM_STR);
            $query->bindValue(":content",$content,PDO::PARAM_STR);
            $query->bindValue(":regist_day",$regist_day,PDO::PARAM_STR);
            $query->bindValue(":hit",$hit,PDO::PARAM_INT);
            $query->bindValue(":is_html",$is_html,PDO::PARAM_STR);
            $query->bindValue(":file_name_0",$file_name_0,PDO::PARAM_STR);
            $query->bindValue(":file_name_1",$file_name_1,PDO::PARAM_STR);
            $query->bindValue(":file_name_2",$file_name_2,PDO::PARAM_STR);
            $query->bindValue(":file_copied_0",$file_copied_0,PDO::PARAM_STR);
            $query->bindValue(":file_copied_1",$file_copied_1,PDO::PARAM_STR);
            $query->bindValue(":file_copied_2",$file_copied_2,PDO::PARAM_STR);
            $query->execute();

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    // 전체 게시글의 카운트 구하기
    public function countConcert(){
        try {
            $query = $this->db->prepare("SELECT COUNT(*) FROM concert");
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
            $query = $this->db->prepare("SELECT * FROM concert order by num desc LIMIT :start , :rows");
            $query->bindValue(":start",$start,PDO::PARAM_INT);
            $query->bindValue(":rows",$rows,PDO::PARAM_INT);
            $query->execute();
            $msgs = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $msgs;
    }

    // 전체 게시글 모두 구하기
    public function selectConcert(){
        try {
            $query = $this->db->prepare("SELECT * FROM concert order by num desc");
            $query->execute();
            $numMsgs = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }

    // 전체 게시글 모두 구하기
    public function selectOneConcert($num){
        try {
            $query = $this->db->prepare("SELECT * FROM concert WHERE num = :num");
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();
            $numMsgs = $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }

    // 게시글 하나 보기
    public function viewConcert($num){
        try {
            $query = $this->db->prepare("SELECT * FROM concert WHERE num = :num");
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();
            $numMsgs = $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }

    //조회수 증가
    public function increaseHit($num){
        try {
            $query = $this->db->prepare("UPDATE concert SET hit=hit+1 WHERE num = :num");
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    // 정보수정
    public function modifyConcert($subject,$content,$regist_day,$num){
        try {
            $query = $this->db->prepare
            ("UPDATE concert SET subject = :subject, content = :content, regist_day = :regist_day WHERE num = :num");

            $query->bindValue(":subject",$subject,PDO::PARAM_STR);
            $query->bindValue(":content",$content,PDO::PARAM_STR);
            $query->bindValue(":regist_day",$regist_day,PDO::PARAM_STR);
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    // 이미지만 삭제하는 수정할떄
    public function DelImgUpdate($field_org_name,$org_name_value,$field_real_name,$org_real_value,$num){
        try {
            $sql = "UPDATE concert SET ".$field_org_name."=:org_name_value, ".$field_real_name."=:org_real_value WHERE num = :num";
            $query = $this->db->prepare($sql);
            $query->bindValue(":org_name_value",$org_name_value,PDO::PARAM_STR);
            $query->bindValue(":org_real_value",'',PDO::PARAM_STR);
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    // 이미지만 수정할떄
    public function ImgUpdate($field_org_name,$org_name_value,$field_real_name,$org_real_value,$num){
        try {
            $sql = "UPDATE concert SET ".$field_org_name."=:org_name_value, ".$field_real_name."=:org_real_value WHERE num = :num";
            $query = $this->db->prepare($sql);
            $query->bindValue(":org_name_value",$org_name_value,PDO::PARAM_STR);
            $query->bindValue(":org_real_value",$org_real_value,PDO::PARAM_STR);
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }
    //정보삭제
    public function deleteConcert($num){
        try {
            $query = $this->db->prepare("DELETE FROM concert WHERE num = :num");
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }
}