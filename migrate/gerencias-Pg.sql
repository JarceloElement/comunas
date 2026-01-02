CREATE TABLE IF NOT EXISTS public.gerencias (
    id bigint PRIMARY KEY NOT NULL,
    f_state character varying(100),
    municipality character varying(200),
    parish character varying(200),
    info_cod character varying(200),
    document_number character varying(200),
    f_name character varying(200),
    f_lastname character varying(200),
    gender character varying(200),
    phone_number character varying(200),
    email character varying(200),
    birthdate character varying(200),
    date_admission character varying(200),
    coordination character varying(200),
    status_nom character varying(200),
    personal_type character varying(200),
    gerencia_tipo character varying(200),
    pcta character varying(200),
    fecha_tentativa character varying(200),
    cargo character varying(200),
    nivel_academico character varying(200),
    prima_profesional character varying(200),
    estatus character varying(200),
    observations character varying(200),
    date_reg timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    date_update timestamp with time zone DEFAULT CURRENT_TIMESTAMP

);
ALTER TABLE public.gerencias OWNER TO lanubede;

CREATE SEQUENCE IF NOT EXISTS public.gerencias_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER TABLE public.gerencias_id_seq OWNER TO lanubede;
ALTER SEQUENCE public.gerencias_id_seq OWNED BY public.gerencias.id;

ALTER TABLE ONLY public.gerencias ALTER COLUMN id SET DEFAULT nextval('public.gerencias_id_seq'::regclass);

-- INSERT INTO public.gerencias(user_name) VALUES('User Demo');