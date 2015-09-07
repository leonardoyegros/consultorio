alter table collections add column used numeric default 0;

CREATE TABLE sales_advances
(
  id serial,
  sale_id bigint,
  collection_id bigint,
  amount numeric,
  user_id bigint,
  created_user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT sales_advances_pkey PRIMARY KEY (id),
  CONSTRAINT collection_id_fk FOREIGN KEY (collection_id)
      REFERENCES collections (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT sale_id_fk FOREIGN KEY (sale_id)
      REFERENCES sales (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT
);