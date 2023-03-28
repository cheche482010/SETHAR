CREATE TABLE log_cambios (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    tabla_afectada VARCHAR(50),
    fecha_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    descripcion VARCHAR(255)
);

CREATE TRIGGER registro_cambios
AFTER INSERT, UPDATE, DELETE ON plantas
FOR EACH ROW
BEGIN
    INSERT INTO log_cambios (tabla_afectada, descripcion)
    VALUES ('plantas', CONCAT(OLD.id, ' -> ', NEW.id));
END;

CREATE TRIGGER registro_consultas
AFTER UPDATE ON plantas
FOR EACH ROW
BEGIN
    INSERT INTO log_cambios (tabla_afectada, descripcion)
    VALUES ('plantas', CONCAT('Consulta SQL: ', @consulta_sql));
END;
