<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        'Auth' => array(
            'loginAction' => array('controller' => 'usuarios', 'action' => 'login'),
            'authError' => 'Debe iniciar sesión',
            'loginRedirect' => '/',
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Usuario',
                    'fields' => array('username' => 'usuario')
                )
            )
        ),
        'Session'
    );

    public $helpers = array('Form');
    private $paises = array('Afganistan','Africa del Sur','Albania','Alemania','Andorra','Angola','Antigua y Barbuda','Antillas Holandesas','Arabia Saudita','Argelia','Argentina','Armenia','Aruba','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarusia','Belgica','Belice','Benin','Bermudas','Bolivia','Bosnia','Botswana','Brasil','Brunei Darussulam','Bulgaria','Burkina Faso','Burundi','Butan','Camboya','Camerun','Canada','Cape Verde','Chad','Chile','China','Chipre','Colombia','Comoros','Congo','Corea del Norte','Corea del Sur','Costa de Marfíl','Costa Rica','Croasia','Cuba','Dinamarca','Djibouti','Dominica','Ecuador','Egipto','El Salvador','Emiratos Arabes Unidos','Eritrea','Eslovenia','España','Estados Unidos','Estonia','Etiopia','Fiji','Filipinas','Finlandia','Francia','Gabon','Gambia','Georgia','Ghana','Granada','Grecia','Groenlandia','Guadalupe','Guam','Guatemala','Guayana Francesa','Guerney','Guinea','Guinea-Bissau','Guinea Equatorial','Guyana','Haiti','Holanda','Honduras','Hong Kong','Hungria','India','Indonesia','Irak','Iran','Irlanda','Islandia','Islas Caiman','Islas Faroe','Islas Malvinas','Islas Marshall','Islas Solomon','Islas Virgenes Britanicas','Islas Virgenes (U.S.)','Israel','Italia','Jamaica','Japon','Jersey','Jordania','Kazakhstan','Kenia','Kiribati','Kuwait','Kyrgyzstan','Laos','Latvia','Lesotho','Libano','Liberia','Libia','Liechtenstein','Lituania','Luxemburgo','Macao','Macedonia','Madagascar','Malasia','Malawi','Maldivas','Mali','Malta','Marruecos','Martinica','Mauricio','Mauritania','Mexico','Micronesia','Moldova','Monaco','Mongolia','Mozambique','Myanmar (Burma)','Namibia','Nepal','Nicaragua','Niger','Nigeria','Noruega','Nueva Caledonia','Nueva Zealandia','Oman','Pakistan','Palestina','Panama','Papua Nueva Guinea','Paraguay','Peru','Polinesia Francesa','Polonia','Portugal','Puerto Rico','Qatar','Reino Unido','Republica Centroafricana','Republica Checa','Republica Democratica del Congo', 'Republica Dominicana', 'Republica Eslovaca','Reunion','Ruanda','Rumania','Rusia','Sahara','Samoa','San Cristobal-Nevis (St. Kitts)','San Marino','San Vincente y las Granadinas','Santa Helena','Santa Lucia','Santa Sede (Vaticano)','Sao Tome & Principe','Senegal','Seychelles','Sierra Leona','Singapur','Siria','Somalia','Sri Lanka (Ceilan)','Sudan','Suecia','Suiza','Sur Africa','Surinam','Swaziland','Tailandia','Taiwan','Tajikistan','Tanzania','Timor Oriental','Togo','Tokelau','Tonga','Trinidad & Tobago','Tunisia','Turkmenistan','Turquia','Ucrania','Uganda','Union Europea','Uruguay','Uzbekistan','Vanuatu','Venezuela','Vietnam','Yemen','Yugoslavia','Zambia','Zimbabwe');

    private $estados = array(
        'Amazonas' => array('Acanaña', 'Cacurí', 'Camani', 'Comunidad', 'Curimacare', 'Isla Ratón', 'La Esmeralda', 'Laja Lisa', 'Limón de Parhueña', 'Macuruco', 'Maroa', 'Marueta', 'Mavaca', 'Munduapo', 'Pendare', 'Puerto Ayacucho', 'Samariapo', 'San Carlos de Río Negro', 'San Fernando de Atabapo', 'San Juan de Manapiare', 'San Pedro del Orinoco', 'Santa Lucía', 'Solano', 'Toky-Shamanaña', 'Victorino'),
        'Anzoátegui' => array('Anaco', 'Aragua de Barcelona', 'Atapirire', 'Barcelona', 'Bergantín', 'Boca de Chávez', 'Boca de Uchire', 'Boca del Pao', 'Caigua', 'Cantaura', 'Carapa', 'Clarines', 'El Carito', 'El Chaparro', 'El Hatillo', 'El Pao de Barcelona', 'El Pilar', 'El Tigre', 'Guanape', 'Guanta', 'José Gregorio Monagas', 'Lecherías', 'Mapire', 'Múcura', 'Mundo Nuevo', 'Naricual', 'Onoto', 'Pariaguán', 'Pertigalete', 'Píritu', 'Pozuelos', 'Pueblo Nuevo', 'Puerto La Cruz', 'Puerto Píritu', 'Sabana de Uchire', 'San Diego de Cabrutica', 'San Francisco', 'San Joaquín', 'San José de Guanipa (El Tigrito)', 'San Mateo', 'San Miguel', 'San Pablo', 'Santa Ana', 'Santa Bárbara', 'Santa Clara', 'Santa Cruz de Orinoco', 'Santa Inés', 'Santa Rosa', 'Soledad', 'Urica', 'Uverito', 'Valle de Guanape', 'Zuata'),
        'Apure' => array('Achaguas', 'Apurito', 'Arichuna', 'Biruaca', 'Bruzual', 'El Amparo', 'El Nula', 'El Recreo', 'El Samán de Apure', 'El Yagual', 'Elorza', 'Guachara', 'Guasdualito', 'Guasimal', 'La Estacada', 'La Trinidad de Orichuna', 'La Victoria', 'Mantecal', 'Palmarito', 'Puerto Páez', 'Quintero', 'San Fernando de Apure', 'San Juan de Payara', 'San Miguel de Cunaviche', 'San Rafael de Atamaica', 'San Vicente'),
        'Aragua' => array('19 de Abril', 'Barbacoas', 'Bella Vista', 'Cagua', 'Camatagua', 'Caña de Azúcar', 'Carmen de Cura', 'Choroní', 'Chuao', 'El Consejo', 'El Limón', 'Francisco de Miranda', 'Güiripa', 'La Colonia Tovar', 'La Pica', 'La Victoria', 'Las Guacamayas', 'Las Mercedes', 'Las Peñitas', 'Las Tejerías', 'Los Bagres', 'Magdaleno', 'Maracay', 'Ocumare de la Costa', 'Ollas de Caramacate', 'Palo Negro', 'Pao de Zárate', 'Paraparal', 'Rosario de Paya', 'San Casimiro', 'San Francisco de Asís', 'San Francisco de Cara', 'San Joaquín', 'San Mateo', 'San Sebastián', 'Santa Cruz', 'Santa Rita', 'Taguay', 'Tiara', 'Tocorón', 'Turmero', 'Valle Morín', 'Villa de Cura', 'Zuata'),
        'Barinas' => array('Altamira', 'Arismendi', 'Barinas', 'Barinitas', 'Barrancas', 'Bum-Bum', 'Calderas', 'Capitanejo', 'Chameta', 'Ciudad Bolivia', 'Ciudad de Nutrias', 'Curbatí', 'Dolores', 'El Cantón', 'El Corozo', 'El Real', 'El Regalo', 'Guadarrama', 'La Caramuca', 'La Luz', 'La Mula', 'La Unión', 'La Yuca', 'Libertad', 'Los Guasimitos', 'Maporal', 'Masparrito', 'Mijagual', 'Obispos', 'Pedraza La Vieja', 'Puerto de Nutrias', 'Puerto Vivas', 'Punta de Piedra', 'Quebrada Seca', 'Sabaneta', 'San Antonio', 'San Rafael de Canaguá', 'San Silvestre', 'Santa Bárbara', 'Santa Catalina', 'Santa Cruz de Guacas', 'Santa Inés', 'Santa Lucía', 'Santa Rosa', 'Socopó', 'Torunos', 'Veguitas'),
        'Bolívar' => array('Almacén', 'Aripao', 'Caicara del Orinoco', 'Ciudad Bolívar', 'Ciudad Piar', 'El Callao', 'El Dorado', 'El Manteco', 'El Miamo', 'El Milagro', 'El Palmar', 'El Pao de El Hierro', 'El Rosario', 'Guarataro', 'Guasipati', 'Ikabarú', 'La Carolina', 'La Paragua', 'La Urbana', 'Las Bonitas', 'Las Claritas', 'Las Majadas', 'Maripa', 'Moitaco', 'Morichalito', 'Pozo Verde', 'Puerto Ordaz', 'San Félix', 'San Francisco', 'San José de Bongo', 'Santa Bárbara de Centurión', 'Santa Elena de Uairén', 'Santa Rosalía', 'Tumeremo', 'Upata'),
        'Carabobo' => array('Bejuma', 'Belén', 'Borburata', 'Canoabo', 'Central Tacarigua', 'Chirgua', 'Guacara', 'Güigüe', 'Los Guayos', 'Los Naranjos', 'Mariara', 'Miranda', 'Montalbán', 'Morón', 'Naguanagua', 'Patanemo', 'Puerto Cabello', 'San Diego', 'San Joaquín', 'Tocuyito', 'Urama', 'Valencia', 'Yagua'),
        'Cojedes' => array('Apartaderos', 'Cojedes', 'El Amparo', 'El Baúl', 'El Pao', 'La Aguadita', 'La Sierra', 'Las Vegas', 'Libertad', 'Macapo', 'Manrique', 'San Carlos', 'Sucre', 'Tinaco', 'Tinaquillo'),
        'Delta Amacuro' => array('Araguabisi', 'Araguaimujo', 'Boca de Cuyubini', 'Capure', 'Carapal de Guara', 'Curiapo', 'El Triunfo', 'Hacienda del Medio', 'La Horqueta', 'Manoa', 'Moruca', 'Paloma', 'Pedernales', 'Piacoa', 'San Francisco de Guayo', 'San Rafael', 'Santa Catalina', 'Sierra Imataca', 'Tucupita', 'Urbanización Delfín Mendoza', 'Urbanización Leonardo Ruíz Pineda'),
        'Distrito Capital' => array('Caracas'),
        'Falcón' => array('Acurigua', 'Adaure', 'Adícora', 'Agua Larga', 'Agua Linda', 'Aracua', 'Araurima', 'Baraived', 'Bariro', 'Boca de Aroa', 'Boca de Tocuyo', 'Borojó', 'Buena Vista', 'Cabure', 'Capadare', 'Capatárida', 'Casigua', 'Chichiriviche', 'Churuguara', 'Coro', 'Curimagua', 'Dabajuro', 'El Charal', 'El Hato', 'El Manantial (Agua Clara)', 'El Mene de San Lorenzo', 'El Moyepo', 'El Paují', 'El Tupí', 'El Vínculo', 'Guaibacoa', 'Guajiro', 'Jacura', 'Jadacaquiva', 'Judibana', 'La Ciénaga', 'La Cruz de Taratara', 'La Negrita', 'La Pastora', 'La Peña', 'La Soledad', 'La Vela de Coro', 'Las Calderas', 'Las Vegas del Tuy', 'Mapararí', 'Mene de Mauroa', 'Mirimire', 'Mitare', 'Moruy', 'Palmasola', 'Pecaya', 'Pedregal', 'Piedra Grande', 'Píritu', 'Pueblo Cumarebo', 'Pueblo Nuevo', 'Pueblo Nuevo de la Sierra', 'Puerto Cumarebo', 'Punta Cardón', 'Punto Fijo', 'Purureche', 'Río Seco', 'Sabaneta', 'San Félix', 'San José de Bruzual', 'San José de la Costa', 'San José de Seque', 'San Juan de los Cayos', 'San Luis', 'Santa Ana', 'Santa Ana de Coro', 'Santa Cruz de Bucaral', 'Santa Cruz de Los Taques', 'Tocópero', 'Tocuyo de La Costa', 'Tucacas', 'Tupure', 'Urumaco', 'Yaracal', 'Zazárida'),
        'Guárico' => array('Altagracia de Orituco', 'Altamira', 'Cabruta', 'Calabozo', 'Camaguán', 'Cantagallo', 'Cazorla', 'Chaguaramas', 'El Calvario', 'El Rastro', 'El Socorro', 'El Sombrero', 'Espino', 'Guardatinajas', 'Guayabal', 'La Unión de Canuto', 'Las Mercedes', 'Lezama', 'Libertad de Orituco', 'Ortiz', 'Parapara', 'Paso Real de Macaira', 'Puerto Miranda', 'Sabana Grande de Orituco', 'San Francisco de Macaira', 'San Francisco de Tiznados', 'San José de Guaribe', 'San José de Tiznados', 'San José de Unare', 'San Juan de Los Morros', 'San Rafael de Laya', 'San Rafael de Orituco', 'Santa María de Ipire', 'Santa Rita', 'Sosa', 'Tucupido', 'Uverito', 'Valle de La Pascua', 'Zaraza'),
        'Lara' => array('Agua Negra', 'Agua Viva', 'Aguada Grande', 'Altagracia', 'Anzoátegui', 'Aregue', 'Arenales', 'Atarigua', 'Baragua', 'Barbacoas', 'Barquisimeto', 'Bobare', 'Buena Vista', 'Burere', 'Cabudare', 'Carora', 'Cuara', 'Cubiro', 'Curarigua', 'Duaca', 'El Empedrado', 'El Eneal', 'El Hato', 'El Jabón', 'El Paradero', 'El Tocuyo', 'Guaitó', 'Guarico', 'Humocaro Alto', 'Humocaro Bajo', 'La Bucarita', 'La Ceiba', 'La Escalera', 'La Miel', 'La Pastora', 'Los Rastrojos', 'Manzanita', 'Palmarito', 'Parapara', 'Quebrada Arriba', 'Quíbor', 'Río Claro', 'Río Tocuyo', 'San Francisco', 'San Miguel', 'San Pedro', 'Sanare', 'Santa Inés', 'Sarare', 'Siquisique', 'Tintorero', 'Villanueva'),
        'Miranda' => array('Altagracia de la Montaña', 'Aragüita', 'Araira', 'Capaya', 'Carrizal', 'Caucagua', 'Caucagüita', 'Chacao', 'Charallave', 'Cúa', 'Cumbo', 'Cúpira', 'Curiepe', 'El Café', 'El Cafetal', 'El Cartanal', 'El Clavo', 'El Guapo', 'El Hatillo', 'El Jarillo', 'Fila de Mariches', 'Guarenas', 'Guatire', 'Higuerote', 'La Democracia', 'La Dolorita', 'Las Brisas', 'Las Minas de Baruta', 'Los Dos Caminos', 'Los Teques', 'Machurucuto', 'Mamporal', 'Marizapa', 'Nuestra Señora del Rosario de Baruta', 'Nueva Cúa', 'Ocumare del Tuy', 'Panaquire', 'Paparo', 'Paracotos', 'Petare', 'Río Chico', 'San Antonio de Los Altos', 'San Antonio de Yare', 'San Diego', 'San Fernando', 'San Francisco de Yare', 'San José de Barlovento', 'San Pedro', 'Santa Bárbara', 'Santa Lucía', 'Santa Teresa del Tuy', 'Tacarigua de La Laguna', 'Tacarigua de Mamporal', 'Tácata', 'Tapipa'),
        'Monagas' => array('Aguasay', 'Aparicio', 'Aragua', 'Areo', 'Barrancas', 'Cachipo', 'Caicara', 'Caripe', 'Caripito', 'Chaguaramal', 'Chaguaramas', 'El Corozo', 'El Furrial', 'El Guácharo', 'El Pinto', 'El Tejero', 'Guanaguana', 'Jusepín', 'La Guanota', 'La Pica', 'La Toscana', 'Las Alhuacas', 'Los Barrancos de Fajardo', 'Maturín', 'Punta de Mata', 'Quiriquire', 'Sabana de Piedra', 'San Agustín', 'San Antonio', 'San Félix', 'San Francisco', 'San Vicente', 'Santa Bárbara', 'Tabasca', 'Taguaya', 'Temblador', 'Teresén', 'Uracoa', 'Viento Fresco'),
        'Mérida' => array('Acequias', 'Arapuey', 'Aricagua', 'Bailadores', 'Cacute', 'Campo Elías', 'Canaguá', 'Caño Tigre', 'Capurí', 'Chacantá', 'Chachopo', 'Chiguará', 'Ejido', 'El Molino', 'El Morro', 'El Pinar', 'El Viento', 'El Vigía', 'Estánquez', 'Guaraque', 'Guayabones', 'Jají', 'La Azulita', 'La Blanca (12 de Octubre)', 'La Mesa', 'La Palmita', 'La Playa', 'La Toma', 'La Trampa', 'La Venta', 'Lagunillas', 'Las Piedras', 'Las Virtudes', 'Los Naranjos', 'Los Nevados', 'Mérida', 'Mesa Bolívar', 'Mesa de las Palmas', 'Mesa de Quintero', 'Mucuchachí', 'Mucuchíes', 'Mucujepe', 'Mucurubá', 'Mucutuy', 'Nueva Bolivia', 'Palmarito', 'Piñango', 'Pueblo Llano', 'Pueblo Nuevo del Sur', 'Río Negro', 'San Cristóbal de Torondoy', 'San José', 'San José de Palmira', 'San Juan', 'San Rafael', 'San Rafael de Alcázar', 'Santa Apolonia', 'Santa Cruz de Mora', 'Santa Elena de Arenales', 'Santa María de Caparo', 'Santo Domingo', 'Tabay', 'Timotes', 'Torondoy', 'Tovar', 'Tucaní', 'Zea'),
        'Nueva Esparta' => array('Altagracia', 'Boca del Pozo', 'Boca del Río', 'El Guamache', 'El Maco', 'El Pilar (Los Robles)', 'El Valle del Espíritu Santo', 'Güinima', 'Juangriego', 'La Asunción', 'La Guardia', 'La Plaza de Paraguachí', 'Los Millanes', 'Pampatar', 'Pedro González', 'Porlamar', 'Punta de Piedras', 'San Juan Bautista', 'San Pedro de Coche', 'Santa Ana', 'Tacarigua', 'Villa Rosa'),
        'Portuguesa' => array('Acarigua', 'Agua Blanca', 'Araure', 'Biscucuy', 'Boconoito', 'Caño Delgadito', 'Colonia Turén', 'Córdoba', 'El Algarrobito', 'El Playón', 'Guanare', 'Guanarito', 'La Aparición', 'La Concepción', 'La Estación', 'La Misión', 'Las Cruces', 'Mesa de Cavacas', 'Mijagüito', 'Morrones', 'Nueva Florida', 'Ospino', 'Papelón', 'Paraíso de Chabasquén', 'Payara', 'Peña Blanca', 'Pimpinela', 'Píritu', 'Quebrada de la Virgen', 'Río Acarigua', 'San José de la Montaña', 'San José de Saguaz', 'San Nicolás', 'San Rafael de Onoto', 'San Rafael de Palo Alzado', 'Santa Cruz', 'Santa Fe', 'Trinidad de la Capilla', 'Uveral', 'Villa Bruzual', 'Villa Rosa'),
        'Sucre' => array('Araya', 'Arenas', 'Aricagua', 'Caigüire', 'Campo Claro', 'Cariaco', 'Carúpano', 'Casanay', 'Catuaro', 'Chacopata', 'Cumaná', 'Cumanacoa', 'El Morro de Puerto Santo', 'El Paujil', 'El Pilar', 'El Rincón', 'Guaraúnos', 'Guariquén', 'Guayana', 'Güiria', 'Irapa', 'Las Piedras', 'Los Altos', 'Los Arroyos', 'Los Puertos de Santa Fe', 'Macuro', 'Manicuare', 'Marabal', 'Marigüitar', 'Playa Grande', 'Puerto Santo', 'Río Caribe', 'Río Casanay', 'Rio Salado', 'Río Seco', 'San Antonio de Irapa', 'San Antonio del Golfo', 'San José de Aerocuar', 'San Juan', 'San Juan de Las Galdonas', 'San Juan de Unare', 'San Lorenzo', 'San Vicente', 'Santa Cruz', 'Santa María', 'Soro', 'Tunapuicito', 'Tunapuy', 'Villa Frontado (Muelle de Cariaco)', 'Villarroel (Quebrada Seca)', 'Yaguaraparo', 'Yoco'),
        'Trujillo' => array('Agua Caliente', 'Agua Santa', 'Altamira de Caús', 'Araguaney', 'Batatal', 'Betijoque', 'Boconó', 'Bolivia', 'Buena Vista', 'Burbusay', 'Cabimbú', 'Campo Alegre', 'Campo Elías', 'Carache', 'Carvajal', 'Casa de Tabla', 'Chejendé', 'Chiquinquirá', 'Cuicas', 'El Alto', 'El Baño', 'El Carmen', 'El Cenizo', 'El Dividive', 'El Gallo', 'El Jagüito', 'El Paradero', 'El Paraíso', 'El Zapatero', 'Escuque', 'Flor de Patria', 'Granados', 'Guaramacal', 'Isnotú', 'Jajó', 'Jalisco', 'Juan Ignacio Montilla', 'Junín', 'La Beatriz', 'La Ceiba', 'La Concepción', 'La Cuchilla', 'La Mata', 'La Mesa de Esnujaque', 'La Placita', 'La Plazuela', 'La Puerta', 'La Quebrada', 'Las Llanadas', 'Las Mesetas', 'Las Mesitas', 'Las Quebradas', 'Las Rurales', 'Los Caprichos', 'Los Cedros', 'Matriz', 'Mendoza', 'Mercedes Díaz', 'Minas', 'Mitón', 'Monay', 'Monte Carmelo', 'Mosquey', 'Motatán', 'Niquitao', 'Pampán', 'Pampanito', 'Sabana de Mendoza', 'Sabana Grande', 'Sabana Libre', 'San Jacinto', 'San Lázaro', 'San Luis', 'San Miguel', 'San Rafael', 'Santa Ana', 'Santa Apolonia', 'Santa Isabel', 'Santa Rosa', 'Santiago', 'Torococo', 'Tostós', 'Tres de Febrero', 'Tres Esquinas', 'Trujillo', 'Tuñame', 'Valera', 'Valerita', 'Valmore Rodríguez', 'Vega de Guaramacal', 'Zona Rica'),
        'Táchira' => array('Abejales', 'Aguas Calientes', 'Boca de Grita', 'Boconó', 'Borotá', 'Bramón', 'Capacho Nuevo', 'Capacho Viejo', 'Colón', 'Coloncito', 'Cordero', 'Delicias', 'EL Cobre', 'El Milagro', 'El Pueblito', 'El Recreo', 'El Valle', 'Hato de la Virgen', 'Hernández', 'La Florida', 'La Fría', 'La Fundación', 'La Grita', 'La Palmita', 'La Tendida', 'Laguna de García', 'Las Dantas', 'Las Mesas', 'Lobatera', 'Macanillo', 'Mesa del Tigre', 'Michelena', 'Orope', 'Palmira', 'Palo Gordo', 'Palotal', 'Patio Redondo', 'Peribeca', 'Pregonero', 'Pueblo Hondo', 'Puerto Nuevo', 'Puerto Teteo', 'Queniquea', 'Río Chiquito', 'Rubio', 'Sabana Grande', 'San Antonio del Táchira', 'San Cristóbal', 'San Félix', 'San Joaquín de Navay', 'San José de Bolívar', 'San Josecito', 'San Lorenzo', 'San Pablo', 'San Pedro del Río', 'San Rafael del Piñal', 'San Simón', 'San Vicente de la Revancha', 'Santa Ana', 'Seboruco', 'Táriba', 'Umuquena', 'Ureña'),
        'Vargas' => array('Caraballeda', 'Carayaca', 'Catia La Mar', 'El Junko', 'La Guaira', 'La Sabana', 'Macuto', 'Maiquetía', 'Naiguatá'),
        'Yaracuy' => array('Albarico', 'Aroa', 'Boraure', 'Cambural', 'Campo Elías', 'Casimiro Vásquez', 'Chivacoa', 'Cocorote', 'Farriar', 'Guama', 'Independencia', 'Marín', 'Nirgua', 'Sabana de Parra', 'Salom', 'San Felipe', 'San Pablo', 'Temerla', 'Urachiche', 'Yaritagua', 'Yumare'),
        'Zulia' => array('Bachaquero', 'Barranquitas', 'Bobures', 'Cabimas', 'Cachirí', 'Caja Seca', 'Campo Lara', 'Carrasquero', 'Casigua El Cubo', 'Ceuta', 'Ciudad Â Ojeda', 'Ciudad Ojeda', 'Cojoro', 'Concepción', 'Concha', 'Cuatro Esquinas', 'El Bajo', 'El Batey', 'El Carmelo', 'El Consejo de Ciruma', 'El Corozo', 'El Cruce', 'El Guanábano', 'El Guayabo', 'El Mecocal', 'El Mene', 'El Molinete', 'El Moralito', 'El Silencio', 'El Tigre', 'El Toro', 'El Venado', 'Encontrados', 'Gibraltar', 'Jobo Alto (Kilómetro 25)', 'Kilómetro 48 (Santo Domingo)', 'La Concepción', 'La Ensenada', 'La Paz', 'La Sierrita', 'La Villa del Rosario', 'Lagunillas', 'Las Parcelas', 'Las Piedras', 'Los Cortijos', 'Los Naranjos', 'Los Puertos de Altagracia', 'Machiques', 'Maracaibo', 'Mene Grande', 'Palito Blanco', 'Palmarejo', 'Paraguaipoa', 'Picapica', 'Potreritos', 'Pueblo Nuevo', 'Pueblo Nuevo El Chivo', 'Punta Gorda', 'Quisiro', 'Río Negro', 'Sabana de la Plata', 'Sabaneta de Palmas', 'San Antonio', 'San Carlos', 'San Carlos del Zulia', 'San Francisco', 'San Ignacio', 'San Isidro', 'San José', 'San Rafael de El Moján', 'San Timoteo', 'Santa Bárbara', 'Santa Cruz de Mara', 'Santa Cruz del Zulia', 'Santa María', 'Santa Rita', 'Sierra Maestra', 'Sinamaica', 'Sur América', 'Tamare', 'Tía Juana'),
    );

    private $default_ciudad = 'Puerto Ordaz';
    private $default_estado = 'Bolívar';

    function beforeRender() {
        if($this->Auth->loggedIn()) {
            $this->set('rol', $this->Auth->user('rol'));
            $this->set('usuario', $this->Auth->user('usuario'));
        }
    }
    
    function isAdmin() {
        return $this->Auth->user('rol') == 'A';
    }

    protected function getPaises() {
        $paises = array();

        foreach($this->paises as $p) 
            $paises[$p] = $p;

        return $paises;
    }

    protected function getEstado() {
        return $this->default_estado;
    }

    protected function getCiudad() {
        return $this->default_ciudad;
    }

    protected function getEstados() {
        $estados = array();

        foreach($this->estados as $estado => $ciudades)
            $estados[$estado] = $estado;
        return $estados;
    }

    protected function getRawEstados() {
        return $this->estados;
    }

    protected function getCiudades($estado = null) {
        if(!$estado)
            $estado = $this->default_estado;
        $ciudades = array();

        foreach($this->estados[$estado] as $c)
            $ciudades[$c] = $c;
		$ciudades['Otra'] = 'Otra';
        return $ciudades;
    }

    function strtoupper_utf8($str) {
        $str = strtoupper($str);
        $str = str_replace(array('á','é','í','ó','ú','ñ'), array('Á','É','Í','Ó','Ú','Ñ'), $str);
        return $str;
    }

    function month2string($m) {
        $months = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        return $months[$m-1];
    }

	function age($date) {
		$dia = date('j', $date);
		$mes = date('n', $date);
		$ano = date('Y', $date);
		$dia_actual = date('j', time());
		$mes_actual = date('n', time());
		$ano_actual = date('Y', time());

		$edad = $ano_actual - $ano;

		if($mes_actual < $mes) {
			return $edad - 1;
		} elseif ($mes_actual > $mes) {
			return $edad;
		} elseif ($mes_actual == $mes) {
			if($dia_actual >= $dia)
				return $edad;
			else
				return $edad - 1;
		}

		return -1;
	}

	function number2word($n) {
		$str = array('un', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve', 'diez',
					'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho',
					'diecinueve', 'veinte');
		if($n > count($str))
			return 'más de ' . $str[count($str) - 1];
		else
			return $str[$n - 1];
	}
}
