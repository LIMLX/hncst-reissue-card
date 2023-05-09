/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : hncst-reissue-card

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 08/05/2023 09:25:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for reissue
-- ----------------------------
DROP TABLE IF EXISTS `reissue`;
CREATE TABLE `reissue`  (
  `card_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '记录id',
  `college_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '二级学院名称',
  `student_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '学生名称',
  `student_num` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '学生学号',
  `student_class` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '学生班级',
  `reissue_reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '补办理由',
  `employee_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '审批辅导员名称',
  `employee_num` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '审批辅导员工号',
  `employee_reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL COMMENT '辅导员否定(同意)理由',
  `reissue_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '补办审批状态(0:待处理,1:同意,2:否定)',
  `reissue_create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '提交补办申请时间',
  `reissue_update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '提交补办修改时间',
  PRIMARY KEY (`card_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
