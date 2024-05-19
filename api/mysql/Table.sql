CREATE TABLE users(  
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    -- Додаємо айді для кращої індексації
    email VARCHAR(256) UNIQUE KEY
    -- Максимальна можлива довжина емеілу 256 символів
);