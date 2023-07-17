-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2022 at 09:56 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `social_networking_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment_list`
--

CREATE TABLE `comment_list` (
  `id` int(30) NOT NULL,
  `post_id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL,
  `message` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment_list`
--

INSERT INTO `comment_list` (`id`, `post_id`, `member_id`, `message`, `date_created`, `date_updated`) VALUES
(1, 1, 1, 'Comment 101', '2022-05-14 14:02:18', '2022-05-14 14:02:18'),
(2, 3, 2, 'Nice', '2022-05-14 14:16:56', '2022-05-14 14:16:56'),
(3, 4, 4, 'First Comment', '2022-05-14 15:47:57', '2022-05-14 15:47:57'),
(4, 4, 1, 'Nice', '2022-05-14 15:50:53', '2022-05-14 15:50:53'),
(6, 2, 1, 'Test 123', '2022-05-14 15:51:48', '2022-05-14 15:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `like_list`
--

CREATE TABLE `like_list` (
  `post_id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `like_list`
--

INSERT INTO `like_list` (`post_id`, `member_id`) VALUES
(1, 3),
(2, 3),
(1, 2),
(3, 2),
(2, 4),
(1, 4),
(4, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `member_list`
--

CREATE TABLE `member_list` (
  `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved, 2 = Denied, 3=Blocked',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_list`
--

INSERT INTO `member_list` (`id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `avatar`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Mark Jason', 'D', 'Cooper', 'mcooper@gmail.com', 'c7162ff89c647f444fcaa5c635dac8c3', 'uploads/member/1.png?v=1652514732', 0, '2022-05-14 09:50:01', '2022-05-14 15:52:12'),
(2, 'Claire', 'C', 'Blake', 'cblake@sample.com', '542d2760db6928e65bd10de7c16bb82c', 'uploads/member/2.png?v=1652497791', 0, '2022-05-14 11:09:38', '2022-05-14 11:09:51'),
(3, 'Mike', 'D', 'Smith', 'msmith@sample.con', '9cfbd29eea6628101eb3ee73a4b6f777', 'uploads/member/3.png?v=1652507486', 0, '2022-05-14 13:51:26', '2022-05-14 13:51:26'),
(4, 'Samantha Jane', 'C', 'Miller', 'sam23@gmail.com', 'b60367cae35de6594b1a09bf44a3a68b', 'uploads/member/4.png?v=1652514321', 0, '2022-05-14 15:45:21', '2022-05-14 15:45:21');

-- --------------------------------------------------------

--
-- Table structure for table `member_meta`
--

CREATE TABLE `member_meta` (
  `member_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_meta`
--

INSERT INTO `member_meta` (`member_id`, `meta_field`, `meta_value`) VALUES
(1, 'contact', '09123456789/456-654-8879'),
(1, 'address', '1014 Street, Brgy. Here, Over There City, Anywhere 2306'),
(1, 'relation_status', 'In-Relationship'),
(1, 'studied_at', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vehicula ullamcorper risus, et facilisis erat vehicula vitae. Quisque ullamcorper non ex sed dapibus. Phasellus rhoncus nec elit et luctus. Cras at augue posuere, commodo enim nec, volutpat lacus. Praesent et malesuada ex.'),
(1, 'working_at', 'Nam sollicitudin felis vitae nulla luctus elementum. Fusce accumsan est a est feugiat, id lacinia elit accumsan. Proin venenatis nunc quis sapien consequat maximus.'),
(1, 'about_me', 'Phasellus blandit neque ultrices ipsum rhoncus venenatis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean interdum fringilla elit. Donec nisl dui, lobortis at sapien sed, consequat sagittis leo. Cras iaculis erat aliquet augue tincidunt porttitor.'),
(2, 'gender', 'Male'),
(2, 'dob', '1997-06-23'),
(2, 'contact', '09877778899'),
(2, 'address', 'Sample Address'),
(2, 'relation_status', 'Married'),
(2, 'studied_at', 'Sample'),
(2, 'working_at', 'Sample'),
(2, 'about_me', 'Nunc a sollicitudin metus. Phasellus sapien turpis, volutpat nec eleifend at, auctor elementum massa. Fusce nec ligula odio. Aliquam rutrum dui ipsum, nec sagittis est laoreet et. Duis molestie tempus nibh sed imperdiet. Mauris nec felis laoreet, vehicula dui id, porta dui. Donec quis consequat arcu, at finibus quam. Donec porta auctor vehicula.'),
(4, 'gender', 'Female'),
(4, 'dob', '1997-06-23'),
(4, 'contact', '094561321558 / 546-987-8798'),
(4, 'address', '23 St, Brgy. 6, There City, NoHere Province 1014'),
(4, 'relation_status', 'In-Relationship'),
(4, 'studied_at', 'Sample School'),
(4, 'working_at', 'Sample Company'),
(4, 'about_me', 'I am simple. ');

-- --------------------------------------------------------

--
-- Table structure for table `post_list`
--

CREATE TABLE `post_list` (
  `id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL,
  `caption` text NOT NULL,
  `upload_path` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_list`
--

INSERT INTO `post_list` (`id`, `member_id`, `caption`, `upload_path`, `date_created`, `date_updated`) VALUES
(1, 2, 'Sample Post', 'uploads/posts/202205140001/', '2022-05-14 13:53:54', '2022-05-14 13:53:54'),
(2, 2, 'Test 123', 'uploads/posts/202205140002/', '2022-05-14 13:57:44', '2022-05-14 13:57:44'),
(3, 3, 'My First Post', 'uploads/posts/202205140003/', '2022-05-14 14:00:45', '2022-05-14 14:00:45'),
(4, 4, 'This is my First Post', 'uploads/posts/202205140005/', '2022-05-14 15:47:35', '2022-05-14 15:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `request_list`
--

CREATE TABLE `request_list` (
  `id` int(30) NOT NULL,
  `member_id` int(30) NOT NULL,
  `ask_member_id` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request_list`
--

INSERT INTO `request_list` (`id`, `member_id`, `ask_member_id`, `status`, `date_created`, `date_updated`) VALUES
(1, 2, 1, 1, '2022-05-14 11:52:46', '2022-05-14 13:26:04'),
(2, 3, 2, 1, '2022-05-14 13:51:35', '2022-05-14 13:51:56'),
(3, 3, 1, 1, '2022-05-14 13:51:41', '2022-05-14 15:50:28'),
(4, 4, 2, 1, '2022-05-14 15:48:48', '2022-05-14 15:49:25'),
(5, 4, 1, 1, '2022-05-14 15:49:56', '2022-05-14 15:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Social Networking Site'),
(6, 'short_name', 'SNS - PHP'),
(11, 'logo', 'uploads/logo.png?v=1652491306'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1652491310');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1649834664', NULL, 1, '2021-01-20 14:02:37', '2022-04-13 15:24:24'),
(5, 'Johnny', 'C', 'Doe', 'jdoe', '9c86d448e84d4ba23eb089e0b5160207', 'uploads/avatars/5.png?v=1652514879', NULL, 2, '2022-05-14 15:54:39', '2022-05-14 15:55:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment_list`
--
ALTER TABLE `comment_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `like_list`
--
ALTER TABLE `like_list`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `member_list`
--
ALTER TABLE `member_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_meta`
--
ALTER TABLE `member_meta`
  ADD KEY `individual_id` (`member_id`);

--
-- Indexes for table `post_list`
--
ALTER TABLE `post_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `request_list`
--
ALTER TABLE `request_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `ask_member_id` (`ask_member_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment_list`
--
ALTER TABLE `comment_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `member_list`
--
ALTER TABLE `member_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post_list`
--
ALTER TABLE `post_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `request_list`
--
ALTER TABLE `request_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment_list`
--
ALTER TABLE `comment_list`
  ADD CONSTRAINT `member_id_fk_cl` FOREIGN KEY (`member_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_id_fk_cl` FOREIGN KEY (`post_id`) REFERENCES `post_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `like_list`
--
ALTER TABLE `like_list`
  ADD CONSTRAINT `member_id_fk_ll` FOREIGN KEY (`member_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_id_fk_ll` FOREIGN KEY (`post_id`) REFERENCES `post_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `member_meta`
--
ALTER TABLE `member_meta`
  ADD CONSTRAINT `member_id_fk_mm` FOREIGN KEY (`member_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `post_list`
--
ALTER TABLE `post_list`
  ADD CONSTRAINT `member_id_fk_pl` FOREIGN KEY (`member_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `request_list`
--
ALTER TABLE `request_list`
  ADD CONSTRAINT `member_id_fk_rl` FOREIGN KEY (`member_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `member_id_fk_rl2` FOREIGN KEY (`ask_member_id`) REFERENCES `member_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;
