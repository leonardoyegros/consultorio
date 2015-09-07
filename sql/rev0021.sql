CREATE TABLE attachments
(
  id serial,
  name character varying,
  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  attached boolean DEFAULT false,
  operation_type character varying,
  operation_id bigint,
  created_user_id bigint,
  CONSTRAINT attachment_id PRIMARY KEY (id)
);

CREATE TABLE sales_attachments
(
  id serial,
  sale_id bigint,
  attachment_id bigint,
  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT sales_attachments_pkey PRIMARY KEY (id),
  CONSTRAINT sale_id_fk FOREIGN KEY (sale_id)
      REFERENCES sales (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
   CONSTRAINT sales_attachment_id_fk FOREIGN KEY (attachment_id)
      REFERENCES attachments (id) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT
);

CREATE TABLE collections_attachments
(
  id serial,
  collection_id bigint,
  attachment_id bigint,
  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT collections_attachments_pkey PRIMARY KEY (id),
  CONSTRAINT collection_id_fk FOREIGN KEY (collection_id)
      REFERENCES collections (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
   CONSTRAINT collection_attachment_id_fk FOREIGN KEY (attachment_id)
      REFERENCES attachments (id) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT
);

CREATE TABLE purchases_attachments
(
  id serial,
  purchase_id bigint,
  attachment_id bigint,
  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT purchases_attachments_pkey PRIMARY KEY (id),
  CONSTRAINT purchase_id_fk FOREIGN KEY (purchase_id)
      REFERENCES purchases (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
   CONSTRAINT purchase_attachment_id_fk FOREIGN KEY (attachment_id)
      REFERENCES attachments (id) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT
);

CREATE TABLE payments_attachments
(
  id serial,
  payment_id bigint,
  attachment_id bigint,
  user_id bigint,
  created timestamp without time zone,
  modified timestamp without time zone,
  CONSTRAINT payments_attachments_pkey PRIMARY KEY (id),
  CONSTRAINT payment_id_fk FOREIGN KEY (payment_id)
      REFERENCES payments (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
   CONSTRAINT payment_attachment_id_fk FOREIGN KEY (attachment_id)
      REFERENCES attachments (id) MATCH SIMPLE
      ON UPDATE RESTRICT ON DELETE RESTRICT
);