-- Active: 1691562866724@@127.0.0.1@3306@asm
-- tạo database
create database if not exists ASM;
use ASM;
-- tạo bảng

create table if not exists users (
	id INT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(250) NOT NULL UNIQUE,
	name VARCHAR(150) NOT NULL,
	avata VARCHAR(2000) NOT NULL,
    token VARCHAR(2000)  NOT NULL
);


create table if not exists lichthi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date VARCHAR(100) NOT NULL,
    idcourse INT NOT NULL,
    address VARCHAR(250) NOT NULL,
    ca INT NOT NULL,
    FOREIGN KEY (idcourse) REFERENCES course(id)
);

create table if not exists lichthinn (
    id INT PRIMARY KEY AUTO_INCREMENT,
    iduser INT NOT NULL,
    idlichthi INT NOT NULL,
    FOREIGN KEY (iduser) REFERENCES users(id),
    FOREIGN KEY (idlichthi) REFERENCES lichthi(id)
);

create table if not exists course (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(250) NOT NULL,
    teacher VARCHAR(250) NOT NULL,
    typecourseid INT NOT NULL,
    FOREIGN KEY (typecourseid) REFERENCES typecourse(id)
);

create table if not exists typecourse (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(250) NOT NULL
);
create table if not exists lichhoc (
    id INT PRIMARY KEY AUTO_INCREMENT,
    courseid INT NOT NULL,
    ca INT NOT NULL,
    address VARCHAR(250) NOT NULL,
    date VARCHAR(250) NOT NULL,
    FOREIGN KEY (courseid) REFERENCES course(id)
);

create table if not exists lichhocnn (
    id INT PRIMARY KEY AUTO_INCREMENT,
    iduser INT NOT NULL,
    idlichhoc INT NOT NULL,
    FOREIGN KEY (iduser) REFERENCES users(id),
    FOREIGN KEY (idlichhoc) REFERENCES lichhoc(id)
);
create table if not exists news (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(250) NOT NULL,
    content VARCHAR(2000) NOT NULL,
    date VARCHAR(250) NOT NULL,
    resource VARCHAR(500) NOT NULL
);

create table if not exists thongbao (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(250) NOT NULL,
    content VARCHAR(2000) NOT NULL,
    date VARCHAR(250) NOT NULL,
    iduser int NOT NULL,
    FOREIGN KEY (iduser) REFERENCES users(id)
);

create table if not exists coso (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(250) NOT NULL
);

create table if not exists cosonn (
    id INT PRIMARY KEY AUTO_INCREMENT,
    iduser INT NOT NULL,
    idcoso INT NOT NULL,
    FOREIGN KEY (iduser) REFERENCES users(id),
    FOREIGN KEY (idcoso) REFERENCES coso(id)
);
