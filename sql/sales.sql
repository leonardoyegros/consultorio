-- Function: sales_after()

-- DROP FUNCTION sales_after();

CREATE OR REPLACE FUNCTION sales_after()
  RETURNS trigger AS
$BODY$
DECLARE	
	TR RECORD;
	SALE RECORD;
	--PRICE NUMERIC;
BEGIN
	IF (TG_OP='DELETE') THEN
		TR := OLD;
	ELSE
		TR := NEW;
	END IF;

	IF (TG_OP = 'INSERT') THEN

		IF(TR.payment_term = 'cash') THEN
			RAISE NOTICE 'VENTA A CREDIO';
			UPDATE sales SET paid = TR.amount where sales.id = TR.id;
		ELSE
			RAISE NOTICE 'VENTA A CREDIO';
			UPDATE sales SET paid = (select sum(amount) from sales_collections where sale_id = TR.id);
		
		END IF;
	END IF;

	RETURN TR;
END
$BODY$
  LANGUAGE plpgsql;
ALTER FUNCTION sales_after()
  OWNER TO postgres;

UPDATE sales set id = id;