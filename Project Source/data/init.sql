CREATE DATABASE IF NOT EXISTS thedirectorsdb;

USE thedirectorsdb;

CREATE TABLE IF NOT EXISTS users (
    userid INT NOT NULL PRIMARY KEY,
    username VARCHAR(45),
    email VARCHAR(45),
    pass VARCHAR(45),
    age INT,
    userscore INT
    );

CREATE TABLE IF NOT EXISTS movies (
    movieid INT NOT NULL PRIMARY KEY,
    title VARCHAR(255),
    genre VARCHAR(45),
    ticket_price INT
    );

CREATE TABLE IF NOT EXISTS review (
    reviewid INT NOT NULL PRIMARY KEY,
    review_text VARCHAR(200),
    moviescore INT,
    movieid INT,
    userid INT,
    FOREIGN KEY (movieid) REFERENCES movies(movieid) ON DELETE CASCADE,
    FOREIGN KEY (userid) REFERENCES users(userid) ON DELETE CASCADE
    );

CREATE TABLE IF NOT EXISTS booking (
     bookingid INT NOT NULL PRIMARY KEY,
    date DATE,
     seating INT,
     movieid INT,
     userid INT,
     FOREIGN KEY (movieid) REFERENCES movies(movieid) ON DELETE CASCADE,
    FOREIGN KEY (userid) REFERENCES users(userid) ON DELETE CASCADE
    );

INSERT INTO users (userid, username, email, password, age, userscore)
SELECT 1, 'JohnDoe', 'johndoe@email.com', 'password123', 28, 100
    WHERE NOT EXISTS (SELECT 1 FROM users WHERE userid = 1);


INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 1, 'Citizen Kane', 'Drama', 12
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 1);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 2, 'Casablanca', 'Romance', 12
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 2);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 3, 'The Godfather', 'Crime', 15
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 3);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 4, 'Gone with the Wind', 'Epic', 12
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 4);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 5, 'Lawrence of Arabia', 'Adventure', 14
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 5);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 6, 'The Wizard of Oz', 'Fantasy', 10
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 6);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 7, 'Psycho', 'Thriller', 12
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 7);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 8, '12 Angry Men', 'Drama', 12
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 8);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 9, 'Sunset Boulevard', 'Drama', 12
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 9);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 10, 'Schindler''s List', 'Biography', 15
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 10);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 11, 'Dune: Part Two', 'Sci-Fi', 18
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 11);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 12, 'The Substance', 'Drama', 16
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 12);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 13, 'Anora', 'Drama', 14
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 13);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 14, 'Furiosa: A Mad Max Saga', 'Action', 20
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 14);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 15, 'Challengers', 'Drama', 15
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 15);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 16, 'The Wild Robot', 'Animation', 12
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 16);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 17, 'A Real Pain', 'Drama', 14
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 17);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 18, 'Sing Sing', 'Drama', 13
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 18);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 19, 'Conclave', 'Drama', 15
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 19);

INSERT INTO movies (movieid, title, genre, ticket_price)
SELECT 20, 'Nickel Boys', 'Drama', 14
    WHERE NOT EXISTS (SELECT 1 FROM movies WHERE movieid = 20);
