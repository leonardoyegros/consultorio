alter table users add column activated boolean default false;
alter table users add column hash character varying;
update users set hash = md5(email||password);