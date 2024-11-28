CREATE TABLE Family_profile (
    FamilyID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    TotalMonthlyIncome DECIMAL(10, 2) NOT NULL,
    MonthlySavingsGoal DECIMAL(10,2) NOT NULL
);

CREATE TABLE BudgetCategory (
    CategoryID INT AUTO_INCREMENT PRIMARY KEY,
    CategoryName VARCHAR(50) NOT NULL
);

CREATE TABLE Expenses (
    ExpenseID INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    Amount DECIMAL(10, 2) NOT NULL,
    CategoryID INT NOT NULL,
    FamilyID INT NOT NULL,
    Description TEXT
);

-- Add foreign key constraints for Expenses
ALTER TABLE Expenses
ADD CONSTRAINT FK_Expenses_Category
FOREIGN KEY (CategoryID) REFERENCES BudgetCategory(CategoryID) ON DELETE CASCADE;

ALTER TABLE Expenses
ADD CONSTRAINT FK_Expenses_Family
FOREIGN KEY (FamilyID) REFERENCES Family_profile(FamilyID) ON DELETE CASCADE;

INSERT INTO BudgetCategory (CategoryName) VALUES
('Food'),
('Rent'),
('Savings'),
('Utilities'),
('Miscellaneous');