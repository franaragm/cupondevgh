<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test funcional para comprobar que funciona bien el registro de usuarios
 * en el frontend, además del perfil y el proceso de baja del usuario.
 */
class UsuarioControllerTest extends WebTestCase
{
    /**
     * @dataProvider usuarios
     *
     * @param $usuario
     */
    public function testRegistroPerfilBaja($usuario)
    {
        $client = static::createClient();
        $client->followRedirects(true);

        $crawler = $client->request('GET', '/');

        // Registrarse como nuevo usuario
        $enlaceRegistro = $crawler->selectLink('Regístrate ya')->link();
        $crawler = $client->click($enlaceRegistro);

        // Se comprueba que se ha cargado la pagina con el formulario de registro
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Regístrate gratis como usuario")')->count(),
            'Después de pulsar el botón Regístrate de la portada, se carga la página con el formulario de registro'
        );

        $formulario = $crawler->selectButton('Registrarme')->form($usuario);
        $crawler = $client->submit($formulario);
        $this->assertTrue($client->getResponse()->isSuccessful());

        // Comprobar que el cliente ahora dispone de una cookie de sesión
        $this->assertRegExp(
            '/(\d|[a-z])+/',
            $client->getCookieJar()->get('MOCKSESSID', '/', 'localhost')->getValue(),
            'La aplicación ha enviado una cookie de sesión'
        );

        // Acceder al perfil del usuario recién creado
        $perfil = $crawler->filter('.dropdown-menu')->selectLink('Ver mi perfil')->link();

        $crawler = $client->click($perfil);
        $this->assertEquals(
            $usuario['usuario[email]'],
            $crawler->filter('form input[name="usuario[email]"]')->attr('value'),
            'El usuario se ha registrado correctamente y sus datos se han guardado en la base de datos'
        );
    }

    /**
     * Método que provee de usuarios de prueba a los tests de esta clase.
     */
    public function usuarios()
    {
        return array(
            array(
                array(
                    'usuario[nombre]' => 'Anónimo',
                    'usuario[apellidos]' => 'Apellido1 Apellido2',
                    'usuario[email]' => 'anonimo'.uniqid('', true).'@localhost.localdomain',
                    'usuario[passwordEnClaro][first]' => 'anonimo1234',
                    'usuario[passwordEnClaro][second]' => 'anonimo1234',
                    'usuario[direccion]' => 'Mi calle, Mi ciudad, 01001',
                    'usuario[dni]' => '11111111H',
                    'usuario[numeroTarjeta]' => '4607391345528949',
                    'usuario[ciudad]' => '16',
                    'usuario[permiteEmail]' => '1',
                ),
            ),
        );
    }

}