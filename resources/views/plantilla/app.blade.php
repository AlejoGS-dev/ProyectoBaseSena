<!doctype html>
<html lang="es">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sistema</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Sistema | ArtCode.com" />
    <meta name="author" content="ArtCode" />
    <meta
      name="description"
      content="Sistema."
    />
    <meta
      name="keywords"
      content="Sistema, ArtCode"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{asset('css/adminlte.css')}}" />
    <!--end::Required Plugin(AdminLTE)-->

    {{-- ✅ Estilos del chat flotante Freeland --}}
    <style>
      #chat-floating-btn {
        position: fixed;
        bottom: 25px;
        right: 25px;
        background: #8a00ff;
        color: #ffffff;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 26px;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(0,0,0,0.3);
        z-index: 999999;
      }

      #chat-floating-window {
        position: fixed;
        bottom: 90px;
        right: 25px;
        width: 360px;
        height: 480px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.3);
        overflow: hidden;
        display: none;
        flex-direction: column;
        z-index: 999999;
      }

      #chat-floating-window .chat-header {
        background: #8a00ff;
        color: #ffffff;
        padding: 10px 12px;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
      }

      #chat-floating-window .chat-header span {
        display: flex;
        align-items: center;
        gap: 8px;
      }

      #chat-floating-window .chat-header span::before {
        content: '💬';
      }

      #chat-floating-window #chat-iframe {
        border: none;
        width: 100%;
        height: calc(100% - 45px);
      }

      #chat-close {
        background: transparent;
        border: none;
        color: #ffffff;
        font-size: 20px;
        line-height: 1;
        cursor: pointer;
      }

      @media (max-width: 768px) {
        #chat-floating-window {
          right: 10px;
          width: calc(100% - 20px);
          height: 60vh;
        }
      }
    </style>

    @stack('estilos')
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      @include('plantilla.header')
      <!--end::Header-->
      <!--begin::Sidebar-->
      @include('plantilla.menu')
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">

          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        @yield('contenido')
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2025&nbsp;
          <a href="#" class="text-decoration-none">ArtCode</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->

    {{-- ✅ Chat flotante Freeland --}}
    <div id="chat-floating-btn" title="Abrir chat">
      💬
    </div>

    <div id="chat-floating-window">
      <div class="chat-header">
        <span>Freeland Chat</span>
        <button id="chat-close">×</button>
      </div>
      <iframe id="chat-iframe" src="{{ route('chatify') }}"></iframe>
    </div>

    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{asset('js/adminlte.js')}}"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });

      // ✅ Lógica del chat flotante
      document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('chat-floating-btn');
        const win = document.getElementById('chat-floating-window');
        const closeBtn = document.getElementById('chat-close');

        if (!btn || !win || !closeBtn) return;

        btn.addEventListener('click', function () {
          win.style.display = 'flex';
        });

        closeBtn.addEventListener('click', function () {
          win.style.display = 'none';
        });
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
    @stack('scripts')
  </body>
  <!--end::Body-->
</html>
