CREATE TABLE posts (
	id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    subject varchar(128) not null,
    content varchar(500) not null,
    date datetime() not null
);

-- Examples
INSERT INTO posts (subject, content, date) VALUES ('First post', 'Hey all this is the first post', '2023-01-12 10:59:01');
INSERT INTO posts (subject, content, date) VALUES ('Second post', 'Hey all this is the second post', CURRENT_TIMESTAMP);

SELECT * FROM posts WHERE id = '1';

UPDATE posts
SET subject='Updated Subject', content='Updated content'
WHERE id='1';

DELETE FROM posts
WHERE id='1';

SELECT * FROM `posts` ORDER BY subject DESC;

-- alter col name
ALTER TABLE table_name
ADD column_name column_name datatype;