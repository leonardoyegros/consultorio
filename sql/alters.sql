alter table users add column document_id character varying;
ALTER TABLE users
  ADD CONSTRAINT email_uq UNIQUE (email);

ALTER TABLE documents
	ADD CONSTRAINT docuements_uq UNIQUE (user_id, code, type);
