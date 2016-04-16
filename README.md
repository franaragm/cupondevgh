# Proyecto CUPON en symfony 2.8

1. Crear base de datos y configurar parametros en parameters.yml
2. Actualizar dependencias
3. Crear estructura de tablas
4. Cargar datos de prueba básicos

``
$ composer update
``

``
$ php app/console doctrine:schema:create
``

``
$ php app/console doctrine:fixtures:load --fixtures=app/Resources
``

`
$ php app/console cache:clear --env=prod
`

*Fran Aragón Mesa*