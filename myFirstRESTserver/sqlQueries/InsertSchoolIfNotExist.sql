insert into school(name)
select '^school^' from dual
where not exists(select name from school where name = '^school^');
