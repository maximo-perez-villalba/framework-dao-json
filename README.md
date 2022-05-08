# framework-dao-json
El proyecto implementa una extensión del framework `maximo-perez-villalba/framework-dao` para persistencia de objetos en archivos con formato Json. Para ver el proyecto padre ir a [framework-dao](https://github.com/maximo-perez-villalba/framework-dao). Y aunque su fin principal es de apoyo pedagógico, la extensión es completamente funcional.


## Instalación
Se puede instalar `framework-dao-json` a través de Composer.

1 Desde una consola de comandos ir al directorio del proyecto y ejecutar:
```
composer require maximo-perez-villalba/framework-dao-json
```

2 También agregando en el archivo `composer.json`, dentro de la sección  `"require"`.
```
"require": {
  "maximo-perez-villalba/framework-dao-json": ">=1.0.0"
},
```
2.1 Luego desde una consola de comandos ejecutar:
```
composer update
```


## Documentación
### Extensión DAO para persistencia de objetos en archivos con formato Json (DAOJson)
Esta extensión implementa a través de la [clase DAOJson](src/framework/dao/json/DAOJson.php) el CRUD definido en la [clase DAO](https://github.com/maximo-perez-villalba/framework-dao/blob/main/src/framework/dao/DAO.php), para persistir objectos en un repositorio con formato Json  usando la componente [code.max/tool-repository-json](https://gitlab.com/code.max/tool-repository-json). A su vez la clase DAOJson incorpora métodos específicos para la recuperación de datos desde el repositorio.


![image:uml-class-daojson.png](/docs/uml-class-framework-dao-json.png)

El diagrama de clases muestra el diseño de implementación de la extensión DAOJson, donde **los objetos de modelo** deben extender de la [clase PersistentJson](/src/framework/dao/json/PersistentJson.php). La clase PersistentJson implementa la interfaz IRepositoryObject que define que los objetos que pueden ser guardados en el repositorio deben tener definido el método `guid` (Global Unique Identificator).
 
#### Como se usa
```
<?php
// Para obtener una instancia de la clase DAOJson.
$dao = new DAOJson( $somethingPersistentJson );

// También puedo obtener una instancia de la clase DAOJson desde el objeto persistible. 
$dao = $somethingPersistentJson->dao();

// Para guardar una nueva instancia de la clase Something en el repositorio.
$dao->create();

// Para sincronizar los cambios de un objeto de modelo.
$dao->update();

// Para borrar un objeto de modelo.
$daodb->delete();

// Para recuperar un objeto de modelo almacenado en formato objeto de la clase PersistentJson.
$something = DAOJson::getObjectByGuid( 'aGlobalUniqueIdentificator' );

// Para recuperar datos almacenados en formato mapa de arreglos .
$list = DAOJson::read( 'class', ['class'=>'aFullClassname'] );

// Para recuperar objetos almacenados en formato mapa de objetos.
$list = DAOJson::listByClass( 'aFullClassname' );
```

