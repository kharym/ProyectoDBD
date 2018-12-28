-- convert Laravel migrations to raw SQL scripts --

-- migration:2018_11_26_210847_create_auditorias_table --
create table "auditorias" (
  "id" serial primary key not null, 
  "tipo_auditoria" smallint not null, 
  "descripcion" varchar(250) not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);

-- migration:2018_11_26_211028_create_rols_table --
create table "rols" (
  "id" serial primary key not null, 
  "tipo_rol" smallint not null, 
  "descripcion" varchar(250) not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);

-- migration:2018_11_26_211030_create_users_table --
create table "users" (
  "id" serial primary key not null, 
  "rol_id" integer not null, 
  "auditoria_id" integer not null, 
  "name" varchar(50) not null, 
  "apellido" varchar(40) not null, 
  "email" varchar(450) not null, 
  "email_verified_at" timestamp(0) without time zone null, 
  "tipo_documento" smallint not null, 
  "numero_documento" varchar(15) not null, 
  "pais" varchar(255) not null, 
  "fecha_nacimiento" date not null, 
  "telefono" varchar(18) not null, 
  "password" varchar(60) not null, 
  "remember_token" varchar(100) null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "users" 
add 
  constraint "users_rol_id_foreign" foreign key ("rol_id") references "rols" ("id") on delete cascade;
alter table 
  "users" 
add 
  constraint "users_auditoria_id_foreign" foreign key ("auditoria_id") references "auditorias" ("id") on delete cascade;
alter table 
  "users" 
add 
  constraint "users_email_unique" unique ("email");

-- migration:2018_11_26_211031_create_password_resets_table --
create table "password_resets" (
  "email" varchar(255) not null, 
  "token" varchar(255) not null, 
  "created_at" timestamp(0) without time zone null
);
create index "password_resets_email_index" on "password_resets" ("email");

-- migration:2018_11_26_211118_create_actividads_table --
create table "actividads" (
  "id" serial primary key not null, 
  "destino" varchar(40) not null, 
  "nombre_actividad" varchar(100) not null, 
  "precio" double precision not null, 
  "cantidad_adulto" smallint not null, 
  "cantidad_ninos" smallint not null, 
  "fecha_ida" date not null, 
  "fecha_vuelta" date not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);

-- migration:2018_11_26_211248_create_medio_de_pagos_table --
create table "medio_de_pagos" (
  "id" serial primary key not null, 
  "tipo_mediopago" smallint not null, 
  "disponibilidad" boolean not null, 
  "monto" double precision not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);

-- migration:2018_11_26_211408_create_reserva_habitacions_table --
create table "reserva_habitacions" (
  "id" serial primary key not null, 
  "precio_res_hab" double precision not null, 
  "fecha_llegada" date not null, 
  "fecha_ida" date not null, 
  "numero_ninos" smallint not null, 
  "numero_adulto" smallint not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);

-- migration:2018_11_26_211528_create_pasajeros_table --
create table "pasajeros" (
  "id" serial primary key not null, 
  "name" varchar(255) not null, 
  "apellido" varchar(255) not null, 
  "dni_pasaporte" varchar(255) not null, 
  "pais" varchar(255) not null, 
  "menor_edad" boolean not null, 
  "telefono" varchar(255) not null, 
  "asistencia_especial" boolean not null, 
  "movilidad_reducida" boolean not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);

-- migration:2018_11_26_211848_create_seguros_table --
create table "seguros" (
  "id" serial primary key not null, 
  "edad_pasajero" smallint not null, 
  "ida_vuelta" boolean not null, 
  "cantidad_personas" smallint not null, 
  "fecha_ida" date not null, 
  "fecha_vuelta" date not null, 
  "destino" varchar(40) not null, 
  "costo_pasaje" double precision not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);

-- migration:2018_11_26_215041_create_pais_table --
create table "pais" (
  "id" serial primary key not null, 
  "nombre_pais" varchar(255) not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);

-- migration:2018_11_26_220835_create_cuenta_bancarias_table --
create table "cuenta_bancarias" (
  "id" serial primary key not null, 
  "user_id" integer not null, 
  "saldo" double precision not null, 
  "maximo_giro" double precision not null, 
  "nombre_banco" varchar(255) not null, 
  "fecha_giro" date not null, 
  "hora_giro" time(0) without time zone not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "cuenta_bancarias" 
add 
  constraint "cuenta_bancarias_user_id_foreign" foreign key ("user_id") references "users" ("id") on delete cascade;

-- migration:2018_11_26_221731_create_ciudads_table --
create table "ciudads" (
  "id" serial primary key not null, 
  "pais_id" integer not null, 
  "nombre_ciudad" varchar(30) not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "ciudads" 
add 
  constraint "ciudads_pais_id_foreign" foreign key ("pais_id") references "pais" ("id") on delete cascade;

-- migration:2018_11_26_222453_create_ubicacions_table --
create table "ubicacions" (
  "id" serial primary key not null, 
  "ciudad_id" integer not null, 
  "latitud" double precision not null, 
  "longitud" double precision not null, 
  "codigo_postal" integer not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "ubicacions" 
add 
  constraint "ubicacions_ciudad_id_foreign" foreign key ("ciudad_id") references "ciudads" ("id") on delete cascade;

-- migration:2018_11_26_223208_create_empresas_table --
create table "empresas" (
  "id" serial primary key not null, 
  "ciudad_id" integer not null, 
  "nombre_empresa" varchar(50) not null, 
  "telefono_empresa" varchar(255) not null, 
  "correo_empresa" varchar(250) not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "empresas" 
add 
  constraint "empresas_ciudad_id_foreign" foreign key ("ciudad_id") references "ciudads" ("id") on delete cascade;

-- migration:2018_11_26_223538_create_autos_table --
create table "autos" (
  "id" serial primary key not null, 
  "empresa_id" integer not null, 
  "numero_puertas" smallint not null, 
  "tipo_transmision" smallint not null, 
  "numero_asientos" smallint not null, 
  "modelo" varchar(50) not null, 
  "marca" varchar(30) not null, 
  "disponibilidad" boolean not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "autos" 
add 
  constraint "autos_empresa_id_foreign" foreign key ("empresa_id") references "empresas" ("id") on delete cascade;

-- migration:2018_11_26_224540_create_reserva_autos_table --
create table "reserva_autos" (
  "id" serial primary key not null, 
  "auto_id" integer not null, 
  "precio_auto" double precision not null, 
  "fecha_recogido" date not null, 
  "fecha_devolucion" date not null, 
  "hora_recogido" time(0) without time zone not null, 
  "hora_devolucion" time(0) without time zone not null, 
  "tipo_auto" smallint not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "reserva_autos" 
add 
  constraint "reserva_autos_auto_id_foreign" foreign key ("auto_id") references "autos" ("id") on delete cascade;

-- migration:2018_11_26_225058_create_alojamientos_table --
create table "alojamientos" (
  "id" serial primary key not null, 
  "ciudad_id" integer not null, 
  "nombre_alojamiento" varchar(255) not null, 
  "numero_estrellas" smallint not null, 
  "calle_alojamiento" varchar(255) not null, 
  "numero_alojamiento" integer not null, 
  "disponibilidad" boolean not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "alojamientos" 
add 
  constraint "alojamientos_ciudad_id_foreign" foreign key ("ciudad_id") references "ciudads" ("id") on delete cascade;

-- migration:2018_11_26_230143_create_habitacions_table --
create table "habitacions" (
  "id" serial primary key not null, 
  "reserva_habitacion_id" integer not null, 
  "alojamiento_id" integer not null, 
  "numero_habitacion" smallint not null, 
  "tipo_habitacion" smallint not null, 
  "numero_camas" smallint not null, 
  "numero_banos" smallint not null, 
  "disponibilidad" boolean not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "habitacions" 
add 
  constraint "habitacions_reserva_habitacion_id_foreign" foreign key ("reserva_habitacion_id") references "reserva_habitacions" ("id") on delete cascade;
alter table 
  "habitacions" 
add 
  constraint "habitacions_alojamiento_id_foreign" foreign key ("alojamiento_id") references "alojamientos" ("id") on delete cascade;

-- migration:2018_11_26_230722_create_paquetes_table --
create table "paquetes" (
  "id" serial primary key not null, 
  "reserva_auto_id" integer not null, 
  "reserva_habitacion_id" integer not null, 
  "precio" double precision not null, 
  "descuento" double precision not null, 
  "tipo_paquete" smallint not null, 
  "disponibilidad" boolean not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "paquetes" 
add 
  constraint "paquetes_reserva_auto_id_foreign" foreign key ("reserva_auto_id") references "reserva_autos" ("id") on delete cascade;
alter table 
  "paquetes" 
add 
  constraint "paquetes_reserva_habitacion_id_foreign" foreign key ("reserva_habitacion_id") references "reserva_habitacions" ("id") on delete cascade;

-- migration:2018_11_26_231153_create_compras_table --
create table "compras" (
  "id" serial primary key not null, 
  "user_id" integer not null, 
  "actividad_id" integer not null, 
  "seguro_id" integer not null, 
  "paquete_id" integer not null, 
  "reserva_auto_id" integer not null, 
  "reserva_habitacion_id" integer not null, 
  "fecha_compra" date not null, 
  "hora_compra" time(0) without time zone not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "compras" 
add 
  constraint "compras_user_id_foreign" foreign key ("user_id") references "users" ("id") on delete cascade;
alter table 
  "compras" 
add 
  constraint "compras_actividad_id_foreign" foreign key ("actividad_id") references "actividads" ("id") on delete cascade;
alter table 
  "compras" 
add 
  constraint "compras_seguro_id_foreign" foreign key ("seguro_id") references "seguros" ("id") on delete cascade;
alter table 
  "compras" 
add 
  constraint "compras_paquete_id_foreign" foreign key ("paquete_id") references "paquetes" ("id") on delete cascade;
alter table 
  "compras" 
add 
  constraint "compras_reserva_auto_id_foreign" foreign key ("reserva_auto_id") references "reserva_autos" ("id") on delete cascade;
alter table 
  "compras" 
add 
  constraint "compras_reserva_habitacion_id_foreign" foreign key ("reserva_habitacion_id") references "reserva_habitacions" ("id") on delete cascade;

-- migration:2018_11_26_231648_create_vuelos_table --
create table "vuelos" (
  "id" serial primary key not null, 
  "ciudad_va_id" integer not null, 
  "ciudad_viene_id" integer not null, 
  "origen" varchar(100) not null, 
  "destino" varchar(100) not null, 
  "precio_vuelo" double precision not null, 
  "cantidad_asientos" smallint not null, 
  "fecha_ida" date not null, 
  "hora_ida" time(0) without time zone not null, 
  "fecha_llegada" date not null, 
  "hora_llegada" time(0) without time zone not null, 
  "duracion_viaje" time(0) without time zone not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "vuelos" 
add 
  constraint "vuelos_ciudad_va_id_foreign" foreign key ("ciudad_va_id") references "ciudads" ("id") on delete cascade;
alter table 
  "vuelos" 
add 
  constraint "vuelos_ciudad_viene_id_foreign" foreign key ("ciudad_viene_id") references "ciudads" ("id") on delete cascade;

-- migration:2018_11_26_232430_create_aeropuertos_table --
create table "aeropuertos" (
  "id" serial primary key not null, 
  "ciudad_id" integer not null, 
  "nombre_aeropuerto" varchar(100) not null, 
  "calle_aeropuerto" varchar(50) not null, 
  "numero_aeropuerto" integer not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "aeropuertos" 
add 
  constraint "aeropuertos_ciudad_id_foreign" foreign key ("ciudad_id") references "ciudads" ("id") on delete cascade;

-- migration:2018_11_27_022349_create_asientos_table --
create table "asientos" (
  "id" serial primary key not null, 
  "vuelo_id" integer not null, 
  "numero_asiento" smallint not null, 
  "disponibilidad" boolean not null, 
  "tipo_asiento" smallint not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "asientos" 
add 
  constraint "asientos_vuelo_id_foreign" foreign key ("vuelo_id") references "vuelos" ("id") on delete cascade;

-- migration:2018_11_27_022350_create_reserva_vuelos_table --
create table "reserva_vuelos" (
  "id" serial primary key not null, 
  "vuelo_id" integer not null, 
  "asiento_id" integer not null, 
  "pasajero_id" integer not null, 
  "ida_vuelta" boolean not null, 
  "cantidad_pasajeros" smallint not null, 
  "tipo_cabina" smallint not null, 
  "fecha_reserva" date not null, 
  "hora_reserva" time(0) without time zone not null, 
  "precio_reserva_vuelo" double precision not null, 
  "cantidad_paradas" smallint not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "reserva_vuelos" 
add 
  constraint "reserva_vuelos_vuelo_id_foreign" foreign key ("vuelo_id") references "vuelos" ("id") on delete cascade;
alter table 
  "reserva_vuelos" 
add 
  constraint "reserva_vuelos_asiento_id_foreign" foreign key ("asiento_id") references "asientos" ("id") on delete cascade;
alter table 
  "reserva_vuelos" 
add 
  constraint "reserva_vuelos_pasajero_id_foreign" foreign key ("pasajero_id") references "pasajeros" ("id") on delete cascade;

-- migration:2018_12_07_194840_create_usuario__medio_de_pagos_table --
create table "usuario__medio_de_pagos" (
  "id" serial primary key not null, 
  "user_id" integer not null, 
  "medio_de_pago_id" integer not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "usuario__medio_de_pagos" 
add 
  constraint "usuario__medio_de_pagos_user_id_foreign" foreign key ("user_id") references "users" ("id") on delete cascade;
alter table 
  "usuario__medio_de_pagos" 
add 
  constraint "usuario__medio_de_pagos_medio_de_pago_id_foreign" foreign key ("medio_de_pago_id") references "medio_de_pagos" ("id") on delete cascade;

-- migration:2018_12_07_195122_create_paquete__reserva_vuelos_table --
create table "paquete__reserva_vuelos" (
  "id" serial primary key not null, 
  "paquete_id" integer not null, 
  "reserva_vuelo_id" integer not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "paquete__reserva_vuelos" 
add 
  constraint "paquete__reserva_vuelos_paquete_id_foreign" foreign key ("paquete_id") references "paquetes" ("id") on delete cascade;
alter table 
  "paquete__reserva_vuelos" 
add 
  constraint "paquete__reserva_vuelos_reserva_vuelo_id_foreign" foreign key ("reserva_vuelo_id") references "reserva_vuelos" ("id") on delete cascade;

-- migration:2018_12_07_195335_create_compra__reserva_vuelos_table --
create table "compra__reserva_vuelos" (
  "id" serial primary key not null, 
  "compra_id" integer not null, 
  "reserva_vuelo_id" integer not null, 
  "created_at" timestamp(0) without time zone null, 
  "updated_at" timestamp(0) without time zone null
);
alter table 
  "compra__reserva_vuelos" 
add 
  constraint "compra__reserva_vuelos_compra_id_foreign" foreign key ("compra_id") references "compras" ("id") on delete cascade;
alter table 
  "compra__reserva_vuelos" 
add 
  constraint "compra__reserva_vuelos_reserva_vuelo_id_foreign" foreign key ("reserva_vuelo_id") references "reserva_vuelos" ("id") on delete cascade;

-- migration:2018_12_07_211554_create_trigger --
CREATE 
OR REPLACE FUNCTION llenarAsientos() RETURNS trigger AS $$ DECLARE i INTEGER := NEW.cantidad_asientos; j INTEGER := 0; valor INTEGER := NEW.id; BEGIN LOOP EXIT WHEN j = i; j := j + 1; INSERT INTO asientos(
  vuelo_id, numero_asiento, disponibilidad, 
  tipo_asiento, created_at
) 
VALUES 
  (valor, j, true, 1, NEW.created_at); END LOOP; RETURN NEW; END $$ LANGUAGE plpgsql;;
CREATE TRIGGER asiento_Vuelo 
AFTER 
  INSERT ON vuelos FOR EACH ROW EXECUTE PROCEDURE llenarAsientos();;

-- migration:2018_12_18_032050_create__user_trigger --
CREATE 
OR REPLACE FUNCTION asignarRol() RETURNS trigger AS $$ BEGIN 
UPDATE 
  users 
SET 
  rol_id = 1 
WHERE 
  users.id = NEW.id; RETURN NEW; END $$ LANGUAGE plpgsql;;
CREATE TRIGGER usuario_rol 
AFTER 
  INSERT ON users FOR EACH ROW EXECUTE PROCEDURE asignarRol();;

-- migration:2018_12_27_211128_hotel_habitacion_trigger --
CREATE 
OR REPLACE FUNCTION deshabilitarHabitacion() RETURNS trigger AS $$ BEGIN IF NEW.disponibilidad = false THEN 
UPDATE 
  habitacions 
SET 
  disponibilidad = false 
WHERE 
  habitacions.alojamiento_id = NEW.id; ELSEIF NEW.disponibilidad = true THEN 
UPDATE 
  habitacions 
SET 
  disponibilidad = true 
WHERE 
  habitacions.alojamiento_id = NEW.id; END IF; RETURN NEW; END $$ LANGUAGE plpgsql;;
CREATE TRIGGER usuario_rol 
AFTER 
UPDATE 
  ON alojamientos FOR EACH ROW EXECUTE PROCEDURE deshabilitarHabitacion();;


---------------------------------- INSERTS--------------------------------------------------------------------

-- insert auditoria---


insert into auditorias (tipo_auditoria, descripcion)
values
('1','descripcion de auditoria 1'), 
('0','descripcion de auditoria 0'),
('1','descripcion de auditoria 1'), 
('0','descripcion de auditoria 0'),
('1','descripcion de auditoria 1');

-- insert rol---

insert into rols (tipo_rol, descripcion)
values
('1','descripcion de rol 1'), 
('0','descripcion de rol 0'),
('1','descripcion de rol 1'), 
('0','descripcion de rol 0'),
('1','descripcion de rol 1');

-- insert users---

insert into users (rol_id, auditoria_id, name, apellido, email, tipo_documento, numero_documento, pais, fecha_nacimiento, telefono, password)
values
('1','1','Pedro','Gonzalez','pedro.gonzalez@gmail.com','1','2','Chile','1990-12-01','+5190244995984','wesdad'), 
('2','2','Marco','Iturra','marco.iturra@gmail.com','1','2','Peru','1990-12-01','+5190244995984','sadas'),
('3','3','Daniel','Perez','d.p@gmail.com','1','2','Peru','1990-12-01','+5190244995984','1231ssa'), 
('4','4','Camilo','Fuentes','c.fa@gmail.com','1','2','Colombia','1990-12-01','+5190244995984','sad21'),
('5','5','Nicolas','Sandoval','ni.sa@gmail.com','1','2','España','1990-12-01','+5190244995984','342asd');

-- insert actividads---

insert into actividads (destino, nombre_actividad, precio, cantidad_adulto, cantidad_ninos, fecha_ida, fecha_vuelta)
values
('Chile','trekking','10000','2','1','2019-10-01','2019-12-01'), 
('Italia','piscina','5000','3','2','2019-11-01','2019-11-11'),
('España','futbol','8500','4','0','2019-09-01','2019-10-01'), 
('Peru','concierto','30000','2','1','2019-04-01','2019-05-01'),
('Canada','zoologico','9000','2','3','2019-03-01','2019-06-01'); 

-- insert medio de pagos---

insert into medio_de_pagos (tipo_mediopago,disponibilidad, monto)
values
('0','true','300000'), 
('1','false','150000'),
('2','false','500000'), 
('3','true','250000'),
('2','true','800000'); 

-- insert reserva habitacions---

insert into reserva_habitacions (precio_res_hab,fecha_llegada, fecha_ida,numero_ninos,numero_adulto)
values
('100000','2019-10-01','2019-12-01','2','1'), 
('250000','2019-11-01','2019-11-11','3','2'),
('150000','2019-09-01','2019-10-01','4','0'), 
('400000','2019-04-01','2019-05-01','2','1'),
('350000','2019-03-01','2019-06-01','2','3'); 

-- insert pasajeros---

insert into pasajeros ( name, apellido, dni_pasaporte, pais, menor_edad, telefono, asistencia_especial,movilidad_reducida)
values
('Pedro','Gonzalez','2182181','Chile','true','+5190244995984','false','false'), 
('Marco','Perez','212121','Peru','true','+5190244995984','false','false'), 
('Antonio','Rosalez','243543','Italia','true','+5190244995984','true','false'), 
('Juan','Alarcon','2234134','España','true','+5190244995984','false','true'), 
('Pedro','Fuentes','215647','Francia','true','+5190244995984','false','false'); 

-- insert seguros---

insert into seguros (edad_pasajero, ida_vuelta, cantidad_personas, fecha_ida,fecha_vuelta, destino, costo_pasaje)
values
('32','true','2','2019-10-01','2019-12-01','Chile','350000'), 
('23','true','3','2019-10-01','2019-12-01','Peru','350000'), 
('25','false','1','2019-10-01','2019-12-01','Francia','350000'),
('40','true','2','2019-10-01','2019-12-01','Chile','350000'),
('55','false','1','2019-10-01','2019-12-01','Chile','350000');


-- insert pais---

insert into pais (nombre_pais)
values
('Chile'), 
('Peru'), 
('Francia'),
('España'),
('Chile');

-- insert cuenta bancaria--

insert into cuenta_bancarias (user_id, saldo, maximo_giro, nombre_banco,fecha_giro, hora_giro)
values
('1','1000000','500000','Bancop','2019-12-01','23:30:10'), 
('2','800000','300000','Bancok','2019-12-01','23:30:10'), 
('3','500000','150000','Bancoe','2019-12-01','23:30:10'),
('4','765422','205000','Bancor','2019-12-01','23:30:10'),
('5','985000','190000','Bancot','2019-12-01','23:30:10');


-- insert ciudads---

insert into ciudads (pais_id,nombre_ciudad)
values
('1','Santiago'), 
('2','Lima'), 
('3','Paris'),
('4','Madrid'),
('5','Temuco');

-- insert ubicacions---

insert into ubicacions (ciudad_id,latitud,longitud,codigo_postal)
values
('1','123131','123131','344325'), 
('2','2323423','123123','234234'), 
('3','12313','523442','345345'),
('4','23423142','5675675','43534'),
('5','123121','54645678','5675643');

-- insert empresas---

insert into empresas (ciudad_id,nombre_empresa,telefono_empresa,correo_empresa)
values
('1','empresaB','+5190244995984','pedro.gonzalez@gmail.com'), 
('2','empresaK','+5190244995984','pedro.gonzalez@gmail.com'), 
('3','empresaG','+5190244995984','pedro.gonzalez@gmail.com'),
('4','empresaT','+5190244995984','pedro.gonzalez@gmail.com'),
('5','empresaW','+5190244995984','pedro.gonzalez@gmail.com');

-- insert autos---

insert into autos (empresa_id,numero_puertas,tipo_transmision,numero_asientos,modelo,marca,disponibilidad)
values
('1','4','0','4','march','nissan','true'), 
('2','5','1','6','morning','kia','true'), 
('3','5','1','4','corsa','chevrolet','false'),
('4','4','0','4','swift','susuki','true'),
('5','4','0','4','march','nissan','false');

-- insert reserva_autos--

insert into reserva_autos (auto_id, precio_auto, fecha_recogido,fecha_devolucion,hora_recogido, hora_devolucion,tipo_auto)
values
('1','1000000','2019-10-01','2019-12-01','10:30:10','23:30:10','0'), 
('2','800000','2019-10-01','2019-12-01','10:30:10','23:30:10','1'), 
('3','500000','2019-10-01','2019-12-01','10:30:10','23:30:10','1'),
('4','765422','2019-10-01','2019-12-01','10:30:10','23:30:10','0'),
('5','985000','2019-10-01','2019-12-01','10:30:10','23:30:10','1');

-- insert alojamientos--

insert into alojamientos (ciudad_id, nombre_alojamiento,numero_estrellas,calle_alojamiento,numero_alojamiento, disponibilidad)
values
('1','HotelP','4','Av. Poniente','1221','true'),
('2','HotelK','5','Av. chao','1221','false'), 
('3','HotelL','2','Av. sol','1221','true'), 
('4','HotelH','3','Av. piramide','1221','false'), 
('5','HotelA','4','Av. caos','1221','true');

-- insert habitacions--

insert into habitacions (reserva_habitacion_id,alojamiento_id,numero_habitacion,tipo_habitacion,numero_camas, numero_banos,disponibilidad)
values
('1','1','32','0','1','1','true'),
('2','2','3','1','2','2','false'), 
('3','3','4','0','2','2','true'), 
('4','4','10','1','1','2','false'), 
('5','5','15','1','3','1','true');


-- insert habitacions--

insert into paquetes (reserva_auto_id,reserva_habitacion_id,precio,descuento,tipo_paquete, disponibilidad)
values
('1','1','320000','10000','1','true'),
('2','2','300000','10000','0','false'), 
('3','3','400000','20000','2','true'), 
('4','4','100550','15000','1','false'), 
('5','5','150000','19000','1','true');


-- insert habitacions--

insert into compras (user_id,actividad_id,seguro_id,paquete_id,reserva_auto_id, reserva_habitacion_id,fecha_compra,hora_compra)
values
('1','1','1','1','1','1','2019-12-01','10:30:10'),
('2','2','2','2','2','2','2019-12-01','10:30:10'), 
('3','3','3','3','3','3','2019-12-01','10:30:10'), 
('4','4','4','4','4','4','2019-12-01','10:30:10'), 
('5','5','5','5','5','5','2019-12-01','10:30:10');

-- insert vuelos--

insert into vuelos (ciudad_va_id,ciudad_viene_id,origen,destino,precio_vuelo, cantidad_asientos,fecha_ida,hora_ida,fecha_llegada,hora_llegada,duracion_viaje)
values
('1','1','Chile','Francia','320000','25','2019-10-01','10:30:10','2019-12-01','23:30:10','22:30:10'),
('2','2','Peru','Brasil','320000','25','2019-10-01','10:30:10','2019-12-01','23:30:10','10:30:10'),
('3','3','España','Canada','320000','25','2019-10-01','10:30:10','2019-12-01','23:30:10','08:30:10'),
('4','4','Argentina','Australia','320000','25','2019-10-01','10:30:10','2019-12-01','23:30:10','15:00:10'),
('5','5','Egipto','Mexico','320000','25','2019-10-01','10:30:10','2019-12-01','23:30:10','20:30:10');



-- insert aeropuertos--

insert into aeropuertos (ciudad_id,nombre_aeropuerto,calle_aeropuerto,numero_aeropuerto)
values
('1','Aeropuerto Nacional','Av. vuelo','1231'),
('2','Aeropuerto Juan Perez','Av. avion','1231'),
('3','Aeropuerto Metropolitano','Av. despegue','1231'),
('4','Aeropuerto InterNacional','Av. piloto','1231'),
('5','Aeropuerto 23','Av. peligro','1231');

-- insert asientos--

insert into asientos (vuelo_id,numero_asiento,disponibilidad,tipo_asiento)
values
('1','2','true','0'),
('2','23','true','1'),
('3','4','false','1'),
('4','10','false','0'),
('5','20','true','1');


-- insert reserva_vuelos--

insert into reserva_vuelos (vuelo_id,asiento_id,pasajero_id,ida_vuelta,cantidad_pasajeros,tipo_cabina,fecha_reserva,hora_reserva,precio_reserva_vuelo,cantidad_paradas)
values
('1','1','1','true','3','1','2019-12-01','10:30:10','320000','2'),
('2','2','2','false','4','0','2019-12-01','10:30:10','320000','1'), 
('3','3','3','true','2','2','2019-12-01','10:30:10','320000','0'), 
('4','4','4','true','1','1','2019-12-01','10:30:10','320000','1'), 
('5','5','5','false','3','1','2019-12-01','10:30:10','320000','2');


-- insert usuario__medio_de_pagos--

insert into usuario__medio_de_pagos (user_id,medio_de_pago_id)
values
('1','1'),
('2','2'),
('3','3'),
('4','4'),
('5','5');

-- insert paquete__reserva_vuelos--

insert into paquete__reserva_vuelos (paquete_id,reserva_vuelo_id)
values
('1','1'),
('2','2'),
('3','3'),
('4','4'),
('5','5');

-- insert compra__reserva_vuelos--

insert into compra__reserva_vuelos (compra_id,reserva_vuelo_id)
values
('1','1'),
('2','2'),
('3','3'),
('4','4'),
('5','5');