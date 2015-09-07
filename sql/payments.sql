CREATE TABLE payments
(
  id serial,
  issue_date character varying,
  advance boolean default false,
  contact_id bigint,
  number character varying,
  notes character varying,
  amount numeric,
  currency_id bigint,
  exchange_rate numeric,
  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT payments_pkey PRIMARY KEY (id)
);

CREATE TABLE payments_fund_accounts
(
  id serial,
  fund_account_id bigint,
  payment_id bigint,
  amount numeric,
  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT payments_fund_accounts_pkey PRIMARY KEY (id)
);

CREATE TABLE purchases_payments
(
  id serial,
  purchase_id bigint,
  payment_id bigint,
  amount numeric,
  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT purchases_payments_pkey PRIMARY KEY (id)
);