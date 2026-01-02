CREATE TABLE IF NOT EXISTS public.users (
    id bigint PRIMARY KEY NOT NULL,
    username character varying(100),
    name character varying(200),
    lastname character varying(200),
    user_dni character varying(200),
    email character varying(200),
    password character varying(200),
    is_active SMALLINT DEFAULT 1,
    user_type integer DEFAULT 1,
    gender character varying(200),
    code_info character varying(200),
    is_organization character varying(200) DEFAULT '0',
    organization_name character varying(200) DEFAULT 'N/A',
    region character varying(200),
    rol character varying(200),
    update_by character varying(200),
    created_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    update_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP

);
ALTER TABLE public.users OWNER TO lanubede;

CREATE SEQUENCE IF NOT EXISTS public.users_id_seq START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;
ALTER TABLE public.users_id_seq OWNER TO lanubede;
ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);

-- INSERT INTO public.users(user_name) VALUES('User Demo');