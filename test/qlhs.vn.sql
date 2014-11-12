insert into `student_schedule`(classId,studentId,studyDate,status) values ('47','1063','2014-07-16','1') # ASCII
update student_schedule set classId='47',studentId='1063',studyDate='2014-07-16',status='0' where 1 AND id=19471 # ASCII
update student_schedule set classId='47',studentId='1063',studyDate='2014-07-16',status='1' where 1 AND id=19471 # ASCII
update student_schedule set classId='47',studentId='1063',studyDate='2014-07-16',status='0' where 1 AND id=19471 # ASCII
insert into `student_schedule`(classId,studentId,studyDate,status) values ('47','1063','2014-11-05','4') # ASCII
insert into `student_schedule`(classId,studentId,studyDate,status) values ('47','1063','2014-11-12','4') # ASCII
update student_schedule set classId='47',studentId='1063',studyDate='2014-11-12',status='0' where 1 AND id=19473 # ASCII
update student_schedule set classId='47',studentId='1063',studyDate='2014-11-05',status='0' where 1 AND id=19472 # ASCII
update student_schedule set classId='47',studentId='1063',studyDate='2014-11-05',status='1' where 1 AND id=19472 # ASCII
update student_schedule set classId='47',studentId='1063',studyDate='2014-11-05',status='4' where 1 AND id=19472 # ASCII
update student_schedule set classId='47',studentId='1063',studyDate='2014-11-12',status='4' where 1 AND id=19473 # ASCII
update student_schedule set classId='47',studentId='1063',studyDate='2014-11-05',status='0' where 1 AND id=19472 # ASCII
update student_schedule set classId='47',studentId='1063',studyDate='2014-11-12',status='0' where 1 AND id=19473 # ASCII
update student_schedule set classId='47',studentId='1063',studyDate='2014-11-05',status='4' where 1 AND id=19472 # ASCII
update student_schedule set classId='47',studentId='1063',studyDate='2014-11-12',status='3' where 1 AND id=19473 # ASCII
update student_schedule set classId='47',studentId='1063',studyDate='2014-11-12',status='4' where 1 AND id=19473 # ASCII
update student_schedule set classId='43',studentId='467',studyDate='2014-11-03',status='2' where 1 AND id=16143 # ASCII
update student_schedule set classId='43',studentId='467',studyDate='2014-11-03',status='3' where 1 AND id=16143 # ASCII
update student_schedule set classId='43',studentId='467',studyDate='2014-11-03',status='4' where 1 AND id=16143 # ASCII
update student_schedule set classId='55',studentId='1062',studyDate='2014-11-06',status='4' where 1 AND id=19264 # ASCII
update student_schedule set classId='55',studentId='1062',studyDate='2014-11-06',status='1' where 1 AND id=19264 # ASCII
update student_schedule set classId='55',studentId='1062',studyDate='2014-11-06',status='4' where 1 AND id=19264 # ASCII
update student_schedule set classId='55',studentId='1062',studyDate='2014-11-06',status='1' where 1 AND id=19264 # ASCII
update student set name='Nguyễn Hiền Chi',phone=' 0989019691',school='',birthDate='',address='',parentName='',startStudyDate='2014-11-01',endStudyDate='' where 1 AND id=1064 # UTF-8
update student set name='Nguyễn Hiền Chi',phone=' 0989019691',school='',birthDate='',address='',parentName='',startStudyDate='2014-11-01',endStudyDate='' where 1 AND id=1064 # UTF-8
insert into `class_student`(classId,studentId,startClassDate,endClassDate) values ('69','1066','','') # ASCII
insert into `student_schedule`(classId,studentId,studyDate,status) values ('69','1066','2014-11-08','1') # ASCII
insert into `student_schedule`(classId,studentId,studyDate,status) values ('69','1066','2014-11-15','1') # ASCII
insert into `student_schedule`(classId,studentId,studyDate,status) values ('69','1066','2014-11-22','1') # ASCII
insert into `student_schedule`(classId,studentId,studyDate,status) values ('69','1066','2014-11-29','1') # ASCII
insert into `student_schedule`(classId,studentId,studyDate,status) values ('69','1066','2014-12-06','1') # ASCII
insert into `student_schedule`(classId,studentId,studyDate,status) values ('69','1066','2014-12-13','1') # ASCII
insert into `student_schedule`(classId,studentId,studyDate,status) values ('69','1066','2014-12-20','1') # ASCII
insert into `student_schedule`(classId,studentId,studyDate,status) values ('69','1066','2014-12-27','1') # ASCII
insert into `general_order`(orderType,type,amount,created,createdTime,bookNum,noNum,debit,name,phone,address,reason,additional,invoiceNum) values ('invoice','student','960000','2014-11-11','1415678641','5','6','','Nguyễn Hoàng Gia Bảo','0983548542','','Nộp tiền lớp 3T1 môn Toán, Tháng 11-12','','') # UTF-8
insert into `student_order`(orderId,classId,studentId,payment_periodId,amount,discount,discount_reason,muster,price,total_before_discount,created,createdTime,bookNum,noNum,debit,name,address,reason,additional,invoiceNum) values ('60','69','1066','6','960000','0',' ','8','120000','960000','2014-11-11','1415678641','5','6','','Nguyễn Hoàng Gia Bảo','','Nộp tiền lớp 3T1 môn Toán, Tháng 11-12','','') # UTF-8
update classes set name='4V2K3',startDate='2014-07-16',endDate='',roomId='',subjectId='2',teacherId='2',teacher2Id='12',level='4',status='1',amount='100000' where 1 AND id=44 # ASCII
update classes set name='4V2K3',startDate='2014-07-16',endDate='',roomId='',subjectId='2',teacherId='2',teacher2Id='12',level='4',status='1',amount='100000' where 1 AND id=44 # ASCII
update classes set name='4V5K3',startDate='2014-07-16',endDate='',roomId='',subjectId='2',teacherId='2',teacher2Id='',level='4',status='1',amount='100000' where 1 AND id=47 # ASCII
insert into `general_order`(orderType,type,amount,created,createdTime,bookNum,noNum,debit,name,phone,address,reason,additional,invoiceNum) values ('invoice','student','900000','2014-11-11','1415680336','2','18','','Nguyễn Hiền Chi',' 0989019691','','Nộp tiền lớp 4V2K3 môn Tiếng Việt, lớp 4V5K3 môn Tiếng Việt, Tháng 11-12','','') # UTF-8
insert into `student_order`(orderId,classId,studentId,payment_periodId,amount,discount,discount_reason,muster,price,total_before_discount,created,createdTime,bookNum,noNum,debit,name,address,reason,additional,invoiceNum) values ('65','44','1064','6','0','0',' ','0','100000','0','2014-11-11','1415680336','2','18','','Nguyễn Hiền Chi','','Nộp tiền lớp 4V2K3 môn Tiếng Việt, lớp 4V5K3 môn Tiếng Việt, Tháng 11-12','','') # UTF-8
insert into `student_order`(orderId,classId,studentId,payment_periodId,amount,discount,discount_reason,muster,price,total_before_discount,created,createdTime,bookNum,noNum,debit,name,address,reason,additional,invoiceNum) values ('65','47','1064','6','900000','0','','9','100000','900000','2014-11-11','1415680336','2','18','','Nguyễn Hiền Chi','','Nộp tiền lớp 4V2K3 môn Tiếng Việt, lớp 4V5K3 môn Tiếng Việt, Tháng 11-12','','') # UTF-8
update config set mkey='noNum',mvalue='19' where 1 AND id=2 # ASCII
update config set mkey='bookNum',mvalue='2' where 1 AND id=3 # ASCII
update class_student set classId='47',studentId='1064',startClassDate='2014-11-08',endClassDate='' where 1 AND id=1779 # ASCII
update class_student set classId='44',studentId='1064',startClassDate='',endClassDate='2014-11-08' where 1 AND id=1777 # ASCII
insert into `general_order`(orderType,type,amount,created,createdTime,bookNum,noNum,debit,name,phone,address,reason,additional,invoiceNum) values ('invoice','student','900000','2014-11-11','1415680536','5','25','','Nguyễn Hiền Chi',' 0989019691','','Nộp tiền lớp 4V2K3 môn Tiếng Việt, lớp 4V5K3 môn Tiếng Việt, Tháng 11-12','','') # UTF-8
insert into `student_order`(orderId,classId,studentId,payment_periodId,amount,discount,discount_reason,muster,price,total_before_discount,created,createdTime,bookNum,noNum,debit,name,address,reason,additional,invoiceNum) values ('72','44','1064','6','100000','0',' ','1','100000','100000','2014-11-11','1415680536','5','25','','Nguyễn Hiền Chi','','Nộp tiền lớp 4V2K3 môn Tiếng Việt, lớp 4V5K3 môn Tiếng Việt, Tháng 11-12','','') # UTF-8
insert into `student_order`(orderId,classId,studentId,payment_periodId,amount,discount,discount_reason,muster,price,total_before_discount,created,createdTime,bookNum,noNum,debit,name,address,reason,additional,invoiceNum) values ('72','47','1064','6','800000','0','','8','100000','800000','2014-11-11','1415680536','5','25','','Nguyễn Hiền Chi','','Nộp tiền lớp 4V2K3 môn Tiếng Việt, lớp 4V5K3 môn Tiếng Việt, Tháng 11-12','','') # UTF-8
update general_order set status='deleted' where 1 AND id=411 # ASCII
update student_order set status='deleted' where 1 AND orderId=411 # ASCII
update general_order set status='deleted' where 1 AND id=410 # ASCII
update student_order set status='deleted' where 1 AND orderId=410 # ASCII
update student set name='Nguyễn Thùy Dương',phone='0904334591',school='',birthDate='',address='',parentName='',startStudyDate='2014-11-01',endStudyDate='' where 1 AND id=1065 # UTF-8
insert into `general_order`(orderType,type,amount,created,createdTime,bookNum,noNum,debit,name,phone,address,reason,additional,invoiceNum) values ('invoice','student','900000','2014-11-11','1415681619','5','25','','Nguyễn Thùy Dương','0904334591','','Nộp tiền lớp 4V5K3 môn Tiếng Việt, Tháng 11-12','','') # UTF-8
insert into `student_order`(orderId,classId,studentId,payment_periodId,amount,discount,discount_reason,muster,price,total_before_discount,created,createdTime,bookNum,noNum,debit,name,address,reason,additional,invoiceNum) values ('80','47','1065','6','900000','0',' ','9','100000','900000','2014-11-11','1415681619','5','25','','Nguyễn Thùy Dương','','Nộp tiền lớp 4V5K3 môn Tiếng Việt, Tháng 11-12','','') # UTF-8
insert into `general_order`(orderType,type,amount,created,createdTime,bookNum,noNum,debit,name,phone,address,reason,additional,invoiceNum) values ('invoice','student','900000','2014-11-11','1415681984','5','50','','Nguyễn Thùy Dương','0904334591','','Nộp tiền lớp 4V5K3 môn Tiếng Việt, Tháng 11-12','','') # UTF-8
insert into `student_order`(orderId,classId,studentId,payment_periodId,amount,discount,discount_reason,muster,price,total_before_discount,created,createdTime,bookNum,noNum,debit,name,address,reason,additional,invoiceNum) values ('82','47','1065','6','900000','0',' ','9','100000','900000','2014-11-11','1415681984','5','50','','Nguyễn Thùy Dương','','Nộp tiền lớp 4V5K3 môn Tiếng Việt, Tháng 11-12','','') # UTF-8
insert into `general_order`(orderType,type,amount,created,createdTime,bookNum,noNum,debit,name,phone,address,reason,additional,invoiceNum) values ('invoice','student','900000','2014-11-11','1415682193','5','25','','Nguyễn Thùy Dương','0904334591','','Nộp tiền lớp 4V5K3 môn Tiếng Việt, Tháng 11-12','','') # UTF-8
insert into `student_order`(orderId,classId,studentId,payment_periodId,amount,discount,discount_reason,muster,price,total_before_discount,created,createdTime,bookNum,noNum,debit,name,address,reason,additional,invoiceNum) values ('414','47','1065','6','900000','0',' ','9','100000','900000','2014-11-11','1415682193','5','25','','Nguyễn Thùy Dương','','Nộp tiền lớp 4V5K3 môn Tiếng Việt, Tháng 11-12','','') # UTF-8
insert into `general_order`(orderType,type,amount,created,createdTime,bookNum,noNum,debit,name,phone,address,reason,additional,invoiceNum) values ('invoice','student','2400000','2014-11-12','1415763514','2','19','','Nguyễn Minh Nghĩa','0988588129','','Nộp tiền lớp M9.1K3 môn Văn miêu tả, ','','') # UTF-8
insert into `student_order`(orderId,classId,studentId,payment_periodId,amount,discount,discount_reason,muster,price,total_before_discount,created,createdTime,bookNum,noNum,debit,name,address,reason,additional,invoiceNum) values ('415','71','794','0','2400000','0','','1','2400000','2400000','2014-11-12','1415763514','2','19','','Nguyễn Minh Nghĩa','','Nộp tiền lớp M9.1K3 môn Văn miêu tả, ','','') # UTF-8
update config set mkey='noNum',mvalue='20' where 1 AND id=2 # ASCII
update config set mkey='bookNum',mvalue='2' where 1 AND id=3 # ASCII
insert into `class_student`(classId,studentId,startClassDate,endClassDate) values ('37','807','2014-10-01','') # ASCII
insert into `general_order`(orderType,type,amount,created,createdTime,bookNum,noNum,debit,name,phone,address,reason,additional,invoiceNum) values ('invoice','student','1200000','2014-11-12','1415767603','2','20','','Đặng Huy Giang','0904305115','','Nộp tiền lớp 5V8K3 môn Tiếng Việt, Tháng 11-12','','') # UTF-8
insert into `student_order`(orderId,classId,studentId,payment_periodId,amount,discount,discount_reason,muster,price,total_before_discount,created,createdTime,bookNum,noNum,debit,name,address,reason,additional,invoiceNum) values ('416','60','807','6','1200000','0',' ','8','150000','1200000','2014-11-12','1415767604','2','20','','Đặng Huy Giang','','Nộp tiền lớp 5V8K3 môn Tiếng Việt, Tháng 11-12','','') # UTF-8
update config set mkey='noNum',mvalue='21' where 1 AND id=2 # ASCII
update config set mkey='bookNum',mvalue='2' where 1 AND id=3 # ASCII
insert into `general_order`(orderType,type,amount,created,createdTime,bookNum,noNum,debit,name,phone,address,reason,additional,invoiceNum) values ('invoice','student','1800000','2014-11-12','1415767736','2','21','','Nguyễn Quốc Khánh','0912216743','','Nộp tiền lớp 5T2K3 môn Toán, Tháng 11-12','','') # UTF-8
insert into `student_order`(orderId,classId,studentId,payment_periodId,amount,discount,discount_reason,muster,price,total_before_discount,created,createdTime,bookNum,noNum,debit,name,address,reason,additional,invoiceNum) values ('417','34','969','6','1800000','0',' ','9','200000','1800000','2014-11-12','1415767736','2','21','','Nguyễn Quốc Khánh','','Nộp tiền lớp 5T2K3 môn Toán, Tháng 11-12','','') # UTF-8
update config set mkey='noNum',mvalue='22' where 1 AND id=2 # ASCII
update config set mkey='bookNum',mvalue='2' where 1 AND id=3 # ASCII
insert into `general_order`(orderType,type,amount,created,createdTime,bookNum,noNum,debit,name,phone,address,reason,additional,invoiceNum) values ('invoice','student','2400000','2014-11-12','1415767968','2','22','','Nguyễn Quốc Khánh','0912216743','','Nộp tiền lớp M10.1K3 môn Văn miêu tả, ','','') # UTF-8
insert into `student_order`(orderId,classId,studentId,payment_periodId,amount,discount,discount_reason,muster,price,total_before_discount,created,createdTime,bookNum,noNum,debit,name,address,reason,additional,invoiceNum) values ('418','73','969','0','2400000','0','','1','2400000','2400000','2014-11-12','1415767969','2','22','','Nguyễn Quốc Khánh','','Nộp tiền lớp M10.1K3 môn Văn miêu tả, ','','') # UTF-8
update config set mkey='noNum',mvalue='23' where 1 AND id=2 # ASCII
update config set mkey='bookNum',mvalue='2' where 1 AND id=3 # ASCII
insert into `class_student`(classId,studentId,startClassDate,endClassDate) values ('54','969','2014-09-01','') # ASCII
insert into `class_student`(classId,studentId,startClassDate,endClassDate) values ('51','969','2014-11-02','') # ASCII
insert into `general_order`(orderType,type,amount,created,createdTime,bookNum,noNum,debit,name,phone,address,reason,additional,invoiceNum) values ('invoice','student','1200000','2014-11-12','1415777224','2','23','','Nguyễn Lê Trà My','0983003889','','Nộp tiền lớp 5T3K3 môn Toán, Tháng 9-10','','') # UTF-8
insert into `student_order`(orderId,classId,studentId,payment_periodId,amount,discount,discount_reason,muster,price,total_before_discount,created,createdTime,bookNum,noNum,debit,name,address,reason,additional,invoiceNum) values ('419','35','791','5','1200000','0',' ','8','150000','1200000','2014-11-12','1415777224','2','23','','Nguyễn Lê Trà My','','Nộp tiền lớp 5T3K3 môn Toán, Tháng 9-10','','') # UTF-8
update config set mkey='noNum',mvalue='24' where 1 AND id=2 # ASCII
update config set mkey='bookNum',mvalue='2' where 1 AND id=3 # ASCII
insert into `general_order`(orderType,type,amount,created,createdTime,bookNum,noNum,debit,name,phone,address,reason,additional,invoiceNum) values ('invoice','student','1350000','2014-11-12','1415777271','2','24','','Nguyễn Lê Trà My','0983003889','','Nộp tiền lớp 5V8K3 môn Tiếng Việt, Tháng 9-10','','') # UTF-8
insert into `student_order`(orderId,classId,studentId,payment_periodId,amount,discount,discount_reason,muster,price,total_before_discount,created,createdTime,bookNum,noNum,debit,name,address,reason,additional,invoiceNum) values ('420','60','791','5','1350000','0',' ','9','150000','1350000','2014-11-12','1415777271','2','24','','Nguyễn Lê Trà My','','Nộp tiền lớp 5V8K3 môn Tiếng Việt, Tháng 9-10','','') # UTF-8
update config set mkey='noNum',mvalue='25' where 1 AND id=2 # ASCII
update config set mkey='bookNum',mvalue='2' where 1 AND id=3 # ASCII
