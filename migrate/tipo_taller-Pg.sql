CREATE TABLE IF NOT EXISTS public.tipo_taller (
    id bigint PRIMARY KEY NOT NULL,
    name_training_type character varying(2000),
    nombre_taller character varying(2000),
    descripcion_taller character varying(2000),
    duracion_horas character varying(20),
    nivel character varying(50),
    modalidad character varying(50),
    permisos character varying(2000),
    CONSTRAINT fk_tipotaller_to_name_training_type FOREIGN KEY (name_training_type) REFERENCES public.training_type(name_training_type) ON UPDATE CASCADE
);
ALTER TABLE public.tipo_taller OWNER TO lanubede;

CREATE SEQUENCE IF NOT EXISTS public.tipo_taller_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER TABLE public.tipo_taller_id_seq OWNER TO lanubede;
ALTER SEQUENCE public.tipo_taller_id_seq OWNED BY public.tipo_taller.id;

ALTER TABLE ONLY public.tipo_taller ALTER COLUMN id SET DEFAULT nextval('public.tipo_taller_id_seq'::regclass);



-- ALTER TABLE products_list
-- ADD CONSTRAINT fk_products_list
-- FOREIGN KEY (strategic_action_id)
-- REFERENCES specific_action(id)
-- ON DELETE SET NULL;


-- INSERT INTO public.gerencias(user_name) VALUES('User Demo'); 