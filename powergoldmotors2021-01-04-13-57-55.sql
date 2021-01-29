DROP TABLE accounts_table;

CREATE TABLE `accounts_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `members_id` text NOT NULL,
  `invoice_no` text NOT NULL,
  `invoice_date` text NOT NULL,
  `debit_amount` text NOT NULL,
  `credit_amount` text NOT NULL,
  `blance` text NOT NULL,
  `narration` text NOT NULL,
  `paid_id` text NOT NULL,
  `dues_id` int(11) NOT NULL,
  `blance_id` int(11) NOT NULL,
  `gn_date` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE admin_user;

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `username` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role` text DEFAULT NULL,
  `role_id` text DEFAULT NULL,
  `photo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO admin_user VALUES("6","Azizar","Rahman","aziz","e9b74cd3c4c1600ee591fd56360b89db","","1","img/user/30bcebf655.jpg");
INSERT INTO admin_user VALUES("5","Seller","One","admin_1","21232f297a57a5a743894a0e4a801fc3","","2","img/user/c4cc560f7f.jpg");
INSERT INTO admin_user VALUES("7","shafik","Hossain","admin3","d41d8cd98f00b204e9800998ecf8427e","","2","img/user/fca72b9571.jpg");



DROP TABLE bank_details;

CREATE TABLE `bank_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_code` text DEFAULT NULL,
  `bank_name` text DEFAULT NULL,
  `account` text DEFAULT NULL,
  `amount_credit` text DEFAULT NULL,
  `amount_debit` text DEFAULT NULL,
  `notes` text NOT NULL,
  `date` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO bank_details VALUES("1","1002","","10011001010","1000","","test     ","2020-12-01");
INSERT INTO bank_details VALUES("2","1002","","10011001010","1000","","1000","2020-12-01");
INSERT INTO bank_details VALUES("3","1002","","10011001010","1000","","google.com
 ","2020-12-01");
INSERT INTO bank_details VALUES("4","1001","","100020030","2000","","dd","2020-12-03");
INSERT INTO bank_details VALUES("5","1001","","100020030","2000","","dd","2020-12-03");
INSERT INTO bank_details VALUES("6","1001","","100020030","10000","","11","2020-12-30");



DROP TABLE bank_info;

CREATE TABLE `bank_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` text NOT NULL,
  `name` text NOT NULL,
  `account` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO bank_info VALUES("6","1002","Rupali Bank ","10011001010");
INSERT INTO bank_info VALUES("5","1001","Dutch Bangla Bank","100020030");



DROP TABLE brand_name;

CREATE TABLE `brand_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO brand_name VALUES("1","RFL");



DROP TABLE company_info;

CREATE TABLE `company_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name_first_part` text NOT NULL,
  `comapnay_name_last_part` text NOT NULL,
  `address` text NOT NULL,
  `tag` text NOT NULL,
  `logo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO company_info VALUES("1","POWER GOLD","MOTORS LIMITED","Cha-103, Uttar Badda (Near Badda General Hospital Road) Dhaka-1212","(All Kinds of Electrical Motors Importers & Marketing)","img/logo/f22646ebb4.png");



DROP TABLE distributor;

CREATE TABLE `distributor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ac` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `mobile_number` text NOT NULL,
  `location_id` text NOT NULL,
  `store_name` text NOT NULL,
  `Address` text NOT NULL,
  `membership_date` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO distributor VALUES("1","1001","Demo User","Demo Last Nam","01916859326","8","Aziz Store","Middle Badda, Dhaka","","1");
INSERT INTO distributor VALUES("2","1005","Shifat","Hossain","0101","4","Shifat Store","Gulshan-1","","1");



DROP TABLE distributor_location;

CREATE TABLE `distributor_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO distributor_location VALUES("1","Badda");
INSERT INTO distributor_location VALUES("2","Rampura");
INSERT INTO distributor_location VALUES("3","Malibagh");
INSERT INTO distributor_location VALUES("4","Gulshan-1");
INSERT INTO distributor_location VALUES("5","Mohakhali");
INSERT INTO distributor_location VALUES("6","Uttara");
INSERT INTO distributor_location VALUES("7","Dhanmondi ");
INSERT INTO distributor_location VALUES("8","Gabtoli");



DROP TABLE employee;

CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Employee_id` varchar(255) DEFAULT NULL,
  `First_Name` varchar(255) DEFAULT NULL,
  `Last_Name` varchar(255) DEFAULT NULL,
  `Desigination` varchar(255) DEFAULT NULL,
  `DOB` varchar(255) DEFAULT NULL,
  `Joining_Date` varchar(255) DEFAULT NULL,
  `Mobile_number` varchar(255) DEFAULT NULL,
  `edu_qulification` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Salary` varchar(255) DEFAULT NULL,
  `Status_employee` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO employee VALUES("1","001","Md. Mahfuzur","Rahman","Imam","2020-09-01","2020-09-01","0","Kamil","Missionpara","13000","1");
INSERT INTO employee VALUES("2","002","Md.Shahidul Islam","Sayeed","Mowazzin","2020-09-01","2020-09-01","01749582650","Alim","Missionpara","12000","1");
INSERT INTO employee VALUES("3","003","Mawlana","Habibullah","Khadem","2020-09-01","2020-09-01","01758423523","Hafez","Kishoreganj","8000","1");



DROP TABLE expens;

CREATE TABLE `expens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `head` text NOT NULL,
  `narration` text NOT NULL,
  `amount` text NOT NULL,
  `date` date NOT NULL,
  `salary_date` text NOT NULL,
  `head_id` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO expens VALUES("1","1","Eletric Bill","3000","2020-12-16","0000-00-00","1");
INSERT INTO expens VALUES("2","2","ddd","22222","2020-12-01","0000-00-00","2");
INSERT INTO expens VALUES("3","1","dd","100","2020-12-31","0000-00-00","1");



DROP TABLE expens_head;

CREATE TABLE `expens_head` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `expense_head` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO expens_head VALUES("1","Electric Bill");
INSERT INTO expens_head VALUES("2","Gas Bill");
INSERT INTO expens_head VALUES("4","Development work");
INSERT INTO expens_head VALUES("5","Misc. Expenses");



DROP TABLE invoice_details;

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `product_id` varchar(25) DEFAULT NULL,
  `product_name` varchar(250) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` text DEFAULT NULL,
  `purchase_price` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_invoice_details_invoices_idx` (`invoice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

INSERT INTO invoice_details VALUES("80","1002","1002","","2","200","100","2021-01-04 14:07:33");
INSERT INTO invoice_details VALUES("81","1002","1002","","3","200","100","2021-01-04 14:07:33");
INSERT INTO invoice_details VALUES("82","1002","1001","","2","300","2","2021-01-04 14:07:33");



DROP TABLE invoices;

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` text DEFAULT NULL,
  `distributor_id` int(11) DEFAULT NULL,
  `invoice_total` text DEFAULT NULL,
  `invoice_subtotal` text DEFAULT NULL,
  `tax` text DEFAULT NULL,
  `tax_amount` text DEFAULT NULL,
  `discount` text DEFAULT NULL,
  `discount_amount` text DEFAULT NULL,
  `amount_paid` text DEFAULT NULL,
  `amount_due` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created` text DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `uuid` varchar(75) DEFAULT NULL,
  `reciept_cat` text NOT NULL,
  `saller_id` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

INSERT INTO invoices VALUES("56","1001","","","","","","","","","","","","","","","");
INSERT INTO invoices VALUES("57","1002","1001","1600","1600","","0","","0","","1600","","2021-01-04","","","1","5");



DROP TABLE product_catagory;

CREATE TABLE `product_catagory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO product_catagory VALUES("1","Motor");
INSERT INTO product_catagory VALUES("2","Gash");
INSERT INTO product_catagory VALUES("3","stove");



DROP TABLE product_table;

CREATE TABLE `product_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` text NOT NULL,
  `product_name` text NOT NULL,
  `product_cat_id` text NOT NULL,
  `brand_id` text NOT NULL,
  `unite_price` text NOT NULL,
  `discount` text NOT NULL,
  `status` text NOT NULL,
  `description` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO product_table VALUES("4","1002","Gas Stove","2","1","200","0","1","Gas Stove","2020-12-09 18:27:44");
INSERT INTO product_table VALUES("3","1001","Motor","1","1","300","0","1","Test","2020-12-09 18:28:18");
INSERT INTO product_table VALUES("5","1003","Weighting Scall","3","1","300","0","1","Test","2020-12-09 16:20:28");



DROP TABLE purches_product;

CREATE TABLE `purches_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` text NOT NULL,
  `product_id` text NOT NULL,
  `catagory_id` text NOT NULL,
  `brand_id` text NOT NULL,
  `purches_quntity` text NOT NULL,
  `purches_price` text NOT NULL,
  `unite_price` text NOT NULL,
  `discount` text NOT NULL,
  `product_description` text NOT NULL,
  `purchase_total` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO purches_product VALUES("1","","1002","2","1","10","100","200","0","","1000","2020-12-09 18:26:44");
INSERT INTO purches_product VALUES("2","","1001","1","1","10","200","300","0","","2000","2020-11-09 18:27:00");
INSERT INTO purches_product VALUES("3","","1003","3","1","4","5","3","2","","20","2021-01-03 23:30:30");
INSERT INTO purches_product VALUES("4","","1001","1","1","2","8","3","0","","16","2021-01-04 00:08:58");
INSERT INTO purches_product VALUES("5","","1001","2","1","4","2","2","2","","8","2021-01-04 00:11:01");



DROP TABLE return_invoice_details;

CREATE TABLE `return_invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `return_invoice_id` text NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` varchar(25) DEFAULT NULL,
  `product_name` varchar(250) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` text DEFAULT NULL,
  `purchase_price` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_invoice_details_invoices_idx` (`invoice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

INSERT INTO return_invoice_details VALUES("25","48","1002","1002 ","","2","200","purchase price","2021-01-03 18:09:06");
INSERT INTO return_invoice_details VALUES("24","49","1002","1001 ","","2","300","purchase price","2021-01-03 18:09:06");
INSERT INTO return_invoice_details VALUES("23","50","1002","1002 ","","2","200","purchase price","2021-01-03 18:09:06");
INSERT INTO return_invoice_details VALUES("26","65","1006","1002 ","","10","200","purchase price","2021-01-03 22:34:39");
INSERT INTO return_invoice_details VALUES("27","66","1006","1002 ","","2","200","purchase price","2021-01-03 22:34:39");
INSERT INTO return_invoice_details VALUES("28","64","1005","1001 ","","2","300","purchase price","2021-01-03 22:34:41");
INSERT INTO return_invoice_details VALUES("29","63","1004","1002 ","","1","200","purchase price","2021-01-03 22:34:44");
INSERT INTO return_invoice_details VALUES("30","62","1004","1002 ","","1","200","purchase price","2021-01-03 22:34:44");
INSERT INTO return_invoice_details VALUES("31","61","1004","1002 ","","1","200","purchase price","2021-01-03 22:34:44");
INSERT INTO return_invoice_details VALUES("32","60","1003","1002 ","","1","200","purchase price","2021-01-03 22:34:47");
INSERT INTO return_invoice_details VALUES("33","59","1003","1001 ","","1","300","purchase price","2021-01-03 22:34:47");
INSERT INTO return_invoice_details VALUES("34","58","1002","1002 ","","1","200","purchase price","2021-01-03 22:34:48");
INSERT INTO return_invoice_details VALUES("35","57","1002","1001 ","","1","300","purchase price","2021-01-03 22:34:48");
INSERT INTO return_invoice_details VALUES("36","76","1006","1002","","1","200","100","2021-01-04 13:33:44");
INSERT INTO return_invoice_details VALUES("37","77","1006","1002","","1","200","100","2021-01-04 13:33:44");
INSERT INTO return_invoice_details VALUES("38","78","1006","1002","","1","200","100","2021-01-04 13:33:44");
INSERT INTO return_invoice_details VALUES("39","79","1006","1002","","1","200","100","2021-01-04 13:33:44");
INSERT INTO return_invoice_details VALUES("40","73","1005","1002","","2","200","100","2021-01-04 13:33:46");
INSERT INTO return_invoice_details VALUES("41","74","1005","1002","","1","200","100","2021-01-04 13:33:46");
INSERT INTO return_invoice_details VALUES("42","75","1005","1001","","1","300","2","2021-01-04 13:33:46");
INSERT INTO return_invoice_details VALUES("43","69","1002","1002 ","","2","200","","2021-01-04 13:33:49");
INSERT INTO return_invoice_details VALUES("44","70","1002","1002 ","","2","200","200","2021-01-04 13:33:49");
INSERT INTO return_invoice_details VALUES("45","68","1001","1002 ","","1","200","purchase price","2021-01-04 13:33:50");



DROP TABLE return_invoices;

CREATE TABLE `return_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `distributor_id` text DEFAULT NULL,
  `return_invoice_id` text NOT NULL,
  `invoice_total` text DEFAULT NULL,
  `invoice_subtotal` text DEFAULT NULL,
  `tax` text DEFAULT NULL,
  `tax_amount` text DEFAULT NULL,
  `amount_paid` text DEFAULT NULL,
  `amount_due` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created` text DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `uuid` varchar(75) DEFAULT NULL,
  `reciept_cat` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO return_invoices VALUES("10","1005","1002","1400","1400","","0","1400","0"," ","2021-01-03","0000-00-00 00:00:00","","1");
INSERT INTO return_invoices VALUES("11","1001","1006","2448","2400","10","240","2400","48","sales by aziz","2021-01-03","0000-00-00 00:00:00","","1");
INSERT INTO return_invoices VALUES("12","1001","1005","600","600","","0","","600"," ","2021-01-03","0000-00-00 00:00:00","","1");
INSERT INTO return_invoices VALUES("13","1005","1004","600","600","","0","600","0"," ","2021-01-03","0000-00-00 00:00:00","","1");
INSERT INTO return_invoices VALUES("14","1005","1003","500","500","","0","200","300"," ","2021-01-03","0000-00-00 00:00:00","","1");
INSERT INTO return_invoices VALUES("15","1005","1002","500","500","","0","500","0"," ","2021-01-03","0000-00-00 00:00:00","","1");
INSERT INTO return_invoices VALUES("16","1005","1001","1000","1000","","0","1000","0"," ","2021-01-03","0000-00-00 00:00:00","","1");
INSERT INTO return_invoices VALUES("17","1001","1006","800","800","","0","","800","","2021-01-04","","","1");
INSERT INTO return_invoices VALUES("18","1001","1005","990","900","10","90","1000","-10","","2021-01-04","","","1");
INSERT INTO return_invoices VALUES("19","1005","1003","700","700","","0","","700","","2021-01-03","","","1");
INSERT INTO return_invoices VALUES("20","1001","1002","800","800","","0","","800","","2021-01-03","","","1");
INSERT INTO return_invoices VALUES("21","1005","1001","200","200","","0","200","0","","2021-01-03","","","1");
INSERT INTO return_invoices VALUES("22","1001","1000","0.00","0.00","","0","","0.00"," ","2021-01-03","","","1");



DROP TABLE salary_payment;

CREATE TABLE `salary_payment` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `Employee_id` text DEFAULT NULL,
  `salary_amount` text DEFAULT NULL,
  `advanced_payment` text DEFAULT NULL,
  `gn_date` date DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO salary_payment VALUES("1","001","13000","0","2020-09-24","2020-09-24");
INSERT INTO salary_payment VALUES("2","002","12000","0","2020-09-24","2020-09-24");
INSERT INTO salary_payment VALUES("3","003","8000","0","2020-09-24","2020-09-24");



DROP TABLE stock_product;

CREATE TABLE `stock_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` text NOT NULL,
  `catogry_id` text NOT NULL,
  `brand_id` text NOT NULL,
  `stock_quantity` text NOT NULL,
  `discount` text NOT NULL,
  `purches_price` text NOT NULL,
  `price` text NOT NULL,
  `saler_id` text NOT NULL,
  `status_id` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO stock_product VALUES("1","1002","2","1","13","0","100","200","5","","2021-01-04 14:07:33");
INSERT INTO stock_product VALUES("2","1001","1","1","7","2","2","2","6","","2021-01-04 14:07:33");
INSERT INTO stock_product VALUES("3","1003","3","1","3","2","2999","3","6","","2021-01-04 00:19:21");



DROP TABLE temp_invoice_details;

CREATE TABLE `temp_invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `disCode` text NOT NULL,
  `invoice_id` text NOT NULL,
  `product_id` varchar(25) DEFAULT NULL,
  `product_name` varchar(250) DEFAULT NULL,
  `quantity` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `purchase_price` text DEFAULT NULL,
  `total` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=latin1;

INSERT INTO temp_invoice_details VALUES("191","1001 ","1007","1002","","1","200","100","200","2021-01-04 13:46:00");
INSERT INTO temp_invoice_details VALUES("192","1001 ","1007","1002","","1","200","100","200","2021-01-04 13:46:03");



DROP TABLE temp_invoices;

CREATE TABLE `temp_invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `distributor_id` int(11) DEFAULT NULL,
  `invoice_total` text DEFAULT NULL,
  `invoice_subtotal` text DEFAULT NULL,
  `tax` text DEFAULT NULL,
  `tax_amount` text DEFAULT NULL,
  `amount_paid` text DEFAULT NULL,
  `amount_due` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created` text DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `uuid` varchar(75) DEFAULT NULL,
  `reciept_cat` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




