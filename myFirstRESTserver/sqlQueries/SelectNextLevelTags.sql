select name from ^targetTag^
where id = (
select distinct ^targetTag^_id from newsTags
where ^parentTag^_id = (
select id from ^parentTag^
where name = 'I dont know what I am tagging'))