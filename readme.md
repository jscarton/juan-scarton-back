# Task 1: Juan Scarton' Senior Backend Developer Challange 

## Instalación

- clone o descargue el repo en su webroot (asegurese que su webserver apunte al directorio public de este repositorio)
- ejecute composer install o composer update para instalar las dependencias de laravel
- si no existe el archivo .env en la raiz de la aplicación creelo a partir del archivo .env.example 
- asegurese que la url configurada en el archivo .env se corresponda con la url en su servidor
- ejecute la instrucción ./artisan key:generate para generar el key de encriptamiento de laravel.
- apunte su navegador a la url del app

## Uso de la interfaz Web

- dirijase a la url. se le presentará una interfaz grafica que le permitira ingresar la descripción de los casos de prueba
![UI DE LA SOLUCION](https://raw.githubusercontent.com/jscarton/juan-scarton-back/master/readme-images/ui.png)
- haciendo clic en el botón "Run challenge" recibirá los resultados en la sección de output.

## Descripción de la solución

Observe el siguiente gráfico:

![DIAGRAMA DE CAPAS](https://raw.githubusercontent.com/jscarton/juan-scarton-back/master/readme-images/layers.png)

### Capa de Control (Controller)
Su responsabilidad es interactuar con el usuario del App. Es gestionada por la clase ChallengeController ubicada en el archivo app/http/controllers/ChallengeController.php. Ofrece al usuario 2 métodos de entrada vía Web. El usuario puede apuntar al index (“/”) donde se le presentará un formulario para ingresar la descripción de los casos de prueba o realizar directamente un POST con la variable user_input conteniendo la descripción de los casos de prueba a la dirección del api (“/api”).

### Capa Modelo (Model)
Esta capa se implementa a través de la clase Cube.
La clase Cube es un contenedor de puntos y se encarga de gestionarlos (crearlos y
actualizarlos) y realizar los querys sobre el conjunto de puntos del Cubo. Está ubicada en app/Cube.php.

### Capa Vista (View)
Es la encargada de procesar la salida de las dos acciones que realiza la App.

El layout principal se define en resources/views/layouts/app.blade.php y define la estructura
basica del HTML a mostrar en el index de la App (“/”). Incluye codigo Javascript y CSS
ubicado en el directorio public/ y tambien las liberias de jQuery y FontAwesome para
mejorar la usabilidad e imagen del formulario.

El formulario de entrada se encuentra en el archivo resources/views/hackerrank/index.blade.php. Define la estructura del formulario de entrada.

Adicionalmente la acción “/api” utiliza la clase JsonResponse de Laravel para generar su salida.

Todas estas capas yacen sobre Laravel 5.5 y PHP 7.

## Testing

En el directorio test/ se incluyen algunos casos de prueba sencillos usando phpunit y las
interfaces provistas por Laravel.

Para ejecutarlo se debe tener instalado PHPUnit y ejecutar el comando phpunit.
