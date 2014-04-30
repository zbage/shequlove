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
)engine=innoDB default charset=utf8;


drop table if exists love_userinfo;
create table love_userinfo(
  id int(10) not null auto_increment primary key,
  openid varchar(30) not null,
  valid  int(1) not null default 0,
  photo varchar(35),
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
  phone int(11),
  bewatch int(10) not null default 0
  lastlogintime int(10) not null
)engine=innoDB default charset=utf8; 




drop table if exists love_userconcern;
create table love_userconcern(
  id int(20) not null auto_increment primary key,
  uid int(10) not null comment "关注用户的ｉｄ",
  uuid int(10) not null comment "被关注用户的ｉｄ",
)engine=innoDB default charset=utf8;


drop table if exists love_usermess;
create table love_usermess(
 id int(20) not null auto_increment primary key,
 mess varchar(100),
 checked int(1) comment "信息是否已被查看"
)engine=innoDB default charset=utf8;

