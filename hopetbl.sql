DROP TABLE IF EXISTS `hopejobs`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `applicants`;

CREATE TABLE `hopejobs` (
  `JobID` int(10) NOT NULL AUTO_INCREMENT,
  `JobName` varchar(30) NOT NULL,
  `Company` varchar(30) NOT NULL,
  `Description` text NOT NULL,
  `Address` varchar(50) NOT NULL,
  `DatePosted` varchar(30) NOT NULL,
  `SalaryMonth` int(10) NOT NULL,
  PRIMARY KEY (`JobID`)
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=latin1;

INSERT INTO hopejobs (JobID, JobName, Company, Description, Address, DatePosted, SalaryMonth) 
VALUES 
(1, 'Waiter', 'Local Cafe', 'Take orders and serve food to customers.', '123 Main St, Cityville, Country', '2023-01-01', 2000),
(2, 'Delivery Driver', 'Express Deliveries', 'Deliver packages to customers in a timely manner.', '456 Oak St, Townsville, Country', '2023-01-02', 2200),
(3, 'Security Guard', 'Safe Haven Security', 'Monitor premises to prevent theft and ensure safety.', '789 Pine St, Villageton, Country', '2023-01-03', 2300),
(4, 'Janitor', 'Clean Sweep Services', 'Perform cleaning tasks to maintain a tidy environment.', '101 Elm St, Hamletville, Country', '2023-01-04', 1800),
(5, 'Retail Sales Associate', 'SuperMart', 'Assist customers, operate the cash register, and restock shelves.', '202 Maple St, Metropolis, Country', '2023-01-05', 1900),
(6, 'Housekeeping Staff', 'Clean Living Hotels', 'Clean and organize rooms to maintain a welcoming atmosphere.', '303 Cedar St, Cityburg, Country', '2023-01-06', 1700),
(7, 'Landscaping Crew Member', 'Green Thumb Landscapes', 'Maintain lawns and gardens for residential and commercial properties.', '404 Walnut St, Suburbia, Country', '2023-01-07', 2000),
(8, 'Cashier', 'Quick Mart', 'Handle customer transactions and provide excellent customer service.', '505 Birch St, Hamletton, Country', '2023-01-08', 1800),
(9, 'Stock Clerk', 'Warehouse Solutions', 'Organize and manage inventory in a warehouse setting.', '606 Spruce St, Villagetown, Country', '2023-01-09', 1900),
(10, 'Dishwasher', 'Culinary Delights Restaurant', 'Clean dishes and kitchen equipment to ensure a hygienic kitchen.', '707 Pine St, Citydale, Country', '2023-01-10', 1700),
(11, 'Software Engineer', 'Tech Innovators Inc.', 'Develop and maintain software applications.', '808 Oak St, Technocity, Country', '2023-01-11', 5000),
(12, 'Project Manager', 'Global Solutions Ltd.', 'Plan, execute, and oversee projects from initiation to completion.', '909 Cedar St, Megatown, Country', '2023-01-12', 5500),
(13, 'Pharmacist', 'Healthy Living Pharmacy', 'Dispense medications and provide pharmaceutical care.', '1010 Maple St, Wellnesstown, Country', '2023-01-13', 6000),
(14, 'Accountant', 'Financial Experts LLC', 'Manage financial records and prepare reports for clients.', '1111 Walnut St, Financetown, Country', '2023-01-14', 5200),
(15, 'Graphic Designer', 'Creative Minds Studio', 'Create visual concepts and designs for various projects.', '1212 Birch St, Artsville, Country', '2023-01-15', 4800),
(16, 'Registered Nurse', 'Community Health Clinic', 'Provide patient care and support in a healthcare setting.', '1313 Elm St, Healthville, Country', '2023-01-16', 5500),
(17, 'Social Worker', 'Hopeful Services Agency', 'Assist individuals and families in accessing social services.', '1414 Spruce St, Helpington, Country', '2023-01-17', 5300),
(18, 'Marketing Coordinator', 'Buzz Marketing Agency', 'Coordinate marketing campaigns and promotional activities.', '1515 Pine St, Promotionville, Country', '2023-01-18', 5000),
(19, 'Web Developer', 'Digital Solutions Co.', 'Build and maintain websites for clients.', '1616 Oak St, Webville, Country', '2023-01-19', 5200),
(20, 'Electrician', 'Power Up Electric', 'Install and repair electrical systems in residential and commercial settings.', '1717 Cedar St, Powertown, Country', '2023-01-20', 4800),
(21, 'Customer Service Representative', 'Helpful Services Inc.', 'Assist customers with inquiries and provide information.', '1818 Maple St, Assistville, Country', '2023-01-21', 2000),
(22, 'Waiter', 'Cloud Bistro', 'Take orders and serve food to customers.', '222 Sunset Blvd, Cloudsville, Country', '2023-02-01', 2100),
(23, 'Delivery Driver', 'Cloud Logistics', 'Deliver packages to customers in a timely manner.', '333 Sunrise Ave, Skytown, Country', '2023-02-02', 2300),
(24, 'Security Guard', 'Secure Solutions', 'Monitor premises to prevent theft and ensure safety.', '444 Moonlight Ln, Safecity, Country', '2023-02-03', 2400),
(25, 'Janitor', 'Spotless Solutions', 'Perform cleaning tasks to maintain a tidy environment.', '555 Star St, Cleancity, Country', '2023-01-25', 1900),
(26, 'Retail Sales Associate', 'MegaMart', 'Assist customers, operate the cash register, and restock shelves.', '666 Galaxy Dr, Supermartland, Country', '2023-01-26', 2000),
(27, 'Housekeeping Staff', 'Pure Living Hotels', 'Clean and organize rooms to maintain a welcoming atmosphere.', '777 Universe Ct, Tranquilityville, Country', '2023-01-27', 1800),
(28, 'Landscaping Crew Member', 'Natures Beauty Landscapes', 'Maintain lawns and gardens for residential and commercial properties.', '888 Planet Rd, Greenerytown, Country', '2023-01-28', 2100),
(29, 'Cashier', 'Speedy Mart', 'Handle customer transactions and provide excellent customer service.', '999 Comet Ave, Quickmart City, Country', '2023-01-29', 1900),
(30, 'Stock Clerk', 'Logistics Solutions', 'Organize and manage inventory in a warehouse setting.', '1010 Asteroid St, Warehouseton, Country', '2023-01-30', 2000),
(31, 'Waiter', 'Cloud Bistro', 'Take orders and serve food to customers.', '123 Main St, Cloudsville, Country', '2023-02-01', 2100),
(32, 'Delivery Driver', 'Cloud Logistics', 'Deliver packages to customers in a timely manner.', '456 Oak St, Skytown, Country', '2023-02-02', 2300),
(33, 'Security Guard', 'Secure Solutions', 'Monitor premises to prevent theft and ensure safety.', '789 Pine St, Safecity, Country', '2023-02-03', 2400);

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `users` (
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(20) NOT NULL,
    `password` VARCHAR(20) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `date_created` DATE DEFAULT NULL,
    `reward_eligibility` INT(255) NOT NULL,
    `admin_status` INT(255) NOT NULL,
    `location` VARCHAR(255),
    `biography` TEXT,
    `career_history` TEXT,
    `education` TEXT,
    `certification` TEXT,
    `skills` TEXT,
    `languages` TEXT,
    `resume_path` VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`username`, `password`, `email`, `reward_eligibility`, `admin_status`, `location`, `biography`, `career_history`, `education`, `certification`, `skills`, `languages`, `resume_path`)
VALUES 
('EricAdmin', 'Admin', 'eric@example.com', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('DarrenAdmin', 'Admin', 'darren@example.com', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('JohnDoe', 'Pass123', 'john@example.com', 1, 0, 'New York', 'Experienced developer', 'Worked at ABC Inc.', 'BS in Computer Science', 'Certified Developer', 'Java, Python', 'English, Spanish', '/path/to/resume1.pdf');


CREATE TABLE `applicants` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `gender` VARCHAR(20) NOT NULL,
    `dob` DATE NOT NULL,
    `contact_number` VARCHAR(20) NOT NULL,
    `civil_status` VARCHAR(20) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `qualification` VARCHAR(255) NOT NULL,
    `resume` VARCHAR(255) NOT NULL
);

INSERT INTO applicants 
(first_name, last_name, address, gender, dob, contact_number, civil_status, email, qualification, resume) 
VALUES 
('John', 'Doe', '123 Main St, City, Country', 'Male', '1990-01-01', '+1234567890', 'Single', 'john.doe@example.com', 'Bachelor in Computer Science', '/path/to/resume.pdf');

COMMIT;