CREATE TABLE purchases_advances
(
  id serial,
  purchase_id bigint,
  payment_id bigint,
  amount numeric,

  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT purchases_advancespkey PRIMARY KEY (id)
);