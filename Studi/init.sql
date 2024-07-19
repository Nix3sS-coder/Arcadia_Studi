CREATE DATABASE IF NOT EXISTS arcadia;
USE arcadia;

-- Inclure d'autres scripts SQL
SOURCE /docker-entrypoint-initdb.d/create_tables.sql;
