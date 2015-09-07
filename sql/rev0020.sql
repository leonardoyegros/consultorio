alter table currencies add column created_user_id bigint;

ALTER TABLE collections_attachments
  DROP CONSTRAINT collection_attachment_id_fk;

ALTER TABLE payments_attachments
  DROP CONSTRAINT payment_attachment_id_fk;

ALTER TABLE purchases_attachments
  DROP CONSTRAINT purchase_attachment_id_fk;

ALTER TABLE sales_attachments
  DROP CONSTRAINT sattachment_id_fk;

-- Table: attachments

DROP TABLE attachments;

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

