

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `admins` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'admin1', '$2y$10$RRRDm6Y/OfyMw0.s6YvfN.2ij4u3KbHa3ESF8scPyYDXc6yLGbrVu', '', '2025-03-19 15:11:44');


CREATE TABLE `college_rating` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `college_rating` (`id`, `student_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 5, '', '2025-03-28 14:56:43');


CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `branch` enum('Computer','Information Technology','Mechanical','Civil','Chemical','Electrical') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `faculty` (`id`, `name`, `email`, `branch`, `created_at`) VALUES
(11, 'Mrs Krishna V. Master', 'KVM12@gmail.com', 'Computer', '2025-03-21 08:37:09'),
(12, 'Mr. Haridas P. Hirapara', 'HPH12@gmail.com', 'Computer', '2025-03-21 08:44:38'),
(13, 'Mrs.Payal K. Gosai', 'PKG12@gmail.com', 'Computer', '2025-03-21 08:45:01'),
(14, 'Pankaj B. Desal ', 'PRD12@gmail.com', 'Computer', '2025-03-21 08:45:19'),
(15, 'Ms. Devangi M. Savaj', 'DMS12@gmail.com', 'Computer', '2025-03-21 08:45:34'),
(16, 'Mr. Jagdish A. Chavada', 'JAC12@gmail.com', 'Computer', '2025-03-21 08:46:43'),
(17, 'Ms. Krijam V. Vaddoriya', 'KVV12@gmail.com', 'Computer', '2025-03-21 08:46:56'),
(18, 'Mr. Richa A. Panchal', 'RAP12@gmail.com', 'Computer', '2025-03-21 08:47:17'),
(19, 'Mr. Vijay S Nirmal', 'VSN12@gmail.com', 'Computer', '2025-03-21 08:47:42'),
(28, 'JAYESH D. RAMANI', 'JDR12@gmail.com', 'Mechanical', '2025-03-21 09:13:22'),
(29, 'CHIRAG R. SANGHANI', 'CRS12@gmail.com', 'Mechanical', '2025-03-21 09:13:22'),
(30, 'JAYESH V. SAVAJ', 'JVS12@gmail.com', 'Mechanical', '2025-03-21 09:13:22'),
(31, 'DHARMESH C. JAYANI', 'DCJ12@gmail.com', 'Mechanical', '2025-03-21 09:13:22'),
(32, 'RAKESH R. PATEL', 'RRP12@gmail.com', 'Mechanical', '2025-03-21 09:13:22'),
(33, 'SANDEEP S. PATIL', 'SSP12@gmail.com', 'Mechanical', '2025-03-21 09:13:22'),
(34, 'VISHAL J. RANA', 'VJR12@gmail.com', 'Mechanical', '2025-03-21 09:13:22'),
(35, 'VIJAY S. NIRMAL', 'VSN123@gmail.com', 'Mechanical', '2025-03-21 09:13:22'),
(42, 'Misa. Nikita A. Patel', 'NAP12@gmail.com', 'Information Technology', '2025-03-21 09:17:42'),
(43, 'Miss. Ruchita H. Devaliya', 'RHD12@gmail.com', 'Information Technology', '2025-03-21 09:17:42'),
(44, 'Ms. Nisha K. Rajodiya', 'NKR12@gmail.com', 'Information Technology', '2025-03-21 09:17:42'),
(45, 'Miss. Mayuri S. Devganiya', 'MSD12@gmail.com', 'Information Technology', '2025-03-21 09:17:42'),
(46, 'Mrs. Dipika K. Patel', 'DKP12@gmail.com', 'Information Technology', '2025-03-21 09:17:42'),
(47, 'Mr. Sandip S. Patil', 'SSP123@gmail.com', 'Information Technology', '2025-03-21 09:17:42'),
(48, 'K. K. Shah', 'KKS12@gmail.com', 'Civil', '2025-03-21 09:19:52'),
(49, 'R.Y.Desai', 'RYD123@gmail.com', 'Civil', '2025-03-21 09:20:13'),
(50, 'M. N. Haveliwala', 'MNH123@gmail.com', 'Civil', '2025-03-21 09:20:33'),
(51, 'P. M. Jariwala', 'PMJ12@gmail.com', 'Civil', '2025-03-21 09:21:03'),
(52, 'K. H. Kheni', 'KHK123@gmail.com', 'Civil', '2025-03-21 09:21:30');


CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `faculty_rating` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `college_rating` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `feedback` (`id`, `student_id`, `faculty_id`, `created_at`, `faculty_rating`, `description`, `student_name`, `college_rating`) VALUES
(16, 1, 11, '2025-03-28 15:01:14', 5, 'Nice', 'Parth Mehta', 5),
(17, 1, 12, '2025-03-28 15:01:28', 5, 'Nice', 'Parth Mehta', 5),
(18, 1, 13, '2025-03-28 15:01:38', 5, 'Nice', 'Parth Mehta', 5),
(19, 1, 14, '2025-03-28 15:07:23', 5, 'Nice', 'Parth Mehta', 5),
(20, 1, 15, '2025-03-28 15:07:36', 5, 'Nice', 'Parth Mehta', 5),
(21, 1, 16, '2025-03-28 15:07:49', 5, 'Nice', 'Parth Mehta', 5),
(22, 1, 17, '2025-03-28 15:07:58', 5, 'Nice', 'Parth Mehta', 5),
(23, 1, 18, '2025-03-28 15:08:45', 5, 'Nice', 'Parth Mehta', 5),
(24, 1, 19, '2025-03-28 15:08:55', 5, 'Nice', 'Parth Mehta', 5);


CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `branch` enum('Computer','Information Technology','Mechanical','Civil','Chemical','Electrical') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `students` (`id`, `name`, `email`, `password`, `branch`, `created_at`) VALUES
(1, 'Parth Mehta', 'pinakin6582@gmail.com', '$2y$10$RYt52Aq/PhdJRaR1LT44Ye1.WgGLwsWvDA0RfYCd/lfDSd3lWJ9Mm', 'Computer', '2025-03-19 14:32:15'),
(2, 'Manthan', 'mp123@gmail.com', '$2y$10$n2jjXVqjox5EPA1a0zmLjOx1vboaujgBhHoFo3gEU7hHjF6Y8d7dG', 'Information Technology', '2025-03-19 14:38:28'),
(3, 'Preyas Mavani', 'pm123@gmail.com', '$2y$10$shW1R.eg8xz3InqdM8ehs.4wWj5O0Yo679w4TtW2uz00pl1308cYC', 'Mechanical', '2025-03-19 14:38:57'),
(4, 'Prem Modi', 'pm1123@gmail.com', '$2y$10$Wfp3EO4/BGpmsbhlO9OxWOQcE5BsoPML3iUotTDCd0RN/VCJOG/je', 'Civil', '2025-03-19 14:39:21'),
(5, 'Ayaan Motiwala', 'am123@gmail.com', '$2y$10$brIjTQGit4KzgLkmzv9OpOgZZ3yn/kkWCKVF/R.YbB67ut6VE3xnq', 'Chemical', '2025-03-19 14:40:18'),
(6, 'Neev Parmar', 'np123@gmail.com', '$2y$10$5NwkPXYn4J6BauF1y4zseecwTTLDF.k0tqRELBkYA7ytmxUku5mgO', 'Electrical', '2025-03-19 15:08:28');


ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `college_rating`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `faculty_id` (`faculty_id`);

ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `college_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `college_rating`
  ADD CONSTRAINT `college_rating_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`) ON DELETE CASCADE;
COMMIT;

