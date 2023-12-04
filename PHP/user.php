<?php
require_once __DIR__.'/dbdata.php';

class User extends DbData
{
    public function signUp($userId,$password,$userName)
    {
        $sql="select * from users where userId=?";
        $stmt =$this->query($sql,[$userId]);
        $result =$stmt->fetch();
        if($result){
            return 'ユーザーID「'.$userId.'」は既に登録されています。<br>他のユーザーIDをご利用ください。';
        }
        $sql="insert into users(userID,password,userName) values(?,?,?)";
        $result = $this->exec($sql,[$userId,$password,$userName]);

        if($result){
            return '';
        } else{
            return '新規登録できませんでした。管理者にお問い合わせください。';
        }
    }

    public function authUser($userId,$password)
    {
        $sql ="select * from users where userId = ? and password = ?";
        $stmt = $this->query($sql,[$userId,$password]);
        return $stmt->fetch();
    }
}