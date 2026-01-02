CREATE TABLE IF NOT EXISTS public.actions_line (
    line_id bigint PRIMARY KEY NOT NULL,
    line_name character varying(1000) UNIQUE,
    permisos character varying(2000)
);
ALTER TABLE public.actions_line OWNER TO lanubede;

CREATE SEQUENCE IF NOT EXISTS public.actions_line_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER TABLE public.actions_line_id_seq OWNER TO lanubede;
ALTER SEQUENCE public.actions_line_id_seq OWNED BY public.actions_line.line_id;

ALTER TABLE ONLY public.actions_line ALTER COLUMN line_id SET DEFAULT nextval('public.actions_line_id_seq'::regclass);

-- ALTER TABLE products_list
-- ADD CONSTRAINT fk_products_list
-- FOREIGN KEY (actions_line_id)
-- REFERENCES actions_line(id)
-- ON DELETE SET NULL;


-- INSERT INTO public.gerencias(user_name) VALUES('User Demo'); 