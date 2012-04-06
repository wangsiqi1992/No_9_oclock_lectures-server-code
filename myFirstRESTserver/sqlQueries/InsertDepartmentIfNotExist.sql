insert into department(name)
select '^department^' from dual
where not exists(select name from department where name = '^department^');
