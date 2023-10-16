CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    username VARCHAR(50),
    email VARCHAR(100),
    password VARCHAR(255),
    profile VARCHAR(255),
    is_admin TINYINT(1)
);

INSERT INTO users (first_name, last_name, username, email, password, profile, is_admin)
VALUES ('Gurnoor', 'Kaur', 'Gurnoor2018', 'gurnoor@example.com', 'password123', 'profile1.jpg', 1);

INSERT INTO users (first_name, last_name, username, email, password, profile, is_admin)
VALUES ('Sahib', 'Singh', 'Sahib2007', 'sahib@example.com', 'test12345', 'profile2.jpg', 0);

-- sql table for categories
CREATE TABLE categories (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50),
    description TEXT
);

-- table for posts management
CREATE TABLE posts (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    body TEXT,
    thumbnail VARCHAR(255),
    date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    category_id INT(11),
    author_id INT(11),
    is_featured TINYINT(1)
);

Alter table posts add constraint FK_blog_category foreign key (category_id) references categories (id) on delete set null;
alter table posts add constraint FK_blog_author foreign key (author_id) references users (id) on delete cascade;
