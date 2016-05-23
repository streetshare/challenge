CHALLENGE "CUBE SUMMATION"

El proyecto se desarrolló sobre PHP, html y jQuery, bajo el framework MVC Codeigniter. A continuación menciono los archivos utilizados y su respectiva responsabilidad:
	* application/controllers/home.php -> La clase home se utiliza para cargar la vista del proyecto.
	* application/views/home.php -> La vista home muestra todos los cambos necesarios para el reto.
	* application/controllers/amf/services/service.php -> La clase Service se utiliza como punto de entrada 	hacia los servicios que operan el reto.
	* application/models/operations.php -> El model Operations se encarga de realizar los calculos y las consultas pertinentes de la información.
	* application/models/persistence.php -> El modelo Persistence se encarga de mantener la informacion 	durante el tiempo necesario, ya que se almacena en sesion.

Dentro de los documentos adjuntos en el presente repositorio se encuentran el codigo original que se debe refactorizar y el refactorizado, y finalmente las respuestas al cuestionario enviado.

Si el sistema presenta problemas al momento de ejecutarlo, basta con implementar el .htacess que se encuentra en el zip del proyecto
