update userBasics
set 
name = '^name^',
school_id = (select id from school where name = '^school^'),
department_id = (select id from department where name = '^department^'),
year = ^year^
where fbid = ^fbid^