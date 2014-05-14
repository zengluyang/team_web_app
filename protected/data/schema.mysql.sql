
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

insert into tbl_patent
  (id,name,app_date,app_number,auth_number,auth_date,is_intl,is_domestic,abstract)
  values
  (
    1,
    '一种无线传感器网络的节能方法及休眠决策系统',
    '2012.01.17',
    '201210014288.9',
    null,
    null,
    0,
    1,
    '本发明公开了一种无线传感器网络的节能方法及休眠决策系统。本发明的方法通过设计元胞自动机状态转换规则，根据网络拓扑情况不同，设置休眠门限值从而调节休眠强度，使得节点能够通过元胞自动机的状态转换规则，在休眠和工作状态间进行切换，当有过多邻居节点处于工作状态时，当前节点可以进入休眠状态，从而减少了能量消耗；本发明的休眠决策系统通过合理使用元胞自动机处理机制，在MAC层与IP层间设计CA层，在保证网络传输可靠性的基础上，减少了节点能量消耗，延长了网络生存期的功能。'
  );


insert into tbl_patent
  (id,name,app_date,app_number,auth_number,auth_date,is_intl,is_domestic,abstract)
  values
  (
    2,
    '一种异构网络的多模切换方法',
    '2011.12.22',
    '201110434828.4',
    null,
    null,
    0,
    1,
    '本发明公开了一种异构网络的多模切换方法，具体包括如下步骤：确定异构网络中每种通信模式下的实时业务和非实时业务以及确定异构网络中多种通信模式之间的优先级；设定每种通信模式下的实时业务和非实时业务各自的丢包率门限值；获取每种通信模式下的实时业务和非实时业务各自的丢包率；按照优先级从高到低的顺序，将得到的丢包率与其对应的门限值对比，找到当前最适合接入的网络进行切换。本发明的方法通过通信业务感知当前的通信性能，经过决策，能够选择最优的通信模式，可以使用户更有效的使用网络资源，并加强抗中断通信能力。'
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

insert into tbl_patent_people values(1,1);
insert into tbl_patent_people values(1,2);
insert into tbl_patent_people values(2,2);

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