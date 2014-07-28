
CREATE TABLE tbl_people
(
  id integer not null PRIMARY KEY auto_increment,
  name varchar(255) not null
);

insert into tbl_people (name) values ('曾路洋1');
insert into tbl_people (name) values ('曾路洋2');
insert into tbl_people (name) values ('曾路洋3');

CREATE TABLE tbl_patent
(
  id integer not null PRIMARY KEY auto_increment,
  name varchar(255) not null,
  app_date DATE not null,
  app_number VARCHAR(255) not null,
  auth_number VARCHAR(255),
  auth_date DATE,
  is_intl BOOL not null,
  is_domestic BOOL not null,
  abstract TEXT not null
);

CREATE TABLE `tbl_patent_people` (
 `patent_id` int(11) NOT NULL,
 `people_id` int(11) NOT NULL,
 `seq` int(11) NOT NULL,
 PRIMARY KEY (`patent_id`,`people_id`),
 KEY `tbl_patent_people_ibfk_2` (`people_id`),
 CONSTRAINT `tbl_patent_people_ibfk_2` FOREIGN KEY (`people_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `tbl_patent_people_ibfk_1` FOREIGN KEY (`patent_id`) REFERENCES `tbl_patent` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_patent_project_achievement` (
  /*成果项目*/
  patent_id int not null,
  project_id int not null,
  seq int null,
  primary key (patent_id,project_id),
  key tbl_patent_project_ibfk_2 (project_id),
  CONSTRAINT `tbl_patent_project_achievement_ibfk_2` FOREIGN KEY (`patent_id`) REFERENCES `tbl_patent` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_patent_project_achievement_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

create TABLE xxx (
  id int not null PRIMARY KEY auto_increment,
  info varchar(255) default null
);
  


CREATE TABLE tbl_paper (
  id int not null PRIMARY KEY auto_increment,
  info varchar(255)  not null,
  status tinyint,
  pass_date date,
  pub_date date,
  index_date date,
  sci_number varchar(255),
  ei_number varchar(255),
  istp_number varchar(255),
  is_first_grade bool,
  is_core bool,
  other_pub varchar(255),
  is_journal bool,
  is_conference bool,
  is_intl bool,
  is_domestic bool,
  filename varchar(255),
  is_high_level bool,
  maintainer_id int,
  CONSTRAINT `tbl_paper_ibfk_1` FOREIGN KEY (`maintainer_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `tbl_paper_people` (
  paper_id int not null,
  people_id int not null,
  seq int null,
  primary key (paper_id,people_id),
  key tbl_paper_people_ibfk_2 (people_id),
  CONSTRAINT `tbl_paper_people_ibfk_2` FOREIGN KEY (`people_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_paper_people_ibfk_1` FOREIGN KEY (`paper_id`) REFERENCES `tbl_paper` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




CREATE TABLE `tbl_project` (
  id int not null primary key auto_increment,
  /*-----------------------------------------------------------------------------------------------------------------*/
  /* 责任书、实际执行 */
  name varchar(255),              # 项目名称
  number varchar(255),            # 编号
  fund_number varchar(255),       # 经费本编号
  is_intl bool,                   # 国际
  is_national bool,               # 国家级
  is_provincial bool,             # 省部级
  is_city bool,                   # 市级
  is_school bool,                 # 校级
  is_enterprise bool,             # 横向
  is_NSF bool,                    # 国家自然基金
  is_973 bool,                    # 973
  is_863 bool,                    # 863
  is_NKTRD bool,                  # 科技支撑计划
  is_DFME bool,                   # 教育部博士点专项基金
  is_major bool,                  # 重大专项
  start_date date,                # 开始时间
  deadline_date date,             # 截至时间
  conclude_date date,             # 结题时间
  /*-----------------------------------------------------------------------------------------------------------------*/
  /* 申报 */
  app_date date,                  # 申报时间
  pass_date date,                 # 立项时间
  app_fund DECIMAL(15,2),         # 申报经费
  pass_fund DECIMAL(15,2)         # 立项经费
);

CREATE TABLE `tbl_project_people_liability` (
  project_id int not null,
  people_id int not null,
  seq int not null,
  primary key (project_id,people_id),
  key tbl_paper_people_liability_ibfk_2 (people_id),
  CONSTRAINT `tbl_project_people_liability_ibfk_2` FOREIGN KEY (`people_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_project_people_liability_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `tbl_project_people_execute` (
  project_id int not null,
  people_id int not null,
  seq int not null,
  primary key (project_id,people_id),
  key tbl_paper_people_execute_ibfk_2 (people_id),
  CONSTRAINT `tbl_project_people_execute_ibfk_2` FOREIGN KEY (`people_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_project_people_execute_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `tbl_user` (
  id int not null primary key auto_increment,
  username varchar(30)  NOT NULL,
  password varchar(255) NOT NULL,
  email varchar(100),
  is_admin bool,
  is_paper bool,
  is_project bool,
  is_patent bool
);

CREATE TABLE `tbl_paper_project_fund` (
  /*支柱项目*/
  paper_id int not null,
  project_id int not null,
  seq int null,
  primary key (paper_id,project_id),
  key tbl_paper_project_ibfk_2 (project_id),
  CONSTRAINT `tbl_project_people_fund_ibfk_2` FOREIGN KEY (`paper_id`) REFERENCES `tbl_paper` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_project_people_fund_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_paper_project_reim` (
  /*报账项目*/
  paper_id int not null,
  project_id int not null,
  seq int null,
  primary key (paper_id,project_id),
  key tbl_paper_project_ibfk_2 (project_id),
  CONSTRAINT `tbl_project_people_reim_ibfk_2` FOREIGN KEY (`paper_id`) REFERENCES `tbl_paper` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_project_people_reim_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_paper_project_achievement` (
  /*成果项目*/
  paper_id int not null,
  project_id int not null,
  seq int null,
  primary key (paper_id,project_id),
  key tbl_paper_project_ibfk_2 (project_id),
  CONSTRAINT `tbl_project_people_achievement_ibfk_2` FOREIGN KEY (`paper_id`) REFERENCES `tbl_paper` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_project_people_achievement_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `tbl_publication` (
  id int not null primary key auto_increment,
  info varchar(255),        #著作信息
  press varchar(255),       #出版社
  pub_date date,            #出版时间
  is_textbook bool,         #教材
  is_pub bool,              #专著
  isbn_number varchar(255), #ISBN书号
  description varchar(255)  #简介
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_publication_people` (
  publication_id int not null,
  people_id int not null,
  seq int not null,
  primary key (publication_id,people_id),
  key tbl_publication_people_ibfk (people_id),
  CONSTRAINT `tbl_publication_people_ibfk_2` FOREIGN KEY (`people_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_publication_people_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `tbl_publication` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_publication_project_fund` (
  /*支柱项目*/
  publication_id int not null,
  project_id int not null,
  seq int null,
  primary key (publication_id,project_id),
  key tbl_publication_project_fund_ibfk (project_id),
  CONSTRAINT `tbl_publication_project_fund_ibfk_2` FOREIGN KEY (`publication_id`) REFERENCES `tbl_publication` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_publication_project_fund_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_publication_project_reim` (
  /*报账项目*/
  publication_id int not null,
  project_id int not null,
  seq int null,
  primary key (publication_id,project_id),
  key tbl_publication_project_reim_ibfk_2 (project_id),
  CONSTRAINT `tbl_publication_project_reim_ibfk_2` FOREIGN KEY (`publication_id`) REFERENCES `tbl_publication` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_publication_project_reim_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_publication_project_achievement` (
  /*成果项目*/
  publication_id int not null,
  project_id int not null,
  seq int null,
  primary key (publication_id,project_id),
  key tbl_publication_project_achievement_ibfk_2 (project_id),
  CONSTRAINT `tbl_publication_project_achievement_ibfk_2` FOREIGN KEY (`publication_id`) REFERENCES `tbl_publication` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_publication_project_achievement_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_software` (
  id int not null primary key auto_increment,
  name varchar(255),          #著作权名称
  reg_date date,              #登记时间
  reg_number varchar(255),    #登记号
  department varchar(255),    #权属单位
  description varchar(255)    #简介
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_software_people` (
  software_id int not null,
  people_id int not null,
  seq int null,
  primary key(software_id,people_id),
  key tbl_software_people_ibfk(people_id),
  CONSTRAINT `tbl_software_people_ibfk_2` FOREIGN KEY (`people_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_software_people_ibfk_1` FOREIGN KEY (`software_id`) REFERENCES `tbl_software` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_software_project_reim` (
  software_id int not null,
  project_id int not null,
  seq int null,
  primary key (software_id,project_id),
  key tbl_software_project_ibfk (project_id),
  CONSTRAINT `tbl_software_project_reim_ibfk_2` FOREIGN KEY (`software_id`) REFERENCES `tbl_software` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_software_project_reim_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `tbl_award` ( #keyan chengguo
  id int not null primary key auto_increment,
  project_name varchar(255),      #项目名称
  award_name varchar(255),        #奖项名称
  award_date date,                #获奖时间
  org_from varchar(255),          #授予单位
  is_intl bool,                   #国际
  is_national bool,               #国家级
  is_provincial bool,             #省部级
  is_city bool,                   #市级
  is_school bool                  #校级
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_award_people` (
  award_id int not null,
  people_id int not null,
  seq int null,
  primary key(award_id,people_id),
  key tbl_award_people_ibfk(people_id),
  CONSTRAINT `tbl_award_people_ibfk_2` FOREIGN KEY (`people_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_award_people_ibfk_1` FOREIGN KEY (`award_id`) REFERENCES `tbl_award` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_award_teaching` (# jiaoxue chengguo
  id int not null primary key auto_increment,
  project_name varchar(255),      #项目名称
  award_name varchar(255),        #奖项名称
  award_date date,                #获奖时间
  org_from varchar(255),          #授予单位
  is_intl bool,                   #国际
  is_national bool,               #国家级
  is_provincial bool,             #省部级
  is_city bool,                   #市级
  is_school bool                  #校级
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_award_teaching_people` (
  award_teaching_id int not null,
  people_id int not null,
  seq int null,
  primary key(award_teaching_id,people_id),
  key tbl_award_teaching_people_ibfk(people_id),
  CONSTRAINT `tbl_award_teaching_people_ibfk_2` FOREIGN KEY (`people_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_award_teaching_people_ibfk_1` FOREIGN KEY (`award_teaching_id`) REFERENCES `tbl_award_teaching` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `tbl_project_teaching` (
  id int not null primary key auto_increment,

  name varchar(255) comment       '项目名称',
  number varchar(255)comment      '项目编号',
  is_intl bool comment            '国际',
  is_provincial bool comment      '省部级',
  is_city bool comment            '市级',
  is_school bool comment          '校级',
  is_quality bool comment         '质量工程',
  is_reform bool comment          '教学改革',
  is_lab bool comment             '实验室建设',
  is_new_lab bool comment         '新实验建设',
  start_date date comment         '开始时间',
  deadline_date date comment      '截至时间',
  conclude_date date comment      '结题时间',
  #app_date date comment           '申报时间',
  #pass_date date comment          '立项时间',
  #app_fund DECIMAL(15,2) comment  '申报经费',
  #pass_fund DECIMAL(15,2) comment '立项经费',
  fund DECIMAL(15,2) comment       '经费',
  director_1 int comment           '负责人1',
  director_2 int comment           '负责人2',
  should_display bool comment      '对外显示',
  maintainer_id int comment        '维护人'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_project_teaching_people` (
  project_teaching_id int not null,
  people_id int not null,
  seq int null,
  primary key(project_teaching_id,people_id),
  key tbl_project_teaching_people_ibfk(people_id),
  CONSTRAINT `tbl_project_teaching_people_ibfk_2` FOREIGN KEY (`people_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_project_teaching_people_ibfk_1` FOREIGN KEY (`project_teaching_id`) REFERENCES `tbl_project_teaching` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE tbl_paper_teaching (
  id int not null PRIMARY KEY auto_increment,
  info varchar(255)  not null,
  status tinyint,
  pass_date date,
  pub_date date,
  index_date date,
  sci_number varchar(255),
  ei_number varchar(255),
  istp_number varchar(255),
  is_first_grade bool,
  is_core bool,
  other_pub varchar(255),
  is_journal bool,
  is_conference bool,
  is_intl bool,
  is_domestic bool,
  filename varchar(255),
  is_high_level bool,
  maintainer_id int,
  CONSTRAINT `tbl_paper_teaching_ibfk_1` FOREIGN KEY (`maintainer_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `tbl_paper_teaching_people` (
  /*Author*/
  paper_teaching_id int not null,
  people_id int not null,
  seq int null,
  primary key (paper_teaching_id,people_id),
  key tbl_paper_teaching_people_ibfk_2 (people_id),
  CONSTRAINT `tbl_paper_teaching_people_ibfk_2` FOREIGN KEY (`people_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_paper_teaching_people_ibfk_1` FOREIGN KEY (`paper_teaching_id`) REFERENCES `tbl_paper_teaching` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `tbl_paper_teaching_project_fund` (
  /*支柱项目*/
  paper_teaching_id int not null,
  project_id int not null,
  seq int null,
  primary key (paper_teaching_id,project_id),
  key tbl_paper_teaching_project_fund_ibfk (project_id),
  CONSTRAINT `tbl_project_project_fund_ibfk_2` FOREIGN KEY (`paper_teaching_id`) REFERENCES `tbl_paper_teaching` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_project_project_fund_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_paper_teaching_project_reim` (
  /*报账项目*/
  paper_teaching_id int not null,
  project_id int not null,
  seq int null,
  primary key (paper_teaching_id,project_id),
  key tbl_paper_teaching_project_reim_ibfk_2 (project_id),
  CONSTRAINT `tbl_project_project_reim_ibfk_2` FOREIGN KEY (`paper_teaching_id`) REFERENCES `tbl_paper_teaching` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_project_project_reim_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_paper_teaching_project_achievement` (
  /*成果项目*/
  paper_teaching_id int not null,
  project_id int not null,
  seq int null,
  primary key (paper_teaching_id,project_id),
  key tbl_paper_teaching_project_achievement_ibfk_2 (project_id),
  CONSTRAINT `tbl_paper_teaching_project_achievement_ibfk_2` FOREIGN KEY (`paper_teaching_id`) REFERENCES `tbl_paper_teaching` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_paper_teaching_project_achievement_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE tbl_course (
  id int not null PRIMARY KEY auto_increment,
  name varchar(255) comment             '课程名称',
  description text comment              '课程简介',
  semester varchar(255) comment         '开课学期',
  duration varchar(255) comment         '学时',
  textbook text comment                 '教材及参考资料'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `tbl_course_people` (
  /*Author*/
  course_id int not null,
  people_id int not null,
  seq int null,
  primary key (course_id,people_id),
  key tbl_course_people_ibfk_2 (people_id),
  CONSTRAINT `tbl_course_people_ibfk_2` FOREIGN KEY (`people_id`) REFERENCES `tbl_people` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_course_people_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `tbl_course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;