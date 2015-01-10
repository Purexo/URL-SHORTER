CREATE DATABASE shorter;
USE shorter;

CREATE TABLE links (
  id bigint unsigned NOT NULL AUTO_INCREMENT,
  link text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id)
);