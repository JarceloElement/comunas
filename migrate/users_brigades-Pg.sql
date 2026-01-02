CREATE TABLE IF NOT EXISTS public.user_brigades (
    id bigint PRIMARY KEY NOT NULL,
    fk_id_user integer,
    fk_id_brigade integer,
    parroquia character varying(300),
    ciudad character varying(300),
    comunidad character varying(300),
    datetime timestamptz DEFAULT CURRENT_TIMESTAMP NOT NULL,
    CONSTRAINT fk_user FOREIGN KEY(fk_id_user) REFERENCES final_users(id) ON DELETE CASCADE,
    CONSTRAINT fk_brigade FOREIGN KEY(fk_id_brigade) REFERENCES brigades(id) ON DELETE CASCADE
);

ALTER TABLE public.user_brigades OWNER TO lanubede;
CREATE SEQUENCE IF NOT EXISTS public.user_brigades_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER TABLE public.user_brigades_id_seq OWNER TO lanubede;
ALTER SEQUENCE public.user_brigades_id_seq OWNED BY public.user_brigades.id;
ALTER TABLE ONLY public.user_brigades ALTER COLUMN id SET DEFAULT nextval('public.user_brigades_id_seq'::regclass);

-- INSERT INTO public.user_brigades(user_name) VALUES('User Demo');