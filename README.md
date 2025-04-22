# Centro de Bienestar – Sistema de Reservas

Este proyecto es una aplicación web desarrollada como parte del curso **Seguridad en Aplicaciones**, de la Universidad de Manizales. Permite a los usuarios registrarse, iniciar sesión y agendar servicios en un centro de bienestar.

## ✨ Funcionalidades principales

- Registro de usuario con validaciones (edad, tarjeta de crédito, contraseña segura)
- Inicio de sesión con autenticación mediante sesiones
- Encriptación de contraseñas con `password_hash()`
- Protección contra SQL Injection usando consultas preparadas
- Creación de reservas seleccionando fecha, hora y servicio
- Visualización de reservas activas
- Redirecciones automáticas y control de acceso a páginas privadas

## 🔐 Tecnologías utilizadas

- PHP
- MySQL
- JavaScript
- Bootstrap 5
- XAMPP (entorno local)

## 🧾 Estructura de archivos

## 🧾 Estructura de archivos

```
/centro_bienestar
├── login.php
├── registro_usuario.php
├── crear_reserva.php
├── ver_reservas.php
├── logout.php
├── db.php
```


## 🚀 Instalación local

1. Clona el repositorio o descarga los archivos ZIP
2. Coloca la carpeta `centro_bienestar` dentro de `htdocs` en XAMPP
3. Crea la base de datos en phpMyAdmin y ajusta las credenciales en `db.php`
4. Abre el navegador en `http://localhost/centro_bienestar`

## 👩‍💻 Autora

**Lesli Tatiana Morales Valencia**  
Estudiante de Tecnología en Desarrollo de Software  
Universidad de Manizales  
2025

