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