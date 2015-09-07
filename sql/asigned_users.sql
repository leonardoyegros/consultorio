CREATE TABLE users_assigned_users
(
  id serial,
  assigned_user_id bigint,
  master_user_id bigint,

  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT assigned_users_pkey PRIMARY KEY (id),
  CONSTRAINT user_id_fk FOREIGN KEY (assigned_user_id)
      REFERENCES users (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);