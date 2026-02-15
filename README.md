# Sistema de Gestión de Personal (CRUD Fetch PHP)

Este proyecto es una aplicación web robusta para la gestión de personal (trabajadores y parientes), construida con una arquitectura modular en PHP y con una potente integración de automatización mediante **n8n**.

## 🚀 Características Principales

- **Gestión Integral de Trabajadores:** Registro detallado de información personal, laboral, vestimenta y dirección.
- **Relaciones Familiares:** Sistema dinámico para gestionar parientes asociados a cada trabajador.
- **Arquitectura MVC (Modelo-Vista-Controlador):** Separación clara de responsabilidades para mayor mantenibilidad.
- **Interfaz Moderna y Reactiva:** Uso intensivo de `Fetch API` en JavaScript para una experiencia de usuario fluida sin recargas de página.
- **Dashboards Estadísticos:** Gráficos y métricas en tiempo real sobre la distribución del personal.
- **Automatización con n8n:** Generación automática de documentos y notificaciones mediante flujos de trabajo inteligentes.

## 🛠️ Stack Tecnológico

- **Backend:** PHP 8+ (Repository Pattern, PDO)
- **Frontend:** HTML5, Modern CSS, Bootstrap, JavaScript (Vanilla ES6+)
- **Base de Datos:** MySQL / MariaDB
- **Automatización:** n8n (Webhooks, Google Docs, Gmail, Google Drive)
- **Servidor:** Apache ($htaccess habilitado)

## 🤖 Integración con n8n

El proyecto cuenta con un feature avanzado que dispara un flujo de trabajo en n8n cada vez que se registra un nuevo trabajador.

### Flujo de Trabajo: "Point Control"

El archivo de configuración del flujo se encuentra en la raíz del proyecto: `Point Control (3).json`.

**Funcionamiento:**

1. **Webhook:** El `TrabajadorController.php` envía una petición POST al webhook de n8n con los datos del nuevo trabajador.
2. **Transformación:** n8n formatea las fechas y prepara los campos necesarios.
3. **Búsqueda de Plantilla:** Localiza automáticamente la plantilla de "Punto de Cuenta" en Google Drive.
4. **Generación de Documento:** Crea una copia de la plantilla y reemplaza los tags (ej: `{{nombre}}`, `{{cedula}}`) con la información real del trabajador.
5. **Conversión y Descarga:** Convierte el documento generado a PDF.
6. **Notificación por Email:** Envía el documento adjunto al correo del administrador/RRHH mediante Gmail.

### Cómo Importar el Workflow en n8n

1. Abre tu instancia de n8n.
2. Ve a **Settings > Import from File**.
3. Selecciona el archivo `Point Control (3).json` que se encuentra en este repositorio.
4. Configura tus credenciales de Google Drive, Google Docs y Gmail.
5. Copia la URL de tu Webhook y asegúrate de que coincida con la configurada en `Controllers/trabajadorController.php`.

## 📂 Estructura del Proyecto

- `Config/`: Configuraciones de conexión a DB.
- `Controllers/`: Lógica de negocio y manejo de peticiones.
- `Models/`: Entidades y Repositorios para acceso a datos.
- `View/`: Plantillas representativas de la interfaz de usuario.
- `Public/`: Archivos estáticos (JavaScript, CSS, Imágenes).
- `Enrutador/`: Sistema de rutas dinámico para la aplicación.
- `index.php`: Punto de entrada principal con manejo de sesiones y CORS.

## ⚙️ Instalación

1. Clona el repositorio en tu servidor local (ej: XAMPP/htdocs).
2. Importa el esquema de la base de datos (ver carpeta `Models` o similar).
3. Configura las credenciales en `Config/POOConexion.php`.
4. Asegúrate de tener activado el `mod_rewrite` en Apache.
