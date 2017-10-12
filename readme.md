# Juan Scarton' Senior Backend Developer Challange for Rappi 

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

# Code Refactoring task

Mi versión del codigo refactorizado seria la siguiente:
```php
//Inicio del codigo
/**
*	post_confirm: este metodo es realmente sorprendente!!!
*	@param $service_id int sirve para muchas cosas
*	@param $driver_id string tambien sirve para muchas cosas
*/
public function post_confirm($service_id, $driver_id)
{
 	$servicio= Service::find($service_id);
 	if (!is_null($servicio))
 	{
 		if ($servicio->status_id==6)
 			return Response::json(['error'=>2]);

 		if (is_null($servicio->driver_id) && $servicio->status_id==1){
 			//update the service
 			$servicio= Service::update($service_id,['driver_id'=>$driver_id,'status_id'=>2]);
 			//update the driver
 			Driver::update($driver_id,['available'=>0]);
 			$driverTmp=Driver::find($driver_id);
 			//update the car
 			Service::update($service_id,['car_id'=>$driverTmp->car_id]);
 			//notify the user
 			if (!empty($servicio->user->uuid)){
 				if ($servicio->user->type==1)
 					$result=Push::make()->ios($servicio->user->uuid,"Tu servicio ha sido confirmado!",1,'honk.wav','Open',['serviceID'=>$servicio->id]); //IOS
 				else
 					$result=Push::make()->android2($servicio->user->uuid,"Tu servicio ha sido confirmado!",1,'default','Open',['serviceID'=>$servicio->id]); //ANDROID 
 			}
 			return Response::json(['error'=>0]);
 		}
 		else
 			return Response::json(['error'=>1]);
 	}
 	else
 		return Response::json(['error'=>3]);
}
//final del código
```
## Malas prácticas evidenciadas en el Codigo:
* No hay descripción de que hace el método ni que significan sus parámetros.
* No valida si los parametrós service_id y driver_id estan presentes antes de intentar ejecutar el código.
* Código comentado en medio de llamadas a funciones. Usando un controlador de versiones como GIT se puede eliminar el código antiguo con confianza de poder volver a él si es necesario ya que queda en el historial del archivo.
* Código de retorno redundante en las notificaciones. Si el uuid del user es vacío simplemente no debería ejecutar las notificaciones y seguir a la línea donde retorna error=0.

## Mi refactorizacion agrega lo siguiente:
* Descripción del metodo y parametros que recibe.
* Utiliza el framework para poder permitir inyectar los parametros en el método. Adicionalmente el framework comprobará que estos parametros esten presentes antes de intentar ejecutar el método.
* Elimina codigo comentado para evitar confundir a otros colegas desarrolladores.
* elimina codigo redundante.
* elimina la llamada array y la cambia por la versión mas actualizada []
* Valida si el uuid existe antes de ejecutar las notificaciones y al final retorna lo que tiene que retornar 
* Con una descripción mas detallada de lo que hace el metodo creo se podria saber si en lugar de [‘error’=>0] se debería retornar el valor de $result.


# Q&A (Preguntas y Respuestas)

## 1.- ¿En qué consiste el principio de responsabilidad única? ¿Cuál es su propósito?

El principio de responsabilidad, es un concepto de OOP que básicamente define que cada clase dentro de la aplicación debe tener un solo propósito o razón de ser. Su proposito principal es hacer que el código sea de facil mantenimiento pues al tener varias acciones no relacionadas entre sí dentro de una clase estamos en presencia de multiples propositos y en caso de que uno de esos propósitos cambie podríamos vernos en la necesidad de modificar no solo una clase sino todas las clases que dependan de esa clase principal.

Separando las clases en unidades con un unico propósito nos aseguramos que el código sea mantenible en el tiempo y que los costos de mantenimiento de ese código estén controlados.

## 2.- ¿Qué características tiene según tu opinión “buen” código o código limpio?

Entre muchas que podria enunciar:
* Contiene comentarios y descripciones que dejan claro el objetivo de cada fragmento de código.
* No contiene código fuente comentado.
* Realiza las validaciones necesarias y el manejo de errores necesario.
* Es susceptible de ser testeado por cualquiera de los métodos de testing habituales.
* En caso de aplicaciones usando el paradigma MVC, el codigo limpio mantiene la separación de capas de manera que un desarrollador que tenga que mantener ese codigo puede ubicar cada parte de la aplicación facilmente.
* Clases y metodos deben contener nombres que no dejen lugagr a dudas a su proposito.
* Los comentarios dentro del código son cortos y precisos a la hora de transmitir información acerca del código al que están relacionados y estan ubicados de manera que no compliquen la lectura del mismo.
