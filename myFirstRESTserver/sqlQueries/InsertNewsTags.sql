insert into newsTags
set
nid = ^nid^,
tag_1_id = (select id from tag_1 where name = '^tag_1^'),
tag_2_id = (select id from tag_2 where name = '^tag_2^'),
tag_3_id = (select id from tag_3 where name = '^tag_3^'),
tag_4_id = (select id from tag_4 where name = '^tag_4^'),
tag_5_id = (select id from tag_5 where name = '^tag_5^')
