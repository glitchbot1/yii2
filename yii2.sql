--
-- PostgreSQL database dump
--

-- Dumped from database version 9.4.15
-- Dumped by pg_dump version 9.4.15
-- Started on 2018-11-23 23:10:58

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 2058 (class 1262 OID 24636)
-- Name: yii2; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE yii2 WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Russian_Russia.1251' LC_CTYPE = 'Russian_Russia.1251';


ALTER DATABASE yii2 OWNER TO postgres;

\connect yii2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 1 (class 3079 OID 11855)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2061 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 175 (class 1259 OID 24669)
-- Name: category; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE category (
    id integer NOT NULL,
    title character varying(255)
);


ALTER TABLE category OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 24667)
-- Name: category_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE category_id_seq OWNER TO postgres;

--
-- TOC entry 2062 (class 0 OID 0)
-- Dependencies: 174
-- Name: category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE category_id_seq OWNED BY category.id;


--
-- TOC entry 177 (class 1259 OID 32869)
-- Name: city; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE city (
    id integer NOT NULL,
    city character varying(255)
);


ALTER TABLE city OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 32867)
-- Name: city_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE city_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE city_id_seq OWNER TO postgres;

--
-- TOC entry 2063 (class 0 OID 0)
-- Dependencies: 176
-- Name: city_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE city_id_seq OWNED BY city.id;


--
-- TOC entry 173 (class 1259 OID 24637)
-- Name: migration; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE migration (
    version character varying(180) NOT NULL,
    apply_time integer
);


ALTER TABLE migration OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 41269)
-- Name: post; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE post (
    id integer NOT NULL,
    user_id integer,
    title character varying(255),
    description text,
    date timestamp without time zone,
    price integer,
    category_id integer,
    city_id integer,
    "isActive" boolean DEFAULT true,
    image character varying(255)
);


ALTER TABLE post OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 41267)
-- Name: post_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE post_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE post_id_seq OWNER TO postgres;

--
-- TOC entry 2064 (class 0 OID 0)
-- Dependencies: 182
-- Name: post_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE post_id_seq OWNED BY post.id;


--
-- TOC entry 181 (class 1259 OID 41183)
-- Name: profile; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE profile (
    user_id integer NOT NULL,
    name character varying(255),
    city_id integer,
    phone bigint,
    description text,
    "dateRegistration" timestamp without time zone,
    photo character varying(255)
);


ALTER TABLE profile OWNER TO postgres;

--
-- TOC entry 180 (class 1259 OID 41181)
-- Name: profile_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE profile_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE profile_user_id_seq OWNER TO postgres;

--
-- TOC entry 2065 (class 0 OID 0)
-- Dependencies: 180
-- Name: profile_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE profile_user_id_seq OWNED BY profile.user_id;


--
-- TOC entry 179 (class 1259 OID 32927)
-- Name: user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "user" (
    id integer NOT NULL,
    email character varying(255) DEFAULT NULL::character varying,
    password character varying(255),
    "isAdmin" boolean DEFAULT false
);


ALTER TABLE "user" OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 32925)
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE user_id_seq OWNER TO postgres;

--
-- TOC entry 2066 (class 0 OID 0)
-- Dependencies: 178
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE user_id_seq OWNED BY "user".id;


--
-- TOC entry 1912 (class 2604 OID 24672)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY category ALTER COLUMN id SET DEFAULT nextval('category_id_seq'::regclass);


--
-- TOC entry 1913 (class 2604 OID 32872)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY city ALTER COLUMN id SET DEFAULT nextval('city_id_seq'::regclass);


--
-- TOC entry 1918 (class 2604 OID 41272)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY post ALTER COLUMN id SET DEFAULT nextval('post_id_seq'::regclass);


--
-- TOC entry 1917 (class 2604 OID 41186)
-- Name: user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY profile ALTER COLUMN user_id SET DEFAULT nextval('profile_user_id_seq'::regclass);


--
-- TOC entry 1914 (class 2604 OID 32930)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_id_seq'::regclass);


--
-- TOC entry 2045 (class 0 OID 24669)
-- Dependencies: 175
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO category VALUES (1, 'Автомобили');
INSERT INTO category VALUES (2, 'Недвижимость');
INSERT INTO category VALUES (3, 'Личные вещи');
INSERT INTO category VALUES (4, 'Животные');
INSERT INTO category VALUES (5, 'Бытовая техника');
INSERT INTO category VALUES (6, 'Услуги');


--
-- TOC entry 2067 (class 0 OID 0)
-- Dependencies: 174
-- Name: category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('category_id_seq', 6, true);


--
-- TOC entry 2047 (class 0 OID 32869)
-- Dependencies: 177
-- Data for Name: city; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO city VALUES (1, 'Томск');
INSERT INTO city VALUES (2, 'Новосибирск');
INSERT INTO city VALUES (3, 'Омск');
INSERT INTO city VALUES (4, 'Кемерово');
INSERT INTO city VALUES (5, 'Абакан');
INSERT INTO city VALUES (6, 'Иркутск');
INSERT INTO city VALUES (7, 'Барнаул');


--
-- TOC entry 2068 (class 0 OID 0)
-- Dependencies: 176
-- Name: city_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('city_id_seq', 7, true);


--
-- TOC entry 2043 (class 0 OID 24637)
-- Dependencies: 173
-- Data for Name: migration; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO migration VALUES ('m000000_000000_base', 1541771328);
INSERT INTO migration VALUES ('m181109_125242_create_user_table', 1541771330);
INSERT INTO migration VALUES ('m181109_125253_create_post_table', 1541771330);
INSERT INTO migration VALUES ('m181109_134234_create_category_table', 1541771330);
INSERT INTO migration VALUES ('m181109_142438_create_post_table', 1541773493);
INSERT INTO migration VALUES ('m181111_020852_create_city_table', 1541902267);
INSERT INTO migration VALUES ('m181112_110103_create_user_table', 1542036844);
INSERT INTO migration VALUES ('m181112_110115_create_profile_table', 1542036844);
INSERT INTO migration VALUES ('m181112_160004_create_profile_table', 1542038599);
INSERT INTO migration VALUES ('m181112_161744_create_user_table', 1542039545);
INSERT INTO migration VALUES ('m181112_161948_create_profile_table', 1542039777);
INSERT INTO migration VALUES ('m181112_162611_create_profile_table', 1542040027);
INSERT INTO migration VALUES ('m181114_150841_create_profile_table', 1542208177);
INSERT INTO migration VALUES ('m181114_154040_create_profile_table', 1542210106);
INSERT INTO migration VALUES ('m181116_143236_create_post_table', 1542378815);
INSERT INTO migration VALUES ('m181118_041950_create_post_table', 1542514875);
INSERT INTO migration VALUES ('m181118_041951_create_post_table', 1542516154);
INSERT INTO migration VALUES ('m181118_041952_create_post_table', 1542516920);
INSERT INTO migration VALUES ('m181118_041953_create_post_table', 1542519832);


--
-- TOC entry 2053 (class 0 OID 41269)
-- Dependencies: 183
-- Data for Name: post; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO post VALUES (1, 1, 'Продам котенка', 'Продам красивого белого котенка.', '2018-11-20 18:47:12', 1500, 4, 1, true, '1541257167620.jpg');
INSERT INTO post VALUES (7, 1, 'Продам ноутбук', 'Заряд батареи держит плохо! От сети работает нормально! Комплект ноутбук зарядка и мышь!', '2018-11-23 05:50:10', 4000, 1, 5, true, 'd2133e45.jpg');
INSERT INTO post VALUES (13, 4, 'Продам шапку', 'В отличном состоянии!
Всё находится в Кемерово!', '2018-11-23 06:04:01', 1500, 3, 4, true, 'dpgm0002036b.jpeg');
INSERT INTO post VALUES (14, 9, 'Мастер по установке, ремонту пластиковых окон', 'Установка окон под ключ,регулировка,ремонт,замена фурнитуры и стеклопакета. изготовление и установка москитных сеток.Все вопросы по телефону, на смс не отвечаю', '2018-11-23 18:23:05', 1000, 3, 5, true, '3549923236.jpg');
INSERT INTO post VALUES (15, 9, 'Продам кошечку', 'Породистая', '2018-11-23 18:25:40', 10000, 4, 6, true, '15_main.jpg');
INSERT INTO post VALUES (2, 1, 'Продам квартиру', 'Продам квартиру срочно!', '2018-11-20 18:54:29', 340000000, 2, 1, true, '754909586036514.jpg');
INSERT INTO post VALUES (3, 2, 'Продам стиральную машинку', 'Быстрое освежение слабозагрязненного белья с помощью программы «Супербыстрая 30’/15’».
Превосходный результат за меньшее время: функция SpeedPerfect сокращает продолжительность программы за счет увеличения расхода воды и интенсивности вращения барабана.
Защита от перепадов напряжения и перебоев с электричеством: с системой VoltCheck, программа стирки продолжится автоматически после восстановления электричества.', '2018-11-21 10:37:12', 30000, 5, 4, true, '20036718b.jpg');
INSERT INTO post VALUES (4, 3, 'Продам автомобиль! Срочно', 'Синий,классный автомобиль. Продам недорого, только Барнаул,просьба после 19 не беспокоить', '2018-11-21 10:56:19', 20000000, 1, 7, true, 'audi.jpg');
INSERT INTO post VALUES (5, 4, 'Рублю дерgh', 'На рублю дров за вас всего 300р в час.dfgdfg', '2018-11-21 11:07:44', 500, 6, 1, true, '1510512371082.jpg');
INSERT INTO post VALUES (6, 4, 'Демонтаж любой сложности', 'Демонтируем различные перегородки, стены, дверные проемы, ниши, кафельную плитку и т.д. Утепляем балконы. Мелкосрочный ремонт по электрике. Работаем быстро, качественно, не пьем не курим. Цены адекватные!', '2018-11-21 11:15:40', 1000, 1, 5, true, '4936603391.jpg');
INSERT INTO post VALUES (8, 1, 'Продам часы', 'Новые Часы с керамическом браслетом ,на гарантии . Покупала за 5490,отдам за 3000р. Коробка и пакет оригинальный ) продажа в связи с покупкой часов apple', '2018-11-23 05:52:49', 3000, 1, 1, true, 'f89e0d94764731a5ed2fbb5062e3ff7e.jpeg');
INSERT INTO post VALUES (9, 1, 'Продам часы', 'Часы в хорошем состояние без преувеличений, приобрёл их в августе 2017 года, имеется доп ремешок на 42 мм, коробка , зарядное устройство емеются, не носил на протяжении всего лета и до сегодняшнего дня так как купили новые.', '2018-11-23 05:57:19', 5000, 3, 4, true, 'Часы-2.jpg');
INSERT INTO post VALUES (10, 1, 'Продам автомобиль', 'Автомобиль в хорошем состоянии. «Сел и поехал» на зимних колёсах . Комплектация Спорт. Звоните, отвечу на все вопросы.Автомобиль Японской сборки.', '2018-11-23 05:57:57', 5000000, 1, 1, true, 'RYAAAgJFkOA-960.jpg');
INSERT INTO post VALUES (11, 4, 'Продам кроссовки', 'Продам кроссовки Nike air max (оригинал) в хорошем состоянии, размер 38', '2018-11-23 06:01:15', 4000, 3, 2, true, '1cde0a0c.jpg');
INSERT INTO post VALUES (12, 4, 'Продам куртку', 'Куртка из экокожи, состояние идеальное, цвет непонятный (серый хаки), кожа очень мягкая, рукав и низ куртки на резинке из гофрированной кожи, справа на груди выдавленная надпись. Железный замок до конца капюшона и на карманах. ', '2018-11-23 06:02:20', 12000, 3, 7, true, '1019456312.jpg');
INSERT INTO post VALUES (16, 9, 'Продам автомобиль', 'Продаю мазду в отличном для своих лет состоянии. Мотор коробка без вложений. Мотор масло не ест. Кондиционер заправлен и работает.', '2018-11-23 18:28:51', 50000000, 1, 7, true, 'images.jpg');
INSERT INTO post VALUES (17, 9, 'Продам.', 'Собственная парковка 1000м.кв. ', '2018-11-23 18:32:02', 25500000, 2, 2, true, 'cf0.jpg');
INSERT INTO post VALUES (18, 9, 'Участок 1.2 га.', 'База 1,2 Гектара. Ангар 1000 кВ, небольшой домик на территории, вода, свет. Адрес Ракитная 3. Торг. Обмен.', '2018-11-23 18:33:29', 15000000, 1, 2, true, 'imagessss (1).jpg');
INSERT INTO post VALUES (19, 9, 'Продам квартиру', 'Однокомнатная квартира в 76 позиции. Ремонт будет готов через три дня. Незагороженный домами вид из окон. Налево санузел и кухня, направо комната. ', '2018-11-23 18:35:10', 1790000, 2, 1, true, 'ls3a0918.jpg');
INSERT INTO post VALUES (20, 9, 'Продам кошку', 'Красивая кошечка в добрые руки , возраст около 2 лет, к лотку приучена . Очень ласковая.', '2018-11-23 18:36:58', 17900, 4, 1, true, 'sterilizacia-koshki.jpg');
INSERT INTO post VALUES (21, 9, 'Продам свинку', 'Продам поросят ,находятся они в ст Баклановская', '2018-11-23 18:39:14', 2340, 4, 4, true, '14452883-cute-pig-.jpg');


--
-- TOC entry 2069 (class 0 OID 0)
-- Dependencies: 182
-- Name: post_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('post_id_seq', 24, true);


--
-- TOC entry 2051 (class 0 OID 41183)
-- Dependencies: 181
-- Data for Name: profile; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO profile VALUES (3, 'Анна Витальевна', 1, 3421541335, 'Очень сложно писать о себе) ', '2018-11-20 19:47:12', 'XtlDa6Ij0E0.jpg');
INSERT INTO profile VALUES (1, 'Анна', 1, 3421541335, 'Привет', '2018-11-19 18:47:12', '1510512370881.jpg');
INSERT INTO profile VALUES (2, 'Сергио', 4, 2131413242, 'Я хороший мальчик', '2018-11-20 18:47:12', '1511847807787.jpg');
INSERT INTO profile VALUES (4, 'Серерж', 3, 346534534, 'привет', '2018-11-20 19:47:12', 'XtlDa6Ij0E0.jpg');
INSERT INTO profile VALUES (9, 'Гена', 1, 3421541335, 'Гена', '2018-11-23 18:21:36', '1541277431168.jpg');


--
-- TOC entry 2070 (class 0 OID 0)
-- Dependencies: 180
-- Name: profile_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('profile_user_id_seq', 1, false);


--
-- TOC entry 2049 (class 0 OID 32927)
-- Dependencies: 179
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO "user" VALUES (1, 'chvse@north.ru', '7c4a8d09ca3762af61e59520943dc26494f8941b', true);
INSERT INTO "user" VALUES (2, 'sergio@ssd.ru', '7c4a8d09ca3762af61e59520943dc26494f8941b', NULL);
INSERT INTO "user" VALUES (3, 'any@any.ru', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', NULL);
INSERT INTO "user" VALUES (4, 'cato@pes.ru', '7ab515d12bd2cf431745511ac4ee13fed15ab578', NULL);
INSERT INTO "user" VALUES (9, 'gena@go.ru', '7ab515d12bd2cf431745511ac4ee13fed15ab578', NULL);


--
-- TOC entry 2071 (class 0 OID 0)
-- Dependencies: 178
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('user_id_seq', 9, true);


--
-- TOC entry 1923 (class 2606 OID 24674)
-- Name: category_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY category
    ADD CONSTRAINT category_pkey PRIMARY KEY (id);


--
-- TOC entry 1925 (class 2606 OID 32874)
-- Name: city_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY city
    ADD CONSTRAINT city_pkey PRIMARY KEY (id);


--
-- TOC entry 1921 (class 2606 OID 24641)
-- Name: migration_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);


--
-- TOC entry 1931 (class 2606 OID 41278)
-- Name: post_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY post
    ADD CONSTRAINT post_pkey PRIMARY KEY (id);


--
-- TOC entry 1929 (class 2606 OID 41191)
-- Name: profile_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY profile
    ADD CONSTRAINT profile_pkey PRIMARY KEY (user_id);


--
-- TOC entry 1927 (class 2606 OID 32937)
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- TOC entry 1933 (class 2606 OID 41279)
-- Name: post_user; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY post
    ADD CONSTRAINT post_user FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 1932 (class 2606 OID 41192)
-- Name: profile_user; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY profile
    ADD CONSTRAINT profile_user FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2060 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2018-11-23 23:10:59

--
-- PostgreSQL database dump complete
--

