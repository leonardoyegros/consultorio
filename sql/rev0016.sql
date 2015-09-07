CREATE TABLE invoice_templates
(
  id serial,
  -- document_id bigint,
  created_user_id bigint,
  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT invoice_templates_pkey PRIMARY KEY (id)
);

CREATE TABLE invoice_template_elements
(
  id serial,
  invoice_template_id bigint,
  created_user_id bigint,
  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT invoice_template_elements_pkey PRIMARY KEY (id),
  CONSTRAINT invoice_template_fk FOREIGN KEY (invoice_template_id)
      REFERENCES invoice_templates (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);

alter table invoice_template_elements add column name character varying;
alter table invoice_template_elements add column number numeric;
alter table invoice_templates add column name character varying;
alter table invoice_templates add column document_type character varying;
alter table invoice_template_elements add column p_top numeric;
alter table invoice_template_elements add column p_left numeric;
alter table invoice_template_elements add column width numeric;
alter table invoice_template_elements add column height numeric;





alter table users add column stay_logged_hash character varying;
alter table documents add column template_id bigint;

ALTER TABLE expenses_taxes
  ADD CONSTRAINT expen_tax UNIQUE (expense_id, tax_id);
