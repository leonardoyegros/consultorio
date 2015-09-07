alter table collections add column notes character varying;
ALTER TABLE collections ADD COLUMN currency_price numeric;
ALTER TABLE collections_fund_accounts ADD COLUMN currency_price numeric;

CREATE OR REPLACE FUNCTION sales_collections_after() RETURNS trigger AS
$BODY$Declare
	TR RECORD;
begin
	if(TG_OP='DELETE') then 
		TR=OLD;
	ELSE
		TR=NEW;
	END IF;

	IF (TG_OP = 'UPDATE' OR TG_OP = 'INSERT') THEN
		UPDATE sales SET paid = (SELECT SUM(sales_collections.amount) FROM  sales_collections  WHERE sales_collections.sale_id =  sales.id);
	END IF;

	return TR;
end;
$BODY$
LANGUAGE plpgsql VOLATILE NOT LEAKPROOF
COST 100;

CREATE TRIGGER sales_collections_after AFTER INSERT OR UPDATE OR DELETE
   ON sales_collections FOR EACH ROW
   EXECUTE PROCEDURE public.sales_collections_after();

CREATE OR REPLACE FUNCTION collections_after() RETURNS trigger AS
$BODY$Declare
	TR RECORD;
begin
	if(TG_OP='DELETE') then 
		TR=OLD;
	ELSE
		TR=NEW;
	END IF;
	UPDATE sales_collections SET id = id WHERE sales_collections.collection_id = TR.id;
	return TR;
end;
$BODY$
LANGUAGE plpgsql VOLATILE NOT LEAKPROOF
COST 100;
