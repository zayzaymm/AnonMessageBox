create database anonmessagebox;
CREATE TABLE data (id INT NOT NULL AUTO_INCREMENT, uid VARCHAR(255), link VARCHAR(255), title VARCHAR(300), message VARCHAR(60000),expired_time INT,expired_date INT,max_count INT, PRIMARY KEY (id)
);
