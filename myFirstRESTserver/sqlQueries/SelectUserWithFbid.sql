select  u.fbid, u.name, s.name as school, d.name as department
from    userBasics as u
inner join  school as s on(u.school_id = s.id)
inner join  department as d on (u.department_id = d.id)
where u.fbid = ^fbid^;