# Store-A-Number Web-Anwendung

## Projektbeschreibung

Diese Webanwendung wurde im Rahmen eines Studienprojekts entwickelt. Sie ermöglicht Benutzern, sich zu registrieren, anzumelden und eine Nummer zu speichern. Die Anwendung demonstriert die Implementierung einer modernen Full-Stack-Webanwendung.

## Technologie-Stack

### Frontend

- **Vue.js 3**
  - Composition API
  - Vue Router für Routing
  - Single File Components
  - Reactive Data Management
- **Vuex 4**
  - Zentrales State Management
  - Benutzer-Authentifizierung
  - Persistente Datenspeicherung
- **Axios**
  - HTTP-Client für API-Kommunikation
  - Interceptors für Auth-Header
  - Error Handling
- **Vite**
  - Hot Module Replacement (HMR)
  - Schnelle Build-Zeiten
  - Optimierte Asset-Verarbeitung

### Backend

- **PHP 8.2**
  - Objektorientierte Architektur
  - Session Management
  - Sichere Passwort-Verschlüsselung
- **Apache Webserver**
  - Mod_rewrite für URL-Routing
  - Sichere SSL/TLS-Konfiguration
  - Access Control
- **MariaDB**
  - Relationale Datenbank
  - Prepared Statements
  - Transaktionssicherheit
- **Composer**
  - Dependency Management
  - Autoloading
  - PHPDotenv für Konfiguration

### Infrastruktur

- **Docker & Docker Compose**
  - Multi-Container-Setup
  - Development/Production Environments
  - Volume Management
- **Nginx**
  - Reverse Proxy
  - SSL Termination
  - Load Balancing
- **Docker Networking**
  - Isolierte Container-Netzwerke
  - Service Discovery
  - Sicherer Container-Kommunikation

## Installation

### Voraussetzungen

- Docker und Docker Compose
- Git

### Setup

```bash
# Repository klonen
git clone https://github.com/someonesocial/storeanumber

# In das Projektverzeichnis wechseln
cd storeanumber

# Frontend-Dependencies installieren
cd frontend
npm install

# Backend-Dependencies installieren
cd backend
composer install

# Docker-Container starten
docker-compose up -d
```

## Projektstruktur

```
.
├── backend/                 # PHP Backend
│   ├── src/                # PHP Quellcode
│   ├── public/             # Öffentliche Dateien
│   └── Dockerfile
├── frontend/               # Vue.js Frontend
│   ├── src/               # Frontend Quellcode
│   ├── public/            # Statische Dateien
│   └── Dockerfile
├── database/              # Datenbank
│   └── init.sql          # Initialisierungsskript
└── docker-compose.yml    # Container-Orchestrierung
```

## API-Dokumentation

### Authentifizierung

Alle authentifizierten Endpunkte erfordern einen gültigen Session-Cookie.

### API-Endpunkte

| Endpunkt        | Methode | Beschreibung          | Authentifizierung |
| --------------- | ------- | --------------------- | ----------------- |
| /api/register   | POST    | Benutzerregistrierung | Nein              |
| /api/login      | POST    | Benutzeranmeldung     | Nein              |
| /api/logout     | POST    | Abmelden              | Ja                |
| /api/saveNumber | POST    | Nummer speichern      | Ja                |
| /api/getNumber  | GET     | Nummer abrufen        | Ja                |

## Sicherheitsmerkmale

- Session-basierte Authentifizierung
- CORS-Konfiguration
- HTTP-Only Cookies
- Prepared Statements für SQL
- Sichere Passwort-Hashing
- XSS-Schutz
- CSRF-Schutz

## Entwicklungsumgebung

### Frontend-Entwicklung

```bash
cd frontend
npm install
npm run dev
```

### Backend-Entwicklung

```bash
cd backend
composer install
```

## Architektur

### Frontend

- Single Page Application (SPA)
- Komponenten-basierte Architektur
- Zentrales State Management
- Reaktive Datenbindung

### Backend

- REST-API
- MVC-Architektur
- PDO für Datenbankzugriffe
- Umgebungsvariablen-Konfiguration

## Testumgebung

Die Anwendung kann lokal unter folgenden URLs erreicht werden:

- Frontend: http://localhost:8080
- Backend API: http://localhost:8080/api
