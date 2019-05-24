/*
 Navicat MySQL Data Transfer

 Source Server         : preOnline
 Source Server Type    : MySQL
 Source Server Version : 100307
 Source Host           : 10.88.12.23:3306
 Source Schema         : chart

 Target Server Type    : MySQL
 Target Server Version : 100307
 File Encoding         : 65001

 Date: 24/05/2019 16:28:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_config
-- ----------------------------
DROP TABLE IF EXISTS `admin_config`;
CREATE TABLE `admin_config`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_config_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_config
-- ----------------------------
INSERT INTO `admin_config` VALUES (1, 'url', 'https://51pphzp.com/data/getChartData', '财务后台充值记录接口', '2019-01-26 02:31:26', '2019-04-09 17:34:05');

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `permission` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES (2, 0, 6, 'Admin', 'fa-tasks', NULL, NULL, NULL, '2019-04-11 13:26:48');
INSERT INTO `admin_menu` VALUES (3, 2, 7, 'Users', 'fa-users', 'auth/users', NULL, NULL, '2019-04-11 13:26:48');
INSERT INTO `admin_menu` VALUES (4, 2, 8, 'Roles', 'fa-user', 'auth/roles', NULL, NULL, '2019-04-11 13:26:48');
INSERT INTO `admin_menu` VALUES (5, 2, 9, 'Permission', 'fa-ban', 'auth/permissions', NULL, NULL, '2019-04-11 13:26:48');
INSERT INTO `admin_menu` VALUES (6, 2, 10, 'Menu', 'fa-bars', 'auth/menu', NULL, NULL, '2019-04-11 13:26:48');
INSERT INTO `admin_menu` VALUES (7, 2, 11, 'Operation log', 'fa-history', 'auth/logs', NULL, NULL, '2019-04-11 13:26:48');
INSERT INTO `admin_menu` VALUES (8, 0, 5, '系统配置', 'fa-toggle-on', 'config', NULL, '2019-01-26 02:24:38', '2019-04-11 13:26:48');
INSERT INTO `admin_menu` VALUES (10, 0, 4, '线上充值列表', 'fa-bars', 'online-pay', NULL, '2019-02-14 02:53:14', '2019-04-11 13:26:48');
INSERT INTO `admin_menu` VALUES (11, 0, 3, '入款成功笔数', 'fa-align-left', 'all-success-pay', NULL, '2019-03-28 02:20:55', '2019-04-11 13:26:48');
INSERT INTO `admin_menu` VALUES (12, 0, 1, '线上充值成功率', 'fa-bar-chart', '/', NULL, '2019-03-28 02:50:33', '2019-03-28 03:01:50');
INSERT INTO `admin_menu` VALUES (13, 0, 2, '实时充值成功率', 'fa-bars', '/pay-success-table', NULL, '2019-04-11 13:26:40', '2019-04-11 13:26:48');

-- ----------------------------
-- Table structure for admin_operation_log
-- ----------------------------
DROP TABLE IF EXISTS `admin_operation_log`;
CREATE TABLE `admin_operation_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_operation_log_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `http_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_permissions_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
INSERT INTO `admin_permissions` VALUES (1, 'All permission', '*', '', '*', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (2, 'Dashboard', 'dashboard', 'GET', '/\r\n/index', NULL, '2019-03-28 02:55:30');
INSERT INTO `admin_permissions` VALUES (3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (6, 'Admin Config', 'ext.config', NULL, '/config*', '2019-01-26 02:24:38', '2019-01-26 02:24:38');
INSERT INTO `admin_permissions` VALUES (8, 'Home.allSuccessPay', 'home.allSuccessPay', '', '/all-success-pay', '2019-03-28 02:24:32', '2019-03-28 02:24:32');
INSERT INTO `admin_permissions` VALUES (9, 'BbinPayOnline.onlinePay', 'bbinPayOnline.onlinePay', '', '/online-pay', '2019-03-28 02:26:56', '2019-03-28 02:26:56');

-- ----------------------------
-- Table structure for admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu`  (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_role_menu_role_id_menu_id_index`(`role_id`, `menu_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_menu
-- ----------------------------
INSERT INTO `admin_role_menu` VALUES (1, 2, NULL, NULL);
INSERT INTO `admin_role_menu` VALUES (1, 10, NULL, NULL);
INSERT INTO `admin_role_menu` VALUES (1, 8, NULL, NULL);
INSERT INTO `admin_role_menu` VALUES (1, 13, NULL, NULL);
INSERT INTO `admin_role_menu` VALUES (3, 13, NULL, NULL);
INSERT INTO `admin_role_menu` VALUES (3, 11, NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_permissions`;
CREATE TABLE `admin_role_permissions`  (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_role_permissions_role_id_permission_id_index`(`role_id`, `permission_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_permissions
-- ----------------------------
INSERT INTO `admin_role_permissions` VALUES (1, 1, NULL, NULL);
INSERT INTO `admin_role_permissions` VALUES (3, 1, NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_users`;
CREATE TABLE `admin_role_users`  (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_role_users_role_id_user_id_index`(`role_id`, `user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_users
-- ----------------------------
INSERT INTO `admin_role_users` VALUES (1, 1, NULL, NULL);
INSERT INTO `admin_role_users` VALUES (1, 2, NULL, NULL);
INSERT INTO `admin_role_users` VALUES (3, 4, NULL, NULL);
INSERT INTO `admin_role_users` VALUES (3, 5, NULL, NULL);
INSERT INTO `admin_role_users` VALUES (3, 6, NULL, NULL);
INSERT INTO `admin_role_users` VALUES (3, 7, NULL, NULL);
INSERT INTO `admin_role_users` VALUES (3, 8, NULL, NULL);

-- ----------------------------
-- Table structure for admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_roles_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_roles
-- ----------------------------
INSERT INTO `admin_roles` VALUES (1, 'Administrator', 'administrator', '2019-01-23 02:17:05', '2019-01-23 02:17:05');
INSERT INTO `admin_roles` VALUES (3, 'Viewer', 'viewer', '2019-03-28 02:57:40', '2019-03-28 02:57:40');

-- ----------------------------
-- Table structure for admin_user_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_permissions`;
CREATE TABLE `admin_user_permissions`  (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_user_permissions_user_id_permission_id_index`(`user_id`, `permission_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_user_permissions
-- ----------------------------
INSERT INTO `admin_user_permissions` VALUES (6, 1, NULL, NULL);
INSERT INTO `admin_user_permissions` VALUES (7, 1, NULL, NULL);
INSERT INTO `admin_user_permissions` VALUES (8, 2, NULL, NULL);

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_users_username_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES (1, 'admin', '$2y$10$eEs11NxTFOBF/Z/vtuV.jO3UgoW6MG6K73qcndUc9O21.Xv1gtgGy', 'admin', NULL, 'Kc0qeTVRtWUgEli4iE9W2hqrZ1xe1lwz9j8FdQgJ8GGnzm8CI66jNmhhK020', '2019-01-23 11:49:16', '2019-03-26 02:47:48');
INSERT INTO `admin_users` VALUES (2, 'superme', '$2y$10$BX.eSnde1pRjerlAZxiNguZET6jizVo7yb6Jrp9k4iExN.F7X3BTK', 'superme', NULL, 'FTNZFLIfzKRWH6yYvh5uJSn2Qk3ns2krDik7cA95XDHCnuLMaS1rTt1SmZDg', '2019-01-24 22:53:33', '2019-01-24 22:53:33');
INSERT INTO `admin_users` VALUES (4, 'fiona', '$2y$10$lo.Qw9g3IeCda39NC9S15.JIA6JoVp1tb8ynLxiYpXiM6SJXs18A2', 'fiona', NULL, 'pnqn6cpI1D38KXsWO63K79WT8QsrFEU1WB8Cip7LpyICpKGsl3dFNylmTyp2', '2019-03-28 02:58:55', '2019-03-28 02:58:55');
INSERT INTO `admin_users` VALUES (5, 'Aimee', '$2y$10$pIIl0SErNZgu748ZCs.5G.c1ofN4EZ1WnkYosxj5oU7iSorMyakuq', '财务部', NULL, 'B90l9MmoVEPRE4yWOo04ZrZ7bIrQ79WwTPhcmRq4uEFl9OcFERCj7HOjwjOu', '2019-03-30 01:36:57', '2019-03-30 01:36:57');
INSERT INTO `admin_users` VALUES (6, 'tony', '$2y$10$/vMvjQ0Tq5WYmWfDlqbrGO34vYjN92tp1sBc0RswW0tCbN2YNbFJK', 'tony', NULL, NULL, '2019-03-30 01:38:24', '2019-03-30 01:38:24');
INSERT INTO `admin_users` VALUES (7, 'Leo', '$2y$10$E87JFFmnhHMf6QAZyU6wtODEnZDe3t8Zzm9yZF11Ct3gdQJ9wdkle', 'Leo', NULL, NULL, '2019-03-30 01:38:45', '2019-03-30 01:38:45');
INSERT INTO `admin_users` VALUES (8, 'Luke', '$2y$10$Dnt.wpJRsWXtMwe21rfI2efO.rftZltBLYeAKHFiGcS/Qmzc8FMRO', 'Luke', NULL, NULL, '2019-03-30 02:53:55', '2019-03-30 02:53:55');

-- ----------------------------
-- Table structure for bbin_pay_onlines
-- ----------------------------
DROP TABLE IF EXISTS `bbin_pay_onlines`;
CREATE TABLE `bbin_pay_onlines`  (
  `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_no` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '订单号',
  `account` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '会员账号',
  `currency` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '币别',
  `level` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '会员支付层级',
  `time` datetime(0) NOT NULL COMMENT '时间',
  `pay_way` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '支付方式',
  `amount` decimal(8, 2) NULL DEFAULT NULL COMMENT '收入金额',
  `real_amount` decimal(8, 2) NULL DEFAULT NULL COMMENT '实际存款金额',
  `status` tinyint(1) NULL DEFAULT NULL COMMENT '支付状态 0:未处理,1:成功',
  `platform` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '支付平台',
  `remark` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '金流',
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `order_no`(`order_no`) USING BTREE,
  INDEX `status`(`status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2016_01_04_173148_create_admin_tables', 1);
INSERT INTO `migrations` VALUES (4, '2017_07_17_040159_create_config_table', 2);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
