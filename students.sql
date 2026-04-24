DROP TABLE students;

-- Student Details
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(40),
    Age INT CHECK (Age >= 0 AND Age <= 99),
    Email VARCHAR(40),
    Course VARCHAR(40)
);

-- Academic details /linked to students
CREATE TABLE student_details (
    detail_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    YearLevel INT CHECK (YearLevel IN (1,2,3,4)),
    GraduationStatus BOOLEAN,
    ImagePath VARCHAR(255),
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);