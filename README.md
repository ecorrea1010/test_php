# Proyecto API de Tareas con PHP y Docker

Este proyecto es una API simple para crear, listar, actualizar y eliminar tareas, desarrollada en PHP y ejecutada con Docker.

## Requisitos

- Tener instalado **Docker** y **Docker Compose** en tu equipo.

## Iniciar el proyecto

1. Clona este repositorio.
2. En la raíz del proyecto, ejecuta:

```bash
docker-compose up -d --build
```

## Iniciar la base de datos
Una vez levantados los contenedores, por favor sigue estos pasos para crear la tabla de la base de datos:

1. Ingresa al contenedor de la base de datos
```bash
docker exec -it db_app bash
```

2. Accede a MariaDB
```bash
mysql -u root -p
```
Se le pedirá la contraseña, ingresa: root

3. Cambia a la base de datos del proyecto
```bash
USE db_php;
```

Una vez en la base de datos del proyecto copia el contenido del archivo sql_table.sql ubicado en la raiz del proyecto y ejecutalo

## Endpoints disponibles
Estos son los endpoints disponibles

/tasks GET
/tasks/{id} GET
/tasks POST
/tasks/{id} PUT
/tasks/{id} DELETE

# Ejemplo de uso
POST
```bash
curl -X POST http://localhost:8080/tasks \
  -H "Content-Type: application/json" \
  -d '{"name":"", "description":""}'
```