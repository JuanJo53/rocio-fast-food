-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2021-11-01 18:41:41.636

-- foreign keys
ALTER TABLE detalle_venta
    DROP FOREIGN KEY detalle_venta_productos;

ALTER TABLE detalle_venta
    DROP FOREIGN KEY detalle_venta_ventas;

ALTER TABLE productos
    DROP FOREIGN KEY productos_categorias;

ALTER TABLE productos
    DROP FOREIGN KEY productos_proveedores;

ALTER TABLE usuarios
    DROP FOREIGN KEY usuarios_roles;

ALTER TABLE ventas
    DROP FOREIGN KEY ventas_clientes;

ALTER TABLE ventas
    DROP FOREIGN KEY ventas_usuarios;

-- tables
DROP TABLE categorias;

DROP TABLE clientes;

DROP TABLE detalle_venta;

DROP TABLE productos;

DROP TABLE proveedores;

DROP TABLE roles;

DROP TABLE usuarios;

DROP TABLE ventas;

-- End of file.

