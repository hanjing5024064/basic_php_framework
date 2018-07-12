/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80011
 Source Host           : 127.0.0.1
 Source Database       : base_php_fw

 Target Server Type    : MySQL
 Target Server Version : 80011
 File Encoding         : utf-8

 Date: 07/12/2018 13:55:47 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text,
  `price` float NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `products`
-- ----------------------------
BEGIN;
INSERT INTO `products` VALUES ('1', '御Mavic Air', 'dj_mavic_air', '大疆（DJI）无人机 御Mavic Air 便携可折叠 4K超清航拍 旅行无人机 全能套装 （曜石黑）', '6399', 'webroot/img/dj_mavic.png', '7', '2018-07-06 11:03:45', '2018-07-10 08:50:56'), ('2', '晓Spark', 'dj_spark', '大疆（DJI）无人机 晓Spark 掌上智能无人机 高清航拍 自拍神器 全能套装 （红色） & Goggles 飞行眼镜', '6398', 'webroot/img/dj_spark.png', '12', '2018-07-06 11:05:15', '2018-07-10 08:50:56'), ('3', '精灵Phantom 4', 'dj_phantom_4', '大疆（DJI）无人机 精灵Phantom 4 Advanced+ 4K专业智能超清航拍无人机 & Goggles飞行眼镜 套装', '12398', 'webroot/img/dj_phantom_4.png', '11', '2018-07-06 11:06:37', '2018-07-06 11:06:41'), ('4', '灵眸Osmo Mobile 2', 'dj_osmo_2', '大疆（DJI）手机云台 灵眸Osmo Mobile 2 防抖手机云台 手持稳定器', '899', 'webroot/img/dj_osmo_2.png', '6', '2018-07-12 12:17:12', '2018-07-12 12:17:14'), ('5', '悟Inspire 2', 'dj_inspire_2', 'DJI 大疆 无人机 悟Inspire 2 四轴专业航拍飞行器 变形无人机 相机套装', '40998', 'webroot/img/dj_inspire_2.png', '4', '2018-07-12 12:18:22', '2018-07-12 12:18:25'), ('6', '如影Ronin 2', 'dj_ronin_2', '大疆（DJI）云台 如影Ronin 2 三轴手持摄影云台 专业稳定器 手持套装\n', '32999', 'webroot/img/dj_ronin_2.png', '6', '2018-07-12 12:19:06', '2018-07-12 12:19:09');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
