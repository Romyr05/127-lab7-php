-- Student Details
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(40) NOT NULL,
    Age INT NOT NULL CHECK (Age >= 0 AND Age <= 99),
    Email VARCHAR(40) NOT NULL UNIQUE,
    Course VARCHAR(40) NOT NULL
);

-- Academic details /linked to students
CREATE TABLE student_details (
    detail_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    YearLevel INT CHECK (YearLevel IN (1,2,3,4)),
    GraduationStatus BOOLEAN,
    ImagePath VARCHAR(255),
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

INSERT INTO students (Name, Age, Email, Course) 
VALUES ('John Doe', 20, 'john.doe@up.edu.ph', 'Computer Science');

INSERT INTO student_details (student_id, YearLevel, GraduationStatus, ImagePath) 
VALUES (1, 3, 0, '');