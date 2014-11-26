delete from attribute_set where 1 AND (`id`='34') # ASCII
delete from attribute_group where 1 AND (`id`='35') # ASCII
delete from attribute_group_attribute where 1 AND (`id`='226') # ASCII
delete from attribute_group_attribute where 1 AND (`id`='227') # ASCII
delete from attribute_group_attribute where 1 AND (`id`='228') # ASCII
delete from attribute_group_attribute where 1 AND (`id`='229') # ASCII
delete from attribute_group_attribute where 1 AND (`id`='230') # ASCII
delete from attribute_set where 1 AND (`id`='35') # ASCII
delete from attribute_group where 1 AND (`id`='36') # ASCII
delete from attribute_group_attribute where 1 AND (`id`='231') # ASCII
delete from attribute_group_attribute where 1 AND (`id`='232') # ASCII
delete from attribute_set where 1 AND (`id`='36') # ASCII
delete from attribute_group where 1 AND (`id`='37') # ASCII
delete from attribute_group_attribute where 1 AND (`id`='233') # ASCII
delete from attribute_group_attribute where 1 AND (`id`='234') # ASCII
delete from attribute_group_attribute where 1 AND (`id`='235') # ASCII
insert into `attribute_value_type`(title,code) values ('Integer','int') # ASCII
insert into `attribute_value_type`(title,code) values ('Text','text') # ASCII
update attribute_value_type set title='Varchar',code='varchar' where 1 AND id=1 # ASCII
