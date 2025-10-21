
CREATE TABLE public.final_users (
    id integer NOT NULL,
    user_type character varying(50),
    user_id integer DEFAULT 0,
    user_nombres character varying(50),
    user_nombre_2 character varying(50),
    user_apellidos character varying(50),
    user_apellido_2 character varying(50),
    user_nationality character varying(50),
    user_has_document character varying(50),
    user_dni character varying(50),
    parent_dni character varying(50),
    child_number integer,
    parent_ref character varying(50),
    user_correo character varying(50),
    user_telefono character varying(50),
    user_genero character varying(50),
    user_comunity_type character varying(50),
    user_etnia character varying(200),
    disability_type character varying(50),
    user_f_nacimiento date,
    user_edad character varying(50),
    user_nivel_academ character varying(200),
    user_profesion character varying(200),
    user_ocupacion character varying(200),
    user_empleado character varying(200),
    user_institucion character varying(200),
    user_organizacion character varying(200),
    user_pertenece_organizacion character varying(20),
    user_estado character varying(200),
    user_municipio character varying(200),
    user_direccion character varying(200),
    red_x character varying(200),
    red_facebook character varying(200),
    red_instagram character varying(200),
    red_linkedin character varying(200),
    red_youtube character varying(200),
    red_tiktok character varying(200),
    red_whatsapp character varying(200),
    red_telegram character varying(200),
    red_snapchat character varying(200),
    red_pinterest character varying(200),
    user_fecha_reg timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.final_users OWNER TO lanubede;

--
-- Name: final_users_id_seq; Type: SEQUENCE; Schema: public; Owner: lanubede
--

ALTER TABLE public.final_users ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.final_users_id_seq
    START WITH 118253
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: infocentros; Type: TABLE; Schema: public; Owner: lanubede
--

CREATE TABLE public.infocentros (
    id integer NOT NULL,
    region_tipo character varying(200),
    cod character varying(50),
    nombre character varying(200),
    estatus character varying(200),
    abierto_en_pandemia character varying(200),
    motivo_cierre character varying(200),
    motivo_cierre_def character varying(200),
    direccion character varying(200),
    ciudad character varying(200),
    estado character varying(200),
    municipio character varying(200),
    parroquia character varying(200),
    n_circuito character varying(200),
    tecno_internet character varying(200),
    proveedor character varying(200),
    perso_contacto character varying(200),
    telef_contacto character varying(50),
    f_instalacion character varying(50),
    f_inauguracion character varying(200),
    creacion_year character varying(50),
    estatus_op character varying(200),
    estatus_falla character varying(200),
    n_reporte character varying(200),
    pc_wifi character varying(200),
    router_wifi character varying(200),
    antena_wifi character varying(200),
    ancho_banda_bajada character varying(200),
    ancho_banda_subida character varying(200),
    mac_pc character varying(200),
    rango_ip character varying(200),
    facili_s_coord character varying(200),
    obs_facilitador character varying(200),
    transferido character varying(200),
    central_dlci character varying(200),
    migrado character varying(200),
    fact_aba character varying(200),
    estatus_migracion character varying(200),
    fecha_migracion character varying(200),
    espacio_inst character varying(200),
    ofensiva_fase_i character varying(200),
    ofensiva_fase_ii character varying(200),
    ofensiva_fase_iii character varying(200),
    ofensiva_fase_iv character varying(200),
    ofensiva_fase_v character varying(200),
    avance_ofensiva character varying(200),
    financiamiento_ofensiva character varying(200),
    grupos_etnicos character varying(500),
    tipo_zona character varying(200),
    municipio_fronterizo character varying(50),
    limite_fronterizo character varying(50),
    latitud character varying(200),
    longitud character varying(200),
    observacion character varying(1500),
    observacion_tecnica character varying(1500),
    cod_gerencia character varying(200) DEFAULT '0'::character varying,
    f_registro timestamp with time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.infocentros OWNER TO lanubede;

--
-- Name: infocentros_id_seq; Type: SEQUENCE; Schema: public; Owner: lanubede
--

ALTER TABLE public.infocentros ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.infocentros_id_seq
    START WITH 1059
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: participants_list; Type: TABLE; Schema: public; Owner: lanubede
--

CREATE TABLE public.participants_list (
    id integer NOT NULL,
    id_user_final character varying(50) DEFAULT ''::character varying,
    uid_fac character varying(50) DEFAULT ''::character varying,
    id_activity integer NOT NULL,
    line_action character varying(200),
    report_type character varying(200),
    name_activity character varying(500) NOT NULL,
    date_activity character varying(50) NOT NULL,
    estate character varying(200),
    info_id integer,
    code_info character varying(50),
    name character varying(200) NOT NULL,
    name_2 character varying(50) DEFAULT ''::character varying,
    lastname character varying(50) DEFAULT ''::character varying,
    lastname_2 character varying(50) DEFAULT ''::character varying,
    user_nationality character varying(50) DEFAULT ''::character varying,
    user_has_document character varying(50) DEFAULT ''::character varying,
    document_id character varying(50) NOT NULL,
    parent_dni character varying(50) DEFAULT 'No aplica'::character varying,
    child_number integer,
    parent_ref character varying(50) DEFAULT 'No aplica'::character varying,
    user_f_nacimiento date,
    age integer NOT NULL,
    gender character varying(50) NOT NULL,
    user_comunity_type character varying(500) DEFAULT 'N/A'::character varying,
    user_pertenece_organizacion character varying(500) DEFAULT 'N/A'::character varying,
    phone character varying(50),
    email character varying(100),
    etnia character varying(200),
    disability_type character varying(200),
    date_reg timestamp with time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.participants_list OWNER TO lanubede;

--
-- Name: participants_list_id_seq; Type: SEQUENCE; Schema: public; Owner: lanubede
--

ALTER TABLE public.participants_list ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.participants_list_id_seq
    START WITH 550408
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: products_list; Type: TABLE; Schema: public; Owner: lanubede
--

CREATE TABLE public.products_list (
    id integer NOT NULL,
    id_activity integer NOT NULL,
    estate character varying(200),
    info_id integer,
    code_info character varying(50),
    activity_title character varying(500) NOT NULL,
    action_performed character varying(2000) NOT NULL,
    date character varying(50) NOT NULL,
    format character varying(200),
    format_detail character varying(1000),
    quantity_created integer NOT NULL,
    quantity_published integer NOT NULL,
    web_link character varying(10000),
    date_reg timestamp with time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.products_list OWNER TO lanubede;

--
-- Name: products_list_id_seq; Type: SEQUENCE; Schema: public; Owner: lanubede
--

ALTER TABLE public.products_list ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.products_list_id_seq
    START WITH 133296
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: reports; Type: TABLE; Schema: public; Owner: lanubede
--

CREATE TABLE public.reports (
    id integer NOT NULL,
    info_id integer,
    is_active boolean DEFAULT true,
    status_activity boolean DEFAULT true,
    code_info character varying(50) NOT NULL,
    user_id character varying(50),
    line_action character varying(200) NOT NULL,
    report_type character varying(200),
    specific_action character varying(500) DEFAULT ''::character varying,
    training_type character varying(500) DEFAULT ''::character varying,
    training_level character varying(500) DEFAULT ''::character varying,
    estate character varying(50) NOT NULL,
    municipality character varying(50) NOT NULL,
    parish character varying(50) NOT NULL,
    city character varying(50),
    address character varying(500),
    activity_title character varying(500) NOT NULL,
    date_pub text NOT NULL,
    date_ini date NOT NULL,
    date_end date NOT NULL,
    hour_activity character varying(50),
    developed_content character varying(2000),
    training_modality character varying(200),
    duration_days character varying(50),
    duration_hour character varying(50),
    person_fe integer,
    person_ma integer,
    responsible_name character varying(200),
    responsible_phone character varying(50),
    responsible_type character varying(50),
    responsible_dni character varying(100) NOT NULL,
    responsible_email character varying(100) NOT NULL,
    personal_type character varying(50),
    organized_by_info character varying(50),
    institutions character varying(200),
    name_os character varying(50),
    observations character varying(500),
    notific text,
    image character varying(1000),
    file character varying(500),
    datetime timestamp with time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    total_products integer DEFAULT 0
);


ALTER TABLE public.reports OWNER TO lanubede;

--
-- Name: reports_id_seq; Type: SEQUENCE; Schema: public; Owner: lanubede
--

ALTER TABLE public.reports ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.reports_id_seq
    START WITH 150321
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: services_users; Type: TABLE; Schema: public; Owner: lanubede
--

CREATE TABLE public.services_users (
    id bigint NOT NULL,
    user_id character varying(50) NOT NULL,
    info_id integer,
    user_info_cod character varying(50) NOT NULL,
    user_nombres character varying(50) NOT NULL,
    user_apellidos character varying(50) NOT NULL,
    user_dni character varying(50) NOT NULL,
    user_correo character varying(50),
    user_telefono character varying(50),
    user_genero character varying(50),
    user_comunity_type character varying(500) DEFAULT 'N/A'::character varying,
    user_pertenece_organizacion character varying(500) DEFAULT 'N/A'::character varying,
    disability_type character varying(100),
    user_etnia character varying(100) NOT NULL,
    user_f_nacimiento date,
    user_edad character varying(200),
    user_nivel_academ character varying(200),
    user_profesion character varying(200),
    user_ocupacion character varying(500) DEFAULT ''::character varying,
    user_empleado character varying(200),
    user_institucion character varying(200),
    user_estado character varying(200),
    user_municipio character varying(200),
    user_direccion character varying(200),
    user_tipo_servicio character varying(200),
    user_fecha_servicio date,
    user_name_os character varying(200),
    user_fecha_reg timestamp with time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.services_users OWNER TO lanubede;

--
-- Name: services_users_id_seq; Type: SEQUENCE; Schema: public; Owner: lanubede
--

CREATE SEQUENCE public.services_users_id_seq
    START WITH 204821
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.services_users_id_seq OWNER TO lanubede;

--
-- Name: services_users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: lanubede
--

ALTER SEQUENCE public.services_users_id_seq OWNED BY public.services_users.id;


--
-- Name: user_session; Type: TABLE; Schema: public; Owner: lanubede
--

CREATE TABLE public.user_session (
    id bigint NOT NULL,
    user_id integer,
    user_name character varying(100),
    session_id character varying(100),
    ip character varying(100),
    fecha_reg timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    active integer DEFAULT 0,
    region character(50)
);


ALTER TABLE public.user_session OWNER TO lanubede;

--
-- Name: user_session_id_seq; Type: SEQUENCE; Schema: public; Owner: lanubede
--

CREATE SEQUENCE public.user_session_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_session_id_seq OWNER TO lanubede;

--
-- Name: user_session_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: lanubede
--

ALTER SEQUENCE public.user_session_id_seq OWNED BY public.user_session.id;


--
-- Name: services_users id; Type: DEFAULT; Schema: public; Owner: lanubede
--

ALTER TABLE ONLY public.services_users ALTER COLUMN id SET DEFAULT nextval('public.services_users_id_seq'::regclass);


--
-- Name: user_session id; Type: DEFAULT; Schema: public; Owner: lanubede
--

ALTER TABLE ONLY public.user_session ALTER COLUMN id SET DEFAULT nextval('public.user_session_id_seq'::regclass);


--
-- Name: final_users final_users_pkey; Type: CONSTRAINT; Schema: public; Owner: lanubede
--

ALTER TABLE ONLY public.final_users
    ADD CONSTRAINT final_users_pkey PRIMARY KEY (id);


--
-- Name: infocentros infocentros_pkey; Type: CONSTRAINT; Schema: public; Owner: lanubede
--

ALTER TABLE ONLY public.infocentros
    ADD CONSTRAINT infocentros_pkey PRIMARY KEY (id);


--
-- Name: participants_list participants_list_pkey; Type: CONSTRAINT; Schema: public; Owner: lanubede
--

ALTER TABLE ONLY public.participants_list
    ADD CONSTRAINT participants_list_pkey PRIMARY KEY (id);


--
-- Name: products_list products_list_pkey; Type: CONSTRAINT; Schema: public; Owner: lanubede
--

ALTER TABLE ONLY public.products_list
    ADD CONSTRAINT products_list_pkey PRIMARY KEY (id);


--
-- Name: reports reports_pkey; Type: CONSTRAINT; Schema: public; Owner: lanubede
--

ALTER TABLE ONLY public.reports
    ADD CONSTRAINT reports_pkey PRIMARY KEY (id);


--
-- Name: idx_20601_primary; Type: INDEX; Schema: public; Owner: lanubede
--

CREATE UNIQUE INDEX idx_20601_primary ON public.reports USING btree (id);


--
-- Name: TABLE final_users; Type: ACL; Schema: public; Owner: lanubede
--

REVOKE ALL ON TABLE public.final_users FROM lanubede;
GRANT ALL ON TABLE public.final_users TO lanubede WITH GRANT OPTION;


--
-- Name: TABLE infocentros; Type: ACL; Schema: public; Owner: lanubede
--

REVOKE ALL ON TABLE public.infocentros FROM lanubede;
GRANT ALL ON TABLE public.infocentros TO lanubede WITH GRANT OPTION;




--
-- Name: TABLE participants_list; Type: ACL; Schema: public; Owner: lanubede
--

REVOKE ALL ON TABLE public.participants_list FROM lanubede;
GRANT ALL ON TABLE public.participants_list TO lanubede WITH GRANT OPTION;




--
-- Name: TABLE products_list; Type: ACL; Schema: public; Owner: lanubede
--

REVOKE ALL ON TABLE public.products_list FROM lanubede;
GRANT ALL ON TABLE public.products_list TO lanubede WITH GRANT OPTION;


--
-- Name: SEQUENCE products_list_id_seq; Type: ACL; Schema: public; Owner: lanubede
--





--
-- PostgreSQL database dump complete
--

