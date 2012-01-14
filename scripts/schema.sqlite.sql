create table proglang (
    id integer not null primary key autoincrement,
    language_name varchar(255) not null,
    language_description longtext not null,
    unique(language_name)
);