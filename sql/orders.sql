--
-- Create public.order table for the Order Model
--
CREATE TABLE public.orders (
	id bigint NOT NULL DEFAULT nextval('orders_id_seq'::regclass),
	lastname character varying NOT NULL,
	firstname character varying NOT NULL,
	email character varying NOT NULL,
	brand character varying NOT NULL,
	model character varying  NOT NULL,
	gearbox character varying,
	color character varying,
	options json,
	return_price numeric(9,0),
	total_price numeric(9,0),
	date time with time zone DEFAULT now(),
	CONSTRAINT orders_pkey PRIMARY KEY (id)
);
--
-- Create public.orders_id_seq sequence for the id
--
CREATE SEQUENCE public.orders_id_seq
	START WITH 1
	INCREMENT BY 1
	NO MINVALUE
	NO MAXVALUE
	CACHE 1
	CYCLE;
