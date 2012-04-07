select n.title, n.date, n.nid, u.name as 'author_name' from newsBasics as n
inner join userBasics as u on(u.fbid = n.author_id)
where nid = ^nid^;