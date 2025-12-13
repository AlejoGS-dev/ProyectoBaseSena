<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\FreelancerProfile;
use App\Models\WorkspaceJob;
use App\Models\Proposal;
use App\Models\PortfolioItem;
use App\Models\Rating;
use Illuminate\Support\Facades\Hash;

class WorkspaceSeeder extends Seeder
{
    public function run(): void
    {
        // Crear 3 Clientes
        $cliente1 = User::create([
            'name' => 'Tech Startup Inc',
            'email' => 'cliente1@workspace.com',
            'password' => Hash::make('password'),
            'activo' => 1,
        ]);
        $cliente1->assignRole('cliente');

        $cliente2 = User::create([
            'name' => 'Marketing Agency',
            'email' => 'cliente2@workspace.com',
            'password' => Hash::make('password'),
            'activo' => 1,
        ]);
        $cliente2->assignRole('cliente');

        $cliente3 = User::create([
            'name' => 'E-commerce Solutions',
            'email' => 'cliente3@workspace.com',
            'password' => Hash::make('password'),
            'activo' => 1,
        ]);
        $cliente3->assignRole('cliente');

        // Crear 5 Freelancers con perfiles completos
        $freelancer1 = User::create([
            'name' => 'Ana García',
            'email' => 'ana.garcia@workspace.com',
            'password' => Hash::make('password'),
            'activo' => 1,
        ]);
        $freelancer1->assignRole('freelancer');

        FreelancerProfile::create([
            'user_id' => $freelancer1->id,
            'title' => 'Desarrolladora Full Stack Senior',
            'bio' => 'Desarrolladora con 5 años de experiencia en Laravel, Vue.js y React. Especializada en aplicaciones web escalables y APIs RESTful.',
            'location' => 'Madrid, España',
            'hourly_rate' => 45.00,
            'years_experience' => 5,
            'jobs_completed' => 23,
            'rating' => 4.8,
            'total_earned' => 12500.00,
            'success_rate' => 95.65,
            'github_url' => 'https://github.com/anagarcia',
            'linkedin_url' => 'https://linkedin.com/in/anagarcia',
        ]);

        $freelancer2 = User::create([
            'name' => 'Carlos Rodríguez',
            'email' => 'carlos.rodriguez@workspace.com',
            'password' => Hash::make('password'),
            'activo' => 1,
        ]);
        $freelancer2->assignRole('freelancer');

        FreelancerProfile::create([
            'user_id' => $freelancer2->id,
            'title' => 'Diseñador UI/UX',
            'bio' => 'Diseñador creativo especializado en interfaces modernas y experiencias de usuario intuitivas. Experto en Figma, Adobe XD.',
            'location' => 'Barcelona, España',
            'hourly_rate' => 40.00,
            'years_experience' => 4,
            'jobs_completed' => 18,
            'rating' => 4.9,
            'total_earned' => 8900.00,
            'success_rate' => 100.00,
            'behance_url' => 'https://behance.net/carlosrodriguez',
            'linkedin_url' => 'https://linkedin.com/in/carlosrodriguez',
        ]);

        $freelancer3 = User::create([
            'name' => 'María López',
            'email' => 'maria.lopez@workspace.com',
            'password' => Hash::make('password'),
            'activo' => 1,
        ]);
        $freelancer3->assignRole('freelancer');

        FreelancerProfile::create([
            'user_id' => $freelancer3->id,
            'title' => 'Desarrolladora Mobile (iOS/Android)',
            'bio' => 'Desarrolladora mobile especializada en Flutter y React Native. Experiencia en publicación de apps en App Store y Google Play.',
            'location' => 'Valencia, España',
            'hourly_rate' => 50.00,
            'years_experience' => 6,
            'jobs_completed' => 31,
            'rating' => 4.7,
            'total_earned' => 18200.00,
            'success_rate' => 93.55,
            'github_url' => 'https://github.com/marialopez',
            'website_url' => 'https://marialopez.dev',
        ]);

        $freelancer4 = User::create([
            'name' => 'David Martínez',
            'email' => 'david.martinez@workspace.com',
            'password' => Hash::make('password'),
            'activo' => 1,
        ]);
        $freelancer4->assignRole('freelancer');

        FreelancerProfile::create([
            'user_id' => $freelancer4->id,
            'title' => 'Especialista en DevOps',
            'bio' => 'Ingeniero DevOps con experiencia en AWS, Docker, Kubernetes y CI/CD. Automatización de infraestructura y despliegues.',
            'location' => 'Sevilla, España',
            'hourly_rate' => 55.00,
            'years_experience' => 7,
            'jobs_completed' => 15,
            'rating' => 5.0,
            'total_earned' => 9800.00,
            'success_rate' => 100.00,
            'github_url' => 'https://github.com/davidmartinez',
            'linkedin_url' => 'https://linkedin.com/in/davidmartinez',
        ]);

        $freelancer5 = User::create([
            'name' => 'Laura Fernández',
            'email' => 'laura.fernandez@workspace.com',
            'password' => Hash::make('password'),
            'activo' => 1,
        ]);
        $freelancer5->assignRole('freelancer');

        FreelancerProfile::create([
            'user_id' => $freelancer5->id,
            'title' => 'Content Writer & SEO Specialist',
            'bio' => 'Redactora de contenidos y especialista en SEO. Experiencia en copywriting, blogs técnicos y estrategias de contenido.',
            'location' => 'Bilbao, España',
            'hourly_rate' => 30.00,
            'years_experience' => 3,
            'jobs_completed' => 42,
            'rating' => 4.6,
            'total_earned' => 7500.00,
            'success_rate' => 97.67,
            'linkedin_url' => 'https://linkedin.com/in/laurafernandez',
            'website_url' => 'https://laurafernandez.blog',
        ]);

        // Portfolio Items
        PortfolioItem::create([
            'freelancer_id' => $freelancer1->id,
            'title' => 'E-commerce Platform',
            'description' => 'Plataforma de comercio electrónico completa con panel de administración, carrito de compras y pasarela de pago.',
            'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Stripe'],
            'start_date' => '2024-01-15',
            'end_date' => '2024-04-20',
            'category' => 'Web Development',
        ]);

        PortfolioItem::create([
            'freelancer_id' => $freelancer2->id,
            'title' => 'Dashboard Analytics UI',
            'description' => 'Diseño de interfaz moderna para dashboard de analytics con visualizaciones de datos interactivas.',
            'technologies' => ['Figma', 'Adobe XD'],
            'start_date' => '2024-02-10',
            'end_date' => '2024-03-05',
            'category' => 'UI/UX Design',
        ]);

        PortfolioItem::create([
            'freelancer_id' => $freelancer3->id,
            'title' => 'Fitness Tracking App',
            'description' => 'Aplicación móvil para seguimiento de ejercicios y nutrición con integración de wearables.',
            'technologies' => ['Flutter', 'Firebase', 'Google Fit API'],
            'start_date' => '2023-11-01',
            'end_date' => '2024-02-28',
            'category' => 'Mobile Development',
        ]);

        PortfolioItem::create([
            'freelancer_id' => $freelancer1->id,
            'title' => 'API REST para Sistema de Reservas',
            'description' => 'API robusta para sistema de reservas hoteleras con autenticación JWT y documentación completa.',
            'technologies' => ['Laravel', 'PostgreSQL', 'Redis', 'Swagger'],
            'start_date' => '2024-05-01',
            'end_date' => '2024-06-15',
            'category' => 'Backend Development',
        ]);

        PortfolioItem::create([
            'freelancer_id' => $freelancer4->id,
            'title' => 'CI/CD Pipeline para Microservicios',
            'description' => 'Implementación de pipeline completo de CI/CD para arquitectura de microservicios en Kubernetes.',
            'technologies' => ['Jenkins', 'Docker', 'Kubernetes', 'AWS'],
            'start_date' => '2024-03-01',
            'end_date' => '2024-04-10',
            'category' => 'DevOps',
        ]);

        // 10 Trabajos en diferentes estados
        // 4 PUBLICADOS (disponibles para propuestas)
        $job1 = WorkspaceJob::create([
            'client_id' => $cliente1->id,
            'title' => 'Desarrollo de Sistema de Gestión de Inventarios',
            'description' => 'Necesito un sistema web para gestionar inventarios de múltiples almacenes con reportes en tiempo real.',
            'category' => 'Web Development',
            'budget' => 2500.00,
            'budget_type' => 'fixed',
            'status' => 'published',
            'deadline' => '2025-02-15',
            'skills' => ['Laravel', 'Vue.js', 'MySQL'],
        ]);

        $job2 = WorkspaceJob::create([
            'client_id' => $cliente2->id,
            'title' => 'Diseño de Landing Page para Campaña de Marketing',
            'description' => 'Busco diseñador para crear landing page moderna y atractiva para campaña de lanzamiento de producto.',
            'category' => 'Design',
            'budget' => 800.00,
            'budget_type' => 'fixed',
            'status' => 'published',
            'deadline' => '2025-01-20',
            'skills' => ['Figma', 'UI/UX', 'Responsive Design'],
        ]);

        $job3 = WorkspaceJob::create([
            'client_id' => $cliente3->id,
            'title' => 'Optimización SEO para E-commerce',
            'description' => 'Necesito especialista en SEO para optimizar mi tienda online y mejorar posicionamiento en Google.',
            'category' => 'Marketing',
            'budget' => 35.00,
            'budget_type' => 'hourly',
            'status' => 'published',
            'deadline' => '2025-03-01',
            'skills' => ['SEO', 'Content Writing', 'Google Analytics'],
        ]);

        $job4 = WorkspaceJob::create([
            'client_id' => $cliente1->id,
            'title' => 'Migración a Infraestructura Cloud (AWS)',
            'description' => 'Proyecto de migración de servidores on-premise a AWS con configuración de autoscaling y backups.',
            'category' => 'DevOps',
            'budget' => 3500.00,
            'budget_type' => 'fixed',
            'status' => 'published',
            'deadline' => '2025-02-28',
            'skills' => ['AWS', 'Docker', 'Terraform'],
        ]);

        // 2 EN PROGRESO
        $job5 = WorkspaceJob::create([
            'client_id' => $cliente2->id,
            'freelancer_id' => $freelancer1->id,
            'title' => 'Desarrollo de Dashboard de Analytics',
            'description' => 'Dashboard interactivo con gráficos y reportes personalizables para análisis de datos de marketing.',
            'category' => 'Web Development',
            'budget' => 1800.00,
            'budget_type' => 'fixed',
            'status' => 'in_progress',
            'deadline' => '2025-01-30',
            'skills' => ['Laravel', 'Chart.js', 'MySQL'],
        ]);

        $job6 = WorkspaceJob::create([
            'client_id' => $cliente3->id,
            'freelancer_id' => $freelancer3->id,
            'title' => 'App Móvil para Delivery',
            'description' => 'Aplicación móvil para servicio de delivery con tracking en tiempo real y pagos integrados.',
            'category' => 'Mobile Development',
            'budget' => 4500.00,
            'budget_type' => 'fixed',
            'status' => 'in_progress',
            'deadline' => '2025-02-20',
            'skills' => ['Flutter', 'Firebase', 'Google Maps API'],
        ]);

        // 4 COMPLETADOS
        $job7 = WorkspaceJob::create([
            'client_id' => $cliente1->id,
            'freelancer_id' => $freelancer2->id,
            'title' => 'Rediseño de Sitio Web Corporativo',
            'description' => 'Rediseño completo de sitio web corporativo con enfoque en UX y diseño moderno.',
            'category' => 'Design',
            'budget' => 1500.00,
            'budget_type' => 'fixed',
            'status' => 'completed',
            'deadline' => '2024-12-15',
            'skills' => ['Figma', 'UI/UX', 'Web Design'],
        ]);

        $job8 = WorkspaceJob::create([
            'client_id' => $cliente2->id,
            'freelancer_id' => $freelancer5->id,
            'title' => 'Redacción de Blog Posts Técnicos',
            'description' => 'Serie de 10 artículos técnicos sobre desarrollo web y mejores prácticas de programación.',
            'category' => 'Content Writing',
            'budget' => 600.00,
            'budget_type' => 'fixed',
            'status' => 'completed',
            'deadline' => '2024-12-01',
            'skills' => ['Content Writing', 'SEO', 'Technical Writing'],
        ]);

        $job9 = WorkspaceJob::create([
            'client_id' => $cliente3->id,
            'freelancer_id' => $freelancer1->id,
            'title' => 'Integración de Pasarela de Pago',
            'description' => 'Integración de Stripe y PayPal en plataforma e-commerce existente.',
            'category' => 'Web Development',
            'budget' => 900.00,
            'budget_type' => 'fixed',
            'status' => 'completed',
            'deadline' => '2024-11-30',
            'skills' => ['Laravel', 'Stripe API', 'PayPal API'],
        ]);

        $job10 = WorkspaceJob::create([
            'client_id' => $cliente1->id,
            'freelancer_id' => $freelancer4->id,
            'title' => 'Configuración de Servidor y Despliegue',
            'description' => 'Configuración de servidor VPS, instalación de Docker y despliegue de aplicación Laravel.',
            'category' => 'DevOps',
            'budget' => 500.00,
            'budget_type' => 'fixed',
            'status' => 'completed',
            'deadline' => '2024-12-10',
            'skills' => ['Linux', 'Docker', 'Nginx'],
        ]);

        // Propuestas para trabajos PUBLICADOS
        // Trabajo 1: 3 propuestas
        Proposal::create([
            'job_id' => $job1->id,
            'freelancer_id' => $freelancer1->id,
            'cover_letter' => 'Tengo amplia experiencia desarrollando sistemas de gestión con Laravel y Vue.js. He completado proyectos similares de inventarios multialmacén. Puedo entregar en 4 semanas.',
            'proposed_amount' => 2300.00,
            'delivery_days' => 28,
            'status' => 'pending',
        ]);

        Proposal::create([
            'job_id' => $job1->id,
            'freelancer_id' => $freelancer3->id,
            'cover_letter' => 'Soy desarrolladora full stack con experiencia en sistemas de gestión empresarial. Propongo una solución escalable con reportes en tiempo real.',
            'proposed_amount' => 2500.00,
            'delivery_days' => 35,
            'status' => 'pending',
        ]);

        Proposal::create([
            'job_id' => $job1->id,
            'freelancer_id' => $freelancer4->id,
            'cover_letter' => 'Como DevOps, puedo no solo desarrollar el sistema sino también configurar la infraestructura para máxima disponibilidad.',
            'proposed_amount' => 2800.00,
            'delivery_days' => 30,
            'status' => 'pending',
        ]);

        // Trabajo 2: 1 propuesta
        Proposal::create([
            'job_id' => $job2->id,
            'freelancer_id' => $freelancer2->id,
            'cover_letter' => 'Diseñador UI/UX especializado en landing pages de alta conversión. He trabajado con varias agencias de marketing creando páginas que convierten.',
            'proposed_amount' => 750.00,
            'delivery_days' => 10,
            'status' => 'pending',
        ]);

        // Propuestas ACEPTADAS para trabajos en progreso
        Proposal::create([
            'job_id' => $job5->id,
            'freelancer_id' => $freelancer1->id,
            'cover_letter' => 'Desarrolladora con experiencia en dashboards y visualización de datos. He trabajado con Chart.js y D3.js extensivamente.',
            'proposed_amount' => 1800.00,
            'delivery_days' => 21,
            'status' => 'accepted',
        ]);

        Proposal::create([
            'job_id' => $job6->id,
            'freelancer_id' => $freelancer3->id,
            'cover_letter' => 'Especialista en Flutter con experiencia en apps de delivery. He integrado múltiples servicios de tracking y pagos.',
            'proposed_amount' => 4500.00,
            'delivery_days' => 45,
            'status' => 'accepted',
        ]);

        // Calificaciones para trabajos completados
        Rating::create([
            'job_id' => $job7->id,
            'from_user_id' => $cliente1->id,
            'to_user_id' => $freelancer2->id,
            'overall_rating' => 5.0,
            'communication' => 5,
            'quality' => 5,
            'timeliness' => 5,
            'professionalism' => 5,
            'comment' => 'Excelente trabajo! El diseño superó nuestras expectativas. Carlos fue muy profesional y entregó a tiempo.',
        ]);

        Rating::create([
            'job_id' => $job8->id,
            'from_user_id' => $cliente2->id,
            'to_user_id' => $freelancer5->id,
            'overall_rating' => 4.5,
            'communication' => 5,
            'quality' => 4,
            'timeliness' => 5,
            'professionalism' => 4,
            'comment' => 'Muy buen contenido técnico. Laura tiene excelente capacidad de explicar conceptos complejos de manera simple.',
        ]);

        Rating::create([
            'job_id' => $job9->id,
            'from_user_id' => $cliente3->id,
            'to_user_id' => $freelancer1->id,
            'overall_rating' => 4.8,
            'communication' => 5,
            'quality' => 5,
            'timeliness' => 4,
            'professionalism' => 5,
            'comment' => 'Ana integró perfectamente las pasarelas de pago. Todo funciona sin problemas. Muy recomendable.',
        ]);

        Rating::create([
            'job_id' => $job10->id,
            'from_user_id' => $cliente1->id,
            'to_user_id' => $freelancer4->id,
            'overall_rating' => 5.0,
            'communication' => 5,
            'quality' => 5,
            'timeliness' => 5,
            'professionalism' => 5,
            'comment' => 'David configuró todo perfectamente. El servidor está funcionando de manera óptima. Trabajo impecable.',
        ]);
    }
}
