# User tables
drop table __prefix__user;
create table __prefix__user(id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, username varchar(255) NOT NULL, password varchar(255) NOT NULL, lastlogin int(100), role int(5) NOT NULL);
drop table __prefix__user_details;
create table __prefix__user_details(id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, userid int(11) NOT NULL, firstname varchar(255), lastname varchar(255), middlename varchar(255), dateofbirth int(100), secquestion int(11) NOT NULL, secanswer varchar(255) NOT NULL);
drop table __prefix__user_roles;
create table __prefix__user_security_questions(id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, secquestion varchar(255));
drop table __prefix__user_roles;
create table __prefix__user_roles(id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, rolename varchar(255) NOT NULL, accesses varchar(255) NOT NULL);
drop table __prefix__user_access;
create table __prefix__user_access(id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, access varchar(255) NOT NULL);