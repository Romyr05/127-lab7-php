DROP TABLE students;
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(40),
    Age INT CHECK (Age >= 0 AND Age <= 99),
    Email VARCHAR(40),
    Course VARCHAR(40),
    YearLevel INT CHECK (YearLevel IN (1,2,3,4)),
    GraduationStatus BOOLEAN,
    ImagePath VARCHAR(255)
);

INSERT INTO students (Name, Age, Email, Course, YearLevel, GraduationStatus, ImagePath)
VALUES ('dummy', 20, 'dummy@gmail.com', 'dummyCourse', 2, 0, 'images/dummy.png')