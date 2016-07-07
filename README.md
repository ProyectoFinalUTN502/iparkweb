# iParkWeb
Repostorio Aplicacion Web para proyecto iParking

## Directorios

- Aplication: Archivos propios de la aplicacion. Configuracion, Controllers, etc..
- System: Framework MVC que da soporte al desarollo de la Aplicacion. Incluye ORM
- DB: Archivos **.sql** para creacion y configuracion de BD. Existen dos principales, el
*create.sql*, que realiza la creacion del esquema, con sus tablas correspondients y el 
*init.sql*, que realiza la carga inicial de datos

## Despliegue en Netbeans (8.0.x)

- Ir a Team->Git->Clone 
- En la URL ponen la copiada del Repo online y de Usuario y Password el que les di yo por WA
- Se lo clonan a alguna carpeta que les guste. Una vez clonado, 
les va a decir que no encuentra proyecto. Le va a preguntar si quieren crear uno
le dan "Crear"
- Crean un proyecto (PHP Aplication para PHP 5.6), siempre dentro del directorio 
de la aplicacion (Hay un gitignore que va a ignorar toda la meta data del proyecto
para que no se suba al repo)
- A menos que tengan que agregar algun puerto en el Apache o algo asi, ya estan. 
(Si tienen una configuracion distinta, me avisan)

## Despliegue en MySQL

- Instalar MySQL Workbench 6.0 
- Conectarse a la DB (pueden elegir la local, alguna que tengan en algun server, lo
que mas bronca les de)
- Una vez conectados, van a File->Open SQL Script y eligen el que esta en la carpeta
del proyecto, en la subcarpeta /DB. El primer archivo que tienen que ejecutar se 
llama **create.sql**. Lo abren, y lo corren. 
- Idem paso anterior pero con el archivo **init.sql**

## Usando la Aplicacion

Para Loguearse:  

USR : La primer letra de su nombre y su apellido completo y en minusculas  
PSW : 123456  

Pantalla Principal:  

La pantalla principal, solo tiene los menues asociados al rol que cumplen en la 
plataforma. Como nuestros usuarios son Administradores, van a tener casi todas
las opciones menos Editar Establecimiento y Actualizar Tarifas que eso les corresponde
a los clientes. A partir de la pagina principal, vayan navegando por la aplicacion
y jugando un poco con los registros. A medida que vaya subiendo funcionalidades nuevas
voy a ir actualizando este archivo.  
Ahi se ven

