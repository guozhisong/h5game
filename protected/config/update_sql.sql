ALTER TABLE `pay` ADD `user_orderid` VARCHAR(30) NOT NULL COMMENT '客户端订单号' AFTER `trade_no`;

ALTER TABLE `games` ADD `appid` VARCHAR(35) NOT NULL AFTER `id`;

ALTER TABLE `games` ADD `appkey` VARCHAR(35) NOT NULL AFTER `appid`;

ALTER TABLE `games` CHANGE `game_egret_id` `game_egret_id` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0';

ALTER TABLE `pay` ADD `appid` VARCHAR(35) NOT NULL AFTER `id`;

ALTER TABLE `pay` ADD `verify_msg` VARCHAR(1000) NOT NULL COMMENT '回调验证时的备注，例如金额有误' AFTER `extra`;

ALTER TABLE `games` ADD `notify_url` VARCHAR(255) NULL COMMENT '异步通知游戏' AFTER `enter`;

ALTER TABLE `games` ADD `status` TINYINT(2) NOT NULL DEFAULT '0' COMMENT '0:待审核 1:审核通过 2:审核不通过 3:禁用' AFTER `notify_url`;

CREATE TABLE `cp_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status` int(6) NOT NULL DEFAULT 10,
  `group_type` tinyint(2) NOT NULL DEFAULT 2,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `send_notify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(200) NOT NULL,
  `param` varchar(1000) NOT NULL,
  `cnt` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `send_notify_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `out_trade_no` varchar(200) NOT NULL,
  `total_fee` decimal(10,2) NOT NULL COMMENT '金额',
  `subject` varchar(200) NOT NULL,
  `trade_status` tinyint(2) NOT NULL,
  `cnt` tinyint(2) NOT NULL,
  `sign` varchar(1000) NOT NULL,
  `back_status` tinyint(2) NOT NULL,
  `add_time` int(11) NOT NULL,
  `para` varchar(1000) NOT NULL DEFAULT '',
  `error_msg` varchar(1000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `pay` CHANGE `verify_msg` `verify_msg` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '回调验证时的备注，例如金额有误';

ALTER TABLE `games` ADD `cp_mid` INT(10) NOT NULL COMMENT 'cp游戏方的会员ID' AFTER `id`;

ALTER TABLE `cp_admin` ADD `com_name` VARCHAR(255) NOT NULL COMMENT '企业名称' AFTER `name`;
