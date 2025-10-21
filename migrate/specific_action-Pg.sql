CREATE TABLE IF NOT EXISTS public.specific_action (
    id bigint PRIMARY KEY NOT NULL,
    k_strategic bigint,
    name_line_action character varying(2000),
    name_strategic character varying(2000),
    name_specific_action character varying(2000) UNIQUE,
    activity_description character varying(2000),
    has_formation character varying(50),
    permisos character varying(2000),
    CONSTRAINT fk_k_strategic FOREIGN KEY (k_strategic) REFERENCES public.strategic_action(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_name_strategic FOREIGN KEY (name_strategic) REFERENCES public.strategic_action(name_action) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_name_line_action FOREIGN KEY (name_line_action) REFERENCES public.actions_line(line_name) ON UPDATE CASCADE ON DELETE CASCADE
);
ALTER TABLE public.specific_action OWNER TO lanubede;

CREATE SEQUENCE IF NOT EXISTS public.specific_action_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER TABLE public.specific_action_id_seq OWNER TO lanubede;
ALTER SEQUENCE public.specific_action_id_seq OWNED BY public.specific_action.id;

ALTER TABLE ONLY public.specific_action ALTER COLUMN id SET DEFAULT nextval('public.specific_action_id_seq'::regclass);



-- ALTER TABLE products_list
-- ADD CONSTRAINT fk_products_list
-- FOREIGN KEY (strategic_action_id)
-- REFERENCES specific_action(id)
-- ON DELETE SET NULL;


-- INSERT INTO public.gerencias(user_name) VALUES('User Demo'); 