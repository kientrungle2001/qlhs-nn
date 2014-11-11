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
