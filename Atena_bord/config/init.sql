create database athenaborad;

use athenaborad

GRANT ALL ON athenaborad.* TO 'dbuser'@'localhost';

create table athena_table (
    id int not null auto_increment primary key,
    email varchar(255) unique,
    password varchar(255),
    created datetime,
    modified datetime);

show columns from athena_table;