-- 1. డేటాబేస్ క్రియేట్ చేయడం
CREATE DATABASE IF NOT EXISTS career_db;
USE career_db;

-- 2. స్టూడెంట్స్ రిజిస్ట్రేషన్ మరియు లాగిన్ వివరాల టేబుల్
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. కెరీర్ అసెస్‌మెంట్ టెస్ట్ రిజల్ట్స్ దాచడానికి టేబుల్
CREATE TABLE IF NOT EXISTS assessment_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    score_tech INT DEFAULT 0,
    score_health INT DEFAULT 0,
    score_business INT DEFAULT 0,
    score_creative INT DEFAULT 0,
    recommended_career VARCHAR(100) NOT NULL,
    test_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);