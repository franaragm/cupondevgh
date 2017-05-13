# Proyecto CUPON en symfony 2.8

1. Crear base de datos y configurar parametros en parameters.yml
2. Instalar dependencias
3. Crear estructura de tablas
4. Cargar datos de prueba básicos

``
$ composer install
``

``
$ php app/console doctrine:schema:create
``

``
$ php app/console doctrine:fixtures:load --fixtures=app/Resources
``

### Otros comandos útiles

* Limpiar cache:

 `$ php app/console cache:clear --env=prod`

* Actualizar estructura de tablas sin afectar a los datos

`$ php app/console doctrine:schema:update --force`


*Fran Aragón Mesa*