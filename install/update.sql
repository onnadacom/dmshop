-- --------------------------------------------------------

--
-- Table structure for table `shop_article_faq`
--

CREATE TABLE IF NOT EXISTS `shop_article_faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ar_id` int(11) NOT NULL DEFAULT '0' COMMENT '원본아이디',
  `ar_count` int(11) NOT NULL DEFAULT '0' COMMENT '답변수',
  `user_id` varchar(50) NOT NULL COMMENT '회원아이디',
  `ar_name` varchar(50) NOT NULL COMMENT '작성자',
  `ar_email` varchar(255) NOT NULL COMMENT '이메일',
  `ar_homepage` varchar(255) NOT NULL COMMENT '홈페이지',
  `ar_password` varchar(50) NOT NULL COMMENT '패스워드',
  `ar_notice` tinyint(4) NOT NULL DEFAULT '0' COMMENT '공지사항',
  `ar_secret` tinyint(4) NOT NULL DEFAULT '0' COMMENT '비밀글',
  `ar_category` varchar(255) NOT NULL COMMENT '분류',
  `ar_title` varchar(255) NOT NULL COMMENT '제목',
  `ar_content` longtext NOT NULL COMMENT '내용',
  `ar_ip` varchar(20) NOT NULL COMMENT '아이피',
  `ar_hit` int(11) NOT NULL DEFAULT '0' COMMENT '조회수',
  `ar_reply` int(11) NOT NULL DEFAULT '0' COMMENT '댓글수',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '작성일',
  PRIMARY KEY (`id`),
  KEY `index_list` (`datetime`),
  KEY `index_reply` (`ar_id`,`id`),
  KEY `index_user` (`user_id`,`datetime`),
  KEY `index_notice` (`ar_notice`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_article_file`
--

CREATE TABLE IF NOT EXISTS `shop_article_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `upload_mode` varchar(255) NOT NULL,
  `upload_source` varchar(255) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `upload_filesize` int(11) NOT NULL DEFAULT '0',
  `upload_width` int(11) NOT NULL DEFAULT '0',
  `upload_height` int(11) NOT NULL DEFAULT '0',
  `upload_type` tinyint(4) NOT NULL DEFAULT '0',
  `upload_download` int(11) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_upload` (`upload_mode`),
  KEY `index_view` (`upload_type`,`upload_file`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_article_notice`
--

CREATE TABLE IF NOT EXISTS `shop_article_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ar_id` int(11) NOT NULL DEFAULT '0' COMMENT '원본아이디',
  `ar_count` int(11) NOT NULL DEFAULT '0' COMMENT '답변수',
  `user_id` varchar(50) NOT NULL COMMENT '회원아이디',
  `ar_name` varchar(50) NOT NULL COMMENT '작성자',
  `ar_email` varchar(255) NOT NULL COMMENT '이메일',
  `ar_homepage` varchar(255) NOT NULL COMMENT '홈페이지',
  `ar_password` varchar(50) NOT NULL COMMENT '패스워드',
  `ar_notice` tinyint(4) NOT NULL DEFAULT '0' COMMENT '공지사항',
  `ar_secret` tinyint(4) NOT NULL DEFAULT '0' COMMENT '비밀글',
  `ar_category` varchar(255) NOT NULL COMMENT '분류',
  `ar_title` varchar(255) NOT NULL COMMENT '제목',
  `ar_content` longtext NOT NULL COMMENT '내용',
  `ar_ip` varchar(20) NOT NULL COMMENT '아이피',
  `ar_hit` int(11) NOT NULL DEFAULT '0' COMMENT '조회수',
  `ar_reply` int(11) NOT NULL DEFAULT '0' COMMENT '댓글수',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '작성일',
  PRIMARY KEY (`id`),
  KEY `index_list` (`datetime`),
  KEY `index_reply` (`ar_id`,`id`),
  KEY `index_user` (`user_id`,`datetime`),
  KEY `index_notice` (`ar_notice`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_article_qna`
--

CREATE TABLE IF NOT EXISTS `shop_article_qna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ar_id` int(11) NOT NULL DEFAULT '0' COMMENT '원본아이디',
  `ar_count` int(11) NOT NULL DEFAULT '0' COMMENT '답변수',
  `user_id` varchar(50) NOT NULL COMMENT '회원아이디',
  `ar_name` varchar(50) NOT NULL COMMENT '작성자',
  `ar_email` varchar(255) NOT NULL COMMENT '이메일',
  `ar_homepage` varchar(255) NOT NULL COMMENT '홈페이지',
  `ar_password` varchar(50) NOT NULL COMMENT '패스워드',
  `ar_notice` tinyint(4) NOT NULL DEFAULT '0' COMMENT '공지사항',
  `ar_secret` tinyint(4) NOT NULL DEFAULT '0' COMMENT '비밀글',
  `ar_category` varchar(255) NOT NULL COMMENT '분류',
  `ar_title` varchar(255) NOT NULL COMMENT '제목',
  `ar_content` longtext NOT NULL COMMENT '내용',
  `ar_ip` varchar(20) NOT NULL COMMENT '아이피',
  `ar_hit` int(11) NOT NULL DEFAULT '0' COMMENT '조회수',
  `ar_reply` int(11) NOT NULL DEFAULT '0' COMMENT '댓글수',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '작성일',
  PRIMARY KEY (`id`),
  KEY `index_list` (`datetime`),
  KEY `index_reply` (`ar_id`,`id`),
  KEY `index_user` (`user_id`,`datetime`),
  KEY `index_notice` (`ar_notice`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_article_reply`
--

CREATE TABLE IF NOT EXISTS `shop_article_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bbs_id` varchar(50) NOT NULL COMMENT '게시판아이디',
  `article_id` int(11) NOT NULL DEFAULT '0' COMMENT '게시물아이디',
  `reply_id` int(11) NOT NULL DEFAULT '0' COMMENT '원본아이디',
  `reply_count` int(11) NOT NULL DEFAULT '0' COMMENT '답변수',
  `user_id` varchar(50) NOT NULL COMMENT '회원아이디',
  `reply_name` varchar(50) NOT NULL COMMENT '작성자',
  `reply_email` varchar(255) NOT NULL COMMENT '이메일',
  `reply_homepage` varchar(255) NOT NULL COMMENT '홈페이지',
  `reply_password` varchar(50) NOT NULL COMMENT '패스워드',
  `reply_content` longtext NOT NULL COMMENT '내용',
  `reply_ip` varchar(20) NOT NULL COMMENT '아이피',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '작성일',
  PRIMARY KEY (`id`),
  KEY `reply_list` (`bbs_id`,`article_id`,`datetime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_article_review`
--

CREATE TABLE IF NOT EXISTS `shop_article_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ar_id` int(11) NOT NULL DEFAULT '0' COMMENT '원본아이디',
  `ar_count` int(11) NOT NULL DEFAULT '0' COMMENT '답변수',
  `user_id` varchar(50) NOT NULL COMMENT '회원아이디',
  `ar_name` varchar(50) NOT NULL COMMENT '작성자',
  `ar_email` varchar(255) NOT NULL COMMENT '이메일',
  `ar_homepage` varchar(255) NOT NULL COMMENT '홈페이지',
  `ar_password` varchar(50) NOT NULL COMMENT '패스워드',
  `ar_notice` tinyint(4) NOT NULL DEFAULT '0' COMMENT '공지사항',
  `ar_secret` tinyint(4) NOT NULL DEFAULT '0' COMMENT '비밀글',
  `ar_category` varchar(255) NOT NULL COMMENT '분류',
  `ar_title` varchar(255) NOT NULL COMMENT '제목',
  `ar_content` longtext NOT NULL COMMENT '내용',
  `ar_ip` varchar(20) NOT NULL COMMENT '아이피',
  `ar_hit` int(11) NOT NULL DEFAULT '0' COMMENT '조회수',
  `ar_reply` int(11) NOT NULL DEFAULT '0' COMMENT '댓글수',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '작성일',
  PRIMARY KEY (`id`),
  KEY `index_list` (`datetime`),
  KEY `index_reply` (`ar_id`,`id`),
  KEY `index_user` (`user_id`,`datetime`),
  KEY `index_notice` (`ar_notice`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_banner`
--

CREATE TABLE IF NOT EXISTS `shop_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '고유번호',
  `group_id` varchar(100) NOT NULL,
  `ba_title` varchar(255) NOT NULL DEFAULT '' COMMENT '배너명',
  `ba_view` tinyint(4) NOT NULL DEFAULT '0' COMMENT '숨김여부',
  `ba_position` int(11) NOT NULL DEFAULT '0' COMMENT '출력순서',
  `ba_url` varchar(255) NOT NULL DEFAULT '' COMMENT 'URL',
  `ba_target` tinyint(4) NOT NULL DEFAULT '0' COMMENT '링크방식',
  `ba_width` int(11) NOT NULL DEFAULT '0' COMMENT '배너가로크기',
  `ba_height` int(11) NOT NULL DEFAULT '0' COMMENT '배너세로크기',
  `ba_hit` int(11) NOT NULL DEFAULT '0' COMMENT '조회수',
  `ba_click` int(11) NOT NULL DEFAULT '0' COMMENT '클릭수',
  `ba_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '생성일',
  `upload_source` varchar(255) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `upload_filesize` int(11) NOT NULL DEFAULT '0',
  `upload_width` int(11) NOT NULL DEFAULT '0',
  `upload_height` int(11) NOT NULL DEFAULT '0',
  `upload_type` tinyint(4) NOT NULL DEFAULT '0',
  `upload_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_banner_group`
--

CREATE TABLE IF NOT EXISTS `shop_banner_group` (
  `group_id` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_board`
--

CREATE TABLE IF NOT EXISTS `shop_board` (
  `bbs_id` varchar(50) NOT NULL DEFAULT '' COMMENT '게시판아이디',
  `bbs_title` varchar(255) NOT NULL DEFAULT '' COMMENT '게시판명',
  `bbs_position` int(11) NOT NULL DEFAULT '0' COMMENT '출력순서',
  `bbs_view` tinyint(4) NOT NULL DEFAULT '0' COMMENT '숨김보임',
  `bbs_category` varchar(255) NOT NULL COMMENT '분류리스트',
  `bbs_category_use` tinyint(4) NOT NULL DEFAULT '0' COMMENT '분류사용',
  `bbs_skin` varchar(255) NOT NULL COMMENT '사용스킨',
  `bbs_order` varchar(255) NOT NULL COMMENT '정렬조건',
  `bbs_sub_len` int(11) NOT NULL DEFAULT '0' COMMENT '제목길이',
  `bbs_new_time` int(11) NOT NULL DEFAULT '0' COMMENT 'NEW',
  `bbs_hit_time` int(11) NOT NULL DEFAULT '0' COMMENT 'HIT',
  `bbs_rows` int(11) NOT NULL DEFAULT '0' COMMENT '목록게시물수',
  `bbs_gallery` int(11) NOT NULL DEFAULT '0' COMMENT '가로이미지수',
  `bbs_thumb_width` int(11) NOT NULL DEFAULT '0' COMMENT '목록가로썸네일',
  `bbs_thumb_height` int(11) NOT NULL DEFAULT '0' COMMENT '목록세로썸네일',
  `bbs_view_image` int(11) NOT NULL DEFAULT '0' COMMENT '내용이미지크기',
  `bbs_view_list` tinyint(4) NOT NULL DEFAULT '0' COMMENT '내용하단목록',
  `bbs_name` tinyint(4) NOT NULL DEFAULT '0' COMMENT '표기방식',
  `bbs_privacy` tinyint(4) NOT NULL DEFAULT '0' COMMENT '프라이버시',
  `bbs_reply_write` tinyint(4) NOT NULL DEFAULT '0' COMMENT '댓글작성',
  `bbs_secret` tinyint(4) NOT NULL DEFAULT '0' COMMENT '비밀글',
  `bbs_list_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '목록권한',
  `bbs_read_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '내용권한',
  `bbs_write_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '작성권한',
  `bbs_answer_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '답변권한',
  `bbs_reply_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '댓글권한',
  `bbs_download_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '다운권한',
  `bbs_file_limit` int(11) NOT NULL DEFAULT '0' COMMENT '업로드갯수',
  `bbs_file_size` int(11) NOT NULL DEFAULT '0' COMMENT '최대용량',
  `bbs_write_cash` int(11) NOT NULL DEFAULT '0' COMMENT '작성적립금',
  `bbs_reply_cash` int(11) NOT NULL DEFAULT '0' COMMENT '댓글적립금',
  `bbs_write_text` text NOT NULL COMMENT '글쓰기기본내용',
  `bbs_text_top` text NOT NULL COMMENT '상단내용',
  `bbs_text_bottom` text NOT NULL COMMENT '하단내용',
  `bbs_include_top` varchar(255) NOT NULL,
  `bbs_include_bottom` varchar(255) NOT NULL,
  `bbs_write_count` int(11) NOT NULL DEFAULT '0' COMMENT '글카운트',
  `bbs_reply_count` int(11) NOT NULL DEFAULT '0' COMMENT '댓글카운트',
  `bbs_notice` tinyint(4) NOT NULL DEFAULT '0' COMMENT '공지유무',
  `bottom_view` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '생성일',
  PRIMARY KEY (`bbs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_bookmark`
--

CREATE TABLE IF NOT EXISTS `shop_bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mode` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `target` tinyint(4) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `index_position` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=128 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_calendar`
--

CREATE TABLE IF NOT EXISTS `shop_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL DEFAULT '0' COMMENT '코드',
  `user_id` varchar(50) NOT NULL COMMENT '회원아이디',
  `title` varchar(255) NOT NULL COMMENT '제목',
  `date` date NOT NULL DEFAULT '0000-00-00' COMMENT '날짜',
  `date1` date NOT NULL DEFAULT '0000-00-00' COMMENT '시작일',
  `date2` date NOT NULL DEFAULT '0000-00-00' COMMENT '종료일',
  `h1` varchar(2) NOT NULL COMMENT '시',
  `h2` varchar(2) NOT NULL COMMENT '시',
  `i1` varchar(2) NOT NULL COMMENT '분',
  `i2` varchar(2) NOT NULL COMMENT '분',
  `mode` tinyint(4) NOT NULL DEFAULT '0' COMMENT '형식',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '등록일',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_cart`
--

CREATE TABLE IF NOT EXISTS `shop_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL DEFAULT '' COMMENT '회원아이디',
  `guest_id` varchar(50) NOT NULL DEFAULT '' COMMENT '비회원',
  `item_id` int(11) NOT NULL DEFAULT '0' COMMENT '상품아이디',
  `order_code` varchar(50) NOT NULL COMMENT '주문번호',
  `order_option` int(11) NOT NULL DEFAULT '0' COMMENT '옵션아이디',
  `order_limit` int(11) NOT NULL DEFAULT '0' COMMENT '주문수량',
  `order_coupon` int(11) NOT NULL DEFAULT '0' COMMENT '쿠폰금액',
  `order_coupon_id` int(11) NOT NULL DEFAULT '0' COMMENT '발급된쿠폰아이디',
  `order_delivery_pay` int(11) NOT NULL DEFAULT '0' COMMENT '착불배송비',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '담은날짜',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_cash`
--

CREATE TABLE IF NOT EXISTS `shop_cash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL DEFAULT '',
  `user_name` varchar(50) NOT NULL COMMENT '회원이름',
  `content` varchar(255) NOT NULL DEFAULT '',
  `cash` int(11) NOT NULL DEFAULT '0',
  `cash_key1` varchar(50) NOT NULL,
  `cash_key2` varchar(50) NOT NULL,
  `cash_key3` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_user` (`user_id`),
  KEY `index_insert` (`user_id`,`cash_key1`,`cash_key2`,`cash_key3`),
  KEY `index_datetime` (`datetime`,`cash`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_category`
--

CREATE TABLE IF NOT EXISTS `shop_category` (
  `id` int(11) NOT NULL DEFAULT '0' COMMENT '고유번호',
  `category` tinyint(4) NOT NULL DEFAULT '0',
  `code` int(11) NOT NULL DEFAULT '0' COMMENT '카테고리 코드',
  `position` int(11) NOT NULL DEFAULT '0' COMMENT '위치',
  `subject` varchar(255) NOT NULL DEFAULT '' COMMENT '카테고리명',
  `log` varchar(255) NOT NULL,
  `view` tinyint(4) NOT NULL COMMENT '숨김보임',
  `skin` varchar(255) NOT NULL COMMENT '사용스킨',
  `item_width` int(11) NOT NULL COMMENT '가로',
  `item_height` int(11) NOT NULL COMMENT '세로',
  `thumb_use` tinyint(4) NOT NULL DEFAULT '0',
  `thumb_width` int(11) NOT NULL COMMENT '썸네일가로',
  `thumb_height` int(11) NOT NULL COMMENT '썸네일세로',
  `text_top` text NOT NULL COMMENT '상단내용',
  `text_bottom` text NOT NULL COMMENT '하단내용',
  `include_top` varchar(255) NOT NULL,
  `include_bottom` varchar(255) NOT NULL,
  `item_icon` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '등록일',
  PRIMARY KEY (`id`),
  KEY `category` (`category`,`code`,`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_config`
--

CREATE TABLE IF NOT EXISTS `shop_config` (
  `company_name` varchar(255) NOT NULL DEFAULT '',
  `shop_name` varchar(255) NOT NULL DEFAULT '',
  `domain_type` tinyint(4) NOT NULL DEFAULT '0',
  `ssl_use` tinyint(4) NOT NULL DEFAULT '0',
  `company_number1` varchar(255) NOT NULL DEFAULT '',
  `company_number2` varchar(255) NOT NULL DEFAULT '',
  `number1` varchar(10) NOT NULL DEFAULT '',
  `number2` varchar(10) NOT NULL DEFAULT '',
  `number3` varchar(10) NOT NULL DEFAULT '',
  `fax1` varchar(10) NOT NULL DEFAULT '',
  `fax2` varchar(10) NOT NULL DEFAULT '',
  `fax3` varchar(10) NOT NULL DEFAULT '',
  `zip1` varchar(10) NOT NULL DEFAULT '',
  `zip2` varchar(10) NOT NULL DEFAULT '',
  `addr1` varchar(255) NOT NULL DEFAULT '',
  `addr2` varchar(255) NOT NULL DEFAULT '',
  `ceo_name` varchar(255) NOT NULL DEFAULT '',
  `ceo_email` varchar(255) NOT NULL DEFAULT '',
  `admin_name` varchar(255) NOT NULL DEFAULT '',
  `admin_email` varchar(255) NOT NULL DEFAULT '',
  `order_guest_use` tinyint(4) NOT NULL DEFAULT '0',
  `payment_type1` tinyint(4) NOT NULL DEFAULT '0',
  `payment_type2` tinyint(4) NOT NULL DEFAULT '0',
  `payment_type3` tinyint(4) NOT NULL DEFAULT '0',
  `payment_type4` tinyint(4) NOT NULL DEFAULT '0',
  `payment_type5` tinyint(4) NOT NULL DEFAULT '0',
  `payment_type6` tinyint(4) NOT NULL DEFAULT '0',
  `bank_name` varchar(255) NOT NULL DEFAULT '',
  `bank_number` varchar(255) NOT NULL DEFAULT '',
  `bank_holder` varchar(255) NOT NULL DEFAULT '',
  `order_pgbank_day` int(11) NOT NULL DEFAULT '0' COMMENT 'PG가상계좌입금기한',
  `order_bank_day` int(11) NOT NULL DEFAULT '0' COMMENT '무통장 입금취소 기간',
  `order_receive_day` tinyint(4) NOT NULL DEFAULT '0' COMMENT '교환반품기간',
  `order_exchange_day` tinyint(4) NOT NULL DEFAULT '0' COMMENT '교환신청기간',
  `cart_day` int(11) NOT NULL DEFAULT '0' COMMENT '장바구니보관기간',
  `view_day` int(11) NOT NULL DEFAULT '0' COMMENT '최근본상품기간',
  `order_pg` tinyint(4) NOT NULL DEFAULT '0' COMMENT '결제모듈',
  `order_escrow_use` tinyint(4) NOT NULL DEFAULT '0' COMMENT '에스크로사용유무',
  `order_escrow_money` int(11) NOT NULL DEFAULT '0' COMMENT '에스크로결제금액',
  `order_card_percent` int(11) NOT NULL DEFAULT '0',
  `order_mobile_percent` int(11) NOT NULL DEFAULT '0',
  `order_cash_min` int(11) NOT NULL DEFAULT '0',
  `order_first_use` tinyint(4) NOT NULL DEFAULT '0',
  `order_first_cash` int(4) NOT NULL DEFAULT '0',
  `order_cash_use` tinyint(4) NOT NULL DEFAULT '0',
  `delivery_money` int(11) NOT NULL DEFAULT '0',
  `delivery_money_free` int(11) NOT NULL DEFAULT '0',
  `item_option1` varchar(255) NOT NULL DEFAULT '',
  `item_option2` varchar(255) NOT NULL DEFAULT '',
  `item_option3` varchar(255) NOT NULL DEFAULT '',
  `item_option4` varchar(255) NOT NULL DEFAULT '',
  `item_option5` varchar(255) NOT NULL DEFAULT '',
  `domain` varchar(255) NOT NULL DEFAULT '',
  `cookie_domain` varchar(100) NOT NULL COMMENT '쿠키도메인',
  `serial_key` varchar(50) NOT NULL DEFAULT '',
  `agency_name` varchar(255) NOT NULL DEFAULT '',
  `agency_url` varchar(255) NOT NULL DEFAULT '',
  `agency_tel` varchar(255) NOT NULL DEFAULT '',
  `birth_cash_use` tinyint(4) NOT NULL DEFAULT '0',
  `birth_cash` int(11) NOT NULL DEFAULT '0',
  `article_cash_use` tinyint(4) NOT NULL DEFAULT '0',
  `reply_cash_use` tinyint(4) NOT NULL DEFAULT '0',
  `version` varchar(100) NOT NULL,
  `version_code` int(11) NOT NULL DEFAULT '0',
  `version_date` date NOT NULL DEFAULT '0000-00-00',
  `kcp_site_code` varchar(100) NOT NULL,
  `kcp_site_key` varchar(100) NOT NULL,
  `kcp_site_name` varchar(100) NOT NULL,
  `kcp_site_file` varchar(100) NOT NULL,
  `kcp_site_logo` varchar(255) NOT NULL,
  `kicc_site_code` varchar(100) NOT NULL,
  `kicc_site_key` varchar(100) NOT NULL,
  `kicc_site_name` varchar(100) NOT NULL,
  `kicc_site_file` varchar(100) NOT NULL,
  `kicc_site_logo` varchar(255) NOT NULL,
  `parcel_id` int(11) NOT NULL DEFAULT '0' COMMENT '택배사아이디',
  `parcel_name` varchar(100) NOT NULL,
  `parcel_tel` varchar(100) NOT NULL,
  `parcel_url` varchar(255) NOT NULL,
  `parcel_search_url` varchar(255) NOT NULL,
  `parcel_money` int(11) NOT NULL DEFAULT '0',
  `sms_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'SMS회사',
  `icode_id` varchar(100) NOT NULL,
  `icode_pw` varchar(100) NOT NULL,
  `sms1` varchar(10) NOT NULL,
  `sms2` varchar(10) NOT NULL,
  `sms3` varchar(10) NOT NULL,
  `rec_sms1` varchar(10) NOT NULL,
  `rec_sms2` varchar(10) NOT NULL,
  `rec_sms3` varchar(10) NOT NULL,
  `real_type` tinyint(4) NOT NULL DEFAULT '0',
  `kcb_id` varchar(100) NOT NULL,
  `item_delivery_text` text NOT NULL,
  `item_refund_text` text NOT NULL,
  `user_level0` varchar(100) NOT NULL COMMENT '비회원등급명',
  `user_level1` varchar(100) NOT NULL COMMENT '1레벨등급명',
  `user_level2` varchar(100) NOT NULL COMMENT '2레벨등급명',
  `user_level3` varchar(100) NOT NULL COMMENT '3레벨등급명',
  `user_level4` varchar(100) NOT NULL COMMENT '4레벨등급명',
  `user_level5` varchar(100) NOT NULL COMMENT '5레벨등급명',
  `user_level6` varchar(100) NOT NULL COMMENT '6레벨등급명',
  `user_level7` varchar(100) NOT NULL COMMENT '7레벨등급명',
  `user_level8` varchar(100) NOT NULL COMMENT '8레벨등급명',
  `user_level9` varchar(100) NOT NULL COMMENT '9레벨등급명',
  `user_level10` varchar(100) NOT NULL COMMENT '10레벨등급명',
  `reply_write_level` int(11) NOT NULL DEFAULT '0' COMMENT '상품평 작성권한',
  `qna_write_level` int(11) NOT NULL DEFAULT '0' COMMENT '상품문의 작성권한',
  `block_ip` text NOT NULL,
  `block_keyword` text NOT NULL,
  `mouse_event` tinyint(4) NOT NULL DEFAULT '0',
  `coupon_auto_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '쿠폰자동발송시간',
  `cash_auto_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '적립금자동지급시간',
  `dm_user_id` varchar(100) NOT NULL,
  `dm_user_pw` varchar(100) NOT NULL,
  `zipcode` tinyint(4) NOT NULL DEFAULT '0',
  `syndi_type` tinyint(4) NOT NULL DEFAULT '0',
  `syndi_token` varchar(255) NOT NULL,
  `login_naver_id` varchar(100) NOT NULL,
  `login_naver_secret` varchar(100) NOT NULL,
  `login_kakao_key` varchar(100) NOT NULL,
  `login_facebook_id` varchar(100) NOT NULL,
  `login_facebook_secret` varchar(100) NOT NULL,
  `login_twitter_key` varchar(100) NOT NULL,
  `login_twitter_secret` varchar(100) NOT NULL,
  `login_google_id` varchar(100) NOT NULL,
  `login_google_secret` varchar(100) NOT NULL,
  `login_naver_count` int(11) NOT NULL default '0',
  `login_kakao_count` int(11) NOT NULL default '0',
  `login_facebook_count` int(11) NOT NULL default '0',
  `login_twitter_count` int(11) NOT NULL default '0',
  `login_google_count` int(11) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_coupon`
--

CREATE TABLE IF NOT EXISTS `shop_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '쿠폰유형',
  `coupon_title` varchar(255) NOT NULL DEFAULT '' COMMENT '쿠폰제목',
  `coupon_max` int(11) NOT NULL DEFAULT '0' COMMENT '발행매수',
  `coupon_down` int(11) NOT NULL DEFAULT '0' COMMENT '다운수',
  `coupon_order` int(11) NOT NULL DEFAULT '0' COMMENT '쿠폰사용수',
  `coupon_discount_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '할인방식',
  `coupon_discount` int(11) NOT NULL DEFAULT '0' COMMENT '할인금액,할인퍼센트',
  `coupon_discount_max` int(11) NOT NULL DEFAULT '0' COMMENT '할인금액,할인퍼센트',
  `coupon_discount_min` int(11) NOT NULL DEFAULT '0' COMMENT '할인조건(최소판매가)',
  `coupon_day_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '사용기간타입',
  `coupon_date1` date NOT NULL DEFAULT '0000-00-00' COMMENT '사용기간(시작)',
  `coupon_date2` date NOT NULL DEFAULT '0000-00-00' COMMENT '사용기간(종료)',
  `coupon_day` int(11) NOT NULL DEFAULT '0' COMMENT '발급일로부터사용기간',
  `coupon_category_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '이용 카테고리 타입',
  `coupon_category` int(11) NOT NULL DEFAULT '0' COMMENT '사용가능분류',
  `coupon_plan` int(11) NOT NULL DEFAULT '0' COMMENT '사용가능기획전',
  `coupon_bank` tinyint(4) NOT NULL DEFAULT '0' COMMENT '무통장만사용가능',
  `coupon_cash` tinyint(4) NOT NULL DEFAULT '0' COMMENT '적립금사용불가',
  `coupon_overlap` tinyint(4) NOT NULL DEFAULT '0' COMMENT '중복다운불가',
  `coupon_image` int(11) NOT NULL DEFAULT '0' COMMENT '쿠폰 이미지',
  `coupon_image_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '기본 이미지 형식',
  `coupon_use` tinyint(4) NOT NULL DEFAULT '0' COMMENT '지급가능여부',
  `coupon_auto` tinyint(4) NOT NULL DEFAULT '0' COMMENT '자동지급타입',
  `coupon_order_money` int(11) NOT NULL DEFAULT '0' COMMENT '금액이상구매시자동지급설정',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '생성날짜',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_coupon_file`
--

CREATE TABLE IF NOT EXISTS `shop_coupon_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) NOT NULL DEFAULT '0',
  `upload_mode` varchar(255) NOT NULL,
  `upload_source` varchar(255) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `upload_filesize` int(11) NOT NULL DEFAULT '0',
  `upload_width` int(11) NOT NULL DEFAULT '0',
  `upload_height` int(11) NOT NULL DEFAULT '0',
  `upload_type` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_upload` (`coupon_id`,`upload_mode`),
  KEY `index_delete` (`coupon_id`),
  KEY `index_view` (`coupon_id`,`upload_type`,`upload_file`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_coupon_list`
--

CREATE TABLE IF NOT EXISTS `shop_coupon_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL DEFAULT '' COMMENT '회원아이디',
  `user_name` varchar(50) NOT NULL COMMENT '회원성명',
  `coupon_id` int(11) NOT NULL DEFAULT '0' COMMENT '쿠폰아이디',
  `coupon_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '쿠폰 형식',
  `coupon_title` varchar(255) NOT NULL DEFAULT '' COMMENT '쿠폰제목',
  `coupon_number` varchar(100) NOT NULL COMMENT '인쇄용쿠폰',
  `coupon_discount_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '할인방식',
  `coupon_discount` int(11) NOT NULL DEFAULT '0' COMMENT '할인금액,할인퍼센트',
  `coupon_discount_max` int(11) NOT NULL DEFAULT '0' COMMENT '할인금액,할인퍼센트',
  `coupon_discount_min` int(11) NOT NULL DEFAULT '0' COMMENT '할인조건(최소판매가)',
  `coupon_date1` date NOT NULL DEFAULT '0000-00-00' COMMENT '사용기간(시작)',
  `coupon_date2` date NOT NULL DEFAULT '0000-00-00' COMMENT '사용기간(종료)',
  `coupon_category_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '이용 카테고리 타입',
  `coupon_category` int(11) NOT NULL DEFAULT '0' COMMENT '사용가능분류',
  `coupon_plan` int(11) NOT NULL DEFAULT '0' COMMENT '사용가능기획전',
  `coupon_bank` tinyint(4) NOT NULL DEFAULT '0' COMMENT '무통장만사용가능',
  `coupon_cash` tinyint(4) NOT NULL DEFAULT '0' COMMENT '적립금사용불가',
  `coupon_overlap` tinyint(4) NOT NULL DEFAULT '0' COMMENT '중복다운불가',
  `coupon_use` tinyint(4) NOT NULL DEFAULT '0' COMMENT '지급가능여부',
  `coupon_mode` tinyint(4) NOT NULL DEFAULT '0' COMMENT '쿠폰상태',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '다운날짜',
  `item_id` int(11) NOT NULL DEFAULT '0' COMMENT '상품아이디',
  `item_code` varchar(255) NOT NULL COMMENT '상품코드',
  `item_title` varchar(255) NOT NULL COMMENT '상품명',
  `cart_id` int(11) NOT NULL DEFAULT '0' COMMENT '장바구니아이디',
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '주문아이디',
  `order_code` varchar(255) NOT NULL COMMENT '주문번호',
  `order_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '주문시간',
  PRIMARY KEY (`id`),
  KEY `index_user` (`user_id`),
  KEY `index_coupon` (`coupon_id`),
  KEY `coupon_print` (`user_id`,`coupon_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_design`
--

CREATE TABLE IF NOT EXISTS `shop_design` (
  `display1_type` tinyint(4) NOT NULL DEFAULT '0',
  `display1_top` int(11) NOT NULL DEFAULT '0',
  `display2_type` tinyint(4) NOT NULL DEFAULT '0',
  `display2_top` int(11) NOT NULL DEFAULT '0',
  `display3_type` tinyint(4) NOT NULL DEFAULT '0',
  `display3_top` int(11) NOT NULL DEFAULT '0',
  `display4_type` tinyint(4) NOT NULL DEFAULT '0',
  `display4_top` int(11) NOT NULL DEFAULT '0',
  `display5_type` tinyint(4) NOT NULL DEFAULT '0',
  `display5_top` int(11) NOT NULL DEFAULT '0',
  `main_tag_top_text` text NOT NULL,
  `main_tag_bottom_text` text NOT NULL,
  `main_body_position` tinyint(4) NOT NULL DEFAULT '0',
  `main_layout` tinyint(4) NOT NULL DEFAULT '0',
  `main_width_use` tinyint(4) NOT NULL DEFAULT '0',
  `main_width` varchar(50) NOT NULL,
  `main_menu_width` int(11) NOT NULL DEFAULT '0',
  `main_center_width` int(11) NOT NULL DEFAULT '0',
  `main_mc_width` int(11) NOT NULL DEFAULT '0',
  `main_background_image_type` int(4) NOT NULL DEFAULT '0',
  `main_background_color` varchar(10) NOT NULL,
  `main_scrollbox_top` int(11) NOT NULL DEFAULT '0' COMMENT '스크롤박스 상단높이',
  `sub_body_position` tinyint(4) NOT NULL DEFAULT '0',
  `sub_layout` tinyint(4) NOT NULL DEFAULT '0',
  `sub_width_use` tinyint(4) NOT NULL DEFAULT '0',
  `sub_width` varchar(50) NOT NULL,
  `sub_menu_width` int(11) NOT NULL DEFAULT '0',
  `sub_center_width` int(11) NOT NULL DEFAULT '0',
  `sub_mc_width` int(11) NOT NULL DEFAULT '0',
  `sub_background_image_type` tinyint(4) NOT NULL DEFAULT '0',
  `sub_background_color` varchar(10) NOT NULL,
  `sub_scrollbox_top` int(11) NOT NULL DEFAULT '0' COMMENT '스크롤박스 상단높이'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_design_bottom`
--

CREATE TABLE IF NOT EXISTS `shop_design_bottom` (
  `bottom_layout` tinyint(4) NOT NULL DEFAULT '0',
  `bottom_servicemenu1_font_family` varchar(100) NOT NULL,
  `bottom_servicemenu1_font_size` int(11) NOT NULL DEFAULT '0',
  `bottom_servicemenu1_font_height` int(11) NOT NULL DEFAULT '0',
  `bottom_servicemenu1_font_color` varchar(10) NOT NULL,
  `bottom_servicemenu1_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `bottom_servicemenu2_font_family` varchar(100) NOT NULL,
  `bottom_servicemenu2_font_size` int(11) NOT NULL DEFAULT '0',
  `bottom_servicemenu2_font_height` int(11) NOT NULL DEFAULT '0',
  `bottom_servicemenu2_font_color` varchar(10) NOT NULL,
  `bottom_servicemenu2_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `bottom_information_font_family` varchar(100) NOT NULL,
  `bottom_information_font_size` int(11) NOT NULL DEFAULT '0',
  `bottom_information_font_height` int(11) NOT NULL DEFAULT '0',
  `bottom_information_font_color` varchar(10) NOT NULL,
  `bottom_information_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `bottom_information_position` tinyint(4) NOT NULL DEFAULT '0',
  `bottom_copyright_font_family` varchar(100) NOT NULL,
  `bottom_copyright_font_size` int(11) NOT NULL DEFAULT '0',
  `bottom_copyright_font_height` int(11) NOT NULL DEFAULT '0',
  `bottom_copyright_font_color` varchar(10) NOT NULL,
  `bottom_copyright_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `bottom_copyright_position` tinyint(4) NOT NULL DEFAULT '0',
  `bottom_tag` text NOT NULL COMMENT 'HTML 입력'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_design_file`
--

CREATE TABLE IF NOT EXISTS `shop_design_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `upload_mode` varchar(255) NOT NULL,
  `upload_source` varchar(255) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `upload_filesize` int(11) NOT NULL DEFAULT '0',
  `upload_width` int(11) NOT NULL DEFAULT '0',
  `upload_height` int(11) NOT NULL DEFAULT '0',
  `upload_type` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_upload` (`upload_mode`),
  KEY `index_view` (`upload_type`,`upload_file`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=209 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_design_font`
--

CREATE TABLE IF NOT EXISTS `shop_design_font` (
  `ct_item_title_font_family` varchar(255) NOT NULL,
  `ct_item_title_font_size` int(11) NOT NULL DEFAULT '0',
  `ct_item_title_font_color` varchar(10) NOT NULL,
  `ct_item_title_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `ct_item_title_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `ct_item_title_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `ct_item_money_font_family` varchar(255) NOT NULL,
  `ct_item_money_font_size` int(11) NOT NULL DEFAULT '0',
  `ct_item_money_font_color` varchar(10) NOT NULL,
  `ct_item_money_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `ct_item_money_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `ct_item_money_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `ct_item_price_font_family` varchar(255) NOT NULL,
  `ct_item_price_font_size` int(11) NOT NULL DEFAULT '0',
  `ct_item_price_font_color` varchar(10) NOT NULL,
  `ct_item_price_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `ct_item_price_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `ct_item_price_font_through` tinyint(4) NOT NULL DEFAULT '0',
  `ct_etc_font_family` varchar(255) NOT NULL,
  `ct_etc_font_size` int(11) NOT NULL DEFAULT '0',
  `ct_etc_font_color` varchar(10) NOT NULL,
  `ct_etc_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `ct_etc_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `ct_etc_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `ct_line_font_family` varchar(255) NOT NULL,
  `ct_line_font_size` int(11) NOT NULL DEFAULT '0',
  `ct_line_font_color` varchar(10) NOT NULL,
  `ct_line_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `ct_line_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `ct_line_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `pl_item_title_font_family` varchar(255) NOT NULL,
  `pl_item_title_font_size` int(11) NOT NULL DEFAULT '0',
  `pl_item_title_font_color` varchar(10) NOT NULL,
  `pl_item_title_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `pl_item_title_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `pl_item_title_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `pl_item_money_font_family` varchar(255) NOT NULL,
  `pl_item_money_font_size` int(11) NOT NULL DEFAULT '0',
  `pl_item_money_font_color` varchar(10) NOT NULL,
  `pl_item_money_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `pl_item_money_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `pl_item_money_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `pl_item_price_font_family` varchar(255) NOT NULL,
  `pl_item_price_font_size` int(11) NOT NULL DEFAULT '0',
  `pl_item_price_font_color` varchar(10) NOT NULL,
  `pl_item_price_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `pl_item_price_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `pl_item_price_font_through` tinyint(4) NOT NULL DEFAULT '0',
  `pl_etc_font_family` varchar(255) NOT NULL,
  `pl_etc_font_size` int(11) NOT NULL DEFAULT '0',
  `pl_etc_font_color` varchar(10) NOT NULL,
  `pl_etc_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `pl_etc_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `pl_etc_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `pl_line_font_family` varchar(255) NOT NULL,
  `pl_line_font_size` int(11) NOT NULL DEFAULT '0',
  `pl_line_font_color` varchar(10) NOT NULL,
  `pl_line_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `pl_line_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `pl_line_font_underline` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_design_hmbar`
--

CREATE TABLE IF NOT EXISTS `shop_design_hmbar` (
  `hmbar_width` int(11) NOT NULL DEFAULT '0',
  `hmbar_height` int(11) NOT NULL DEFAULT '0',
  `hmbar_background_color` varchar(10) NOT NULL,
  `hmbar_position` tinyint(4) NOT NULL DEFAULT '0',
  `hmbar_margin1` int(11) NOT NULL DEFAULT '0',
  `hmbar_margin2` int(11) NOT NULL DEFAULT '0',
  `hmbar_line_use` tinyint(4) NOT NULL DEFAULT '0',
  `hmbar_line_color` varchar(10) NOT NULL,
  `hmbar_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `hmbar_text1_font_family` varchar(100) NOT NULL,
  `hmbar_text1_font_size` int(11) NOT NULL DEFAULT '0',
  `hmbar_text1_font_color` varchar(10) NOT NULL,
  `hmbar_text1_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `hmbar_text1_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `hmbar_text1_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `hmbar_text2_font_family` varchar(100) NOT NULL,
  `hmbar_text2_font_size` int(11) NOT NULL DEFAULT '0',
  `hmbar_text2_font_color` varchar(10) NOT NULL,
  `hmbar_text2_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `hmbar_text2_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `hmbar_text2_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `hmbar_image1_font_size` int(11) NOT NULL DEFAULT '0',
  `hmbar_image1_font_color` varchar(10) NOT NULL,
  `hmbar_image1_transparent` tinyint(4) NOT NULL DEFAULT '0',
  `hmbar_image2_font_size` int(11) NOT NULL DEFAULT '0',
  `hmbar_image2_font_color` varchar(10) NOT NULL,
  `hmbar_image2_transparent` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_design_hmlist`
--

CREATE TABLE IF NOT EXISTS `shop_design_hmlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '고유번호',
  `menu_type` varchar(255) NOT NULL COMMENT '형식',
  `menu_id` varchar(255) NOT NULL COMMENT '아이디',
  `image_width` int(11) NOT NULL DEFAULT '0',
  `image_height` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_design_image`
--

CREATE TABLE IF NOT EXISTS `shop_design_image` (
  `image_category_use` tinyint(4) NOT NULL DEFAULT '0',
  `image_category` varchar(50) NOT NULL,
  `image_category_width` int(11) NOT NULL DEFAULT '0',
  `image_category_height` int(11) NOT NULL DEFAULT '0',
  `image_category_thumb_type` tinyint(4) NOT NULL DEFAULT '0',
  `image_category1_border` int(11) NOT NULL DEFAULT '0',
  `image_category1_border_color` varchar(10) NOT NULL,
  `image_category2_border` int(11) NOT NULL DEFAULT '0',
  `image_category2_border_color` varchar(10) NOT NULL,
  `image_plan_use` tinyint(4) NOT NULL DEFAULT '0',
  `image_plan` varchar(50) NOT NULL,
  `image_plan_width` int(11) NOT NULL DEFAULT '0',
  `image_plan_height` int(11) NOT NULL DEFAULT '0',
  `image_plan_thumb_type` tinyint(4) NOT NULL DEFAULT '0',
  `image_plan1_border` int(11) NOT NULL DEFAULT '0',
  `image_plan1_border_color` varchar(10) NOT NULL,
  `image_plan2_border` int(11) NOT NULL DEFAULT '0',
  `image_plan2_border_color` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_design_item`
--

CREATE TABLE IF NOT EXISTS `shop_design_item` (
  `buy_use1` tinyint(4) NOT NULL DEFAULT '0',
  `buy_use2` tinyint(4) NOT NULL DEFAULT '0',
  `buy_use3` tinyint(4) NOT NULL DEFAULT '0',
  `buy_use4` tinyint(4) NOT NULL DEFAULT '0',
  `buy_use5` tinyint(4) NOT NULL DEFAULT '0',
  `buy_use6` tinyint(4) NOT NULL DEFAULT '0',
  `sns_use1` tinyint(4) NOT NULL DEFAULT '0',
  `sns_use2` tinyint(4) NOT NULL DEFAULT '0',
  `sns_use3` tinyint(4) NOT NULL DEFAULT '0',
  `sns_use4` tinyint(4) NOT NULL DEFAULT '0',
  `sns_use5` tinyint(4) NOT NULL DEFAULT '0',
  `sns_use6` tinyint(4) NOT NULL DEFAULT '0',
  `item_gallery` int(11) NOT NULL DEFAULT '0',
  `item_relation` int(11) NOT NULL DEFAULT '0',
  `tab_use1` tinyint(4) NOT NULL DEFAULT '0',
  `tab_use2` tinyint(4) NOT NULL DEFAULT '0',
  `tab_use3` tinyint(4) NOT NULL DEFAULT '0',
  `tab_use4` tinyint(4) NOT NULL DEFAULT '0',
  `tab_use5` tinyint(4) NOT NULL DEFAULT '0',
  `item_option1` varchar(255) NOT NULL,
  `item_option2` varchar(255) NOT NULL,
  `item_option3` varchar(255) NOT NULL,
  `item_option4` varchar(255) NOT NULL,
  `item_option5` varchar(255) NOT NULL,
  `item_option6` varchar(255) NOT NULL,
  `item_option7` varchar(255) NOT NULL,
  `item_option8` varchar(255) NOT NULL,
  `item_option9` varchar(255) NOT NULL,
  `item_option10` varchar(255) NOT NULL,
  `thumb_type` tinyint(4) NOT NULL DEFAULT '0',
  `smart_zoom` tinyint(4) NOT NULL DEFAULT '0',
  `image_default_use` tinyint(4) NOT NULL DEFAULT '0',
  `image_default` varchar(50) NOT NULL,
  `image_default_width` int(11) NOT NULL DEFAULT '0',
  `image_default_height` int(11) NOT NULL DEFAULT '0',
  `image_default1_border` tinyint(4) NOT NULL DEFAULT '0',
  `image_default1_border_color` varchar(10) NOT NULL,
  `image_default2_border` tinyint(4) NOT NULL DEFAULT '0',
  `image_default2_border_color` varchar(10) NOT NULL,
  `image_gallery_thumb_use` tinyint(4) NOT NULL DEFAULT '0',
  `image_gallery_thumb` varchar(50) NOT NULL,
  `image_gallery_thumb_width` int(11) NOT NULL DEFAULT '0',
  `image_gallery_thumb_height` int(11) NOT NULL DEFAULT '0',
  `image_gallery1_border` tinyint(4) NOT NULL DEFAULT '0',
  `image_gallery1_border_color` varchar(10) NOT NULL,
  `image_gallery2_border` tinyint(4) NOT NULL DEFAULT '0',
  `image_gallery2_border_color` varchar(10) NOT NULL,
  `image_relation_use` tinyint(4) NOT NULL DEFAULT '0',
  `image_relation` varchar(50) NOT NULL,
  `image_relation_width` int(11) NOT NULL DEFAULT '0',
  `image_relation_height` int(11) NOT NULL DEFAULT '0',
  `image_relation1_border` tinyint(4) NOT NULL DEFAULT '0',
  `image_relation1_border_color` varchar(10) NOT NULL,
  `image_relation2_border` tinyint(4) NOT NULL DEFAULT '0',
  `image_relation2_border_color` varchar(10) NOT NULL,
  `item_image_width` int(11) NOT NULL DEFAULT '0',
  `item_title_font_family` varchar(50) NOT NULL,
  `item_title_font_size` int(11) NOT NULL DEFAULT '0',
  `item_title_font_color` varchar(10) NOT NULL,
  `item_title_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `item_title_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `item_title_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `item_subtitle_font_family` varchar(50) NOT NULL,
  `item_subtitle_font_size` int(11) NOT NULL DEFAULT '0',
  `item_subtitle_font_color` varchar(10) NOT NULL,
  `item_subtitle_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `item_subtitle_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `item_subtitle_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `item_price_font_family` varchar(50) NOT NULL,
  `item_price_font_size` int(11) NOT NULL DEFAULT '0',
  `item_price_font_color` varchar(10) NOT NULL,
  `item_price_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `item_price_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `item_price_font_through` tinyint(4) NOT NULL DEFAULT '0',
  `item_money_font_family` varchar(50) NOT NULL,
  `item_money_font_size` int(11) NOT NULL DEFAULT '0',
  `item_money_font_color` varchar(10) NOT NULL,
  `item_money_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `item_money_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `item_money_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `item_cash_font_family` varchar(50) NOT NULL,
  `item_cash_font_size` int(11) NOT NULL DEFAULT '0',
  `item_cash_font_color` varchar(10) NOT NULL,
  `item_cash_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `item_cash_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `item_cash_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `item_limit_font_family` varchar(50) NOT NULL,
  `item_limit_font_size` int(11) NOT NULL DEFAULT '0',
  `item_limit_font_color` varchar(10) NOT NULL,
  `item_limit_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `item_limit_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `item_limit_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `item_sale_limit_font_family` varchar(50) NOT NULL,
  `item_sale_limit_font_size` int(11) NOT NULL DEFAULT '0',
  `item_sale_limit_font_color` varchar(10) NOT NULL,
  `item_sale_limit_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `item_sale_limit_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `item_sale_limit_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `item_delivery_money_font_family` varchar(50) NOT NULL,
  `item_delivery_money_font_size` int(11) NOT NULL DEFAULT '0',
  `item_delivery_money_font_color` varchar(10) NOT NULL,
  `item_delivery_money_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `item_delivery_money_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `item_delivery_money_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `item_total_money_font_family` varchar(50) NOT NULL,
  `item_total_money_font_size` int(11) NOT NULL DEFAULT '0',
  `item_total_money_font_color` varchar(10) NOT NULL,
  `item_total_money_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `item_total_money_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `item_total_money_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `item_relation_title_font_family` varchar(50) NOT NULL,
  `item_relation_title_font_size` int(11) NOT NULL DEFAULT '0',
  `item_relation_title_font_color` varchar(10) NOT NULL,
  `item_relation_title_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `item_relation_title_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `item_relation_title_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `item_relation_money_font_family` varchar(50) NOT NULL,
  `item_relation_money_font_size` int(11) NOT NULL DEFAULT '0',
  `item_relation_money_font_color` varchar(10) NOT NULL,
  `item_relation_money_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `item_relation_money_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `item_relation_money_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `item_optiontitle_font_family` varchar(50) NOT NULL,
  `item_optiontitle_font_size` int(11) NOT NULL DEFAULT '0',
  `item_optiontitle_font_color` varchar(10) NOT NULL,
  `item_optiontitle_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `item_optiontitle_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `item_optiontitle_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `item_optioncontent_font_family` varchar(50) NOT NULL,
  `item_optioncontent_font_size` int(11) NOT NULL DEFAULT '0',
  `item_optioncontent_font_color` varchar(10) NOT NULL,
  `item_optioncontent_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `item_optioncontent_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `item_optioncontent_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `help_font_family` varchar(50) NOT NULL,
  `help_font_size` int(11) NOT NULL DEFAULT '0',
  `help_font_color` varchar(10) NOT NULL,
  `help_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `help_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `help_font_underline` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_design_menu`
--

CREATE TABLE IF NOT EXISTS `shop_design_menu` (
  `menu_list_id` varchar(255) NOT NULL,
  `menu_margin_top` int(11) NOT NULL DEFAULT '0',
  `menu_margin_left` int(11) NOT NULL DEFAULT '0',
  `menu_margin_right` int(11) NOT NULL DEFAULT '0',
  `menu_margin_side` int(11) NOT NULL DEFAULT '0',
  `menu_margin_bottom` int(11) NOT NULL DEFAULT '0',
  `menu_tag` text NOT NULL,
  `menu_searchbox_skin` varchar(100) NOT NULL,
  `menu_loginbox_skin` varchar(100) NOT NULL,
  `menu_menubar_use` tinyint(4) NOT NULL DEFAULT '0',
  `menu_menubar_skin` varchar(100) NOT NULL,
  `menu_planbox_skin` varchar(100) NOT NULL,
  `menu_boardbox_skin` varchar(100) NOT NULL,
  `menu_article` varchar(100) NOT NULL,
  `menu_article_skin` varchar(100) NOT NULL,
  `menu_article_sort` varchar(100) NOT NULL,
  `menu_article_use1` tinyint(4) NOT NULL DEFAULT '0',
  `menu_article_use2` tinyint(4) NOT NULL DEFAULT '0',
  `menu_article_use3` tinyint(4) NOT NULL DEFAULT '0',
  `menu_article_width` int(11) NOT NULL DEFAULT '0',
  `menu_article_height` int(11) NOT NULL DEFAULT '0',
  `menu_banner_group` varchar(100) NOT NULL,
  `menu_banner_sort` varchar(100) NOT NULL,
  `menu_banner_skin` varchar(100) NOT NULL,
  `menu_banner_rolling_limit` int(11) NOT NULL DEFAULT '0',
  `menu_banner_rolling_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_design_skin`
--

CREATE TABLE IF NOT EXISTS `shop_design_skin` (
  `skin_main` varchar(100) NOT NULL,
  `skin_main_top` varchar(100) NOT NULL,
  `skin_main_menu` varchar(100) NOT NULL,
  `skin_main_bottom` varchar(100) NOT NULL,
  `skin_main_scrollbox` varchar(100) NOT NULL,
  `skin_sub_top` varchar(100) NOT NULL,
  `skin_sub_menu` varchar(100) NOT NULL,
  `skin_sub_bottom` varchar(100) NOT NULL,
  `skin_sub_scrollbox` varchar(100) NOT NULL,
  `skin_signin` varchar(100) NOT NULL,
  `skin_signup` varchar(100) NOT NULL,
  `skin_find` varchar(100) NOT NULL,
  `skin_zip` varchar(100) NOT NULL,
  `skin_item` varchar(100) NOT NULL,
  `skin_item_gallery` varchar(100) NOT NULL,
  `skin_item_preview` varchar(100) NOT NULL,
  `skin_search` varchar(100) NOT NULL,
  `skin_cart` varchar(100) NOT NULL,
  `skin_favorite` varchar(100) NOT NULL,
  `skin_mypage` varchar(100) NOT NULL,
  `skin_order` varchar(100) NOT NULL,
  `skin_order_list` varchar(100) NOT NULL,
  `skin_order_guest` varchar(100) NOT NULL,
  `skin_order_view` varchar(100) NOT NULL,
  `skin_order_option` varchar(100) NOT NULL,
  `skin_order_address` varchar(100) NOT NULL,
  `skin_order_delivery` varchar(100) NOT NULL,
  `skin_cash` varchar(100) NOT NULL,
  `skin_coupon` varchar(100) NOT NULL,
  `skin_payment` varchar(100) NOT NULL COMMENT '개별결제창',
  `skin_cancel` varchar(100) NOT NULL,
  `skin_exchange` varchar(100) NOT NULL,
  `skin_refund` varchar(100) NOT NULL,
  `skin_help` varchar(100) NOT NULL,
  `skin_popup` varchar(100) NOT NULL,
  `skin_sms` varchar(100) NOT NULL,
  `skin_email` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_design_top`
--

CREATE TABLE IF NOT EXISTS `shop_design_top` (
  `top_layout` tinyint(4) NOT NULL DEFAULT '0',
  `top_banner1_group` varchar(100) NOT NULL,
  `top_banner1_sort` varchar(100) NOT NULL,
  `top_banner1_skin` varchar(100) NOT NULL,
  `top_banner1_rolling_limit` int(11) NOT NULL DEFAULT '0',
  `top_banner1_rolling_time` int(11) NOT NULL DEFAULT '0',
  `top_banner2_group` varchar(100) NOT NULL,
  `top_banner2_sort` varchar(100) NOT NULL,
  `top_banner2_skin` varchar(100) NOT NULL,
  `top_banner2_rolling_limit` int(11) NOT NULL DEFAULT '0',
  `top_banner2_rolling_time` int(11) NOT NULL DEFAULT '0',
  `top_article` varchar(100) NOT NULL,
  `top_article_skin` varchar(100) NOT NULL,
  `top_article_sort` varchar(100) NOT NULL,
  `top_article_use1` tinyint(4) NOT NULL DEFAULT '0',
  `top_article_use2` tinyint(4) NOT NULL DEFAULT '0',
  `top_article_use3` tinyint(4) NOT NULL DEFAULT '0',
  `top_article_width` int(11) NOT NULL DEFAULT '0',
  `top_article_height` int(11) NOT NULL DEFAULT '0',
  `top_searchbox_skin` varchar(100) NOT NULL,
  `top_servicemenu1_font_family` varchar(100) NOT NULL,
  `top_servicemenu1_font_size` int(11) NOT NULL DEFAULT '0',
  `top_servicemenu1_font_color` varchar(10) NOT NULL,
  `top_servicemenu1_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `top_servicemenu2_font_family` varchar(100) NOT NULL,
  `top_servicemenu2_font_size` int(11) NOT NULL DEFAULT '0',
  `top_servicemenu2_font_color` varchar(10) NOT NULL,
  `top_servicemenu2_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `top_menubar_use` tinyint(4) NOT NULL DEFAULT '0',
  `top_menubar_skin` varchar(100) NOT NULL,
  `top_bottom_height` int(11) NOT NULL DEFAULT '0' COMMENT '하단여백'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_design_wmbar`
--

CREATE TABLE IF NOT EXISTS `shop_design_wmbar` (
  `wmbar_width` int(11) NOT NULL DEFAULT '0',
  `wmbar_height` int(11) NOT NULL DEFAULT '0',
  `wmbar_background_color` varchar(10) NOT NULL,
  `wmbar_position` tinyint(4) NOT NULL DEFAULT '0',
  `wmbar_margin` int(11) NOT NULL DEFAULT '0',
  `wmbar_line_use` tinyint(4) NOT NULL DEFAULT '0',
  `wmbar_line_color` varchar(10) NOT NULL,
  `wmbar_list_use` tinyint(4) NOT NULL DEFAULT '0',
  `wmbar_text1_font_family` varchar(100) NOT NULL,
  `wmbar_text1_font_size` int(11) NOT NULL DEFAULT '0',
  `wmbar_text1_font_color` varchar(10) NOT NULL,
  `wmbar_text1_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `wmbar_text1_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `wmbar_text1_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `wmbar_text2_font_family` varchar(100) NOT NULL,
  `wmbar_text2_font_size` int(11) NOT NULL DEFAULT '0',
  `wmbar_text2_font_color` varchar(10) NOT NULL,
  `wmbar_text2_font_bold` tinyint(4) NOT NULL DEFAULT '0',
  `wmbar_text2_font_italic` tinyint(4) NOT NULL DEFAULT '0',
  `wmbar_text2_font_underline` tinyint(4) NOT NULL DEFAULT '0',
  `wmbar_image1_font_size` int(11) NOT NULL DEFAULT '0',
  `wmbar_image1_font_color` varchar(10) NOT NULL,
  `wmbar_image1_transparent` tinyint(4) NOT NULL DEFAULT '0',
  `wmbar_image2_font_size` int(11) NOT NULL DEFAULT '0',
  `wmbar_image2_font_color` varchar(10) NOT NULL,
  `wmbar_image2_transparent` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_design_wmlist`
--

CREATE TABLE IF NOT EXISTS `shop_design_wmlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '고유번호',
  `menu_type` varchar(255) NOT NULL COMMENT '형식',
  `menu_id` varchar(255) NOT NULL COMMENT '아이디',
  `image_width` int(11) NOT NULL DEFAULT '0',
  `image_height` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_display_box_file`
--

CREATE TABLE IF NOT EXISTS `shop_display_box_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `upload_mode` varchar(255) NOT NULL,
  `upload_source` varchar(255) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `upload_filesize` int(11) NOT NULL DEFAULT '0',
  `upload_width` int(11) NOT NULL DEFAULT '0',
  `upload_height` int(11) NOT NULL DEFAULT '0',
  `upload_type` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_upload` (`upload_mode`),
  KEY `index_view` (`upload_type`,`upload_file`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_display_box_list`
--

CREATE TABLE IF NOT EXISTS `shop_display_box_list` (
  `display_id` int(11) NOT NULL DEFAULT '0' COMMENT '디스플레이',
  `display_type` int(11) NOT NULL DEFAULT '0',
  `display_list` int(11) NOT NULL DEFAULT '0',
  `category` int(11) NOT NULL DEFAULT '0',
  `icon` int(11) NOT NULL DEFAULT '0',
  `sort` varchar(100) NOT NULL COMMENT '정렬방식',
  `skin` varchar(255) NOT NULL COMMENT '스킨',
  `count_width` int(11) NOT NULL DEFAULT '0' COMMENT '가로갯수',
  `count_height` int(11) NOT NULL DEFAULT '0' COMMENT '세로갯수',
  `thumb_width` int(11) NOT NULL DEFAULT '0' COMMENT '썸네일가로',
  `thumb_height` int(11) NOT NULL DEFAULT '0' COMMENT '썸네일세로',
  `rolling_limit` int(11) NOT NULL DEFAULT '0' COMMENT '롤링갯수',
  `rolling_time` int(11) NOT NULL DEFAULT '0' COMMENT '롤링시간',
  `titletype` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL COMMENT '타이틀명',
  `plan` int(11) NOT NULL DEFAULT '0',
  `board` varchar(255) NOT NULL,
  `use1` tinyint(4) NOT NULL DEFAULT '0',
  `use2` tinyint(4) NOT NULL DEFAULT '0',
  `use3` tinyint(4) NOT NULL DEFAULT '0',
  `use4` tinyint(4) NOT NULL DEFAULT '0',
  `banner` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `urltype` tinyint(4) NOT NULL DEFAULT '0',
  `html` text NOT NULL COMMENT 'HTML 입력'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_display_box_type`
--

CREATE TABLE IF NOT EXISTS `shop_display_box_type` (
  `display_id` int(11) NOT NULL DEFAULT '0',
  `display_type` int(11) NOT NULL DEFAULT '0',
  `box_type` tinyint(4) NOT NULL DEFAULT '0',
  `box_width` int(11) NOT NULL DEFAULT '0',
  `box_height` int(11) NOT NULL DEFAULT '0',
  `side_width` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_display_item`
--

CREATE TABLE IF NOT EXISTS `shop_display_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '고유번호',
  `display_id` int(11) NOT NULL DEFAULT '0' COMMENT '디스플레이',
  `display_type` int(11) NOT NULL DEFAULT '0',
  `display_list` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0' COMMENT '등록상품아이디',
  `position` int(11) NOT NULL DEFAULT '0' COMMENT '위치',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '등록일',
  PRIMARY KEY (`id`),
  KEY `index_display` (`display_id`,`display_type`,`display_list`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=118 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_favorite`
--

CREATE TABLE IF NOT EXISTS `shop_favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL DEFAULT '' COMMENT '회원아이디',
  `item_id` int(11) NOT NULL DEFAULT '0' COMMENT '상품아이디',
  `order_option` int(11) NOT NULL DEFAULT '0' COMMENT '옵션아이디',
  `order_limit` int(11) NOT NULL DEFAULT '0' COMMENT '주문수량',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '담은날짜',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_help`
--

CREATE TABLE IF NOT EXISTS `shop_help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `help_id` int(11) NOT NULL DEFAULT '0' COMMENT '답변 아이디',
  `help_count` int(11) NOT NULL DEFAULT '0' COMMENT '답변 수',
  `user_id` varchar(50) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_hp` varchar(50) NOT NULL,
  `help_category` int(11) NOT NULL DEFAULT '0',
  `help_type` int(11) NOT NULL DEFAULT '0',
  `help_code` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `help_send_email` tinyint(4) NOT NULL DEFAULT '0',
  `help_send_sms` tinyint(4) NOT NULL DEFAULT '0',
  `help_view` tinyint(4) NOT NULL DEFAULT '0' COMMENT '열람여부',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_user` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_help_file`
--

CREATE TABLE IF NOT EXISTS `shop_help_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `upload_mode` varchar(255) NOT NULL,
  `upload_source` varchar(255) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `upload_filesize` int(11) NOT NULL DEFAULT '0',
  `upload_width` int(11) NOT NULL DEFAULT '0',
  `upload_height` int(11) NOT NULL DEFAULT '0',
  `upload_type` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_upload` (`upload_mode`),
  KEY `index_view` (`upload_type`,`upload_file`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_icon_file`
--

CREATE TABLE IF NOT EXISTS `shop_icon_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL DEFAULT '0' COMMENT '순서',
  `title` varchar(255) NOT NULL COMMENT '아이콘명',
  `view` tinyint(4) NOT NULL DEFAULT '0' COMMENT '사용여부',
  `upload_source` varchar(255) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `upload_filesize` int(11) NOT NULL DEFAULT '0',
  `upload_width` int(11) NOT NULL DEFAULT '0',
  `upload_height` int(11) NOT NULL DEFAULT '0',
  `upload_type` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_view` (`upload_type`,`upload_file`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_item`
--

CREATE TABLE IF NOT EXISTS `shop_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_title` varchar(255) NOT NULL DEFAULT '' COMMENT '상품명',
  `item_keyword` varchar(255) NOT NULL COMMENT '검색키워드',
  `item_code` varchar(255) NOT NULL DEFAULT '' COMMENT '상품코드',
  `category1` int(11) NOT NULL DEFAULT '0' COMMENT '1차분류',
  `category2` int(11) NOT NULL DEFAULT '0' COMMENT '2차분류',
  `category3` int(11) NOT NULL DEFAULT '0' COMMENT '3차분류',
  `category4` int(11) NOT NULL DEFAULT '0' COMMENT '4차분류',
  `item_position` int(11) NOT NULL DEFAULT '0' COMMENT '상품순서',
  `item_price_use` tinyint(4) NOT NULL DEFAULT '0' COMMENT '시중가사용',
  `item_price` int(11) NOT NULL DEFAULT '0' COMMENT '시중가',
  `item_money` int(11) NOT NULL DEFAULT '0' COMMENT '판매가',
  `item_cash` int(11) NOT NULL DEFAULT '0' COMMENT '적립금',
  `item_delivery` int(11) NOT NULL DEFAULT '0' COMMENT '배송비',
  `item_delivery_pay` int(11) NOT NULL DEFAULT '0' COMMENT '착불배송비',
  `item_delivery_bunch` tinyint(4) NOT NULL DEFAULT '0' COMMENT '묶음배송여부',
  `item_option_use` tinyint(4) NOT NULL DEFAULT '0' COMMENT '옵션사용',
  `item_limit` int(11) NOT NULL DEFAULT '0' COMMENT '기본재고',
  `item_use` tinyint(4) NOT NULL DEFAULT '0' COMMENT '판매여부',
  `item_option1` varchar(255) NOT NULL DEFAULT '' COMMENT '옵션명1',
  `item_option2` varchar(255) NOT NULL DEFAULT '' COMMENT '옵션명2',
  `item_option3` varchar(255) NOT NULL DEFAULT '' COMMENT '옵션명3',
  `item_option4` varchar(255) NOT NULL DEFAULT '' COMMENT '옵션명4',
  `item_option5` varchar(255) NOT NULL DEFAULT '' COMMENT '옵션명5',
  `item_option6` varchar(255) NOT NULL COMMENT '옵션명6',
  `item_option7` varchar(255) NOT NULL COMMENT '옵션명7',
  `item_option8` varchar(255) NOT NULL COMMENT '옵션명8',
  `item_option9` varchar(255) NOT NULL COMMENT '옵션명9',
  `item_option10` varchar(255) NOT NULL COMMENT '옵션명10',
  `item_option1_text` varchar(255) NOT NULL DEFAULT '' COMMENT '옵션내용1',
  `item_option2_text` varchar(255) NOT NULL DEFAULT '' COMMENT '옵션내용2',
  `item_option3_text` varchar(255) NOT NULL DEFAULT '' COMMENT '옵션내용3',
  `item_option4_text` varchar(255) NOT NULL DEFAULT '' COMMENT '옵션내용4',
  `item_option5_text` varchar(255) NOT NULL DEFAULT '' COMMENT '옵션내용5',
  `item_option6_text` varchar(255) NOT NULL COMMENT '옵션내용6',
  `item_option7_text` varchar(255) NOT NULL COMMENT '옵션내용7',
  `item_option8_text` varchar(255) NOT NULL COMMENT '옵션내용8',
  `item_option9_text` varchar(255) NOT NULL COMMENT '옵션내용9',
  `item_option10_text` varchar(255) NOT NULL COMMENT '옵션내용10',
  `item_text` longtext NOT NULL COMMENT '상세설명',
  `item_delivery_text` text NOT NULL COMMENT '배송내용',
  `item_refund_text` text NOT NULL COMMENT '반품내용',
  `item_gallery_use` tinyint(4) NOT NULL DEFAULT '0' COMMENT '갤러리사용',
  `item_icon` varchar(255) NOT NULL,
  `item_hit` int(11) NOT NULL DEFAULT '0' COMMENT '조회수',
  `item_sale` int(11) NOT NULL DEFAULT '0' COMMENT '주문수',
  `item_reply` int(11) NOT NULL DEFAULT '0' COMMENT '상품평',
  `item_qna` int(11) NOT NULL DEFAULT '0' COMMENT '상품문의',
  `color1` tinyint(4) NOT NULL DEFAULT '0',
  `color2` tinyint(4) NOT NULL DEFAULT '0',
  `color3` tinyint(4) NOT NULL DEFAULT '0',
  `color4` tinyint(4) NOT NULL DEFAULT '0',
  `color5` tinyint(4) NOT NULL DEFAULT '0',
  `color6` tinyint(4) NOT NULL DEFAULT '0',
  `color7` tinyint(4) NOT NULL DEFAULT '0',
  `color8` tinyint(4) NOT NULL DEFAULT '0',
  `color9` tinyint(4) NOT NULL DEFAULT '0',
  `color10` tinyint(4) NOT NULL DEFAULT '0',
  `color11` tinyint(4) NOT NULL DEFAULT '0',
  `color12` tinyint(4) NOT NULL DEFAULT '0',
  `color13` tinyint(4) NOT NULL DEFAULT '0',
  `color14` tinyint(4) NOT NULL DEFAULT '0',
  `color15` tinyint(4) NOT NULL DEFAULT '0',
  `color16` tinyint(4) NOT NULL DEFAULT '0',
  `color17` tinyint(4) NOT NULL DEFAULT '0',
  `color18` tinyint(4) NOT NULL DEFAULT '0',
  `color19` tinyint(4) NOT NULL DEFAULT '0',
  `color20` tinyint(4) NOT NULL DEFAULT '0',
  `color21` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '등록일',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_item_file`
--

CREATE TABLE IF NOT EXISTS `shop_item_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `upload_mode` varchar(255) NOT NULL,
  `upload_source` varchar(255) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `upload_filesize` int(11) NOT NULL DEFAULT '0',
  `upload_width` int(11) NOT NULL DEFAULT '0',
  `upload_height` int(11) NOT NULL DEFAULT '0',
  `upload_type` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_upload` (`item_id`,`upload_mode`),
  KEY `index_delete` (`item_id`),
  KEY `index_view` (`item_id`,`upload_type`,`upload_file`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_item_option`
--

CREATE TABLE IF NOT EXISTS `shop_item_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `option_name` varchar(255) NOT NULL,
  `option_money` int(11) NOT NULL DEFAULT '0',
  `option_limit` int(11) NOT NULL DEFAULT '0',
  `option_position` int(11) NOT NULL DEFAULT '0',
  `option_mode` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_view` (`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_item_view`
--

CREATE TABLE IF NOT EXISTS `shop_item_view` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL DEFAULT '' COMMENT '회원아이디',
  `guest_id` varchar(50) NOT NULL DEFAULT '' COMMENT '비회원',
  `item_id` int(11) NOT NULL DEFAULT '0' COMMENT '상품아이디',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '읽은날짜',
  PRIMARY KEY (`id`),
  KEY `index_list` (`user_id`,`guest_id`,`datetime`),
  KEY `index_user_view` (`user_id`,`item_id`),
  KEY `index_guest_view` (`guest_id`,`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_memo`
--

CREATE TABLE IF NOT EXISTS `shop_memo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(50) NOT NULL COMMENT '주문번호',
  `content` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_order_code` (`order_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_order`
--

CREATE TABLE IF NOT EXISTS `shop_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ss_name` varchar(255) NOT NULL COMMENT '주문세션',
  `order_number` int(11) NOT NULL DEFAULT '0' COMMENT '정렬순서',
  `order_code` varchar(50) NOT NULL DEFAULT '0' COMMENT '주문번호',
  `order_title` varchar(255) NOT NULL COMMENT '주문공통제목(OO외몇건)',
  `order_count` int(11) NOT NULL DEFAULT '0' COMMENT '총 주문수',
  `user_id` varchar(50) NOT NULL COMMENT '회원아이디',
  `guest_id` varchar(50) NOT NULL COMMENT '비회원쿠키아이디',
  `cart_id` int(11) NOT NULL DEFAULT '0' COMMENT '장바구니아이디',
  `item_id` int(11) NOT NULL DEFAULT '0' COMMENT '상품아이디',
  `item_code` varchar(255) NOT NULL COMMENT '상품코드',
  `item_title` varchar(255) NOT NULL COMMENT '상품제목',
  `item_money` int(11) NOT NULL DEFAULT '0' COMMENT '상품가격',
  `item_cash` int(11) NOT NULL DEFAULT '0' COMMENT '상품적립금',
  `category1` int(11) NOT NULL DEFAULT '0' COMMENT '카테고리1',
  `category2` int(11) NOT NULL DEFAULT '0' COMMENT '카테고리2',
  `category3` int(11) NOT NULL DEFAULT '0' COMMENT '카테고리3',
  `category4` int(11) NOT NULL DEFAULT '0' COMMENT '카테고리4',
  `delivery_money_free` int(11) NOT NULL DEFAULT '0' COMMENT '무료배송금액',
  `delivery_money` int(11) NOT NULL DEFAULT '0' COMMENT '기본배송료',
  `option_id` int(11) NOT NULL DEFAULT '0' COMMENT '상품옵션아이디',
  `option_name` varchar(255) NOT NULL COMMENT '상품옵션명',
  `option_money` int(11) NOT NULL DEFAULT '0' COMMENT '상품옵션가격',
  `order_coupon_id` int(11) NOT NULL DEFAULT '0' COMMENT '쿠폰 아이디',
  `order_delivery_money` int(11) NOT NULL DEFAULT '0' COMMENT '배송비',
  `order_delivery_pay` int(11) NOT NULL DEFAULT '0' COMMENT '착불배송비',
  `order_delivery_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '배송비방식',
  `order_real_delivery` int(11) NOT NULL DEFAULT '0' COMMENT '실배송비',
  `order_item_money` int(11) NOT NULL DEFAULT '0' COMMENT '옵션포함상품가격',
  `order_total_money` int(11) NOT NULL DEFAULT '0' COMMENT '결제총액',
  `order_total_item_money` int(11) NOT NULL DEFAULT '0' COMMENT '상품총액(옵션가포함)',
  `order_total_coupon` int(11) NOT NULL DEFAULT '0' COMMENT '쿠폰가격합계',
  `order_pay_money` int(11) NOT NULL DEFAULT '0' COMMENT '실결제금액',
  `order_limit` int(11) NOT NULL DEFAULT '0' COMMENT '주문수량',
  `order_cash` int(11) NOT NULL DEFAULT '0' COMMENT '사용적립금',
  `order_coupon` int(11) NOT NULL DEFAULT '0' COMMENT '사용쿠폰금액',
  `order_name` varchar(255) NOT NULL COMMENT '주문자명',
  `order_zip1` varchar(10) NOT NULL DEFAULT '' COMMENT '주문자우1',
  `order_zip2` varchar(10) NOT NULL DEFAULT '' COMMENT '주문자우2',
  `order_addr1` varchar(255) NOT NULL DEFAULT '' COMMENT '주문자주소',
  `order_addr2` varchar(255) NOT NULL DEFAULT '' COMMENT '주문자 상세주소',
  `order_hp` varchar(50) NOT NULL COMMENT '주문자 휴대폰',
  `order_tel` varchar(50) NOT NULL COMMENT '주문자 집전화',
  `order_email` varchar(255) NOT NULL COMMENT '주문자 이메일',
  `order_password` varchar(100) NOT NULL COMMENT '비회원 비밀번호',
  `order_rec_name` varchar(255) NOT NULL COMMENT '수령자명',
  `order_rec_zip1` varchar(10) NOT NULL DEFAULT '' COMMENT '수령자우1',
  `order_rec_zip2` varchar(10) NOT NULL DEFAULT '' COMMENT '수령자우2',
  `order_rec_addr1` varchar(255) NOT NULL DEFAULT '' COMMENT '수령자주소',
  `order_rec_addr2` varchar(255) NOT NULL DEFAULT '' COMMENT '수령자 상세주소',
  `order_rec_hp` varchar(50) NOT NULL COMMENT '수령자 휴대폰',
  `order_rec_tel` varchar(50) NOT NULL COMMENT '수령자 전화번호',
  `order_dep_name` varchar(100) NOT NULL COMMENT '무통장입금자명',
  `order_dep_name_real` varchar(100) NOT NULL COMMENT '무통장실제입금자',
  `order_dep_money_real` int(11) NOT NULL DEFAULT '0' COMMENT '무통장실제입금액',
  `order_bank_name` varchar(100) NOT NULL COMMENT '은행명',
  `order_bank_number` varchar(100) NOT NULL COMMENT '은행번호',
  `order_bank_holder` varchar(100) NOT NULL COMMENT '예금주',
  `order_memo` varchar(255) NOT NULL DEFAULT '' COMMENT '주문시메모',
  `order_pay_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '결제방식(카드,가상계좌등)',
  `order_payment` tinyint(4) NOT NULL DEFAULT '0' COMMENT '결제상태',
  `order_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '주문시각',
  `order_pay_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '결제시각',
  `order_delivery` tinyint(4) NOT NULL DEFAULT '0' COMMENT '배송상태',
  `order_delivery_id` int(11) NOT NULL DEFAULT '0' COMMENT '택배사아이디',
  `order_delivery_name` varchar(100) NOT NULL COMMENT '택배사명',
  `order_delivery_number` varchar(100) NOT NULL COMMENT '송장번호',
  `order_delivery_url` varchar(255) NOT NULL COMMENT '송장조회주소',
  `order_delivery_tel` varchar(100) NOT NULL COMMENT '택배사전화번호',
  `order_delivery_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '발송일',
  `order_receive` tinyint(4) NOT NULL DEFAULT '0' COMMENT '상품수령',
  `order_receive_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '상품수령일',
  `order_cancel` tinyint(4) NOT NULL DEFAULT '0' COMMENT '취소상태',
  `order_cancel_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '취소신청일',
  `order_cancel_ok_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '취소완료일',
  `order_exchange` tinyint(4) NOT NULL DEFAULT '0' COMMENT '교환',
  `order_exchange_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '교환신청일',
  `order_exchange_ok_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '교환완료일',
  `order_refund` tinyint(4) NOT NULL DEFAULT '0' COMMENT '반품',
  `order_refund_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '반품신청일',
  `order_refund_ok_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '반품완료일',
  `order_refund_holder` varchar(50) NOT NULL COMMENT '환불계좌예금주',
  `order_refund_number` varchar(50) NOT NULL COMMENT '환불계좌번호',
  `order_refund_code` varchar(50) NOT NULL COMMENT '환불계좌은행코드',
  `order_refund_jumin` varchar(100) NOT NULL COMMENT '환불수취주민번호',
  `order_ok` tinyint(4) NOT NULL DEFAULT '0' COMMENT '구매확정',
  `order_ok_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '구매확정시간',
  `order_type` int(11) NOT NULL DEFAULT '0' COMMENT '주문상태',
  `order_type_tmp` int(11) NOT NULL DEFAULT '0' COMMENT '주문상태 임시저장',
  `order_pg` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'PG업체코드',
  `order_pg_code1` varchar(100) NOT NULL COMMENT 'PG승인코드',
  `order_pg_code1_date` varchar(100) NOT NULL COMMENT '승인일자',
  `order_pg_code1_time` varchar(100) NOT NULL COMMENT '승인시간',
  `order_pg_code2` varchar(100) NOT NULL COMMENT 'PG가상계좌승인코드',
  `order_pg_code2_date` varchar(100) NOT NULL COMMENT '승인일자',
  `order_pg_code2_time` varchar(100) NOT NULL COMMENT '승인시간',
  `order_pg_code3` varchar(100) NOT NULL COMMENT 'PG영수증승인코드',
  `order_pg_code3_date` varchar(100) NOT NULL COMMENT '승인일자',
  `order_pg_code3_time` varchar(100) NOT NULL COMMENT '승인시간',
  `order_pg_card_code` varchar(100) NOT NULL COMMENT 'PG신용카드승인번호',
  `order_pg_escrow` tinyint(4) NOT NULL DEFAULT '0' COMMENT '에스크로결제',
  `order_receipt` tinyint(4) NOT NULL DEFAULT '0' COMMENT '영수증발행',
  `order_receipt_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '영수증발급방식(휴대,주민,카드)',
  `order_receipt_name` varchar(50) NOT NULL COMMENT '영수증신청자',
  `order_receipt_number` varchar(50) NOT NULL COMMENT '영수증주민',
  `order_receipt_code` varchar(100) NOT NULL COMMENT '영수증발급번호',
  `order_ip` varchar(50) NOT NULL COMMENT '주문자아이피',
  `order_guest_session` varchar(100) NOT NULL COMMENT '비회원조회세션',
  PRIMARY KEY (`id`),
  KEY `index_receive` (`order_delivery`,`order_receive`,`order_delivery_datetime`),
  KEY `index_order_list` (`order_code`,`order_datetime`,`order_payment`),
  KEY `count_order_all` (`order_code`,`order_payment`),
  KEY `order_code_list` (`order_code`,`id`),
  KEY `mypage_order_list` (`order_number`,`user_id`,`order_payment`,`order_cancel`,`order_refund`,`order_datetime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_page`
--

CREATE TABLE IF NOT EXISTS `shop_page` (
  `page_id` varchar(50) NOT NULL DEFAULT '' COMMENT '게시판아이디',
  `page_title` varchar(255) NOT NULL DEFAULT '' COMMENT '게시판명',
  `page_position` int(11) NOT NULL DEFAULT '0' COMMENT '출력순서',
  `page_view` tinyint(4) NOT NULL DEFAULT '0' COMMENT '숨김보임',
  `page_text_content` longtext NOT NULL COMMENT '본문내용',
  `page_text_top` text NOT NULL COMMENT '상단내용',
  `page_text_bottom` text NOT NULL COMMENT '하단내용',
  `page_include_top` varchar(255) NOT NULL,
  `page_include_bottom` varchar(255) NOT NULL,
  `page_hit` int(11) NOT NULL DEFAULT '0' COMMENT '조회수',
  `bottom_view` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '생성일',
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_payment`
--

CREATE TABLE IF NOT EXISTS `shop_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL COMMENT '회원아이디',
  `user_name` varchar(255) NOT NULL COMMENT '주문자명',
  `user_zip1` varchar(10) NOT NULL DEFAULT '' COMMENT '주문자우1',
  `user_zip2` varchar(10) NOT NULL DEFAULT '' COMMENT '주문자우2',
  `user_addr1` varchar(255) NOT NULL DEFAULT '' COMMENT '주문자주소',
  `user_addr2` varchar(255) NOT NULL DEFAULT '' COMMENT '주문자 상세주소',
  `user_hp` varchar(50) NOT NULL COMMENT '주문자 휴대폰',
  `user_tel` varchar(50) NOT NULL COMMENT '주문자 집전화',
  `user_email` varchar(255) NOT NULL COMMENT '주문자 이메일',
  `pay_code` varchar(50) NOT NULL DEFAULT '0' COMMENT '주문번호',
  `pay_title` varchar(255) NOT NULL COMMENT '제목',
  `pay_money` int(11) NOT NULL DEFAULT '0' COMMENT '결제금액',
  `pay_dep_name` varchar(100) NOT NULL COMMENT '무통장입금자명',
  `pay_dep_name_real` varchar(100) NOT NULL COMMENT '무통장실제입금자',
  `pay_dep_money_real` int(11) NOT NULL DEFAULT '0' COMMENT '무통장실제입금액',
  `pay_bank_name` varchar(100) NOT NULL COMMENT '은행명',
  `pay_bank_number` varchar(100) NOT NULL COMMENT '은행번호',
  `pay_bank_holder` varchar(100) NOT NULL COMMENT '예금주',
  `pay_memo` varchar(255) NOT NULL DEFAULT '' COMMENT '주문시메모',
  `pay_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '결제방식(카드,가상계좌등)',
  `pay_payment` int(11) NOT NULL DEFAULT '0' COMMENT '결제상태',
  `pay_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '주문시각',
  `pay_ok_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '결제시각',
  `pay_pg` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'PG업체코드',
  `pay_pg_code1` varchar(100) NOT NULL COMMENT 'PG승인코드',
  `pay_pg_code1_date` varchar(100) NOT NULL COMMENT '승인일자',
  `pay_pg_code1_time` varchar(100) NOT NULL COMMENT '승인시간',
  `pay_pg_code2` varchar(100) NOT NULL COMMENT 'PG가상계좌승인코드',
  `pay_pg_code2_date` varchar(100) NOT NULL COMMENT '승인일자',
  `pay_pg_code2_time` varchar(100) NOT NULL COMMENT '승인시간',
  `pay_pg_code3` varchar(100) NOT NULL COMMENT 'PG영수증승인코드',
  `pay_pg_code3_date` varchar(100) NOT NULL COMMENT '승인일자',
  `pay_pg_code3_time` varchar(100) NOT NULL COMMENT '승인시간',
  `pay_pg_card_code` varchar(100) NOT NULL COMMENT 'PG신용카드승인번호',
  `pay_pg_escrow` tinyint(4) NOT NULL DEFAULT '0' COMMENT '에스크로결제',
  `pay_receipt` tinyint(4) NOT NULL DEFAULT '0' COMMENT '영수증발행',
  `pay_receipt_code` varchar(100) NOT NULL COMMENT '영수증발급번호',
  `pay_ip` varchar(50) NOT NULL COMMENT '주문자아이피',
  PRIMARY KEY (`id`),
  KEY `index_user` (`user_id`),
  KEY `index_order_code` (`pay_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_plan`
--

CREATE TABLE IF NOT EXISTS `shop_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '고유번호',
  `position` int(11) NOT NULL DEFAULT '0' COMMENT '위치',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '기획전명',
  `date1` date NOT NULL DEFAULT '0000-00-00' COMMENT '시작일',
  `date2` date NOT NULL DEFAULT '0000-00-00' COMMENT '종료일',
  `view` tinyint(4) NOT NULL COMMENT '숨김보임',
  `skin` varchar(255) NOT NULL COMMENT '사용스킨',
  `item_width` int(11) NOT NULL COMMENT '가로',
  `item_height` int(11) NOT NULL COMMENT '세로',
  `thumb_use` tinyint(4) NOT NULL DEFAULT '0',
  `thumb_width` int(11) NOT NULL COMMENT '썸네일가로',
  `thumb_height` int(11) NOT NULL COMMENT '썸네일세로',
  `text_top` text NOT NULL COMMENT '상단내용',
  `text_bottom` text NOT NULL COMMENT '하단내용',
  `include_top` varchar(255) NOT NULL,
  `include_bottom` varchar(255) NOT NULL,
  `item_count` int(11) NOT NULL DEFAULT '0' COMMENT '아이탬갯수',
  `item_icon` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '등록일',
  PRIMARY KEY (`id`),
  KEY `category` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_plan_item`
--

CREATE TABLE IF NOT EXISTS `shop_plan_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '고유번호',
  `plan_id` int(11) NOT NULL DEFAULT '0' COMMENT '플랜 아이디',
  `item_id` int(11) NOT NULL DEFAULT '0' COMMENT '상품 아이디',
  `position` int(11) NOT NULL DEFAULT '0' COMMENT '위치',
  `item_title` varchar(255) NOT NULL COMMENT '상품명',
  `item_code` varchar(255) NOT NULL COMMENT '상품코드',
  `item_money` int(11) NOT NULL DEFAULT '0' COMMENT '판매가',
  `item_cash` int(11) NOT NULL DEFAULT '0' COMMENT '적립금',
  `item_icon` varchar(255) NOT NULL COMMENT '상품혜택',
  `item_hit` int(11) NOT NULL DEFAULT '0' COMMENT '조회수',
  `item_sale` int(11) NOT NULL DEFAULT '0' COMMENT '주문수',
  `item_reply` int(11) NOT NULL DEFAULT '0' COMMENT '상품평',
  `item_qna` int(11) NOT NULL DEFAULT '0' COMMENT '상품문의',
  `item_use` tinyint(4) NOT NULL DEFAULT '0' COMMENT '판매여부',
  `category1` int(11) NOT NULL DEFAULT '0' COMMENT '카테고리1',
  `category2` int(11) NOT NULL DEFAULT '0' COMMENT '카테고리2',
  `category3` int(11) NOT NULL DEFAULT '0' COMMENT '카테고리3',
  `category4` int(11) NOT NULL DEFAULT '0' COMMENT '카테고리4',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '등록일',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_popup`
--

CREATE TABLE IF NOT EXISTS `shop_popup` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '고유번호',
  `pop_title` varchar(255) NOT NULL DEFAULT '' COMMENT '제목',
  `pop_text` text NOT NULL COMMENT '내용',
  `pop_view` tinyint(4) NOT NULL DEFAULT '0' COMMENT '사용여부',
  `pop_position` int(11) NOT NULL DEFAULT '0' COMMENT '출력순서',
  `pop_start` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '시작일',
  `pop_end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '종료일',
  `pop_width` int(11) NOT NULL DEFAULT '0' COMMENT '가로크기',
  `pop_height` int(11) NOT NULL DEFAULT '0' COMMENT '세로크기',
  `pop_left` int(11) NOT NULL DEFAULT '0' COMMENT '왼쪽위치',
  `pop_top` int(11) NOT NULL DEFAULT '0' COMMENT '위쪽위치',
  `pop_url` varchar(255) NOT NULL DEFAULT '' COMMENT 'URL',
  `pop_target` tinyint(4) NOT NULL DEFAULT '0' COMMENT '링크방식',
  `pop_hit` int(11) NOT NULL DEFAULT '0' COMMENT '조회수',
  `pop_click` int(11) NOT NULL DEFAULT '0' COMMENT '클릭수',
  `pop_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '생성일',
  `upload_source` varchar(255) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `upload_filesize` int(11) NOT NULL DEFAULT '0',
  `upload_width` int(11) NOT NULL DEFAULT '0',
  `upload_height` int(11) NOT NULL DEFAULT '0',
  `upload_type` tinyint(4) NOT NULL DEFAULT '0',
  `upload_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_qna`
--

CREATE TABLE IF NOT EXISTS `shop_qna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qna_id` int(11) NOT NULL DEFAULT '0' COMMENT '원본아이디',
  `qna_count` int(11) NOT NULL DEFAULT '0' COMMENT '답변수',
  `item_id` int(11) NOT NULL DEFAULT '0' COMMENT '상품아이디',
  `item_code` varchar(255) NOT NULL COMMENT '상품코드',
  `category1` int(11) NOT NULL DEFAULT '0' COMMENT '1차분류',
  `category2` int(11) NOT NULL DEFAULT '0' COMMENT '2차분류',
  `category3` int(11) NOT NULL DEFAULT '0' COMMENT '3차분류',
  `category4` int(11) NOT NULL DEFAULT '0' COMMENT '4차분류',
  `user_id` varchar(50) NOT NULL COMMENT '회원아이디',
  `qna_name` varchar(50) NOT NULL COMMENT '작성자',
  `qna_password` varchar(50) NOT NULL COMMENT '패스워드',
  `qna_secret` tinyint(4) NOT NULL DEFAULT '0' COMMENT '비밀글',
  `qna_category` varchar(255) NOT NULL COMMENT '문의유형',
  `qna_title` varchar(50) NOT NULL COMMENT '제목',
  `qna_content` text NOT NULL COMMENT '내용',
  `qna_ip` varchar(20) NOT NULL COMMENT '아이피',
  `qna_view` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '작성일',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_qna_file`
--

CREATE TABLE IF NOT EXISTS `shop_qna_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `upload_mode` varchar(255) NOT NULL,
  `upload_source` varchar(255) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `upload_filesize` int(11) NOT NULL DEFAULT '0',
  `upload_width` int(11) NOT NULL DEFAULT '0',
  `upload_height` int(11) NOT NULL DEFAULT '0',
  `upload_type` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_upload` (`upload_mode`),
  KEY `index_view` (`upload_type`,`upload_file`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_real`
--

CREATE TABLE IF NOT EXISTS `shop_real` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `real_type` tinyint(4) NOT NULL DEFAULT '0',
  `real_code` varchar(50) NOT NULL DEFAULT '',
  `real_ip` varchar(20) NOT NULL DEFAULT '',
  `user_name` varchar(255) NOT NULL DEFAULT '',
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `user_hp` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_relation`
--

CREATE TABLE IF NOT EXISTS `shop_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '고유번호',
  `item_id` int(11) NOT NULL DEFAULT '0' COMMENT '상품아이디',
  `item_add_id` int(11) NOT NULL DEFAULT '0' COMMENT '관련상품아이디',
  `position` int(11) NOT NULL DEFAULT '0' COMMENT '위치',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '등록일',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_reply`
--

CREATE TABLE IF NOT EXISTS `shop_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reply_id` int(11) NOT NULL DEFAULT '0' COMMENT '원본아이디',
  `reply_count` int(11) NOT NULL DEFAULT '0' COMMENT '답변수',
  `item_id` int(11) NOT NULL DEFAULT '0' COMMENT '상품아이디',
  `item_code` varchar(255) NOT NULL COMMENT '상품코드',
  `category1` int(11) NOT NULL DEFAULT '0' COMMENT '1차분류',
  `category2` int(11) NOT NULL DEFAULT '0' COMMENT '2차분류',
  `category3` int(11) NOT NULL DEFAULT '0' COMMENT '3차분류',
  `category4` int(11) NOT NULL DEFAULT '0' COMMENT '4차분류',
  `user_id` varchar(50) NOT NULL COMMENT '회원아이디',
  `reply_name` varchar(50) NOT NULL COMMENT '작성자',
  `reply_password` varchar(50) NOT NULL COMMENT '패스워드',
  `reply_score` tinyint(4) NOT NULL DEFAULT '0' COMMENT '점수',
  `reply_title` varchar(50) NOT NULL COMMENT '제목',
  `reply_content` text NOT NULL COMMENT '내용',
  `reply_ip` varchar(20) NOT NULL COMMENT '아이피',
  `reply_view` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '작성일',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_reply_file`
--

CREATE TABLE IF NOT EXISTS `shop_reply_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `upload_mode` varchar(255) NOT NULL,
  `upload_source` varchar(255) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `upload_filesize` int(11) NOT NULL DEFAULT '0',
  `upload_width` int(11) NOT NULL DEFAULT '0',
  `upload_height` int(11) NOT NULL DEFAULT '0',
  `upload_type` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_upload` (`upload_mode`),
  KEY `index_view` (`upload_type`,`upload_file`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_service`
--

CREATE TABLE IF NOT EXISTS `shop_service` (
  `service_text` longtext NOT NULL,
  `privacy_text` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_session`
--

CREATE TABLE IF NOT EXISTS `shop_session` (
  `id` varchar(32) NOT NULL,
  `ss_datetime` datetime NOT NULL,
  `ss_data` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `se_datetime` (`ss_datetime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_signup`
--

CREATE TABLE IF NOT EXISTS `shop_signup` (
  `user_real_check` tinyint(4) NOT NULL DEFAULT '0',
  `user_real_max` int(11) NOT NULL DEFAULT '0',
  `user_id` tinyint(4) NOT NULL DEFAULT '0',
  `user_pw` tinyint(4) NOT NULL DEFAULT '0',
  `user_pw_qa` tinyint(4) NOT NULL DEFAULT '0',
  `user_name` tinyint(4) NOT NULL DEFAULT '0',
  `user_birth` tinyint(4) NOT NULL DEFAULT '0',
  `user_sex` tinyint(4) NOT NULL DEFAULT '0',
  `user_level` int(11) NOT NULL DEFAULT '0',
  `user_nick` tinyint(4) NOT NULL DEFAULT '0',
  `user_hp` tinyint(4) NOT NULL DEFAULT '0',
  `user_tel` tinyint(4) NOT NULL DEFAULT '0',
  `user_addr` tinyint(4) NOT NULL DEFAULT '0',
  `user_company` tinyint(4) NOT NULL DEFAULT '0',
  `user_company_tel` tinyint(4) NOT NULL DEFAULT '0',
  `user_company_addr` tinyint(4) NOT NULL DEFAULT '0',
  `user_email` tinyint(4) NOT NULL DEFAULT '0',
  `user_homepage` tinyint(4) NOT NULL DEFAULT '0',
  `user_recommend` tinyint(4) NOT NULL DEFAULT '0',
  `user_recommend_cash` int(11) NOT NULL DEFAULT '0',
  `user_recommend_insert_cash` int(11) NOT NULL DEFAULT '0',
  `user_profile` tinyint(4) NOT NULL DEFAULT '0',
  `user_robot` tinyint(4) NOT NULL DEFAULT '0',
  `user_signup_cash` tinyint(4) NOT NULL DEFAULT '0',
  `user_cash` int(11) NOT NULL DEFAULT '0',
  `user_etc` tinyint(4) NOT NULL DEFAULT '0',
  `user_etc1` varchar(255) NOT NULL DEFAULT '',
  `user_etc1_help` varchar(255) NOT NULL DEFAULT '',
  `user_etc2` varchar(255) NOT NULL DEFAULT '',
  `user_etc2_help` varchar(255) NOT NULL DEFAULT '',
  `user_etc3` varchar(255) NOT NULL DEFAULT '',
  `user_etc3_help` varchar(255) NOT NULL DEFAULT '',
  `user_etc4` varchar(255) NOT NULL DEFAULT '',
  `user_etc4_help` varchar(255) NOT NULL DEFAULT '',
  `user_etc5` varchar(255) NOT NULL DEFAULT '',
  `user_etc5_help` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_sms_auto`
--

CREATE TABLE IF NOT EXISTS `shop_sms_auto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_message` varchar(255) NOT NULL COMMENT '메세지내용',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '생성일',
  PRIMARY KEY (`id`),
  KEY `index_datetime` (`datetime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_sms_config`
--

CREATE TABLE IF NOT EXISTS `shop_sms_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_code` varchar(50) NOT NULL DEFAULT '' COMMENT '고유코드',
  `sms_message` varchar(255) NOT NULL DEFAULT '' COMMENT '메세지',
  `sms_use` tinyint(4) NOT NULL DEFAULT '0' COMMENT '사용여부',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_sms_log`
--

CREATE TABLE IF NOT EXISTS `shop_sms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_code` varchar(255) NOT NULL COMMENT 'sms유형',
  `user_id` varchar(50) NOT NULL COMMENT '수신아이디',
  `to_id` varchar(50) NOT NULL COMMENT '수신자아이디',
  `sms_to` varchar(50) NOT NULL COMMENT '수신자번호',
  `sms_from` varchar(50) NOT NULL COMMENT '발신자번호',
  `sms_message` varchar(255) NOT NULL COMMENT '메세지내용',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '전송일',
  PRIMARY KEY (`id`),
  KEY `index_datetime` (`datetime`),
  KEY `index_code` (`sms_code`,`datetime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_user`
--

CREATE TABLE IF NOT EXISTS `shop_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL DEFAULT '' COMMENT '아이디',
  `user_pw` varchar(255) NOT NULL DEFAULT '' COMMENT '패스워드',
  `user_pw_q` varchar(255) NOT NULL DEFAULT '' COMMENT '찾기질문',
  `user_pw_a` varchar(255) NOT NULL DEFAULT '' COMMENT '찾기답변',
  `user_jumin` varchar(50) NOT NULL COMMENT '주민등록번호',
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '성명',
  `user_nick` varchar(50) NOT NULL DEFAULT '' COMMENT '닉네임',
  `user_birth` varchar(10) NOT NULL DEFAULT '' COMMENT '생년월일',
  `user_sex` varchar(10) NOT NULL DEFAULT '' COMMENT '성별',
  `user_hp` varchar(50) NOT NULL DEFAULT '' COMMENT '휴대전화',
  `user_sms` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'sms수신여부',
  `user_tel` varchar(50) NOT NULL DEFAULT '' COMMENT '일반전화',
  `user_email` varchar(255) NOT NULL DEFAULT '' COMMENT '이메일주소',
  `user_mailing` tinyint(4) NOT NULL DEFAULT '0' COMMENT '메일링여부',
  `user_homepage` varchar(255) NOT NULL DEFAULT '' COMMENT '홈페이지주소',
  `user_recommend` varchar(50) NOT NULL DEFAULT '' COMMENT '추천인',
  `user_profile` varchar(255) NOT NULL DEFAULT '' COMMENT '자기소개',
  `user_zip1` varchar(10) NOT NULL COMMENT '우편번호1',
  `user_zip2` varchar(10) NOT NULL COMMENT '우편번호2',
  `user_addr1` varchar(255) NOT NULL COMMENT '주소',
  `user_addr2` varchar(255) NOT NULL COMMENT '상세주소',
  `user_company` varchar(255) NOT NULL DEFAULT '' COMMENT '회사명',
  `user_company_tel` varchar(50) NOT NULL DEFAULT '' COMMENT '회사번호',
  `user_company_zip1` varchar(10) NOT NULL COMMENT '회사우편번호1',
  `user_company_zip2` varchar(10) NOT NULL COMMENT '회사우편번호2',
  `user_company_addr1` varchar(255) NOT NULL COMMENT '회사주소',
  `user_company_addr2` varchar(255) NOT NULL COMMENT '회사상세주소',
  `user_etc1` varchar(255) NOT NULL COMMENT '기타1',
  `user_etc2` varchar(255) NOT NULL COMMENT '기타2',
  `user_etc3` varchar(255) NOT NULL COMMENT '기타3',
  `user_etc4` varchar(255) NOT NULL COMMENT '기타4',
  `user_etc5` varchar(255) NOT NULL COMMENT '기타5',
  `user_cash` int(11) NOT NULL DEFAULT '0' COMMENT '적립금',
  `user_level` int(11) NOT NULL DEFAULT '0' COMMENT '회원레벨',
  `user_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '로그인시각',
  `user_login_ip` varchar(50) NOT NULL DEFAULT '' COMMENT '로그인아이피',
  `user_ip` varchar(50) NOT NULL DEFAULT '' COMMENT '가입아이피',
  `user_block_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '차단시각',
  `user_leave` varchar(255) NOT NULL COMMENT '탈퇴사유',
  `user_leave_memo` text NOT NULL COMMENT '탈퇴전달메모',
  `user_leave_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '탈퇴시각',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '가입시각',
  `social` tinyint(4) NOT NULL default '0',
  `social_key` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_user_level`
--

CREATE TABLE IF NOT EXISTS `shop_user_level` (
  `level` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `memo` varchar(255) NOT NULL,
  PRIMARY KEY (`level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_user_level_file`
--

CREATE TABLE IF NOT EXISTS `shop_user_level_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `upload_mode` varchar(255) NOT NULL,
  `upload_source` varchar(255) NOT NULL,
  `upload_file` varchar(255) NOT NULL,
  `upload_filesize` int(11) NOT NULL DEFAULT '0',
  `upload_width` int(11) NOT NULL DEFAULT '0',
  `upload_height` int(11) NOT NULL DEFAULT '0',
  `upload_type` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_upload` (`upload_mode`),
  KEY `index_view` (`upload_type`,`upload_file`,`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_user_login`
--

CREATE TABLE IF NOT EXISTS `shop_user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL DEFAULT '',
  `login_ip` varchar(50) NOT NULL DEFAULT '',
  `login_type` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_user_memo`
--

CREATE TABLE IF NOT EXISTS `shop_user_memo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL DEFAULT '' COMMENT '회원아이디',
  `content` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `index_user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_visit`
--

CREATE TABLE IF NOT EXISTS `shop_visit` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '고유번호',
  `vi_ip` varchar(255) NOT NULL DEFAULT '' COMMENT 'ip',
  `vi_first` tinyint(4) NOT NULL DEFAULT '0' COMMENT '처음방문',
  `vi_browser` varchar(50) NOT NULL DEFAULT '' COMMENT 'browser',
  `vi_version` varchar(50) NOT NULL DEFAULT '' COMMENT 'version',
  `vi_os` varchar(50) NOT NULL DEFAULT '' COMMENT 'os',
  `vi_resolution` varchar(50) NOT NULL COMMENT '해상도',
  `vi_agent` varchar(255) NOT NULL DEFAULT '' COMMENT 'agent',
  `vi_referer` varchar(255) NOT NULL DEFAULT '' COMMENT 'referer',
  `vi_host` varchar(50) NOT NULL COMMENT '호스트',
  `vi_keyword` varchar(100) NOT NULL DEFAULT '' COMMENT 'keyword',
  `vi_url` varchar(255) NOT NULL COMMENT 'url',
  `vi_return` int(11) NOT NULL DEFAULT '0' COMMENT '방문횟수',
  `vi_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '접속일',
  PRIMARY KEY (`id`),
  KEY `index_ip` (`vi_ip`,`vi_datetime`),
  KEY `index_first` (`vi_ip`,`vi_datetime`,`vi_first`),
  KEY `index_ip_check` (`id`,`vi_ip`),
  KEY `index_visit_list` (`vi_first`,`vi_datetime`),
  KEY `index_keyword` (`vi_datetime`,`vi_keyword`),
  KEY `index_host` (`vi_datetime`,`vi_first`,`vi_host`,`vi_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
