CREATE TABLE IF NOT EXISTS public.strategic_action (
    id bigint PRIMARY KEY NOT NULL,
    line_id bigint,
    line_action character varying(2000) ,
    name_action character varying(2000) UNIQUE,
    permisos character varying(2000),
    CONSTRAINT fk_strategic_action_line FOREIGN KEY (line_id) REFERENCES public.actions_line(line_id) ON DELETE CASCADE,
    CONSTRAINT fk_line_actionn FOREIGN KEY (line_action) REFERENCES public.actions_line(line_name) ON UPDATE CASCADE
);
ALTER TABLE public.strategic_action OWNER TO lanubede;

CREATE SEQUENCE IF NOT EXISTS public.strategic_action_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER TABLE public.strategic_action_id_seq OWNER TO lanubede;
ALTER SEQUENCE public.strategic_action_id_seq OWNED BY public.strategic_action.id;

ALTER TABLE ONLY public.strategic_action ALTER COLUMN id SET DEFAULT nextval('public.strategic_action_id_seq'::regclass);

-- CREATE UNIQUE INDEX IF NOT EXISTS idx_name_action ON public.specific_action(name_action);



-- INSERT INTO public.gerencias(user_name) VALUES('User Demo'); 