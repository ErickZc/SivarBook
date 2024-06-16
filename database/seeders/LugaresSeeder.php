<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lugares;

class LugaresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Imagen por defecto
        $path1 = public_path('img/tacos.jpg');
        $imagenBinaria1 = file_get_contents($path1);
        $imagenBase641 = base64_encode($imagenBinaria1);

        $path2 = public_path('img/reapertura-puerta-del-diablo-17.jpg');
        $imagenBinaria2 = file_get_contents($path2);
        $imagenBase642 = base64_encode($imagenBinaria2);

        $path3 = public_path('img/elpital.jpg');
        $imagenBinaria3 = file_get_contents($path3);
        $imagenBase643 = base64_encode($imagenBinaria3);

        $path4 = public_path('img/ElTunco.jpg');
        $imagenBinaria4 = file_get_contents($path4);
        $imagenBase644 = base64_encode($imagenBinaria4);

        $path5 = public_path('img/yali.jpg');
        $imagenBinaria5 = file_get_contents($path5);
        $imagenBase645 = base64_encode($imagenBinaria5);

        $path6 = public_path('img/BINAES.jpg');
        $imagenBinaria6 = file_get_contents($path6);
        $imagenBase646 = base64_encode($imagenBinaria6);

        $path7 = public_path('img/suiza.jpg');
        $imagenBinaria7 = file_get_contents($path7);
        $imagenBase647 = base64_encode($imagenBinaria7);


        $lugar = new Lugares();
        $lugar->nombre_lugar = 'Tacos Benito Carca';
        $lugar->descripcion = '<p>Tacos Benito Carca es un establecimiento ic&oacute;nico ubicado en el coraz&oacute;n de la ciudad, conocido por su autenticidad y sabor inigualable. Fundado hace m&aacute;s de tres d&eacute;cadas, este peque&ntilde;o local se ha ganado la lealtad de los comensales gracias a sus tacos excepcionales, preparados con ingredientes frescos y recetas tradicionales que han pasado de generaci&oacute;n en generaci&oacute;n. Su ambiente acogedor y servicio amigable crean una experiencia &uacute;nica para los amantes de la comida mexicana. Desde los cl&aacute;sicos tacos de carne asada hasta opciones vegetarianas innovadoras, Tacos Benito Caresta es el lugar ideal para disfrutar de una verdadera fiesta culinaria</p><p>Cel: 7722 7722</p><p>Delivery 08:00 18:00</p>';
        $lugar->precio = 7;
        $lugar->imagen = $imagenBase641;
        $lugar->estado = true;
        $lugar->fechaPublicacion = now();
        $lugar->id_usuario = 3;
        $lugar->id_categoria = 41;
        $lugar->id_municipio = 178;
        $lugar->save();

        $lugar = new Lugares();
        $lugar->nombre_lugar = 'La puerta del diablo';
        $lugar->descripcion = '<p>La Puerta del Diablo en El Salvador es un mirador natural impresionante situado en la cima de la Cordillera del B&aacute;lsamo, ofreciendo vistas panor&aacute;micas espectaculares del Valle de San Salvador y m&aacute;s all&aacute;. Este destino tur&iacute;stico es famoso por sus acantilados vertiginosos y su formaci&oacute;n rocosa distintiva que se asemeja a una puerta abierta al abismo. Es un lugar ideal para los amantes de la naturaleza y los aventureros que desean explorar senderos esc&eacute;nicos y capturar vistas inolvidables. La Puerta del Diablo no solo ofrece una experiencia visual impresionante, sino tambi&eacute;n una conexi&oacute;n profunda con la belleza natural de El Salvador</p>';
        $lugar->precio = 3;
        $lugar->imagen = $imagenBase642;
        $lugar->estado = true;
        $lugar->fechaPublicacion = now();
        $lugar->id_usuario = 4;
        $lugar->id_categoria = 2;
        $lugar->id_municipio = 189;
        $lugar->save();

        $lugar = new Lugares();
        $lugar->nombre_lugar = 'El pital';
        $lugar->descripcion = '<p>El Pital, en El Salvador, es el punto m&aacute;s alto del pa&iacute;s, ubicado en la Sierra Madre, ofreciendo a los visitantes una experiencia &uacute;nica en la naturaleza. Con su elevaci&oacute;n de m&aacute;s de 2,730 metros sobre el nivel del mar, El Pital ofrece vistas impresionantes de paisajes monta&ntilde;osos, densos bosques nubosos y una biodiversidad &uacute;nica. Es un destino popular para los amantes del ecoturismo y el senderismo, con rutas que llevan a cascadas cristalinas y lagunas glaciares. Adem&aacute;s, sus frescas temperaturas hacen de El Pital un refugio ideal para aquellos que buscan escapar del calor tropical y explorar la belleza natural de El Salvador.</p>';
        $lugar->precio = 10;
        $lugar->imagen = $imagenBase643;
        $lugar->estado = true;
        $lugar->fechaPublicacion = now();
        $lugar->id_usuario = 4;
        $lugar->id_categoria = 2;
        $lugar->id_municipio = 22;
        $lugar->save();

        $lugar = new Lugares();
        $lugar->nombre_lugar = 'Playa El Tunco';
        $lugar->descripcion = '<p>Playa El Tunco, en El Salvador, es un para&iacute;so costero que combina la serenidad del oc&eacute;ano Pac&iacute;fico con un ambiente vibrante y relajado. Conocida por sus olas consistentes y perfectas para el surf, esta playa atrae a surfistas de todo el mundo que buscan emociones en las aguas cristalinas. Sus paisajes impresionantes incluyen acantilados rocosos que se sumergen en aguas turquesas, creando un tel&oacute;n de fondo perfecto para atardeceres inolvidables. Adem&aacute;s de ser un para&iacute;so para los deportes acu&aacute;ticos, El Tunco ofrece una rica cultura local, con restaurantes de mariscos frescos, bares frente al mar y una vibrante vida nocturna que captura la esencia de la vida playera salvadore&ntilde;a..</p>';
        $lugar->precio = 0;
        $lugar->imagen = $imagenBase644;
        $lugar->estado = true;
        $lugar->fechaPublicacion = now();
        $lugar->id_usuario = 4;
        $lugar->id_categoria = 1;
        $lugar->id_municipio = 80;
        $lugar->save();

        $lugar = new Lugares();
        $lugar->nombre_lugar = 'YALI Hotel & Resort';
        $lugar->descripcion = '<p>YALI Hotel &amp; Resort, el &uacute;nico hotel boutique en El Salvador con un servicio personalizado excepcional, ubicado en el coraz&oacute;n de playa el Sunzal &ndash; La Libertad, te ofrece una propuesta de alojamiento &uacute;nica, perfecta para familias, parejas y adultos.</p><p>Reserva al 7020-0301</p><div class="x1y1aw1k xwib8y2 x152qxlz"><span class="x193iq5w xeuugli x13faqbe x1vvkbs x1xmvt09 x1lliihq x1s928wv xhkezso x1gmr53x x1cpjm7i x1fgarty x1943h6x xudqn12 x3x7a5m x6prxxf xvq8zen xo1l8bm xzsf02u" dir="auto">Consumo en el lugar</span></div><div class="x1y1aw1k xwib8y2 x152qxlz"><span class="x193iq5w xeuugli x13faqbe x1vvkbs x1xmvt09 x1lliihq x1s928wv xhkezso x1gmr53x x1cpjm7i x1fgarty x1943h6x xudqn12 x3x7a5m x6prxxf xvq8zen xo1l8bm xzsf02u" dir="auto">Terraza o mesas al aire libre</span></div>';
        $lugar->precio = 40;
        $lugar->imagen = $imagenBase645;
        $lugar->estado = true;
        $lugar->fechaPublicacion = now();
        $lugar->id_usuario = 4;
        $lugar->id_categoria = 43;
        $lugar->id_municipio = 80;
        $lugar->save();

        $lugar = new Lugares();
        $lugar->nombre_lugar = 'BINAES El Salvador';
        $lugar->descripcion = '<p>La Binaes (Biblioteca Nacional de El Salvador) es el principal repositorio cultural del pa&iacute;s, ubicado en San Salvador. Fundada en 1870, alberga una vasta colecci&oacute;n de libros, peri&oacute;dicos, documentos hist&oacute;ricos y otros materiales bibliogr&aacute;ficos de gran valor. Es un centro vital para la investigaci&oacute;n, el estudio y la preservaci&oacute;n del patrimonio intelectual salvadore&ntilde;o. Sus instalaciones modernas y accesibles promueven el acceso a la cultura y el conocimiento, siendo un espacio indispensable para estudiantes, acad&eacute;micos y el p&uacute;blico en general interesado en explorar la rica historia y la diversidad cultural de El Salvador</p>';
        $lugar->precio = 0;
        $lugar->imagen = $imagenBase646;
        $lugar->estado = true;
        $lugar->fechaPublicacion = now();
        $lugar->id_usuario = 4;
        $lugar->id_categoria = 44;
        $lugar->id_municipio = 178;
        $lugar->save();

        $lugar = new Lugares();
        $lugar->nombre_lugar = 'Pupuseria Suiza';
        $lugar->descripcion = '<p>La Pupuser&iacute;a Suiza es un emblem&aacute;tico establecimiento gastron&oacute;mico en El Salvador, reconocido por sus exquisitas pupusas, un plato tradicional salvadore&ntilde;o. Situada en el coraz&oacute;n de San Salvador, esta pupuser&iacute;a destaca por su ambiente acogedor y familiar, donde se pueden degustar pupusas de diversos sabores como queso, frijoles, chicharr&oacute;n y loroco, entre otros. La calidad de sus ingredientes frescos y la habilidad artesanal en la preparaci&oacute;n hacen de la Pupuser&iacute;a Suiza un lugar de referencia para quienes desean experimentar la aut&eacute;ntica cocina salvadore&ntilde;a en todo su esplendor.</p>';
        $lugar->precio = 1;
        $lugar->imagen = $imagenBase647;
        $lugar->estado = true;
        $lugar->fechaPublicacion = now();
        $lugar->id_usuario = 3;
        $lugar->id_categoria = 41;
        $lugar->id_municipio = 178;
        $lugar->save();
    }
}
