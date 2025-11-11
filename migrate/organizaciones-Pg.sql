CREATE TABLE IF NOT EXISTS public.organizaciones (
    id bigint PRIMARY KEY NOT NULL,
    code_info character varying(100),
    codigo_organizacion character varying(200),
    nombre_organizacion character varying(200),
    dni_responsable character varying(200),
    email_responsable character varying(200),
    nombre_responsable character varying(200),
    apellido_responsable character varying(200),
    genero_responsable character varying(200),
    telefono_responsable character varying(50),
    rol_responsable character varying(200),
    estado_organizacion character varying(100),
    municipio_organizacion character varying(100),
    parroquia_organizacion character varying(100),
    update_by character varying(200),
    created_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    update_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP

);
ALTER TABLE public.organizaciones OWNER TO lanubepl_managercomunas;

CREATE SEQUENCE IF NOT EXISTS public.organizaciones_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER TABLE public.organizaciones_id_seq OWNER TO lanubepl_managercomunas;
ALTER SEQUENCE public.organizaciones_id_seq OWNED BY public.organizaciones.id;

ALTER TABLE ONLY public.organizaciones ALTER COLUMN id SET DEFAULT nextval('public.organizaciones_id_seq'::regclass);

-- INSERT INTO public.organizaciones(user_name) VALUES('User Demo');