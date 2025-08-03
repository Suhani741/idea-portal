CREATE DATABASE ideamanagementportal;

USE ideamanagementportal;

-- Table for Students
CREATE TABLE Student (
    usn VARCHAR(10) PRIMARY KEY,
    username VARCHAR(100),
    year INT,
    branch VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

-- Table for Faculty
CREATE TABLE Faculty (
    faculty_id VARCHAR(10) PRIMARY KEY,
    username VARCHAR(100),
    department VARCHAR(100),
    domain VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

CREATE TABLE Team (
    team_id INT AUTO_INCREMENT PRIMARY KEY,   
    team_leader VARCHAR(100) NOT NULL,        
    title VARCHAR(255) NOT NULL,             
    team_member1 VARCHAR(100) NOT NULL,      
    team_member2 VARCHAR(100) NOT NULL,      
    team_member3 VARCHAR(100),               
    FOREIGN KEY (team_leader) REFERENCES Student(usn) 
);

CREATE TABLE domain (
    domain_id INT AUTO_INCREMENT PRIMARY KEY,
    domain_name VARCHAR(100),
    faculty_name VARCHAR(100)
);

CREATE TABLE submit_idea (
    idea_id INT AUTO_INCREMENT PRIMARY KEY,
    team_id INT,
    idea_title VARCHAR(255),
    idea_description TEXT,
    FOREIGN KEY (team_id) REFERENCES team(team_id)
);
