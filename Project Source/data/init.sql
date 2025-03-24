-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS thedirectorsdb;

-- Use the created database
USE thedirectorsdb;

-- Drop the tables if they exist (to replace them)
DROP TABLE IF EXISTS booking;
DROP TABLE IF EXISTS review;
DROP TABLE IF EXISTS movies;
DROP TABLE IF EXISTS users;

-- Creating the 'users' table
CREATE TABLE users (
  userid INT NOT NULL PRIMARY KEY,
  username VARCHAR(45),
  email VARCHAR(45),
  password VARCHAR(45),
  age INT,
  userscore INT
);

-- Creating the 'movies' table
CREATE TABLE movies (
  movieid INT NOT NULL PRIMARY KEY,
  title VARCHAR(255),
  genre VARCHAR(45),
  ticket_price INT
);

-- Creating the 'review' table
CREATE TABLE review (
  reviewid INT NOT NULL PRIMARY KEY,
  review_text VARCHAR(200),
  moviescore INT,
  movieid INT,
  userid INT,
  FOREIGN KEY (movieid) REFERENCES movies(movieid) ON DELETE CASCADE,
  FOREIGN KEY (userid) REFERENCES users(userid) ON DELETE CASCADE
);

-- Creating the 'booking' table
CREATE TABLE booking (
  bookingid INT NOT NULL PRIMARY KEY,
  date DATE,
  seating INT,
  movieid INT,
  userid INT,
  FOREIGN KEY (movieid) REFERENCES movies(movieid) ON DELETE CASCADE,
  FOREIGN KEY (userid) REFERENCES users(userid) ON DELETE CASCADE
);

-- Sample Insert for 'users' table
INSERT INTO users (userid, username, email, password, age, userscore) 
VALUES (1, 'JohnDoe', 'johndoe@email.com', 'password123', 28, 100);

-- Inserting 20 movies (10 classics and 10 from 2024)
-- Classics
INSERT INTO movies (movieid, title, genre, ticket_price)
VALUES 
(1, 'Citizen Kane', 'Drama', 12),
(2, 'Casablanca', 'Romance', 12),
(3, 'The Godfather', 'Crime', 15),
(4, 'Gone with the Wind', 'Epic', 12),
(5, 'Lawrence of Arabia', 'Adventure', 14),
(6, 'The Wizard of Oz', 'Fantasy', 10),
(7, 'Psycho', 'Thriller', 12),
(8, '12 Angry Men', 'Drama', 12),
(9, 'Sunset Boulevard', 'Drama', 12),
(10, 'Schindler''s List', 'Biography', 15);

-- 2024 Movies
INSERT INTO movies (movieid, title, genre, ticket_price)
VALUES 
(11, 'Dune: Part Two', 'Sci-Fi', 18),
(12, 'The Substance', 'Drama', 16),
(13, 'Anora', 'Drama', 14),
(14, 'Furiosa: A Mad Max Saga', 'Action', 20),
(15, 'Challengers', 'Drama', 15),
(16, 'The Wild Robot', 'Animation', 12),
(17, 'A Real Pain', 'Drama', 14),
(18, 'Sing Sing', 'Drama', 13),
(19, 'Conclave', 'Drama', 15),
(20, 'Nickel Boys', 'Drama', 14);
