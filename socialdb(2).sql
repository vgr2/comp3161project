-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 14, 2014 at 10:57 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `socialdb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `friends_of_lst`()
BEGIN
	SELECT friendId,
	       friends_owner,
	       friend
	  FROM friends_of;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `friends_of_sel`(pkfriendId int(10))
BEGIN
	SELECT friendId,
	       friends_owner,
	       friend
	  FROM friends_of
	 WHERE friendId = pkfriendId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `friends_of_upd`(kvfriendId int(10),
	kvfriends_owner int(10),
	kvfriend int(10))
BEGIN
	DECLARE lcount INT;
	SELECT count(1) INTO lcount
	  FROM friends_of
	 WHERE friendId = kvfriendId;
	IF lcount = 0 THEN
		INSERT INTO friends_of(friendId,
				friends_owner,
				friend)
		VALUES (kvfriendId,
				kvfriends_owner,
				kvfriend);
	ELSE
		UPDATE friends_of
		SET friendId = kvfriendId,
			friends_owner = kvfriends_owner,
			friend = kvfriend
		WHERE friendId = kvfriendId;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `friendtype_friendof_del`(pkfriendtype_friendofId int(10))
BEGIN
	DELETE FROM friendtype_friendof
	 WHERE friendtype_friendofId = pkfriendtype_friendofId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `friendtype_friendof_lst`()
BEGIN
	SELECT friendtype_friendofId,
	       friendId,
	       friend_typeId
	  FROM friendtype_friendof;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `friendtype_friendof_sel`(pkfriendtype_friendofId int(10))
BEGIN
	SELECT friendtype_friendofId,
	       friendId,
	       friend_typeId
	  FROM friendtype_friendof
	 WHERE friendtype_friendofId = pkfriendtype_friendofId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `friendtype_friendof_upd`(kvfriendtype_friendofId int(10),
	kvfriendId int(10),
	kvfriend_typeId int(10))
BEGIN
	DECLARE lcount INT;
	SELECT count(1) INTO lcount
	  FROM friendtype_friendof
	 WHERE friendtype_friendofId = kvfriendtype_friendofId;
	IF lcount = 0 THEN
		INSERT INTO friendtype_friendof(friendtype_friendofId,
				friendId,
				friend_typeId)
		VALUES (kvfriendtype_friendofId,
				kvfriendId,
				kvfriend_typeId);
	ELSE
		UPDATE friendtype_friendof
		SET friendtype_friendofId = kvfriendtype_friendofId,
			friendId = kvfriendId,
			friend_typeId = kvfriend_typeId
		WHERE friendtype_friendofId = kvfriendtype_friendofId;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `friend_type_del`(pkfriend_typeId int(10))
BEGIN
	DELETE FROM friend_type
	 WHERE friend_typeId = pkfriend_typeId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `friend_type_lst`()
BEGIN
	SELECT friend_typeId,
	       type
	  FROM friend_type;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `friend_type_sel`(pkfriend_typeId int(10))
BEGIN
	SELECT friend_typeId,
	       type
	  FROM friend_type
	 WHERE friend_typeId = pkfriend_typeId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `friend_type_upd`(kvfriend_typeId int(10),
	kvtype varchar(20))
BEGIN
	DECLARE lcount INT;
	SELECT count(1) INTO lcount
	  FROM friend_type
	 WHERE friend_typeId = kvfriend_typeId;
	IF lcount = 0 THEN
		INSERT INTO friend_type(friend_typeId,
				type)
		VALUES (kvfriend_typeId,
				kvtype);
	ELSE
		UPDATE friend_type
		SET friend_typeId = kvfriend_typeId,
			type = kvtype
		WHERE friend_typeId = kvfriend_typeId;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_editors_del`(pkg_id int(10),
	pkuser_added int(10))
BEGIN
	DELETE FROM group_editors
	 WHERE g_id = pkg_id
	   AND user_added = pkuser_added;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_editors_lst`()
BEGIN
	SELECT g_id,
	       user_added,
	       date_added
	  FROM group_editors;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_editors_sel`(pkg_id int(10),
	pkuser_added int(10))
BEGIN
	SELECT g_id,
	       user_added,
	       date_added
	  FROM group_editors
	 WHERE g_id = pkg_id
	   AND user_added = pkuser_added;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_editors_upd`(kvg_id int(10),
	kvuser_added int(10),
	kvdate_added date)
BEGIN
	DECLARE lcount INT;
	SELECT count(1) INTO lcount
	  FROM group_editors
	 WHERE g_id = kvg_id
	   AND user_added = kvuser_added;
	IF lcount = 0 THEN
		INSERT INTO group_editors(g_id,
				user_added,
				date_added)
		VALUES (kvg_id,
				kvuser_added,
				kvdate_added);
	ELSE
		UPDATE group_editors
		SET g_id = kvg_id,
			user_added = kvuser_added,
			date_added = kvdate_added
		WHERE g_id = kvg_id
			  AND user_added = kvuser_added;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_members_del`(pkuserId int(10),
	pkg_id int(10))
BEGIN
	DELETE FROM group_members
	 WHERE userId = pkuserId
	   AND g_id = pkg_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_members_lst`()
BEGIN
	SELECT g_id,
	       userId,
	       date_added
	  FROM group_members;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_members_sel`(pkuserId int(10),
	pkg_id int(10))
BEGIN
	SELECT g_id,
	       userId,
	       date_added
	  FROM group_members
	 WHERE userId = pkuserId
	   AND g_id = pkg_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_members_upd`(kvg_id int(10),
	kvuserId int(10),
	kvdate_added date)
BEGIN
	DECLARE lcount INT;
	SELECT count(1) INTO lcount
	  FROM group_members
	 WHERE userId = kvuserId
	   AND g_id = kvg_id;
	IF lcount = 0 THEN
		INSERT INTO group_members(g_id,
				userId,
				date_added)
		VALUES (kvg_id,
				kvuserId,
				kvdate_added);
	ELSE
		UPDATE group_members
		SET g_id = kvg_id,
			userId = kvuserId,
			date_added = kvdate_added
		WHERE userId = kvuserId
			  AND g_id = kvg_id;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_post_del`(pkgpostId int(10))
BEGIN
	DELETE FROM group_post
	 WHERE gpostId = pkgpostId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_post_lst`()
BEGIN
	SELECT g_id,
	       userId,
	       gpostId,
	       title,
	       g_post_type,
	       g_image_path,
	       text_body,
	       date_created
	  FROM group_post;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_post_sel`(pkgpostId int(10))
BEGIN
	SELECT g_id,
	       userId,
	       gpostId,
	       title,
	       g_post_type,
	       g_image_path,
	       text_body,
	       date_created
	  FROM group_post
	 WHERE gpostId = pkgpostId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_post_upd`(kvg_id int(10),
	kvuserId int(10),
	kvgpostId int(10),
	kvtitle varchar(20),
	kvg_post_type varchar(15),
	kvg_image_path varchar(30),
	kvtext_body varchar(160),
	kvdate_created date)
BEGIN
	DECLARE lcount INT;
	SELECT count(1) INTO lcount
	  FROM group_post
	 WHERE gpostId = kvgpostId;
	IF lcount = 0 THEN
		INSERT INTO group_post(g_id,
				userId,
				gpostId,
				title,
				g_post_type,
				g_image_path,
				text_body,
				date_created)
		VALUES (kvg_id,
				kvuserId,
				kvgpostId,
				kvtitle,
				kvg_post_type,
				kvg_image_path,
				kvtext_body,
				kvdate_created);
	ELSE
		UPDATE group_post
		SET g_id = kvg_id,
			userId = kvuserId,
			gpostId = kvgpostId,
			title = kvtitle,
			g_post_type = kvg_post_type,
			g_image_path = kvg_image_path,
			text_body = kvtext_body,
			date_created = kvdate_created
		WHERE gpostId = kvgpostId;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_table_del`(pkg_id int(10))
BEGIN
	DELETE FROM group_table
	 WHERE g_id = pkg_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_table_lst`()
BEGIN
	SELECT g_id,
	       userId,
	       group_name,
	       date_created
	  FROM group_table;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_table_sel`(pkg_id int(10))
BEGIN
	SELECT g_id,
	       userId,
	       group_name,
	       date_created
	  FROM group_table
	 WHERE g_id = pkg_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `group_table_upd`(kvg_id int(10),
	kvuserId int(10),
	kvgroup_name varchar(20),
	kvdate_created date)
BEGIN
	DECLARE lcount INT;
	SELECT count(1) INTO lcount
	  FROM group_table
	 WHERE g_id = kvg_id;
	IF lcount = 0 THEN
		INSERT INTO group_table(g_id,
				userId,
				group_name,
				date_created)
		VALUES (kvg_id,
				kvuserId,
				kvgroup_name,
				kvdate_created);
	ELSE
		UPDATE group_table
		SET g_id = kvg_id,
			userId = kvuserId,
			group_name = kvgroup_name,
			date_created = kvdate_created
		WHERE g_id = kvg_id;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `postsCreated`(IN username VARCHAR(20))
SELECT DISTINCT user.username, post.title, post.text_body, post.image_path 
  FROM profile 
  JOIN user ON user.userId = profile.userId
  JOIN post ON post.userId = profile.userId
  WHERE profile.username = username$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `post_del`(pkpostId int(10))
BEGIN
	DELETE FROM post
	 WHERE postId = pkpostId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `post_lst`()
BEGIN
	SELECT postId,
	       userId,
	       title,
	       post_type,
	       image_path,
	       text_body,
	       date_created
	  FROM post;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `post_sel`(pkpostId int(10))
BEGIN
	SELECT postId,
	       userId,
	       title,
	       post_type,
	       image_path,
	       text_body,
	       date_created
	  FROM post
	 WHERE postId = pkpostId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `post_upd`(kvpostId int(10),
	kvuserId int(10),
	kvtitle varchar(20),
	kvpost_type varchar(15),
	kvimage_path varchar(30),
	kvtext_body varchar(160),
	kvdate_created date)
BEGIN
	DECLARE lcount INT;
	SELECT count(1) INTO lcount
	  FROM post
	 WHERE postId = kvpostId;
	IF lcount = 0 THEN
		INSERT INTO post(postId,
				userId,
				title,
				post_type,
				image_path,
				text_body,
				date_created)
		VALUES (kvpostId,
				kvuserId,
				kvtitle,
				kvpost_type,
				kvimage_path,
				kvtext_body,
				kvdate_created);
	ELSE
		UPDATE post
		SET postId = kvpostId,
			userId = kvuserId,
			title = kvtitle,
			post_type = kvpost_type,
			image_path = kvimage_path,
			text_body = kvtext_body,
			date_created = kvdate_created
		WHERE postId = kvpostId;
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `profile`(IN username VARCHAR(20))
SELECT * FROM profile JOIN user ON user.userId = profile.userId
  WHERE user.username = username$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `profile_del`(pkprofileId int(10))
BEGIN
	DELETE FROM profile
	 WHERE profileId = pkprofileId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `profile_lst`()
BEGIN
	SELECT userId,
	       profileId,
	       status,
	       fname,
	       lname,
	       email,
	       dob,
	       profile_pic
	  FROM profile;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `userId`) VALUES
(1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `commentId` int(11) NOT NULL AUTO_INCREMENT,
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `content` varchar(120) NOT NULL,
  `date_commented` date NOT NULL,
  PRIMARY KEY (`commentId`),
  KEY `postId` (`postId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `friends_of`
--

CREATE TABLE IF NOT EXISTS `friends_of` (
  `friendId` int(10) NOT NULL AUTO_INCREMENT,
  `friends_owner` int(10) NOT NULL,
  `friend` int(10) NOT NULL,
  PRIMARY KEY (`friendId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `friendtype_friendof`
--

CREATE TABLE IF NOT EXISTS `friendtype_friendof` (
  `friendtype_friendofId` int(10) NOT NULL AUTO_INCREMENT,
  `friendId` int(10) NOT NULL,
  `friend_typeId` int(10) NOT NULL,
  PRIMARY KEY (`friendtype_friendofId`),
  KEY `friendId` (`friendId`),
  KEY `friend_typeId` (`friend_typeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `friend_type`
--

CREATE TABLE IF NOT EXISTS `friend_type` (
  `friend_typeId` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`friend_typeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_editors`
--

CREATE TABLE IF NOT EXISTS `group_editors` (
  `g_id` int(10) NOT NULL,
  `user_added` int(10) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`g_id`,`user_added`),
  KEY `user_added` (`user_added`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE IF NOT EXISTS `group_members` (
  `g_id` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`userId`,`g_id`),
  KEY `g_id` (`g_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_post`
--

CREATE TABLE IF NOT EXISTS `group_post` (
  `g_id` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `gpostId` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `g_post_type` varchar(15) NOT NULL,
  `g_image_path` varchar(30) DEFAULT NULL,
  `text_body` varchar(160) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`gpostId`),
  KEY `g_id` (`g_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_table`
--

CREATE TABLE IF NOT EXISTS `group_table` (
  `g_id` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `group_name` varchar(20) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `postId` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `title` varchar(20) NOT NULL,
  `post_type` varchar(15) DEFAULT NULL,
  `image_path` varchar(30) DEFAULT NULL,
  `text_body` varchar(160) NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`postId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `userId` int(10) NOT NULL,
  `profileId` int(10) NOT NULL AUTO_INCREMENT,
  `status` varchar(90) DEFAULT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `profile_pic` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`profileId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`userId`, `profileId`, `status`, `firstname`, `lastname`, `email`, `dob`, `profile_pic`) VALUES
(7, 5, NULL, 'Val', 'Rowe', 'val@val.net', '1990-09-09', NULL),
(8, 6, NULL, 'John', 'Brown', 'johnbrown@jb.com', '1990-09-09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `password`) VALUES
(7, 'vgr2', 'b201cd97b6072f9ffb86ebc5220411e29bbc400f'),
(8, 'John', 'b201cd97b6072f9ffb86ebc5220411e29bbc400f');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `post` (`postId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friendtype_friendof`
--
ALTER TABLE `friendtype_friendof`
  ADD CONSTRAINT `friendtype_friendof_ibfk_1` FOREIGN KEY (`friendId`) REFERENCES `friends_of` (`friendId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friendtype_friendof_ibfk_2` FOREIGN KEY (`friend_typeId`) REFERENCES `friend_type` (`friend_typeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_editors`
--
ALTER TABLE `group_editors`
  ADD CONSTRAINT `group_editors_ibfk_1` FOREIGN KEY (`g_id`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_editors_ibfk_2` FOREIGN KEY (`user_added`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`g_id`) REFERENCES `group_table` (`g_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_post`
--
ALTER TABLE `group_post`
  ADD CONSTRAINT `group_post_ibfk_1` FOREIGN KEY (`g_id`) REFERENCES `group_table` (`g_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
