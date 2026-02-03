# 🐾 PeluPet API - Laravel

API REST completa para la aplicación PeluPet (Veterinaria y Grooming).

## 🚀 Instalación

Esta API Laravel está diseñada para trabajar con la aplicación Next.js de PeluPet.

### Requisitos
- PHP 8.2+
- Composer
- SQLite (ya configurado) o MySQL/PostgreSQL

### Pasos de Instalación

```bash
# 1. Ya instalado - Si necesitas reinstalar:
cd /ruta/a/pelupet-api
composer install

# 2. Copiar variables de entorno (ya configurado)
cp .env.example .env  # Solo si no existe

# 3. Generar key (ya hecho)
php artisan key:generate

# 4. Ejecutar migraciones (ya hecho)
php artisan migrate

# 5. Poblar servicios (ya hecho)
php artisan db:seed --class=ServiceSeeder

# 6. Iniciar servidor
php artisan serve
```

La API estará disponible en `http://localhost:8000`

## 📡 Endpoints API

### Autenticación

#### Registrar usuario
```http
POST /api/auth/register
Content-Type: application/json

{
  "name": "Juan Pérez",
  "email": "juan@example.com",
  "password": "password123",
  "phone": "+1234567890",
  "first_name": "Juan",
  "last_name": "Pérez",
  "address": "Calle Principal 123"
}
```

#### Login
```http
POST /api/auth/login
Content-Type: application/json

{
  "email": "juan@example.com",
  "password": "password123"
}
```

**Respuesta:**
```json
{
  "user": {...},
  "customer": {...},
  "token": "1|xxxxxxxxxxxxx"
}
```

## 🗄️ Base de Datos

### Tablas Principales

- **users** - Usuarios del sistema (con roles: customer, admin, doctor)
- **customers** - Perfil de clientes
- **pets** - Mascotas de los clientes
- **services** - Catálogo de servicios
- **grooming_appointments** - Citas agendadas
- **custom_services** - Solicitudes de servicios personalizados

## 🔐 Autenticación

La API usa **Laravel Sanctum** para autenticación basada en tokens.

### Uso:
1. Registra o loguea un usuario
2. Obtén el token de la respuesta
3. Incluye el token en requests:
   ```
   Authorization: Bearer {token}
   ```

## 🌐 CORS

Configurado para `localhost:3000` (Next.js). Edita `.env` para más orígenes:
```env
SANCTUM_STATEFUL_DOMAINS=localhost:3000,tudominio.com
```

## 📦 Servicios Pre-cargados

- ✂️ Baño Completo - $25
- ✂️ Corte de Pelo - $30
- 🏥 Limpieza Dental - $50
- 🏥 Consulta Veterinaria - $35
- 💉 Vacunación - $20
- 🌟 Spa Premium - $60

## 🚀 Para Producción

```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan migrate --force
```

Cambiar `.env`:
```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
```

## 🤝 Integración con Next.js

En Next.js `.env.local`:
```env
NEXT_PUBLIC_API_URL=http://localhost:8000/api
```

---

**Desarrollado con 💚 para PeluPet** 🐾
# pelupet-api
