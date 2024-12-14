CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    area VARCHAR(50) NOT NULL,
    location VARCHAR(255) NOT NULL,
    income INT NOT NULL,
    disability VARCHAR(50),
    password VARCHAR(255) NOT NULL,
    Confirm_password VARCHAR(255) NOT NULL
);
