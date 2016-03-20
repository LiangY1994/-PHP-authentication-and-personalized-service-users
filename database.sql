CREATE DATABASE bookmarks;
USE bookmarks;
CREATE TABLE users(
    name char(30) not null PRIMARY KEY,
    password char(30) not null,
    email char(50) not null);

CREATE TABLE bookmark(
    name char(30) not null,
    bm_url char(50) not null,
    INDEX(name),
    INDEX(bm_url),
    PRIMARY KEY(name, bm_url));