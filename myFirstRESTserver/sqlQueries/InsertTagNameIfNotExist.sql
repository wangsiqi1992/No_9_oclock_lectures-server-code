insert into ^tagTable^ (name)
select '^tagName^' from dual
where not exists(select name from ^tagTable^ where name = '^tagName^')