CREATE TABLE IF NOT EXISTS public.brigades (
    id bigint PRIMARY KEY NOT NULL,
    nombre character varying(300),
    estado character varying(300),
    info_id character varying(300),
    info_cod character varying(300),
    datetime timestamptz DEFAULT CURRENT_TIMESTAMP NOT NULL
);

ALTER TABLE public.brigades OWNER TO lanubede;
CREATE SEQUENCE IF NOT EXISTS public.brigades_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER TABLE public.brigades_id_seq OWNER TO lanubede;
ALTER SEQUENCE public.brigades_id_seq OWNED BY public.brigades.id;
ALTER TABLE ONLY public.brigades ALTER COLUMN id SET DEFAULT nextval('public.brigades_id_seq'::regclass);

-- INSERT INTO public.brigades(user_name) VALUES('User Demo');