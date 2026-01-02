CREATE TABLE IF NOT EXISTS public.facilitators (
    id bigint PRIMARY KEY NOT NULL,
    f_state character varying(100),
    municipality character varying(200),
    parish character varying(200),
    f_name character varying(200),
    f_lastname character varying(200),
    document_number character varying(200),
    phone_number character varying(200),
    email character varying(200),
    gender character varying(200),
    birthdate character varying(200),
    date_admission character varying(200),
    info_cod character varying(200),
    status_nom character varying(200),
    personal_type character varying(200),
    observations character varying(200),
    date_reg timestamp with time zone DEFAULT CURRENT_TIMESTAMP
);
ALTER TABLE public.facilitators OWNER TO lanubede;

CREATE SEQUENCE IF NOT EXISTS public.facilitators_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER TABLE public.facilitators_id_seq OWNER TO lanubede;
ALTER SEQUENCE public.facilitators_id_seq OWNED BY public.facilitators.id;

ALTER TABLE ONLY public.facilitators ALTER COLUMN id SET DEFAULT nextval('public.facilitators_id_seq'::regclass);

-- INSERT INTO public.facilitators(user_name) VALUES('User Demo');