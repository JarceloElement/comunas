CREATE TABLE IF NOT EXISTS public.certificados (
    id bigint PRIMARY KEY NOT NULL,
    usuario_id bigint,
    curso_cod character varying(200),
    codigo_unico_cert character varying(200),
    fecha_emision timestamp with time zone,
    update_by character varying(200),
    created_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    update_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_usuario_id FOREIGN KEY (usuario_id) REFERENCES public.final_users(id) ON UPDATE CASCADE,
    CONSTRAINT fk_curso_cod FOREIGN KEY (curso_cod) REFERENCES public.training_type(codigo_curso) ON UPDATE CASCADE

);
ALTER TABLE public.certificados OWNER TO lanubepl_managercomunas;

CREATE SEQUENCE IF NOT EXISTS public.certificados_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER TABLE public.certificados_id_seq OWNER TO lanubepl_managercomunas;
ALTER SEQUENCE public.certificados_id_seq OWNED BY public.certificados.id;

ALTER TABLE ONLY public.certificados ALTER COLUMN id SET DEFAULT nextval('public.certificados_id_seq'::regclass);

-- INSERT INTO public.certificados(user_name) VALUES('User Demo');