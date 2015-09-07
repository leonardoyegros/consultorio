
CREATE TABLE collections
(
  id serial,
  issue_date character varying,
  advance boolean default false,
  contact_id bigint,
  number character varying,
  amount numeric,
  currency_id bigint,
  exchange_rate numeric,
  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT collections_pkey PRIMARY KEY (id)
);

CREATE TABLE sales_collections
(
  id serial,
  sale_id bigint,
  collection_id bigint,
  amount numeric,

  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT sales_collections_pkey PRIMARY KEY (id)
);

CREATE TABLE collections_fund_accounts
(
  id serial,
  fund_account_id bigint,
  collection_id bigint,
  amount numeric,

  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT collections_fund_accounts_pkey PRIMARY KEY (id)
);


ALTER TABLE sales_collections
  ADD CONSTRAINT collection_fk FOREIGN KEY (collection_id) REFERENCES collections (id) ON UPDATE CASCADE ON DELETE CASCADE;

  ALTER TABLE collections_fund_accounts
  ADD CONSTRAINT collection_fa_fk FOREIGN KEY (collection_id) REFERENCES collections (id) ON UPDATE CASCADE ON DELETE CASCADE;



-- Function: sales_after()

-- DROP FUNCTION sales_after();
-- Function: sales_after()

-- DROP FUNCTION sales_after();


