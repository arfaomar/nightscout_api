# Nightscout Laravel Middleware

Eine leichtgewichtige, Nightscout-kompatible Middleware-API in PHP (Laravel), die AndroidAPS unterstützt.

---
## Projektbeschreibung
Implementieren Sie eine Middleware in PHP, die Anfragen an die "Nightscout API" annimmt und in SQL-Datenbank-Anfragen übersetzt. Parallel soll die Middleware die Datenbank entsprechend der API-Anfragen pflegen. Die Technologie-Wahl soll ein besonders preisgünstiges Hosting ermöglichen und ist daher fest vorgegeben.

Dieses Projekt simuliert die Nightscout-API mit Laravel und ersetzt MongoDB durch SQL-Kompatibilität. Es wurde so aufgebaut, dass es mit AndroidAPS verbunden werden kann.

##  Features

-  Kompatibel mit AndroidAPS (via Socket.IO)
-  Unterstützt Nightscout-Endpunkte: `/entries`, `/treatments`, `/devicestatus`, `/profile`, ...
-  Keine MongoDB notwendig
-  Vorbereitung für SQLite/MySQL Speicherung
---

##  Projektstart (lokal)

### 1. Repository klonen

```bash
git clone https://code.fbi.h-da.de/istkrsadl/nightscoutpse.git
cd NightscoutPSE
```

### 2. Abhängigkeiten installieren

```bash
composer install
cp .env.example .env
```

### 3. Server starten

```bash
php artisan serve
```

Server läuft dann auf:\
 `http://127.0.0.1:8000`

---


##  Unterstützte API-Endpunkte

| Kategorie      | Pfad                            |
| -------------- | ------------------------------- |
| Entries        | `/api/entries`                  |
| Treatments     | `/api/treatments`               |
| DeviceStatus   | `/api/devicestatus`             |
| Profile        | `/api/profile`, `/profiles`     |
| Status         | `/api/status`                   |
| Activity       | `/api/activity`                 |
| Notifications  | `/api/notifications/*`          |
| AdminNotifies  | `/api/adminnotifies`            |
| VerifyAuth     | `/api/verifyauth`               |
| Alexa / Google | `/api/alexa`, `/api/googlehome` |
| Root           | `/api/versions`                 |


---

##  Struktur

```bash
app/Http/Controllers/       # Alle API-Controller
routes/api.php              # Alle API-Routen (Nightscout-kompatibel)
storage/debug/              # JSON-Dateien für gespeicherte Daten
```

---
## Projektteam
- Omar Ibrahim Arfa
- Elyes Lachal
- Simon Pototzki
- Krystian Sadlo
- Aiham Zaria