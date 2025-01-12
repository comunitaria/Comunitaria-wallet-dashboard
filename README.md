# Vestigia Portal

## ¿Qué es Vestigia Portal?

Vestigia Portal es un template para agilizar la creación de páginas web basadas en Codeigniter 4 con AdminLTE.

El proceso para crear una página web bajo Vestigia Portal, asumiendo que tenemos una máquina con LAMP es:
1. Clonar el repositorio en el directorio de documentos de apache
2. Acceder desde un navegador
3. Aparece un cuadro que pide valores iniciales básicos:
   - Url (base)
   - Nombre de la base de datos
   - Nombre del superusuario (usuario con permisos para configurar la web)
   - Clave del superusuario
4. Acceder a la página [URL base]/vpconf
5. Configurar (textos, imágenes, identidad visual, menús, páginas y otros)
6. Editar los controladores y vistas creados, contando con funciones predefinidas para elementos visuales (*helpers* HTML).

En este documento se describen las páginas de configuración y helpers disponibles.

## Instalación

Ubicarse en el directorio de documentos de apache y descargar la última versión de Vestigia Portal:

`git clone https://[usuario]:[clave]@bitbucket.org/vestigiadesarrollo/vstportal.git [pagina]`

Donde:
* *usuario*: nombre de usuario sin signos especiales (p.e. *jcaro@vestigia.io* aparece como *jcarovestigiaio*)
* *clave*: clave de aplicación con permisos para lectura de cuenta y de repositorio (se crea una clave de aplicación en bitbucket entrando en el perfil, Personal settings, App passwords).
* *pagina*: nombre del directorio que vamos a crear con la página

Si es preciso, configurar apache para acceder a este directorio con la URL correspondiente.

Acceder a la URL con un navegador. Aparece un cuadro de diálogo. Cumplimentar:
* URL de la página (debería detectarla)
* Usuario y clave de acceso a MySQL
* Nombre de la base de datos que se creará para la página
* Un nombre de usuario y una clave para el superusuario (el único usuario que puede acceder a configuración)
  
## Configuración de la página

Accediendo a la dirección [URL]/vpconf con el superusuario, se configuran:

* **Datos generales**:
  * Título de la página (en el navegador)
  * Nombre del cliente: texto que aparece en el cuadro superior izquierdo
  
* **Imágenes**
  * Favicon
  * Un fondo para la página de login
  * Logotipo: el que aparece en el cuadro superior izquierdo

* **Identidad visual**
  * Tamaño y fuentes generales
  * Paleta: todos los colores están accesibles como clase bootstrap (texto-[color], bg-[color], etc.). Se puede capturar el color de otra página (una página del cliente, por ejemplo)
  
* **Páginas**
Aquí se crean las páginas
 Estructura
        //   m: menu lateral
        //   e: encabezado (logo)
        //   b: barra superior
        //   B: barra superior fixed
        //   u: cuadro usuario en encabezado
        //   c: menu configuracion
        //   p: pie
        //   P: pie fixed

## Helpers

Se dispone de varios *helpers* para agilizar la construcción de vistas.

### Enlaces
*Modulos\Vpbasicos\enlaces_helper*

Cada helper requiere que se importen una serie de ficheros script y css. No es necesario preocuparse por esto al crear la página. Simplemente se incluyen en el *head* de la vista con:

`<?= inserta_enlaces($enlaces) ?>`

Para que la variable *$enlaces* lleve la lista de enlaces, en el controlador hay que declarar el uso de helpers de la manera estándar con:

`protected $helpers=['enlaces','autorizaciones', 'Modulos\Vpbasicos\navegacion', ...]`

y luego obtener la lista de enlaces y meterlo en $data con 

`enlaces_navegacion($this->data['enlaces']);`

lógicamente, se llama a la vista con `return view('nombre de la vista',$this->data)`

### Navegación
*Modulos\Vpbasicos\navegacion_helper*

### Formularios
*Modulos\Vpbasicos\formularios_helper*

#### formulario
Devuelve el html de un formulario modal, para insertar en la página y luego abrirlo de la manera estándar con, por ejemplo:

`$("#idFormulario).modal("show")`

Se pasan los siguientes parámetros:
* **id**
  Identificador del elemento modal.
* **descripcion**
  Array con los siguientes campos:
  * **titulo** Título del formulario (puede ser html)
  * **campos** Array de campos del formulario
  * **requerido** Expresión javascript que debe devolver *true* o *false*, normalmente en función del valor de los campos (*$("#ipNombre").val()!=''*, por ejemplo). El botón de [Aceptar] del formulario se habilita solo cuando este valor vale *true*. Por defecto, es *'true'*.
  * **aceptar** Es una función escrita en javascript que se ejecutará cuando el usuario haga click en el botón [Aceptar]. Debe incluir el cierre del formulario con `.modal("hide")`. Por defecto, se cierra el formulario simplemente.  

Cada campo del array **campos**, puede tener, a su vez, las propiedades siguientes:
* **id** (Opcionalmente, el *id* del campo puede ponerse como clave del elemento del array). Id del elemento de entrada.
* **tipo** Tipo de elemento de entrada: *text*, *number*, ... (todos los tipos admitidos en un <*input*>, incluido *hidden*), o *select*.
* **label** Mensaje previo al campo de entrada (no se muestra en *tipo=>'hidden'*)
* **opciones** (Solo en *tipo=>'select'*) Array *clave*=>*valor* que se usa como lista de selección. El texto que se muestra es *valor* y el valor que toma el campo es *clave*.
* **valor** Un valor inicial que se mostrará en el campo al abrirse el formulario
    
Ejemplo:

```
formulario('idFormulario',[
      'titulo'=>'Nueva página',
      'requerido'=>
<<<JS
    (campo("Nombre")!='')&&(campo("Controlador")!='')
JS,
      'aceptar'=>
<<<JS
          function(){
                tabla_$id.row.add(valores).draw(false);
                $('#idFormulario').modal('hide');
          }   
JS, 
      'campos'=>[
                  'ipNombre'=>[
                        'tipo'=>'text',
                        'label'=>'Nombre de la página:'
                  ],
                  'ipEstructura'=>[
                        'tipo'=>'text',
                        'label'=>'Disposición:',
                  ],
                  'ipVerbos'=>[
                      'tipo'=>'select',
                      'label'=>'Verbos:',
                      'opciones'=>['g'=>'get','g+p'=>'get+post'],
                      'valor'=>'g'
                  ]
      ]
    ]);
```

### Tablas
*Modulos\Vpbasicos\tabla_helper*

#### tabla
Devuelve el html de una tabla *datatables*, para insertar en la página, además de (opcionalmente) un título y un menú superior para acciones como insertar o eliminar registros. Por defecto, la tabla tiene una primera columna con checkboxes.

Se pasan los siguientes parámetros:
* **id**
  Identificador de los elementos:
  * La tabla: *'tabla_[id]'*
  * Formulario para nuevo elemento: *'frmAnadir--[id]'*
  * Formulario para edición: *'frmEditar--[id]'*
* **descripcion**
  Array con los siguientes campos:
  * **menu** Descriptor del menú superior y título (opcionales) de la tabla
  * **columnas** Array de descriptores de las columnas de la tabla 
  * **estilo** Elementos de estilo
  * **datos** Array de filas de la tabla

El *menu* se describe con los campos:
  * **titulo** Título opcional sobre la tabla
  * **items** Array de items del menú, cada uno de ellos con:
    * **texto** El texto que aparece en el menú (se admite html)
    * **accion** Acción ejecutada por el item (ver abajo descripción de *accion*)

Las *columnas* son un array descriptor de cada campo:
  * **titulo** Texto en la cabecera, aunque se usa como identificador del campo, sustituyendo los espacios por guión bajo.
  * **esIndice** *true* o *false*, opcional, por defecto *false*, indica si el valor es un índice de la tabla (valor único en la tabla)
  * **oculta** *true* o *false*, opcional, por defecto *false*, oculta la columna.
  * **entrada** Define cómo se va a solicitar el valor de esta columna en los formularios de añadir fila o de editar fila:
    * **label** Mensaje que pide el valor
    * **tipo** Tipo de entrada, según se especifica en el helper *formulario*
    * **opciones** Opciones para tipo *select* (ver helper *formulario*)
    * **valor** Valor inicial o por defecto
  * **accion** (Para columnas índice) El valor se vuelve activable (tipo link) y se ejecuta esta acción al hacer clic en él (ver abajo descripción de *accion*)

El *estilo* es una cadena que puede contener las claves:
  * *dark* Tonalidades oscuras (si no, claras)
  * *striped* Alterna colores entre filas pares e impares (si no, mismo fondo)
  * *hover* Al pasar el cursor, la fila se oscurece
  
Finalmente, los *datos* son un array en los que cada fila contiene un array de tantos elementos como columnas se hayan descrito.

Las descripciones de *accion* permiten la edición de los datos. En las acciones predefinidas se realizan dos ediciones consecutivas: primero, una adición, edición o eliminación del lado servidor; luego, si la acción fue exitosa, se replica la acción sobre la tabla en lado cliente. El objetivo es una respuesta más dinámica y elegante que recargar la tabla con un "submit" y un refresco de la página. Los campos que describen un campo *accion* son:
  * **tipo** Existen los tipos predefinidos:
    * *anadir* Se abre un formulario de creación de registro y se envían los datos a la URL indicada
    * *editar* Se abre un formulario de edición de registro y se envían los datos a la URL indicada
    * *eliminar* Todos los registros marcados (checkbox) se eliminarán, tras notificación en la URL
  * **url** URL que realizará la operación del lado servidor (post)
  * **formulario** Propiedades del formulario (tipos *anadir* y *editar*), sobreentendiendo que los *campos* son las columnas de la tabla:
    * **titulo**
    * **requerido**
    * **aceptar**

Ejemplo de definición de tabla:

```
[ 'menu'=>[
        'titulo'=>'Páginas definidas en el proyecto',
        'items' =>[
            [
                'texto'=>'<i class="fas fa-plus pr-2"></i>Nueva',
                'accion'=>[
                    'tipo'=>'anadir',
                    'formulario'=>[
                        'titulo'=>'Nueva página',
                        'requerido'=>
<<<JS
    (campo("Nombre")!='')&&(campo("Controlador")!='')
JS
                        ],
                        'url'=>base_url('/vpconf/anade_pagina')           
                    ]
                ],
                [
                    'texto'=>'Eliminar',
                    'accion'=>[
                        'tipo'=>'eliminar',
                        'url'=>base_url('/vpconf/borra_paginas')           
                    ]
                ],
            ]
        ],
        'columnas'=>[
            [
                'titulo'=>'Nombre',
                'entrada'=>[
                    'tipo'=>'text',
                    'label'=>'Nombre de la página:'
                ],
                'accion'=>[
                    'tipo'=>'editar',
                    'formulario'=>[
                        'titulo'=>'Modificar página',
                        'requerido'=>
<<<JS
(campo("Nombre")!='')&&(campo("Controlador")!='')
JS
                    ],
                    'url'=>base_url('/vpconf/modifica_pagina'),           
                ],
                'esIndice'=>true
            ],
            [
                'titulo'=>'Estructura',
                'entrada'=>[
                        'tipo'=>'text',
                        'label'=>'Disposición:',
                ]
            ],
            [
                'titulo'=>'Controlador',
                'entrada'=>[
                    'tipo'=>'text',
                    'label'=>'Controlador:'
                ]
            ],
            [
                'titulo'=>'Verbos',
                'entrada'=>[
                    'tipo'=>'select',
                    'label'=>'Verbos:',
                    'opciones'=>['g'=>'get','g+p'=>'get+post'],
                    'valor'=>'g'
                ]
            ],
            [
                'titulo'=>'Acceso',
                'entrada'=>[
                    'tipo'=>'text',
                    'label'=>'Permisos requeridos (separados por coma, 0=todos):'
                ]
            ],
          ],
        'estilo'=>'hover dark striped',
        'datos'=>$paginas]
```

