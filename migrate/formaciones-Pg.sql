CREATE TABLE IF NOT EXISTS public.formaciones (
    id bigint PRIMARY KEY NOT NULL,
    usuario_id bigint,
    taller_id bigint,
    completado character varying(200),
    fecha_completado timestamp with time zone,
    update_by character varying(200),
    created_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    update_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_taller_id FOREIGN KEY (taller_id) REFERENCES public.tipo_taller(id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_usuario_id FOREIGN KEY (usuario_id) REFERENCES public.final_users(id) ON UPDATE CASCADE

);
ALTER TABLE public.formaciones OWNER TO lanubepl_managercomunas;

CREATE SEQUENCE IF NOT EXISTS public.formaciones_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER TABLE public.formaciones_id_seq OWNER TO lanubepl_managercomunas;
ALTER SEQUENCE public.formaciones_id_seq OWNED BY public.formaciones.id;

ALTER TABLE ONLY public.formaciones ALTER COLUMN id SET DEFAULT nextval('public.formaciones_id_seq'::regclass);

-- INSERT INTO public.formaciones(user_name) VALUES('User Demo');