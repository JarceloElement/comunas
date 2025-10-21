CREATE TABLE IF NOT EXISTS public.training_type (
    id bigint PRIMARY KEY NOT NULL,
    name_line_action character varying(2000),
    name_strategic_action character varying(2000),
    name_specific_action character varying(2000),
    name_training_type character varying(2000) UNIQUE,
    duracion_horas character varying(20),
    nivel_curso character varying(50),
    modalidad_curso character varying(50),
    ejes_actuacion character varying(200),
    tipo_certificacion character varying(200),
    contenido_curso character varying(200),
    descripcion_actividad character varying(200),
    habilitar_descripcion INTEGER DEFAULT 0,
    habilitar_institucion INTEGER DEFAULT 0,
    codigo_curso character varying(20),
    restringir_categoria character varying(2000),
    CONSTRAINT fk_training_to_name_line_action FOREIGN KEY (name_line_action) REFERENCES public.actions_line(line_name) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_training_to_name_strategic_action FOREIGN KEY (name_strategic_action) REFERENCES public.strategic_action(name_action) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_training_to_name_specific_action FOREIGN KEY (name_specific_action) REFERENCES public.specific_action(name_specific_action) ON UPDATE CASCADE ON DELETE CASCADE
);
ALTER TABLE public.training_type OWNER TO lanubede;

CREATE SEQUENCE IF NOT EXISTS public.training_type_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER TABLE public.training_type_id_seq OWNER TO lanubede;
ALTER SEQUENCE public.training_type_id_seq OWNED BY public.training_type.id;

ALTER TABLE ONLY public.training_type ALTER COLUMN id SET DEFAULT nextval('public.training_type_id_seq'::regclass);



-- ALTER TABLE products_list
-- ADD CONSTRAINT fk_products_list
-- FOREIGN KEY (strategic_action_id)
-- REFERENCES specific_action(id)
-- ON DELETE SET NULL;


-- INSERT INTO public.gerencias(user_name) VALUES('User Demo'); 