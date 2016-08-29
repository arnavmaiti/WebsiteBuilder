# User data
INSERT INTO __prefix__user_access(access) VALUES ('profile');
INSERT INTO __prefix__user_access(access) VALUES ('admin');
INSERT INTO __prefix__user_roles(rolename, accesses) VALUES ('administrator', '1,2');
INSERT INTO __prefix__user_roles(rolename, accesses) VALUES ('user', '1');
# Security questions
INSERT INTO __prefix__user_security_questions(secquestion) VALUES ('What was the name of your elementary / primary school?');
INSERT INTO __prefix__user_security_questions(secquestion) VALUES ('In what city or town does your nearest sibling live?');
INSERT INTO __prefix__user_security_questions(secquestion) VALUES ('What time of the day were you born? (hh:mm)?');