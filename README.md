# Professional IT Support Specialist & Full-Stack Developer Portfolio

A production-ready personal portfolio web application and content management system engineered with a decoupled architecture: **Vue 3 + TypeScript + Tailwind CSS** frontend and a **Laravel 11 RESTful API** backend with **Sanctum** token authentication.

---

## 🌟 Architecture & Technology Stack

### Frontend
- **Framework**: Vue 3 (Composition API `<script setup lang="ts">`)
- **Language**: TypeScript
- **Bundler**: Vite 8
- **Styling**: Tailwind CSS & Glassmorphic UI design
- **Component Library**: Element Plus (Tables, Modals, Forms, Sliders) & Lucide Icons
- **State Management**: Pinia Store
- **Router**: Vue Router with Authentication Navigation Guards
- **HTTP Client**: Axios with Bearer token interceptors
- **Theme**: Dark & Light mode toggle with persistent `localStorage`

### Backend
- **Framework**: Laravel 11 (PHP 8.2+)
- **API Architecture**: RESTful API with standardized JSON response envelopes
- **Authentication**: Laravel Sanctum Token Authentication
- **Database**: SQLite (local development) / MySQL (production ready)
- **Data Layer**: 20 Normalized Migrations, Eloquent Models with relationships (`hasMany`, `belongsTo`, `belongsToMany`), and comprehensive Seeders.
- **Validation**: Form Request Validation

---

## 🧭 Application Modules & Route Map

### 🌐 Public Experience
- `/` - **Home**: Hero section, profile portrait, live stats banner, developer CLI terminal, featured projects, and client testimonials.
- `/about` - **About Me**: Professional narrative, IT Support & SysAdmin capabilities, Web & Mobile development breakdown, live stats counters, and interactive skill proficiency matrix.
- `/services` - **Services & IT Support**: Hardware diagnostics, network routing, OS maintenance, disaster recovery, web apps, and REST API development cards.
- `/projects` - **Portfolio Catalog**: Searchable project showcase with category filters (Web App, Mobile App, IT System, API, Admin Dashboard), live preview & GitHub links.
- `/projects/:slug` - **Project Details**: System specifications, client metadata, dates, architecture summary, and screenshot galleries.
- `/experience` - **Work Experience**: Career milestones, roles, and technology stacks.
- `/certifications` - **Certifications & Education**: Degrees alongside verified CompTIA, AWS, and networking certification badges.
- `/blog` - **Articles & Knowledge Base**: Searchable technical guides and tutorials.
- `/blog/:slug` - **Article Reader**: Markdown article view with tags and related articles.
- `/contact` - **Contact**: Direct communication channels (Email, Phone, Telegram, LinkedIn, GitHub, Facebook) and contact form transmitting messages to the Laravel REST API.

### 🛡️ Admin Dashboard (Protected by Sanctum)
- `/admin/login` - Sanctum Admin Authentication
- `/admin/dashboard` - Overview & Real-time Metrics
- `/admin/projects` - Full CRUD Project Management
- `/admin/skills` - Skills Matrix CRUD
- `/admin/services` - IT Support & Web Dev Services CRUD
- `/admin/experience` - Work History CRUD
- `/admin/education` - Academic Background CRUD
- `/admin/certifications` - Certificates & Badges CRUD
- `/admin/blog` - Article CMS with draft/published status & SEO metadata
- `/admin/testimonials` - Client Reviews CRUD
- `/admin/messages` - Inquiries Inbox
- `/admin/settings` - Profile, Location, Bio & Counter Settings

---

## 🚀 Local Development Setup

### 1. Prerequisites
- **Node.js** 18+ and **npm**
- **PHP** 8.2+ with `pdo_sqlite`, `sqlite3`, `zip`, `mbstring`, `openssl` extensions enabled.
- **Composer** 2.x

### 2. Backend Setup
```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --force --seed
php artisan serve --port=8000
```

### 3. Frontend Setup
```bash
cd frontend
npm install
npm run dev
```

The frontend will run on [http://localhost:5173/](http://localhost:5173/) and connect to the Laravel API on [http://127.0.0.1:8000/](http://127.0.0.1:8000/).

---

### Default Admin Credentials (Seeded)
- **Email**: `admin@puvy.dev`
- **Password**: `password123`

---

## 📄 License
MIT License. Created by **Khonn Vy (Puvy)**.
