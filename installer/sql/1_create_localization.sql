drop table __prefix__locale;
drop table __prefix__site;
create table __prefix__locale(id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, locale varchar(50) NOT NULL, name varchar(255) NOT NULL);
insert into __prefix__locale (locale, name) values ('en', 'English');
insert into __prefix__locale (locale, name) values ('de', 'German');
insert into __prefix__locale (locale, name) values ('fr', 'French');
create table __prefix__site(id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, site_key varchar(50) NOT NULL, site_value varchar(1024) NOT NULL);