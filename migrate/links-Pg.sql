CREATE TABLE IF NOT EXISTS public.links (
    id bigint PRIMARY KEY NOT NULL,
    products_list_id int4 NULL,
    social_medias_id int4 NULL,
    activity_id int4 NULL,
    link character varying(300),
    CONSTRAINT fk_products_list FOREIGN KEY(products_list_id) REFERENCES products_list(id) ON DELETE CASCADE,
    CONSTRAINT fk_social_medias FOREIGN KEY(social_medias_id) REFERENCES social_medias(id) ON DELETE CASCADE,
    CONSTRAINT fk_activity FOREIGN KEY(activity_id) REFERENCES reports(id) ON DELETE CASCADE

);
ALTER TABLE public.links OWNER TO lanubede;

CREATE SEQUENCE IF NOT EXISTS public.links_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER TABLE public.links_id_seq OWNER TO lanubede;
ALTER SEQUENCE public.links_id_seq OWNED BY public.links.id;

ALTER TABLE ONLY public.links ALTER COLUMN id SET DEFAULT nextval('public.links_id_seq'::regclass);

ALTER TABLE products_list DROP COLUMN social_medias_id;
