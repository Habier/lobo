------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS colores CASCADE;

CREATE TABLE colores
(
      id     BIGSERIAL    PRIMARY KEY
    , nombre VARCHAR(255) UNIQUE
    , color  CHAR(7) NOT NULL
                          UNIQUE
                          CHECK (color ~* '^#[a-fA-F0-9]{6}')
);

DROP TABLE IF EXISTS especies CASCADE;

CREATE TABLE especies
(
      id      BIGSERIAL    PRIMARY KEY
    , especie VARCHAR(255) NOT NULL
                           UNIQUE
);

DROP TABLE IF EXISTS razas CASCADE;

CREATE TABLE razas
(
      id         BIGSERIAL    PRIMARY KEY
    , raza       VARCHAR(255) NOT NULL
                              UNIQUE
    , especie_id BIGINT       NOT NULL
                              REFERENCES especies(id)
                              ON UPDATE CASCADE
                              ON DELETE NO ACTION
    , UNIQUE(raza,especie_id)
);

DROP TABLE IF EXISTS animales CASCADE;

CREATE TABLE animales
(
      id            BIGSERIAL    PRIMARY KEY
    , nombre        VARCHAR(255) NOT NULL
    , nacimiento                 TIMESTAMP
    , chip          VARCHAR(255) UNIQUE
    , peso          NUMERIC(5,2)
    , ppp           BOOL
    , esterilizado  BOOL
    , sexo          VARCHAR(6)   CONSTRAINT ck_sexo_valido
                                 CHECK (sexo = 'h' OR sexo = 'm') --HEMBRA/MACHO--
    , observaciones TEXT
    , created_at    TIMESTAMP    DEFAULT LOCALTIMESTAMP
    , updated_at    TIMESTAMP    DEFAULT LOCALTIMESTAMP
);

DROP TABLE IF EXISTS animales_razas CASCADE;

CREATE TABLE animales_razas
(
      id        BIGSERIAL PRIMARY KEY
    , animal_id BIGINT    NOT NULL
                          REFERENCES animales(id)
                          ON UPDATE CASCADE
                          ON DELETE NO ACTION
    , raza_id   BIGINT    NOT NULL
                          REFERENCES razas(id)
                          ON UPDATE CASCADE
                          ON DELETE NO ACTION
    , UNIQUE(animal_id, raza_id)
);
