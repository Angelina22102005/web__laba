CREATE DATABASE IF NOT EXISTS hackathon_db;
USE hackathon_db;

CREATE TABLE IF NOT EXISTS hackathon_registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    email VARCHAR(255) NOT NULL,
    direction VARCHAR(100) NOT NULL,
    team_role VARCHAR(100) NOT NULL,
    previous_experience BOOLEAN DEFAULT FALSE,
    workshop BOOLEAN DEFAULT FALSE,
    mentoring BOOLEAN DEFAULT FALSE,
    newsletter BOOLEAN DEFAULT FALSE,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE INDEX idx_email ON hackathon_registrations(email);
CREATE INDEX idx_direction ON hackathon_registrations(direction);
CREATE INDEX idx_created_at ON hackathon_registrations(created_at);
