# Store-A-Number Web-Anwendung

## Projektbeschreibung

Diese Webanwendung wurde im Rahmen eines Studienprojekts entwickelt. Sie ermöglicht Benutzern, sich zu registrieren, anzumelden und eine Nummer zu speichern. Die Anwendung demonstriert die Implementierung einer modernen Full-Stack-Webanwendung.

## Technologie-Stack

### Frontend

- Vue.js 3 (Frontend-Framework)
- Vuex (State Management)
- Axios (HTTP-Client)
- Vite (Build-Tool)

### Backend

- PHP 8.2
- Apache Webserver
- MariaDB (Datenbank)
- Composer (PHP-Abhängigkeiten)

### Infrastruktur

- Docker & Docker Compose
- Nginx (Reverse Proxy)
- Docker Networking

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

## API-Endpunkte

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

## Deployment

Die Anwendung ist vollständig containerisiert und kann mit einem Befehl deployt werden:

```bash
docker-compose up -d --build
```

## Testumgebung

Die Anwendung kann lokal unter folgenden URLs erreicht werden:

- Frontend: http://localhost:8080
- Backend API: http://localhost:8080/api
