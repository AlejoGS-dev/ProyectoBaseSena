<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Freeland | Dashboard</title>
  <link href="https://fonts.googleapis.com/css?family=Inter:400,600&display=swap" rel="stylesheet">
<link href="{{ asset('css/home/inicio.css') }}" rel="stylesheet">

</head>
<body>
  <aside class="sidebar">
    <div class="logo">Freeland</div>
    <nav>
      <ul>
        <li class="active">Inicio</li>
        <li>Workspace Cliente</li>
        <li>Workspace Freelancer</li>
        <li>Eventos / Retos</li>
        <li>Ajustes</li>
      </ul>
    </nav>
  </aside>
  <header class="top-bar">
    <input type="text" class="search" placeholder="Buscar proyectos, personas, publicaciones..."/>
    <div class="profile">
      <span class="icon-bell">&#128276;</span>
      <img src="https://ui-avatars.com/api/?name=Juan&background=ededed&color=7c3aed" class="avatar" alt="Juan" />
      <span class="profile-name">Juan</span>
    </div>
  </header>
  <main class="main-content">
    <div class="share-card">
      <div class="share-header">
        <img src="https://ui-avatars.com/api/?name=Juan&background=ededed&color=363636" class="avatar-large" alt="Juan" />
        <input type="text" class="share-input" placeholder="¿Qué quieres compartir, Juan?" disabled />
      </div>
      <div class="share-actions">
        <button class="share-action">
          <span class="share-icon">&#128188;</span>
          Proyecto
        </button>
        <button class="share-action">
          <span class="share-icon">&#127942;</span>
          Logro
        </button>
        <button class="share-action">
          <span class="share-icon">&#128101;</span>
          Colaboración
        </button>
        <button class="share-action">
          <span class="share-icon">&#128247;</span>
          Foto
        </button>
      </div>
    </div>

    <div class="no-publications">
        <div class="empty-icon">&#128230;</div>
        <p>No hay publicaciones aún</p>
        <span>Sé el primero en compartir algo...</span>
      </div>

  </main>
</body>
</html>
