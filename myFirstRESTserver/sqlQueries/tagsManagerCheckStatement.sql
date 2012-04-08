select newsBasics.nid from newsBasics 
inner join newsTags 
on( newsTags.nid = newsBasics.nid)
where
newsBasics.title = '^title^'


