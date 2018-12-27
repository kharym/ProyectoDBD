CreateLibrosTable: create table "libros" ("id" serial primary key not null, "nombre" varchar(255) not null, "resumen" varchar(255) not null, "npagina" integer not null, "edicion" integer not null, "autor" varchar(255) not null, "precio" decimal(5, 2) not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateAuditoriasTable: create table "auditorias" ("id" serial primary key not null, "tipo_auditoria" smallint not null, "descripcion" varchar(250) not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateRolsTable: create table "rols" ("id" serial primary key not null, "tipo_rol" smallint not null, "descripcion" varchar(250) not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateUsersTable: create table "users" ("id" serial primary key not null, "rol_id" integer not null, "auditoria_id" integer not null, "name" varchar(50) not null, "apellido" varchar(40) not null, "email" varchar(450) not null, "email_verified_at" timestamp(0) without time zone null, "tipo_documento" smallint not null, "numero_documento" varchar(15) not null, "pais" varchar(255) not null, "fecha_nacimiento" date not null, "telefono" varchar(18) not null, "password" varchar(60) not null, "remember_token" varchar(100) null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateUsersTable: alter table "users" add constraint "users_rol_id_foreign" foreign key ("rol_id") references "rols" ("id") on delete cascade
CreateUsersTable: alter table "users" add constraint "users_auditoria_id_foreign" foreign key ("auditoria_id") references "auditorias" ("id") on delete cascade
CreateUsersTable: alter table "users" add constraint "users_email_unique" unique ("email")
CreatePasswordResetsTable: create table "password_resets" ("email" varchar(255) not null, "token" varchar(255) not null, "created_at" timestamp(0) without time zone null)
CreatePasswordResetsTable: create index "password_resets_email_index" on "password_resets" ("email")
CreateActividadsTable: create table "actividads" ("id" serial primary key not null, "destino" varchar(40) not null, "nombre_actividad" varchar(100) not null, "precio" double precision not null, "cantidad_adulto" smallint not null, "cantidad_ninos" smallint not null, "fecha_ida" date not null, "fecha_vuelta" date not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateMedioDePagosTable: create table "medio_de_pagos" ("id" serial primary key not null, "tipo_medioPago" smallint not null, "disponibilidad" boolean not null, "monto" double precision not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateReservaHabitacionsTable: create table "reserva_habitacions" ("id" serial primary key not null, "precio_res_hab" double precision not null, "fecha_llegada" date not null, "fecha_ida" date not null, "numero_ninos" smallint not null, "numero_adulto" smallint not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreatePasajerosTable: create table "pasajeros" ("id" serial primary key not null, "name" varchar(255) not null, "apellido" varchar(255) not null, "dni_pasaporte" varchar(255) not null, "pais" varchar(255) not null, "menor_edad" boolean not null, "telefono" varchar(255) not null, "asistencia_especial" boolean not null, "movilidad_reducida" boolean not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateSegurosTable: create table "seguros" ("id" serial primary key not null, "edad_pasajero" smallint not null, "ida_vuelta" boolean not null, "cantidad_personas" smallint not null, "fecha_ida" date not null, "fecha_vuelta" date not null, "destino" varchar(40) not null, "costo_pasaje" double precision not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreatePaisTable: create table "pais" ("id" serial primary key not null, "nombre_pais" varchar(255) not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateCuentaBancariasTable: create table "cuenta_bancarias" ("id" serial primary key not null, "usuario_id" integer not null, "saldo" double precision not null, "maximo_giro" double precision not null, "nombre_banco" varchar(255) not null, "fecha_giro" date not null, "hora_giro" time(0) without time zone not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateCuentaBancariasTable: alter table "cuenta_bancarias" add constraint "cuenta_bancarias_usuario_id_foreign" foreign key ("usuario_id") references "users" ("id") on delete cascade
CreateCiudadsTable: create table "ciudads" ("id" serial primary key not null, "pais_id" integer not null, "nombre_ciudad" varchar(30) not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateCiudadsTable: alter table "ciudads" add constraint "ciudads_pais_id_foreign" foreign key ("pais_id") references "pais" ("id") on delete cascade
CreateUbicacionsTable: create table "ubicacions" ("id" serial primary key not null, "ciudad_id" integer not null, "latitud" double precision not null, "longitud" double precision not null, "codigo_postal" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateUbicacionsTable: alter table "ubicacions" add constraint "ubicacions_ciudad_id_foreign" foreign key ("ciudad_id") references "ciudads" ("id") on delete cascade
CreateEmpresasTable: create table "empresas" ("id" serial primary key not null, "ciudad_id" integer not null, "nombre_empresa" varchar(50) not null, "telefono_empresa" varchar(255) not null, "correo_empresa" varchar(250) not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateEmpresasTable: alter table "empresas" add constraint "empresas_ciudad_id_foreign" foreign key ("ciudad_id") references "ciudads" ("id") on delete cascade
CreateAutosTable: create table "autos" ("id" serial primary key not null, "empresa_id" integer not null, "numero_puertas" smallint not null, "tipo_transmision" smallint not null, "numero_asientos" smallint not null, "modelo" varchar(50) not null, "marca" varchar(30) not null, "disponibilidad" boolean not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateAutosTable: alter table "autos" add constraint "autos_empresa_id_foreign" foreign key ("empresa_id") references "empresas" ("id") on delete cascade
CreateReservaAutosTable: create table "reserva_autos" ("id" serial primary key not null, "auto_id" integer not null, "precio_auto" double precision not null, "fecha_recogido" date not null, "fecha_devolucion" date not null, "hora_recogido" time(0) without time zone not null, "hora_devolucion" time(0) without time zone not null, "tipo_auto" smallint not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateReservaAutosTable: alter table "reserva_autos" add constraint "reserva_autos_auto_id_foreign" foreign key ("auto_id") references "autos" ("id") on delete cascade
CreateAlojamientosTable: create table "alojamientos" ("id" serial primary key not null, "ciudad_id" integer not null, "nombre_alojamiento" varchar(255) not null, "numero_estrellas" smallint not null, "calle_alojamiento" varchar(255) not null, "numero_alojamiento" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateAlojamientosTable: alter table "alojamientos" add constraint "alojamientos_ciudad_id_foreign" foreign key ("ciudad_id") references "ciudads" ("id") on delete cascade
CreateHabitacionsTable: create table "habitacions" ("id" serial primary key not null, "reserva_habitacion_id" integer not null, "alojamiento_id" integer not null, "numero_habitacion" smallint not null, "tipo_habitacion" smallint not null, "numero_camas" smallint not null, "numero_banos" smallint not null, "disponibilidad" boolean not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateHabitacionsTable: alter table "habitacions" add constraint "habitacions_reserva_habitacion_id_foreign" foreign key ("reserva_habitacion_id") references "reserva_habitacions" ("id") on delete cascade
CreateHabitacionsTable: alter table "habitacions" add constraint "habitacions_alojamiento_id_foreign" foreign key ("alojamiento_id") references "alojamientos" ("id") on delete cascade
CreatePaquetesTable: create table "paquetes" ("id" serial primary key not null, "reserva_auto_id" integer not null, "reserva_habitacion_id" integer not null, "precio" double precision not null, "descuento" double precision not null, "tipo_paquete" smallint not null, "disponibilidad" boolean not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreatePaquetesTable: alter table "paquetes" add constraint "paquetes_reserva_auto_id_foreign" foreign key ("reserva_auto_id") references "reserva_autos" ("id") on delete cascade
CreatePaquetesTable: alter table "paquetes" add constraint "paquetes_reserva_habitacion_id_foreign" foreign key ("reserva_habitacion_id") references "reserva_habitacions" ("id") on delete cascade
CreateComprasTable: create table "compras" ("id" serial primary key not null, "usuario_id" integer not null, "actividad_id" integer not null, "seguro_id" integer not null, "paquete_id" integer not null, "reserva_auto_id" integer not null, "reserva_habitacion_id" integer not null, "fecha_compra" date not null, "hora_compra" time(0) without time zone not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateComprasTable: alter table "compras" add constraint "compras_usuario_id_foreign" foreign key ("usuario_id") references "users" ("id") on delete cascade
CreateComprasTable: alter table "compras" add constraint "compras_actividad_id_foreign" foreign key ("actividad_id") references "actividads" ("id") on delete cascade
CreateComprasTable: alter table "compras" add constraint "compras_seguro_id_foreign" foreign key ("seguro_id") references "seguros" ("id") on delete cascade
CreateComprasTable: alter table "compras" add constraint "compras_paquete_id_foreign" foreign key ("paquete_id") references "paquetes" ("id") on delete cascade
CreateComprasTable: alter table "compras" add constraint "compras_reserva_auto_id_foreign" foreign key ("reserva_auto_id") references "reserva_autos" ("id") on delete cascade
CreateComprasTable: alter table "compras" add constraint "compras_reserva_habitacion_id_foreign" foreign key ("reserva_habitacion_id") references "reserva_habitacions" ("id") on delete cascade
CreateVuelosTable: create table "vuelos" ("id" serial primary key not null, "ciudad_va_id" integer not null, "ciudad_viene_id" integer not null, "origen" varchar(100) not null, "destino" varchar(100) not null, "precio_vuelo" double precision not null, "cantidad_asientos" smallint not null, "fecha_ida" date not null, "hora_ida" time(0) without time zone not null, "fecha_llegada" date not null, "hora_llegada" time(0) without time zone not null, "duracion_viaje" time(0) without time zone not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateVuelosTable: alter table "vuelos" add constraint "vuelos_ciudad_va_id_foreign" foreign key ("ciudad_va_id") references "ciudads" ("id") on delete cascade
CreateVuelosTable: alter table "vuelos" add constraint "vuelos_ciudad_viene_id_foreign" foreign key ("ciudad_viene_id") references "ciudads" ("id") on delete cascade
CreateAeropuertosTable: create table "aeropuertos" ("id" serial primary key not null, "ciudad_id" integer not null, "nombre_aeropuerto" varchar(100) not null, "calle_aeropuerto" varchar(50) not null, "numero_aeropuerto" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateAeropuertosTable: alter table "aeropuertos" add constraint "aeropuertos_ciudad_id_foreign" foreign key ("ciudad_id") references "ciudads" ("id") on delete cascade
CreateAsientosTable: create table "asientos" ("id" serial primary key not null, "vuelo_id" integer not null, "numero_asiento" smallint not null, "disponibilidad" boolean not null, "tipo_asiento" smallint not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateAsientosTable: alter table "asientos" add constraint "asientos_vuelo_id_foreign" foreign key ("vuelo_id") references "vuelos" ("id") on delete cascade
CreateReservaVuelosTable: create table "reserva_vuelos" ("id" serial primary key not null, "vuelo_id" integer not null, "asiento_id" integer not null, "pasajero_id" integer not null, "ida_vuelta" boolean not null, "cantidad_pasajeros" smallint not null, "tipo_cabina" smallint not null, "fecha_reserva" date not null, "hora_reserva" time(0) without time zone not null, "precio_reserva_vuelo" double precision not null, "cantidad_paradas" smallint not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateReservaVuelosTable: alter table "reserva_vuelos" add constraint "reserva_vuelos_vuelo_id_foreign" foreign key ("vuelo_id") references "vuelos" ("id") on delete cascade
CreateReservaVuelosTable: alter table "reserva_vuelos" add constraint "reserva_vuelos_asiento_id_foreign" foreign key ("asiento_id") references "asientos" ("id") on delete cascade
CreateReservaVuelosTable: alter table "reserva_vuelos" add constraint "reserva_vuelos_pasajero_id_foreign" foreign key ("pasajero_id") references "pasajeros" ("id") on delete cascade
CreateUsuarioMedioDePagosTable: create table "usuario__medio_de_pagos" ("id" serial primary key not null, "user_id" integer not null, "medioDePago_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateUsuarioMedioDePagosTable: alter table "usuario__medio_de_pagos" add constraint "usuario__medio_de_pagos_user_id_foreign" foreign key ("user_id") references "users" ("id") on delete cascade
CreateUsuarioMedioDePagosTable: alter table "usuario__medio_de_pagos" add constraint "usuario__medio_de_pagos_mediodepago_id_foreign" foreign key ("medioDePago_id") references "medio_de_pagos" ("id") on delete cascade
CreatePaqueteReservaVuelosTable: create table "paquete__reserva_vuelos" ("id" serial primary key not null, "paquete_id" integer not null, "reservaVuelo_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreatePaqueteReservaVuelosTable: alter table "paquete__reserva_vuelos" add constraint "paquete__reserva_vuelos_paquete_id_foreign" foreign key ("paquete_id") references "paquetes" ("id") on delete cascade
CreatePaqueteReservaVuelosTable: alter table "paquete__reserva_vuelos" add constraint "paquete__reserva_vuelos_reservavuelo_id_foreign" foreign key ("reservaVuelo_id") references "reserva_vuelos" ("id") on delete cascade
CreateCompraReservaVuelosTable: create table "compra__reserva_vuelos" ("id" serial primary key not null, "compra_id" integer not null, "reservaVuelo_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null)
CreateCompraReservaVuelosTable: alter table "compra__reserva_vuelos" add constraint "compra__reserva_vuelos_compra_id_foreign" foreign key ("compra_id") references "compras" ("id") on delete cascade
CreateCompraReservaVuelosTable: alter table "compra__reserva_vuelos" add constraint "compra__reserva_vuelos_reservavuelo_id_foreign" foreign key ("reservaVuelo_id") references "reserva_vuelos" ("id") on delete cascade
CreateTrigger: 
            CREATE OR REPLACE FUNCTION llenarAsientos()
            RETURNS trigger AS
            $$
                DECLARE
                i INTEGER := 25;
                j INTEGER := 0;
                valor INTEGER := NEW.id;
                BEGIN           
                LOOP 
                    EXIT WHEN j = i;
                    j := j + 1;
                    INSERT INTO asientos( vuelo_id, numero_asiento, disponibilidad,tipo_asiento,created_at) VALUES 
                    (valor, j, true, 1, NEW.created_at );
                END LOOP ;
                RETURN NEW;
            END
            $$ LANGUAGE plpgsql;
        
CreateTrigger: 
        CREATE TRIGGER asiento_Vuelo AFTER INSERT ON vuelos FOR EACH ROW
        EXECUTE PROCEDURE llenarAsientos();
        
CreateUserTrigger: 
        CREATE OR REPLACE FUNCTION asignarRol()
        RETURNS trigger AS
        $$
        BEGIN           
            UPDATE users
            SET rol_id = 1
            WHERE users.id = NEW.id;
            RETURN NEW;
        END
        $$ LANGUAGE plpgsql;
        
CreateUserTrigger: 
        CREATE TRIGGER usuario_rol AFTER INSERT ON users FOR EACH ROW
        EXECUTE PROCEDURE asignarRol();
        
