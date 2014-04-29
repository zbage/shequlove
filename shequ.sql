/*创建用户进入love的缓存，建议后期用memcache代替
 */
 drop table if exists love_imgcache;
 create table love_imgcache(
  id int(10) not null auto_increment primary key,
  fromusername varchar(30) not null,
  createtime  int(10) not null
 )engine=innoDB default charset=utf8;



drop table if exists love_accesstoken;
create table love_accesstoken(
  id int(10) not null auto_increment primary key,
  accesstoken varchar(255) not null,
  expirestime  int(10) not null
)engine=innoDB default charset=utf8;


drop table if exists love_userdata;
create table love_userdata(
  id int(10) not null auto_increment primary key,
  openid varchar(30) not null,
  createtime int(10) not null,
  lastlogintime int(10) not null
)engine=innoDB default charset=utf8;


drop table if exists love_userinfo;
create table love_userinfo(
  id int(10) not null auto_increment primary key,
  openid varchar(30) not null,
  valid  int(1) not null default 0,
  nickname varchar(30) not null,
  location int(2) not null,
  age int(2) ,
  sex int(1) not null,
  height int(3),
  profession varchar(20) not null,
  income int(2) not null,
  education int(1) not null,
  house int(1) not null,
  introduce varchar(400) not null,
  request varchar(400) not null,
  qqnum int(14),
  wxusername varchar(20) not null,
  phone int(11)
)engine=innoDB default charset=utf8; 


drop table if exists love_userconcern;
create table love_userattention(
id int(10) not null auto_increment primary key,
qqnum int(14) not null,
concern text not null comment '关注的人',
friend text not null comment '相互关注成为朋友的人',
concern_num int(10),
beconcerned_num int(10),
no_concern_message text not null comment '被关注，但是未添加朋友的信息id',
be_watched int(10) comment '被查看次数'
);
