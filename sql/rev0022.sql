drop table tickets;
CREATE TABLE tickets
(
  id serial,
  name character varying,
  notes character varying,
  module character varying,
  status character varying default 'pending',

  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  created_user_id bigint,
  CONSTRAINT ticket_id PRIMARY KEY (id)
);

ALTER table contacts add column init_date character varying;