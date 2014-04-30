
CREATE TABLE article (
  articleId integer PRIMARY KEY AUTOINCREMENT NOT NULL,
  title varchar(255) NOT NULL,
  slug varchar(255) NOT NULL,
  content text NOT NULL,
  description text NOT NULL,
  keywords text NOT NULL,
  pageHits integer(128) NOT NULL,
  dateCreated text(128) NOT NULL,
  dateModified text(128) NOT NULL
);
CREATE UNIQUE INDEX slug ON article (slug ASC);
CREATE UNIQUE INDEX articleId ON article (articleId ASC);