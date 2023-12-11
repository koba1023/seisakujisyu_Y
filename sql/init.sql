drop table if exists users;
create table users(
    userId	      varchar(50) primary key,
    userName	    varchar(50) not null,
    kana	        varchar(50) not null,
    zip           char(7) default '',
    address			  varchar(50) default '',
    tel				    varchar(20) default '',
    password      varchar(20)
);

# テーブルusersへデータを入力
insert into users(userId, userName, kana, zip, address, tel, password)
 values('kobe@denshi.net', '神戸　電子', 'コウベ　デンシ', '6500002', '神戸市中央区北野町1-1-8',
 '078-242-0014', 'kobedenshi');

 # 新しいデータベースの作成
CREATE DATABASE IF NOT EXISTS seisaku;
# データベースの選択
USE items;
# テーブルitemsの作成
drop table if exists items;
# テーブルitemsの作成
create table items(
    name varchar(50) not null,
    address	varchar(50) not null,
    dosha varchar(10) not null,
    kouzui varchar(10) not null,
    tunami varchar(10) not null,
    petto varchar(10) not null
    );
    
#テーブルitemsへデータを入力
insert into items(name, address, dosha, kouzui, tunami, petto)
	values('東灘小学校', '深江北町', 'yes', 'yes', 'yes', 'no');