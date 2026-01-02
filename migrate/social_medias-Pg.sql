CREATE TABLE IF NOT EXISTS public.social_medias (
    id bigint PRIMARY KEY NOT NULL,
    nombre character varying(100)
);
ALTER TABLE public.social_medias OWNER TO lanubede;

CREATE SEQUENCE IF NOT EXISTS public.social_medias_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER TABLE public.social_medias_id_seq OWNER TO lanubede;
ALTER SEQUENCE public.social_medias_id_seq OWNED BY public.social_medias.id;

ALTER TABLE ONLY public.social_medias ALTER COLUMN id SET DEFAULT nextval('public.social_medias_id_seq'::regclass);

ALTER TABLE products_list
ADD social_medias_id int4 NULL;

ALTER TABLE products_list
ADD CONSTRAINT fk_products_list
FOREIGN KEY (social_medias_id)
REFERENCES social_medias(id)
ON DELETE SET NULL;
-- INSERT INTO public.gerencias(user_name) VALUES('User Demo'); 