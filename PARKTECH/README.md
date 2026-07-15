# 🚗 ParkTech

> Sistema de Parqueadero Inteligente desarrollado para la asignatura **Ingeniería de Software I** de la **Universidad Nacional de Colombia – Sede Manizales**.

ParkTech es una aplicación web diseñada para gestionar las operaciones básicas de un parqueadero mediante el registro de vehículos, el control de entradas y salidas, la administración de usuarios, la gestión de espacios disponibles y el cálculo automático de tarifas según el tipo de vehículo y el tiempo de permanencia.

---

## 👥 Integrantes

* **Salomé Arroyave Urrea**
* **Cristian Alexander Bermúdez Correa**
* **Carlos Francisco Moreno Casas**

---

## 📚 Información del Proyecto

| Elemento | Información |
| :--- | :--- |
| **Proyecto** | ParkTech |
| **Asignatura** | Ingeniería de Software I |
| **Universidad** | Universidad Nacional de Colombia – Sede Manizales |
| **Arquitectura** | Monolítica (MVC) |
| **Framework** | Laravel |
| **Base de datos** | MySQL |

---

## 🎯 Objetivo

Desarrollar una aplicación web que permita administrar eficientemente un parqueadero mediante el control de usuarios, vehículos, espacios de parqueo y registros de ingreso y salida, automatizando el cálculo de tarifas y facilitando la gestión administrativa.

---

## ✨ Funcionalidades

El sistema cuenta con los siguientes módulos:

* 🔐 **Autenticación:** Control de acceso y roles de usuarios.
* 👤 **Gestión de usuarios:** Administración de cuentas del personal.
* 🚗 **Gestión de vehículos:** Registro y control de datos de vehículos.
* 🚙 **Tipos de vehículo:** Clasificación para tarifas personalizadas.
* 🅿️ **Espacios de parqueo:** Control de plazas disponibles en tiempo real.
* 📥 **Registro de ingresos:** Control y asignación de espacio al entrar.
* 📤 **Registro de salidas:** Control de egreso de vehículos.
* 💰 **Tarifación:** Cálculo automático según el tiempo transcurrido.
* 📊 **Cupos:** Visualización del estado del parqueadero.
* 📄 **Reportes:** Generación de información administrativa.

---

## 🛠 Tecnologías Utilizadas

| Tecnología | Descripción |
| :--- | :--- |
| **Laravel** | Framework de desarrollo web (PHP) |
| **PHP** | Lenguaje de programación del lado del servidor |
| **MySQL** | Sistema gestor de base de datos |
| **Bootstrap 5** | Framework para el diseño de la interfaz gráfica |
| **HTML5 & CSS3** | Estructura y diseño de las vistas |
| **JavaScript** | Dinamismo y funcionalidades del lado del cliente |
| **Git & GitHub** | Control de versiones y repositorio |
| **Composer** | Gestor de dependencias de PHP |
| **Laragon** | Entorno de desarrollo local recomendado |

---

## 🏛 Arquitectura

ParkTech fue desarrollado utilizando una **arquitectura monolítica**, implementando el patrón **Modelo-Vista-Controlador (MVC)** proporcionado por Laravel. 

Esta estructura separa de forma clara la lógica de negocio, la interfaz de usuario y el acceso a la base de datos, facilitando el mantenimiento y la escalabilidad del sistema.

---

## 📂 Estructura del Proyecto

```text
PARKTECH
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
├── storage/
├── tests/
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md