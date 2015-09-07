alter table users_assigned_users add column enabled boolean default true;
--alter table accounts add column created_user_id bigint;
alter table attachments add column created_user_id bigint;
alter table cities add column created_user_id bigint;
alter table collections add column created_user_id bigint;
alter table collections_attachments add column created_user_id bigint;
alter table collections_fund_accounts add column created_user_id bigint;
alter table contacts add column created_user_id bigint;
alter table contacts_expenses add column created_user_id bigint;
alter table countries add column created_user_id bigint;
alter table documents add column created_user_id bigint;
alter table expenses add column created_user_id bigint;
alter table expenses_taxes add column created_user_id bigint;
alter table fund_accounts add column created_user_id bigint;
alter table payments add column created_user_id bigint;
alter table payments_attachments add column created_user_id bigint;
alter table payments_fund_accounts add column created_user_id bigint;
alter table purchases add column created_user_id bigint;
alter table purchases_advances add column created_user_id bigint;
alter table purchases_attachments add column created_user_id bigint;
alter table purchases_expenses add column created_user_id bigint;
alter table purchases_expenses_prices add column created_user_id bigint;
alter table purchases_files add column created_user_id bigint;
alter table purchases_fund_accounts add column created_user_id bigint;
alter table purchaseS_payments add column created_user_id bigint;
alter table sales add column created_user_id bigint;
alter table sales_attachments add column created_user_id bigint;
alter table sales_collections add column created_user_id bigint;
alter table sales_expenses add column created_user_id bigint;
alter table sales_expenses_prices add column created_user_id bigint;
alter table sales_fund_accounts add column created_user_id bigint;
alter table taxes add column created_user_id bigint;
alter table tickets add column created_user_id bigint;
alter table users add column created_user_id bigint;
alter table users_assigned_users add column created_user_id bigint;
alter table accounts add column created_user_id bigint;

ALTER TABLE users_assigned_users
  ADD CONSTRAINT user_master_assigned UNIQUE (assigned_user_id, master_user_id);

ALTER TABLE users_assigned_users
   ALTER COLUMN assigned_user_id SET NOT NULL;
ALTER TABLE users_assigned_users
   ALTER COLUMN master_user_id SET NOT NULL;