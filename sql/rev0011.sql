ALTER TABLE sales
  ADD CONSTRAINT d_sales1_fk FOREIGN KEY (document_id) REFERENCES documents (id) ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE purchases_expenses_prices
  ADD CONSTRAINT t_purchases_fk FOREIGN KEY (tax_id) REFERENCES taxes (id) ON UPDATE RESTRICT ON DELETE RESTRICT;

ALTER TABLE sales_expenses_prices
  ADD CONSTRAINT t_sales_fk FOREIGN KEY (tax_id) REFERENCES taxes (id) ON UPDATE RESTRICT ON DELETE RESTRICT;

delete from sales_expenses where expense_id not in (select id from expenses);
ALTER TABLE sales_expenses
  ADD CONSTRAINT e_sales_fk FOREIGN KEY (expense_id) REFERENCES expenses (id) ON UPDATE RESTRICT ON DELETE RESTRICT;

delete from purchases_expenses where expense_id not in (select id from expenses);
ALTER TABLE purchases_expenses
  ADD CONSTRAINT e_purchases_fk FOREIGN KEY (expense_id) REFERENCES expenses (id) ON UPDATE RESTRICT ON DELETE RESTRICT;

 ALTER TABLE sales
  ADD CONSTRAINT c_sales FOREIGN KEY (contact_id) REFERENCES contacts (id) ON UPDATE RESTRICT ON DELETE RESTRICT;

 ALTER TABLE purchases
  ADD CONSTRAINT c_purchases FOREIGN KEY (contact_id) REFERENCES contacts (id) ON UPDATE RESTRICT ON DELETE RESTRICT;

 ALTER TABLE collections
  ADD CONSTRAINT c_collections FOREIGN KEY (contact_id) REFERENCES contacts (id) ON UPDATE RESTRICT ON DELETE RESTRICT;

 ALTER TABLE payments
  ADD CONSTRAINT c_payments FOREIGN KEY (contact_id) REFERENCES contacts (id) ON UPDATE RESTRICT ON DELETE RESTRICT;

drop table contacts_expenses;
CREATE TABLE contacts_expenses
(
  id serial,
  contact_id bigint,
  expense_id bigint,
  amount numeric DEFAULT 1,
  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT contact_expense_pkey PRIMARY KEY (id),
  CONSTRAINT contact_expense_fk FOREIGN KEY (contact_id)
      REFERENCES contacts (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);

alter table contacts add column autoinvoice boolean DEFAULT false;