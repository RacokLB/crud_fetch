👥 Personnel Management System (CRUD Fetch PHP)
🚀 Streamlining HR Operations through Modular Architecture and Automation
This project is a robust web application for personnel management (employees and dependents), built with a modular PHP architecture and a powerful automation integration using n8n.

📋 Key Features
Comprehensive Employee Management: Detailed records for personal, labor, uniform sizing, and residential information.

Dynamic Family Relations: Integrated system to manage and link dependents associated with each employee.

MVC Architecture (Model-View-Controller): Clear separation of concerns ensuring high maintainability and scalability.

Modern & Reactive Interface: Intensive use of JavaScript Fetch API for a fluid user experience without page reloads.

Statistical Dashboards: Real-time charts and metrics regarding personnel distribution and demographics.

n8n Automation: Automatic document generation and notifications via intelligent workflows.

🛠️ Tech Stack
Backend: PHP 8+ (Repository Pattern, PDO).

Frontend: HTML5, Modern CSS, Bootstrap, JavaScript (Vanilla ES6+).

Database: MySQL / MariaDB.

Automation: n8n (Webhooks, Google Docs, Gmail, Google Drive).

Server: Apache (with .htaccess enabled).

🤖 n8n Integration
The project features an advanced integration that triggers an n8n workflow every time a new employee is registered.

Workflow: "Point Control" (Official Memorandum)
The workflow configuration file is located in the root directory: Point Control (3).json.

How it works:

Webhook: TrabajadorController.php sends a POST request to the n8n webhook with the new employee's data.

Transformation: n8n formats dates and prepares the necessary data fields.

Template Lookup: Automatically locates the "Punto de Cuenta" (Official Memo) template in Google Drive.

Document Generation: Creates a copy of the template and replaces tags (e.g., {{name}}, {{id_number}}) with real-time employee data.

Conversion & Download: Converts the generated document into a PDF format.

Email Notification: Sends the PDF as an attachment to the Administrator/HR email via Gmail.

📂 Project Structure
Config/: Database connection settings.

Controllers/: Business logic and request handling.

Models/: Entities and Repositories for data access.

View/: UI templates and layouts.

Public/: Static assets (JavaScript, CSS, Images).

Enrutador/: Dynamic routing system for the application.

index.php: Main entry point with session and CORS handling.

⚙️ Installation & Setup
Clone the repository to your local server (e.g., XAMPP/htdocs).

Import the database schema (refer to the Models folder or SQL dump).

Configure credentials in Config/POOConexion.php.

Enable Apache mod_rewrite to ensure routing works correctly.

How to Import the Workflow in n8n
Open your n8n instance.

Go to Settings > Import from File.

Select the Point Control (3).json file from this repository.

Configure your credentials for Google Drive, Google Docs, and Gmail.

Copy your Production Webhook URL and ensure it matches the one configured in Controllers/trabajadorController.php.

Developed by: Victor Batista

Full Stack & Automation Engineer specialized in process optimization.
