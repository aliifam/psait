USE `psait11`;
 
/*Table structure for table `tbl_mahasiswa` */
 
DROP TABLE IF EXISTS `tbl_mahasiswa`;
 
CREATE TABLE `tbl_mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` char(8) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `jk` char(1) DEFAULT NULL,
  `alamat` text,
  `jurusan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
 
/*Data for the table `tbl_mahasiswa` */
 
insert  into `tbl_mahasiswa`(`id`,`nim`,`nama`,`jk`,`alamat`,`jurusan`) values
(1,'15119999','muhammad al fatih','L','Jl. P. Puger 2 No 19','Informatika'),
(2,'16119212','Fatimah','P','Jl. Ringin Raya','Sistem Informasi');