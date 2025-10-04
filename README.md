# CashHack

*Aplicación web financiera que te permite administrar todas tus cuentas en un sólo sitio.*

## Comenzando 🚀

*Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas.*

### Pre-requisitos 📋

*Necesitas tener GIT instalado en tu ordenador, para verificar si lo tienes instalado debes ejecutar el siguiente comando:*

```
$ git version
```

*Sino instalalo con el siguiente comando:*

```
$ sudo apt-get install git
```

### Instalación 🔧

*Este es el paso a paso el cual debes ejecutar para tener un entorno de desarrollo ejecutandose*

*Despues de haber instalado y verificado la versión de GIT, lo primero por hacer es clonar el repositorio con el siguiente comando *

```
$ git clone https://jorgeninordev21@bitbucket.org/dev-jesus/cashhack.git
```

*Despues de haber clonado el repositorio lo abrimos en VSCode y configuramos los parametros para conectarnos con la Base de Datos en el archivo "classes.data.php" ubicado en "/path-to-the-file/cashhack/model/classes/" , se va a modificar la clase "data" con lo siguiente:*

```
public $host = "127.0.0.1";
public $port = "5432";
public $user = ""; // Nombre de usuario
public $pass = ""; // Password del usuario
public $dbName = "cashhack"; // Nombre de la base de datos
```

Luego de haber cambiado los parametros nos dirigimos a la dirección:

```
http://localhost/cashhack/
```

y hacemos click para registrarnos y verificar que se esta conectando a la Base de Datos.

### Funcionalidades 📄

- Login
  
- Registro
  
- Recuperar Clave
  
- Dashboard
  
- Productos
  
- Productos / Crear Cuenta
  
- Productos / Modificar Cuenta
  
- Productos / Inactivar Cuenta
  
- Productos / Activar Cuenta
  
- Productos / Eliminar Cuenta
  
- Productos / Cargar Movimientos
  
- Movimientos
  
- Movimientos / Cargar Movimientos
  
- Movimientos / Exportar Movimientos
  
- Movimientos / Exportar Movimientos EXCEL
  
- Movimientos / Exportar Movimientos CSV
  
- Movimientos / Exportar Movimientos PDF
  
- Movimientos / Exportar Movimientos IMPRIMIR
  
- Movimientos / Ver-Editar Movimiento
  
- Movimientos / Filtros
  
- Conciliación
  
- Contabilidad [Por desarrollar]
  

## Construido con 🛠️

- [PHP](https://www.php.net/docs.php) - Lenguaje de código abierto muy popular para el desarrollo web.
- [JavaScript](https://www.javascript.com/) - Lenguaje de programación ligero, interpretado, o compilado.
- [PostgreSQL](https://www.postgresql.org/) - Manejador de Base de Datos
- [Bootstrap](https://getbootstrap.com/) - Biblioteca multiplataforma de estilos adaptables.

## Autores ✒️

*Desarrollador:*

- **Jorge Niño** - *Desarrollador Frontend*

---

⌨️ con ❤️ por Jorge Niño 😊
