insert into userBasics (fbid, name, school_id, department_id)
values(
^fbid^,
'^name^',
(select id from school where name = '^school^'),
(select id from department where name = '^department^')
);