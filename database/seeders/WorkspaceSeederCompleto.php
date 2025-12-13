<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Habilidad;
use App\Models\Trabajo;
use App\Models\Propuesta;
use App\Models\FreelancerPerfil;
use App\Models\PortfolioItem;
use App\Models\Calificacion;
use Spatie\Permission\Models\Role;

class WorkspaceSeederCompleto extends Seeder
{
    public function run(): void
    {
        // Crear roles si no existen
        $clienteRole = Role::firstOrCreate(['name' => 'cliente']);
        $freelancerRole = Role::firstOrCreate(['name' => 'freelancer']);

        // Crear categorías
        $categorias = [
            ['nombre' => 'Desarrollo Web', 'slug' => 'desarrollo-web', 'icono' => 'ri-code-line', 'descripcion' => 'Proyectos de desarrollo web', 'activo' => true],
            ['nombre' => 'Diseño Gráfico', 'slug' => 'diseno-grafico', 'icono' => 'ri-palette-line', 'descripcion' => 'Diseño y creatividad', 'activo' => true],
            ['nombre' => 'Marketing Digital', 'slug' => 'marketing-digital', 'icono' => 'ri-megaphone-line', 'descripcion' => 'Marketing y publicidad', 'activo' => true],
            ['nombre' => 'Redacción', 'slug' => 'redaccion', 'icono' => 'ri-quill-pen-line', 'descripcion' => 'Contenido escrito', 'activo' => true],
            ['nombre' => 'Traducción', 'slug' => 'traduccion', 'icono' => 'ri-translate-2', 'descripcion' => 'Servicios de traducción', 'activo' => true],
        ];

        foreach ($categorias as $cat) {
            Categoria::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Crear habilidades
        $habilidades = [
            ['nombre' => 'PHP', 'slug' => 'php', 'categoria_id' => 1, 'activo' => true],
            ['nombre' => 'Laravel', 'slug' => 'laravel', 'categoria_id' => 1, 'activo' => true],
            ['nombre' => 'JavaScript', 'slug' => 'javascript', 'categoria_id' => 1, 'activo' => true],
            ['nombre' => 'React', 'slug' => 'react', 'categoria_id' => 1, 'activo' => true],
            ['nombre' => 'Vue.js', 'slug' => 'vuejs', 'categoria_id' => 1, 'activo' => true],
            ['nombre' => 'Node.js', 'slug' => 'nodejs', 'categoria_id' => 1, 'activo' => true],
            ['nombre' => 'MySQL', 'slug' => 'mysql', 'categoria_id' => 1, 'activo' => true],
            ['nombre' => 'Photoshop', 'slug' => 'photoshop', 'categoria_id' => 2, 'activo' => true],
            ['nombre' => 'Illustrator', 'slug' => 'illustrator', 'categoria_id' => 2, 'activo' => true],
            ['nombre' => 'Figma', 'slug' => 'figma', 'categoria_id' => 2, 'activo' => true],
            ['nombre' => 'SEO', 'slug' => 'seo', 'categoria_id' => 3, 'activo' => true],
            ['nombre' => 'Google Ads', 'slug' => 'google-ads', 'categoria_id' => 3, 'activo' => true],
            ['nombre' => 'Social Media', 'slug' => 'social-media', 'categoria_id' => 3, 'activo' => true],
        ];

        foreach ($habilidades as $hab) {
            Habilidad::firstOrCreate(['slug' => $hab['slug']], $hab);
        }

        // ==================== CLIENTES ====================
        $cliente1 = User::firstOrCreate(
            ['email' => 'cliente1@freeland.com'],
            [
                'name' => 'Juan Pérez',
                'password' => bcrypt('password'),
                'activo' => true
            ]
        );
        $cliente1->assignRole($clienteRole);

        $cliente2 = User::firstOrCreate(
            ['email' => 'cliente2@freeland.com'],
            [
                'name' => 'María González',
                'password' => bcrypt('password'),
                'activo' => true
            ]
        );
        $cliente2->assignRole($clienteRole);

        $cliente3 = User::firstOrCreate(
            ['email' => 'cliente3@freeland.com'],
            [
                'name' => 'Roberto Silva',
                'password' => bcrypt('password'),
                'activo' => true
            ]
        );
        $cliente3->assignRole($clienteRole);

        // ==================== FREELANCERS ====================
        $freelancer1 = User::firstOrCreate(
            ['email' => 'freelancer1@freeland.com'],
            [
                'name' => 'Carlos Rodríguez',
                'password' => bcrypt('password'),
                'activo' => true
            ]
        );
        $freelancer1->assignRole($freelancerRole);

        $freelancer2 = User::firstOrCreate(
            ['email' => 'freelancer2@freeland.com'],
            [
                'name' => 'Ana Martínez',
                'password' => bcrypt('password'),
                'activo' => true
            ]
        );
        $freelancer2->assignRole($freelancerRole);

        $freelancer3 = User::firstOrCreate(
            ['email' => 'freelancer3@freeland.com'],
            [
                'name' => 'Luis Fernández',
                'password' => bcrypt('password'),
                'activo' => true
            ]
        );
        $freelancer3->assignRole($freelancerRole);

        $freelancer4 = User::firstOrCreate(
            ['email' => 'freelancer4@freeland.com'],
            [
                'name' => 'Sofia García',
                'password' => bcrypt('password'),
                'activo' => true
            ]
        );
        $freelancer4->assignRole($freelancerRole);

        $freelancer5 = User::firstOrCreate(
            ['email' => 'freelancer5@freeland.com'],
            [
                'name' => 'Diego Torres',
                'password' => bcrypt('password'),
                'activo' => true
            ]
        );
        $freelancer5->assignRole($freelancerRole);

        // ==================== PERFILES DE FREELANCERS ====================
        FreelancerPerfil::firstOrCreate(
            ['user_id' => $freelancer1->id],
            [
                'titulo_profesional' => 'Desarrollador Full Stack Laravel & Vue.js',
                'biografia' => 'Desarrollador con 5+ años de experiencia en Laravel y Vue.js. Especializado en aplicaciones web empresariales, APIs REST y soluciones escalables. He trabajado con clientes de diferentes industrias entregando proyectos de alta calidad.',
                'ubicacion' => 'Ciudad de México, México',
                'tarifa_por_hora' => 45000,
                'anos_experiencia' => 5,
                'disponibilidad' => 'tiempo_completo',
                'disponible_ahora' => true,
                'trabajos_completados' => 12,
                'calificacion_promedio' => 4.8,
                'total_calificaciones' => 12,
                'total_ganado' => 28000000,
                'propuestas_exitosas' => 15,
                'total_propuestas' => 22,
                'github' => 'https://github.com/carlosdev',
                'linkedin' => 'https://linkedin.com/in/carlosdev',
                'categorias_preferidas' => [1]
            ]
        );

        FreelancerPerfil::firstOrCreate(
            ['user_id' => $freelancer2->id],
            [
                'titulo_profesional' => 'Diseñadora Gráfica & UI/UX',
                'biografia' => 'Diseñadora con pasión por crear experiencias visuales impactantes. Especializada en diseño de identidad corporativa, UI/UX y diseño web moderno. Portfolio con más de 50 proyectos completados exitosamente.',
                'ubicacion' => 'Bogotá, Colombia',
                'tarifa_por_hora' => 35000,
                'anos_experiencia' => 4,
                'disponibilidad' => 'medio_tiempo',
                'disponible_ahora' => true,
                'trabajos_completados' => 18,
                'calificacion_promedio' => 4.9,
                'total_calificaciones' => 18,
                'total_ganado' => 15000000,
                'propuestas_exitosas' => 20,
                'total_propuestas' => 28,
                'behance' => 'https://behance.net/anamartinez',
                'linkedin' => 'https://linkedin.com/in/anamartinez',
                'categorias_preferidas' => [2]
            ]
        );

        FreelancerPerfil::firstOrCreate(
            ['user_id' => $freelancer3->id],
            [
                'titulo_profesional' => 'Especialista en Marketing Digital & SEO',
                'biografia' => 'Experto en marketing digital con enfoque en SEO, SEM y redes sociales. He ayudado a más de 30 empresas a aumentar su visibilidad online y conversiones. Certificado en Google Ads y Analytics.',
                'ubicacion' => 'Buenos Aires, Argentina',
                'tarifa_por_hora' => 40000,
                'anos_experiencia' => 6,
                'disponibilidad' => 'por_proyecto',
                'disponible_ahora' => true,
                'trabajos_completados' => 24,
                'calificacion_promedio' => 4.7,
                'total_calificaciones' => 24,
                'total_ganado' => 32000000,
                'propuestas_exitosas' => 28,
                'total_propuestas' => 40,
                'linkedin' => 'https://linkedin.com/in/luisfernandez',
                'website' => 'https://luisfernandez.com',
                'categorias_preferidas' => [3]
            ]
        );

        FreelancerPerfil::firstOrCreate(
            ['user_id' => $freelancer4->id],
            [
                'titulo_profesional' => 'Desarrolladora Frontend React & Next.js',
                'biografia' => 'Desarrolladora frontend especializada en React y Next.js. Me apasiona crear interfaces modernas, responsivas y con excelente performance. Experiencia en proyectos de e-commerce y aplicaciones web complejas.',
                'ubicacion' => 'Santiago, Chile',
                'tarifa_por_hora' => 42000,
                'anos_experiencia' => 3,
                'disponibilidad' => 'tiempo_completo',
                'disponible_ahora' => true,
                'trabajos_completados' => 8,
                'calificacion_promedio' => 5.0,
                'total_calificaciones' => 8,
                'total_ganado' => 12000000,
                'propuestas_exitosas' => 10,
                'total_propuestas' => 15,
                'github' => 'https://github.com/sofiagarcia',
                'website' => 'https://sofiagarcia.dev',
                'categorias_preferidas' => [1]
            ]
        );

        FreelancerPerfil::firstOrCreate(
            ['user_id' => $freelancer5->id],
            [
                'titulo_profesional' => 'Backend Developer Node.js & Python',
                'biografia' => 'Desarrollador backend con experiencia en Node.js, Python y microservicios. Especializado en arquitectura de software escalable, APIs REST/GraphQL y bases de datos NoSQL y SQL. Passionate about clean code.',
                'ubicacion' => 'Lima, Perú',
                'tarifa_por_hora' => 48000,
                'anos_experiencia' => 7,
                'disponibilidad' => 'por_proyecto',
                'disponible_ahora' => false,
                'trabajos_completados' => 16,
                'calificacion_promedio' => 4.9,
                'total_calificaciones' => 16,
                'total_ganado' => 35000000,
                'propuestas_exitosas' => 18,
                'total_propuestas' => 25,
                'github' => 'https://github.com/diegotorres',
                'linkedin' => 'https://linkedin.com/in/diegotorres',
                'categorias_preferidas' => [1]
            ]
        );

        // ==================== PORTFOLIO ITEMS ====================
        // Portfolio de Carlos (Freelancer1)
        PortfolioItem::create([
            'user_id' => $freelancer1->id,
            'titulo' => 'Sistema de Gestión Empresarial',
            'descripcion' => 'Plataforma completa de gestión empresarial con módulos de inventario, facturación, CRM y reportes avanzados. Desarrollada con Laravel 10 y Vue.js 3.',
            'categoria_id' => 1,
            'tecnologias' => ['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS'],
            'fecha_inicio' => now()->subMonths(6),
            'fecha_fin' => now()->subMonths(3),
            'orden' => 1,
            'destacado' => true
        ]);

        PortfolioItem::create([
            'user_id' => $freelancer1->id,
            'titulo' => 'E-commerce Multivendor',
            'descripcion' => 'Marketplace con sistema de múltiples vendedores, pagos integrados con Stripe, gestión de pedidos y panel de administración completo.',
            'categoria_id' => 1,
            'tecnologias' => ['Laravel', 'Livewire', 'AlpineJS', 'MySQL'],
            'fecha_inicio' => now()->subMonths(10),
            'fecha_fin' => now()->subMonths(7),
            'orden' => 2,
            'destacado' => true
        ]);

        // Portfolio de Ana (Freelancer2)
        PortfolioItem::create([
            'user_id' => $freelancer2->id,
            'titulo' => 'Identidad Corporativa Tech Startup',
            'descripcion' => 'Diseño completo de identidad corporativa para startup tecnológica: logotipo, manual de marca, papelería y assets digitales.',
            'categoria_id' => 2,
            'tecnologias' => ['Illustrator', 'Photoshop', 'Figma'],
            'fecha_inicio' => now()->subMonths(4),
            'fecha_fin' => now()->subMonths(3),
            'orden' => 1,
            'destacado' => true
        ]);

        PortfolioItem::create([
            'user_id' => $freelancer2->id,
            'titulo' => 'Diseño UI/UX App Móvil',
            'descripcion' => 'Diseño de interfaz y experiencia de usuario para aplicación móvil de delivery. Incluye wireframes, prototipos interactivos y sistema de diseño completo.',
            'categoria_id' => 2,
            'tecnologias' => ['Figma', 'Adobe XD'],
            'fecha_inicio' => now()->subMonths(2),
            'fecha_fin' => now()->subMonth(),
            'orden' => 2,
            'destacado' => true
        ]);

        // Portfolio de Sofia (Freelancer4)
        PortfolioItem::create([
            'user_id' => $freelancer4->id,
            'titulo' => 'Dashboard Analítico React',
            'descripcion' => 'Dashboard interactivo con gráficos en tiempo real, filtros avanzados y exportación de reportes. Optimizado para performance con React 18.',
            'categoria_id' => 1,
            'tecnologias' => ['React', 'TypeScript', 'Chart.js', 'TailwindCSS'],
            'fecha_inicio' => now()->subMonths(3),
            'fecha_fin' => now()->subMonth(),
            'orden' => 1,
            'destacado' => true
        ]);

        $this->command->info('✅ Perfiles de freelancers y portfolios creados');

        // Continuará en el siguiente bloque...
        $this->crearTrabajos($cliente1, $cliente2, $cliente3, $freelancer1, $freelancer2, $freelancer3, $freelancer4, $freelancer5);
    }

    private function crearTrabajos($cliente1, $cliente2, $cliente3, $freelancer1, $freelancer2, $freelancer3, $freelancer4, $freelancer5)
    {
        // ==================== TRABAJOS ====================

        // TRABAJO 1: Publicado (sin asignar) - Múltiples propuestas
        $trabajo1 = Trabajo::create([
            'cliente_id' => $cliente1->id,
            'categoria_id' => 1,
            'titulo' => 'Desarrollar sitio web corporativo con Laravel',
            'descripcion' => 'Necesito un desarrollador experto en Laravel para crear un sitio web corporativo moderno con sistema de gestión de contenidos. El proyecto incluye diseño responsive, integración de formularios y optimización SEO.',
            'presupuesto_min' => 1500000,
            'tipo_presupuesto' => 'fijo',
            'duracion_estimada' => 30,
            'modalidad' => 'remoto',
            'estado' => 'publicado',
            'nivel_experiencia' => 'avanzado',
            'publicado_en' => now()->subDays(3),
            'num_propuestas' => 0
        ]);
        $trabajo1->habilidades()->attach([2, 3, 7]); // Laravel, JavaScript, MySQL

        // Propuestas para trabajo1
        Propuesta::create([
            'trabajo_id' => $trabajo1->id,
            'freelancer_id' => $freelancer1->id,
            'carta_presentacion' => 'Hola Juan, soy desarrollador Laravel con más de 5 años de experiencia. He trabajado en proyectos similares y puedo entregar un sitio web de alta calidad dentro del plazo establecido. Mi portafolio incluye sitios corporativos para empresas reconocidas. Me encantaría discutir más detalles del proyecto contigo.',
            'tarifa_propuesta' => 1400000,
            'tipo_tarifa' => 'fijo',
            'tiempo_estimado' => 28,
            'estado' => 'pendiente'
        ]);
        $trabajo1->increment('num_propuestas');

        Propuesta::create([
            'trabajo_id' => $trabajo1->id,
            'freelancer_id' => $freelancer3->id,
            'carta_presentacion' => 'Experto en Laravel y desarrollo web moderno. Tengo experiencia comprobada en proyectos corporativos con Laravel 10 y Vue.js. Puedo empezar inmediatamente y entregar un producto excepcional.',
            'tarifa_propuesta' => 1600000,
            'tipo_tarifa' => 'fijo',
            'tiempo_estimado' => 30,
            'estado' => 'pendiente'
        ]);
        $trabajo1->increment('num_propuestas');

        Propuesta::create([
            'trabajo_id' => $trabajo1->id,
            'freelancer_id' => $freelancer4->id,
            'carta_presentacion' => 'Hola! Me especializo en crear sitios web modernos y responsivos. Aunque mi enfoque principal es React, tengo experiencia sólida en Laravel y puedo crear un sitio corporativo profesional que supere tus expectativas.',
            'tarifa_propuesta' => 1500000,
            'tipo_tarifa' => 'fijo',
            'tiempo_estimado' => 32,
            'estado' => 'pendiente'
        ]);
        $trabajo1->increment('num_propuestas');

        // TRABAJO 2: Publicado - Con 1 propuesta
        $trabajo2 = Trabajo::create([
            'cliente_id' => $cliente1->id,
            'categoria_id' => 2,
            'titulo' => 'Diseño de logotipo e identidad corporativa',
            'descripcion' => 'Busco diseñador gráfico para crear logotipo profesional y manual de identidad corporativa para startup tecnológica. Debe incluir versiones en diferentes formatos y colores.',
            'presupuesto_min' => 500000,
            'presupuesto_max' => 800000,
            'tipo_presupuesto' => 'rango',
            'duracion_estimada' => 15,
            'modalidad' => 'remoto',
            'estado' => 'publicado',
            'nivel_experiencia' => 'intermedio',
            'publicado_en' => now()->subDays(1),
            'num_propuestas' => 0
        ]);
        $trabajo2->habilidades()->attach([8, 9, 10]); // Photoshop, Illustrator, Figma

        Propuesta::create([
            'trabajo_id' => $trabajo2->id,
            'freelancer_id' => $freelancer2->id,
            'carta_presentacion' => 'Diseñadora gráfica especializada en identidad corporativa. He creado más de 50 logotipos para startups y empresas establecidas. Trabajo con Adobe Creative Suite y entrego archivos en todos los formatos necesarios. Me encantaría ayudarte a crear una identidad visual memorable para tu startup.',
            'tarifa_propuesta' => 650000,
            'tipo_tarifa' => 'fijo',
            'tiempo_estimado' => 12,
            'estado' => 'pendiente'
        ]);
        $trabajo2->increment('num_propuestas');

        // TRABAJO 3: Publicado - Nuevo sin propuestas
        $trabajo3 = Trabajo::create([
            'cliente_id' => $cliente2->id,
            'categoria_id' => 1,
            'titulo' => 'Desarrollador React para aplicación de gestión',
            'descripcion' => 'Proyecto de desarrollo de aplicación web con React para gestión interna de empresa. Requiere integración con API REST existente y diseño de interfaz moderna.',
            'presupuesto_min' => 50000,
            'tipo_presupuesto' => 'por_hora',
            'duracion_estimada' => 45,
            'modalidad' => 'remoto',
            'estado' => 'publicado',
            'nivel_experiencia' => 'avanzado',
            'publicado_en' => now()->subHours(12),
            'num_propuestas' => 0
        ]);
        $trabajo3->habilidades()->attach([3, 4]); // JavaScript, React

        // TRABAJO 4: EN PROGRESO
        $trabajo4 = Trabajo::create([
            'cliente_id' => $cliente2->id,
            'freelancer_id' => $freelancer3->id,
            'categoria_id' => 3,
            'titulo' => 'Campaña de marketing digital en redes sociales',
            'descripcion' => 'Necesito especialista en marketing para crear y gestionar campaña publicitaria en redes sociales durante 2 meses.',
            'presupuesto_min' => 1200000,
            'tipo_presupuesto' => 'fijo',
            'duracion_estimada' => 60,
            'modalidad' => 'remoto',
            'estado' => 'en_progreso',
            'nivel_experiencia' => 'intermedio',
            'publicado_en' => now()->subDays(10),
            'asignado_en' => now()->subDays(7),
            'num_propuestas' => 3
        ]);
        $trabajo4->habilidades()->attach([11, 13]); // SEO, Social Media

        // Propuesta aceptada para trabajo4
        Propuesta::create([
            'trabajo_id' => $trabajo4->id,
            'freelancer_id' => $freelancer3->id,
            'carta_presentacion' => 'Especialista en marketing digital con resultados comprobados en campañas de redes sociales. He gestionado campañas con presupuestos de hasta $50,000 USD con ROI promedio de 300%. Puedo ayudarte a alcanzar tus objetivos de marketing.',
            'tarifa_propuesta' => 1200000,
            'tipo_tarifa' => 'fijo',
            'tiempo_estimado' => 60,
            'estado' => 'aceptada',
            'aceptada_en' => now()->subDays(7)
        ]);

        // TRABAJO 5: COMPLETADO con calificación
        $trabajo5 = Trabajo::create([
            'cliente_id' => $cliente1->id,
            'freelancer_id' => $freelancer2->id,
            'categoria_id' => 1,
            'titulo' => 'API REST con Node.js y MongoDB',
            'descripcion' => 'Desarrollo de API REST completa para aplicación móvil usando Node.js y MongoDB.',
            'presupuesto_min' => 2000000,
            'tipo_presupuesto' => 'fijo',
            'duracion_estimada' => 30,
            'modalidad' => 'remoto',
            'estado' => 'completado',
            'nivel_experiencia' => 'experto',
            'publicado_en' => now()->subDays(60),
            'asignado_en' => now()->subDays(55),
            'completado_en' => now()->subDays(25),
            'num_propuestas' => 5
        ]);
        $trabajo5->habilidades()->attach([3, 6]); // JavaScript, Node.js

        // Calificación del trabajo5
        Calificacion::create([
            'trabajo_id' => $trabajo5->id,
            'evaluador_id' => $cliente1->id,
            'evaluado_id' => $freelancer2->id,
            'tipo' => 'cliente_a_freelancer',
            'calificacion' => 5,
            'comentario' => 'Excelente trabajo! Ana superó todas mis expectativas. La API quedó perfecta, bien documentada y con un código muy limpio. Definitivamente la recomiendo y trabajaré con ella nuevamente.',
            'comunicacion' => 5,
            'calidad_trabajo' => 5,
            'cumplimiento_plazo' => 5,
            'profesionalismo' => 5,
            'verificado' => true
        ]);

        // TRABAJO 6: COMPLETADO - Freelancer1
        $trabajo6 = Trabajo::create([
            'cliente_id' => $cliente2->id,
            'freelancer_id' => $freelancer1->id,
            'categoria_id' => 1,
            'titulo' => 'Sistema de reservas online',
            'descripcion' => 'Plataforma de reservas para hotel con calendario, pagos online y panel de administración.',
            'presupuesto_min' => 2500000,
            'tipo_presupuesto' => 'fijo',
            'duracion_estimada' => 45,
            'modalidad' => 'remoto',
            'estado' => 'completado',
            'nivel_experiencia' => 'avanzado',
            'publicado_en' => now()->subDays(90),
            'asignado_en' => now()->subDays(85),
            'completado_en' => now()->subDays(40),
            'num_propuestas' => 4
        ]);
        $trabajo6->habilidades()->attach([2, 3, 7]);

        Calificacion::create([
            'trabajo_id' => $trabajo6->id,
            'evaluador_id' => $cliente2->id,
            'evaluado_id' => $freelancer1->id,
            'tipo' => 'cliente_a_freelancer',
            'calificacion' => 5,
            'comentario' => 'Carlos es un desarrollador excepcional. El sistema de reservas quedó perfecto y funciona sin problemas. Muy profesional y cumplido con los tiempos. 100% recomendado!',
            'comunicacion' => 5,
            'calidad_trabajo' => 5,
            'cumplimiento_plazo' => 5,
            'profesionalismo' => 5,
            'verificado' => true
        ]);

        // TRABAJO 7: COMPLETADO - Freelancer2
        $trabajo7 = Trabajo::create([
            'cliente_id' => $cliente3->id,
            'freelancer_id' => $freelancer2->id,
            'categoria_id' => 2,
            'titulo' => 'Rediseño de sitio web',
            'descripcion' => 'Rediseño completo de sitio web empresarial con enfoque moderno y minimalista.',
            'presupuesto_min' => 1800000,
            'tipo_presupuesto' => 'fijo',
            'duracion_estimada' => 20,
            'modalidad' => 'remoto',
            'estado' => 'completado',
            'nivel_experiencia' => 'intermedio',
            'publicado_en' => now()->subDays(70),
            'asignado_en' => now()->subDays(65),
            'completado_en' => now()->subDays(45),
            'num_propuestas' => 3
        ]);
        $trabajo7->habilidades()->attach([8, 9, 10]);

        Calificacion::create([
            'trabajo_id' => $trabajo7->id,
            'evaluador_id' => $cliente3->id,
            'evaluado_id' => $freelancer2->id,
            'tipo' => 'cliente_a_freelancer',
            'calificacion' => 5,
            'comentario' => 'Ana es una diseñadora talentosísima. El rediseño superó ampliamente nuestras expectativas. Nuestros clientes han comentado muy positivamente sobre el nuevo look del sitio.',
            'comunicacion' => 5,
            'calidad_trabajo' => 5,
            'cumplimiento_plazo' => 4,
            'profesionalismo' => 5,
            'verificado' => true
        ]);

        // TRABAJO 8: EN PROGRESO - Freelancer1
        $trabajo8 = Trabajo::create([
            'cliente_id' => $cliente3->id,
            'freelancer_id' => $freelancer1->id,
            'categoria_id' => 1,
            'titulo' => 'Integración de API de pagos',
            'descripcion' => 'Integrar sistema de pagos con Stripe y MercadoPago en plataforma existente.',
            'presupuesto_min' => 800000,
            'tipo_presupuesto' => 'fijo',
            'duracion_estimada' => 15,
            'modalidad' => 'remoto',
            'estado' => 'en_progreso',
            'nivel_experiencia' => 'avanzado',
            'publicado_en' => now()->subDays(8),
            'asignado_en' => now()->subDays(5),
            'num_propuestas' => 2
        ]);
        $trabajo8->habilidades()->attach([2, 3]);

        // TRABAJO 9: COMPLETADO - Freelancer4
        $trabajo9 = Trabajo::create([
            'cliente_id' => $cliente2->id,
            'freelancer_id' => $freelancer4->id,
            'categoria_id' => 1,
            'titulo' => 'Dashboard administrativo React',
            'descripcion' => 'Dashboard con gráficos, tablas y gestión de usuarios usando React y TypeScript.',
            'presupuesto_min' => 1500000,
            'tipo_presupuesto' => 'fijo',
            'duracion_estimada' => 25,
            'modalidad' => 'remoto',
            'estado' => 'completado',
            'nivel_experiencia' => 'avanzado',
            'publicado_en' => now()->subDays(50),
            'asignado_en' => now()->subDays(45),
            'completado_en' => now()->subDays(20),
            'num_propuestas' => 4
        ]);
        $trabajo9->habilidades()->attach([3, 4]);

        Calificacion::create([
            'trabajo_id' => $trabajo9->id,
            'evaluador_id' => $cliente2->id,
            'evaluado_id' => $freelancer4->id,
            'tipo' => 'cliente_a_freelancer',
            'calificacion' => 5,
            'comentario' => 'Sofia es increíble! El dashboard quedó hermoso y súper rápido. Su atención al detalle y conocimiento de React es impresionante. Sin duda trabajaré con ella en futuros proyectos.',
            'comunicacion' => 5,
            'calidad_trabajo' => 5,
            'cumplimiento_plazo' => 5,
            'profesionalismo' => 5,
            'verificado' => true
        ]);

        // TRABAJO 10: Publicado - Recién creado
        $trabajo10 = Trabajo::create([
            'cliente_id' => $cliente3->id,
            'categoria_id' => 3,
            'titulo' => 'Consultoría SEO y optimización web',
            'descripcion' => 'Necesito experto en SEO para auditoría completa del sitio y plan de optimización para mejorar posicionamiento en Google.',
            'presupuesto_min' => 900000,
            'tipo_presupuesto' => 'fijo',
            'duracion_estimada' => 30,
            'modalidad' => 'remoto',
            'estado' => 'publicado',
            'nivel_experiencia' => 'experto',
            'publicado_en' => now()->subHours(6),
            'num_propuestas' => 0
        ]);
        $trabajo10->habilidades()->attach([11, 13]);

        $this->command->info('✅ Trabajos, propuestas y calificaciones creados');
        $this->command->info('');
        $this->command->info('===========================================');
        $this->command->info('Credenciales de prueba:');
        $this->command->info('');
        $this->command->info('CLIENTES:');
        $this->command->info('  • cliente1@freeland.com / password (Juan Pérez - 3 trabajos)');
        $this->command->info('  • cliente2@freeland.com / password (María González - 3 trabajos)');
        $this->command->info('  • cliente3@freeland.com / password (Roberto Silva - 4 trabajos)');
        $this->command->info('');
        $this->command->info('FREELANCERS:');
        $this->command->info('  • freelancer1@freeland.com / password (Carlos - Full Stack Laravel)');
        $this->command->info('  • freelancer2@freeland.com / password (Ana - Diseñadora UI/UX)');
        $this->command->info('  • freelancer3@freeland.com / password (Luis - Marketing Digital)');
        $this->command->info('  • freelancer4@freeland.com / password (Sofia - Frontend React)');
        $this->command->info('  • freelancer5@freeland.com / password (Diego - Backend Node.js)');
        $this->command->info('===========================================');
    }
}
