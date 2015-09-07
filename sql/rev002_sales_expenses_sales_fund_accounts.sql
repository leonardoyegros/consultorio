ALTER TABLE sales_expenses
   ALTER COLUMN sale_id DROP NOT NULL;


drop table sales_expenses cascade;
CREATE TABLE sales_expenses
(
  id serial,
  sale_id bigint,
  expense_id bigint,
  quantity numeric DEFAULT 1,
  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT sales_items_pkey PRIMARY KEY (id),
  CONSTRAINT sale_id_fk FOREIGN KEY (sale_id)
      REFERENCES sales (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);

drop table sales_fund_accounts cascade;
CREATE TABLE sales_fund_accounts
(
  id serial NOT NULL,
  fund_account_id bigint,
  sale_id bigint,
  amount numeric,
  user_id bigint,
  CONSTRAINT sales_fund_accounts_pkey PRIMARY KEY (id),
  CONSTRAINT sfa_sale_id_fk FOREIGN KEY (sale_id)
      REFERENCES sales (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);
