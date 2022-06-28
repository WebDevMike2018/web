create database {database};
create user '{user}'@'localhost' identified by '{password}';
grant all on {database}.* to '{user}'@'localhost';
