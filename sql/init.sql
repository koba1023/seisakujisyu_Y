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
USE seisaku;
# テーブルitemsの作成
drop table if exists items;
# テーブルitemsの作成
create table items(
    name varchar(50) not null,
    town	varchar(50) not null,
    dosha varchar(10) not null,
    kouzui varchar(10) not null,
    tunami varchar(10) not null,
    petto varchar(10) not null
    );
    
#テーブルitemsへデータを入力
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘高校','深江北町', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('神戸大学海洋政策科学部','深江南町', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('魚崎小学校','魚崎中町', 'yes', 'yes', 'yes', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('灘中・高校','魚崎中町', 'yes', 'yes', 'yes', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
insert into items(name, town, dosha, kouzui, tunami, petto)
	values('東灘小学校','深江北町', 'yes', 'yes', 'yes', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄小学校','青木', 'yes', 'yes', 'no', 'no');
insert into items(name, town, dosha, kouzui, tunami, petto)
    values('本庄中学校','青木', 'yes', 'yes', 'no', 'yes');
