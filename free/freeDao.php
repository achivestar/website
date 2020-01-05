<?php


class freeDao
{
    public function freeDao()
    {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=kkameun","kkameun","qkagksmf1!");
            $this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->db->exec("set names utf8"); // 한글 깨짐 방지
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    //게시판 글 insert
    public function insertFree($id,$name,$nick,$subject,$content,$regist_day,$hit,$is_html,$file_name_0,$file_name_1,
                                  $file_name_2, $file_copied_0, $file_copied_1, $file_copied_2){
        try {
            $query = $this->db->prepare("INSERT INTO free (id,name,nick,subject,content,regist_day,
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
    public function countFree(){
        try {
            $query = $this->db->prepare("SELECT COUNT(*) FROM free");
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
            $query = $this->db->prepare("SELECT * FROM free order by num desc LIMIT :start , :rows");
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
    public function selectFree(){
        try {
            $query = $this->db->prepare("SELECT * FROM free order by num desc");
            $query->execute();
            $numMsgs = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }


    // 전체 게시글 모두 구하기
    public function selectOneFree($num){
        try {
            $query = $this->db->prepare("SELECT * FROM free WHERE num = :num");
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();
            $numMsgs = $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }

    // 검색  쿼리
    public function searchFree($search){
        try {
            $sql = "select * from free where subject like '%".$search."%' or content like '%".$search."%' ";
            $query = $this->db->prepare($sql);
            $query->execute();
            $numMsgs = $query->fetchAll();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }

    //검색결과 게시글의 카운트
   public function searchFreeCount($search){
        try {
            $sql = "select COUNT(*) from free where subject like '%".$search."%' or content like '%".$search."%' ";
            $query = $this->db->prepare($sql);
            $query->execute();
            $numMsgs = $query->fetchColumn();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }

    // 게시글 하나 보기
    public function viewFree($num){
        try {
            $query = $this->db->prepare("SELECT * FROM free WHERE num = :num");
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
            $query = $this->db->prepare("UPDATE free SET hit=hit+1 WHERE num = :num");
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    // 정보수정
    public function modifyFree($subject,$content,$regist_day,$num){
        try {
            $query = $this->db->prepare
            ("UPDATE free SET subject = :subject, content = :content, regist_day = :regist_day WHERE num = :num");

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
            $sql = "UPDATE free SET ".$field_org_name."=:org_name_value, ".$field_real_name."=:org_real_value WHERE num = :num";
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
            $sql = "UPDATE free SET ".$field_org_name."=:org_name_value, ".$field_real_name."=:org_real_value WHERE num = :num";
            $query = $this->db->prepare($sql);
            $query->bindValue(":org_name_value",$org_name_value,PDO::PARAM_STR);
            $query->bindValue(":org_real_value",$org_real_value,PDO::PARAM_STR);
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    //memoRipple DB에 추가
    public function insertFreeRipple($num,$id,$name,$nick,$content,$regist_day){
        try {
            $query = $this->db->prepare("INSERT INTO free_ripple (parent,id,name,nick,content,regist_day) 
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

    // 게시판의 리플 전체 글 수(전체 레코드 수) 반환
    public function getNumRippleMsgs($parent){
        try {
            $query = $this->db->prepare("SELECT COUNT(*) FROM free_ripple WHERE parent = :parent");
            $query->bindValue(":parent",$parent,PDO::PARAM_INT);
            $query->execute();
            $numMsgs = $query->fetchColumn();
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }

    //댓글 전체 레코드 반환
    public function selectFreeRipple($num){
        try {
            $query = $this->db->prepare("SELECT * FROM free_ripple where parent = :num  order by num desc LIMIT 3");
           // $query = $this->db->prepare("SELECT * FROM free_ripple where parent = :num  order by num desc");
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
            $query = $this->db->prepare("SELECT * FROM free_ripple where num < :lastmsg and parent = :parent order by num desc LIMIT 3");
            $query->bindValue(":lastmsg",$lastMsg,PDO::PARAM_INT);
            $query->bindValue(":parent",$parent,PDO::PARAM_INT);
            $query->execute();
            $numMsgs = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
        return $numMsgs;
    }


    //게시글 삭제
    public function deleteFree($num){
        try {
            $query = $this->db->prepare("DELETE FROM free WHERE num = :num");
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    //게시글의 리플들 삭제
    public function deleteFreeRipple($parent,$num){
        try {
            $query = $this->db->prepare("DELETE FROM free_ripple WHERE parent = :parent and num = :num");
            $query->bindValue(":parent",$parent,PDO::PARAM_INT);
            $query->bindValue(":num",$num,PDO::PARAM_INT);
            $query->execute();

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

}
?>