-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2021-11-19 00:56:31.249

-- tables
-- Table: categorias
CREATE TABLE categorias (
    cat_id bigint NOT NULL AUTO_INCREMENT,
    cat_categoria varchar(50) NOT NULL,
    cat_estado int NOT NULL COMMENT '0: DELETED
1: ACTIVE',
    CONSTRAINT categorias_pk PRIMARY KEY (cat_id)
);

-- Table: clientes
CREATE TABLE clientes (
    cl_id bigint NOT NULL AUTO_INCREMENT,
    cl_cliente varchar(40) NOT NULL,
    cl_documento varchar(10) NOT NULL,
    cl_estado int NOT NULL COMMENT '0: DELETED
1: ACTIVE',
    CONSTRAINT clientes_pk PRIMARY KEY (cl_id)
);

-- Table: detalle_venta
CREATE TABLE detalle_venta (
    dv_id bigint NOT NULL AUTO_INCREMENT,
    dv_cantidad int NOT NULL,
    dv_subtotal double(12,2) NOT NULL,
    dv_estado int NOT NULL COMMENT '0: DELETED
1: ACTIVE',
    vent_id bigint NOT NULL,
    prod_id bigint NOT NULL,
    CONSTRAINT detalle_venta_pk PRIMARY KEY (dv_id)
);

-- Table: productos
CREATE TABLE productos (
    prod_id bigint NOT NULL AUTO_INCREMENT,
    prod_nombre varchar(255) NOT NULL,
    prod_descripcion varchar(255) NOT NULL,
    prod_precio numeric(6,2) NOT NULL,
    prod_existencia int NOT NULL,
    prod_imagen longblob NOT NULL,
    prod_estado int NOT NULL COMMENT '0: DELETED
1: ACTIVE',
    cat_id bigint NOT NULL,
    prov_id bigint NOT NULL,
    CONSTRAINT productos_pk PRIMARY KEY (prod_id)
);

-- Table: proveedores
CREATE TABLE proveedores (
    prov_id bigint NOT NULL AUTO_INCREMENT,
    prov_proveedor varchar(50) NOT NULL,
    prov_direccion varchar(70) NOT NULL,
    prov_correo varchar(50) NOT NULL,
    prov_contacto varchar(20) NOT NULL,
    prov_estado int NOT NULL COMMENT '0: DELETED
1: ACTIVE',
    CONSTRAINT proveedores_pk PRIMARY KEY (prov_id)
);

-- Table: roles
CREATE TABLE roles (
    rol_id bigint NOT NULL AUTO_INCREMENT,
    rol_nombre varchar(40) NOT NULL,
    rol_estado int NOT NULL COMMENT '0: DELETED
1: ACTIVE',
    CONSTRAINT roles_pk PRIMARY KEY (rol_id)
);

-- Table: usuarios
CREATE TABLE usuarios (
    usr_id bigint NOT NULL AUTO_INCREMENT,
    usr_nombre_completo varchar(50) NOT NULL,
    usr_direccion varchar(50) NOT NULL,
    usr_correo varchar(50) NOT NULL,
    usr_contacto varchar(20) NOT NULL,
    usr_usuario varchar(20) NOT NULL,
    usr_password varchar(70) NOT NULL,
    usr_estado int NOT NULL COMMENT '0: DELETED
1: ACTIVE',
    rol_id bigint NOT NULL,
    CONSTRAINT usuarios_pk PRIMARY KEY (usr_id)
);

-- Table: ventas
CREATE TABLE ventas (
    vent_id bigint NOT NULL AUTO_INCREMENT,
    ven_fecha date NOT NULL,
    ven_total double(12,2) NOT NULL,
    ven_estado int NOT NULL COMMENT '0: DELETED
1: ACTIVE',
    cl_id bigint NOT NULL,
    usr_id bigint NOT NULL,
    CONSTRAINT ventas_pk PRIMARY KEY (vent_id)
);

-- foreign keys
-- Reference: detalle_venta_productos (table: detalle_venta)
ALTER TABLE detalle_venta ADD CONSTRAINT detalle_venta_productos FOREIGN KEY detalle_venta_productos (prod_id)
    REFERENCES productos (prod_id);

-- Reference: detalle_venta_ventas (table: detalle_venta)
ALTER TABLE detalle_venta ADD CONSTRAINT detalle_venta_ventas FOREIGN KEY detalle_venta_ventas (vent_id)
    REFERENCES ventas (vent_id);

-- Reference: productos_categorias (table: productos)
ALTER TABLE productos ADD CONSTRAINT productos_categorias FOREIGN KEY productos_categorias (cat_id)
    REFERENCES categorias (cat_id);

-- Reference: productos_proveedores (table: productos)
ALTER TABLE productos ADD CONSTRAINT productos_proveedores FOREIGN KEY productos_proveedores (prov_id)
    REFERENCES proveedores (prov_id);

-- Reference: usuarios_roles (table: usuarios)
ALTER TABLE usuarios ADD CONSTRAINT usuarios_roles FOREIGN KEY usuarios_roles (rol_id)
    REFERENCES roles (rol_id);

-- Reference: ventas_clientes (table: ventas)
ALTER TABLE ventas ADD CONSTRAINT ventas_clientes FOREIGN KEY ventas_clientes (cl_id)
    REFERENCES clientes (cl_id);

-- Reference: ventas_usuarios (table: ventas)
ALTER TABLE ventas ADD CONSTRAINT ventas_usuarios FOREIGN KEY ventas_usuarios (usr_id)
    REFERENCES usuarios (usr_id);

-- End of file.

