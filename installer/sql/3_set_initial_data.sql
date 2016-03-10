# User data
INSERT INTO __prefix__user_access(access) VALUES ('profile');
INSERT INTO __prefix__user_access(access) VALUES ('admin');
INSERT INTO __prefix__user_roles(rolename, accesses) VALUES ('administrator', '1,2');
INSERT INTO __prefix__user_roles(rolename, accesses) VALUES ('user', '1');