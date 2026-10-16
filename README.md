# Entorno de Desarrollo Local para WordPress & Plugin

Este entorno levanta una instancia local completa de WordPress utilizando Docker Compose, pensada específicamente para el desarrollo y prueba de plugins.

## Características

- **WordPress:** Versión oficial con PHP moderno y Apache.
- **MariaDB 10.11:** Base de datos persistente.
- **phpMyAdmin:** Interfaz gráfica para gestionar la base de datos en `http://localhost:8081`.
- **WP-CLI:** Herramienta de línea de comandos de WordPress integrada.
- **Live-Reload del Plugin:** La raíz de este repositorio está montada directamente en `/var/www/html/wp-content/plugins/plugin_segundaley/`. Cualquier cambio en el código se refleja de inmediato.
- **Configuración de depuración activa:** `WP_DEBUG`, `WP_DEBUG_LOG` y `SCRIPT_DEBUG` preconfigurados.
- **Límites de subida extendidos:** PHP configurado a 128MB de subida y 512MB de memoria.

---

## Inicio Rápido

### 1. Iniciar los contenedores e instalar WordPress automáticamente

Ejecuta el script de configuración:

```bash
./bin/setup.sh
```

Este script:
1. Descarga las imágenes y levanta los contenedores en segundo plano.
2. Espera a que la base de datos y Apache estén listos.
3. Instala WordPress con los datos de `.env` (si aún no está instalado).

---

## Accesos por defecto

| Servicio | URL / Host | Usuario | Contraseña |
|---|---|---|---|
| **WordPress (Frontend)** | [http://localhost:8080](http://localhost:8080) | - | - |
| **WordPress Admin** | [http://localhost:8080/wp-admin](http://localhost:8080/wp-admin) | `admin` | `admin` |
| **phpMyAdmin** | [http://localhost:8081](http://localhost:8081) | `wordpress` | `wordpress_pass` |
| **MySQL / MariaDB** | `127.0.0.1:3306` | `wordpress` | `wordpress_pass` |

> *Nota: Puedes personalizar puertos y contraseñas en el archivo `.env`.*

---

## Comandos Útiles

### Levantar / Detener el entorno

```bash
# Iniciar servicios en segundo plano
docker compose up -d

# Ver registros en tiempo real (logs)
docker compose logs -f wordpress

# Detener servicios
docker compose down

# Detener y borrar volúmenes de datos (reinicio limpio desde cero)
docker compose down -v
```

### Usar WP-CLI

Puedes usar el script `./bin/wp` para interactuar con WordPress sin salir de tu terminal:

```bash
# Listar plugins
./bin/wp plugin list

# Activar el plugin
./bin/wp plugin activate plugin_segundaley

# Desactivar el plugin
./bin/wp plugin deactivate plugin_segundaley

# Ver versión de WordPress
./bin/wp core version
```

---

## Estructura para tu Plugin

Coloca los archivos de tu plugin directamente en este directorio. Por ejemplo, al crear tu archivo principal (ej. `plugin-segundaley.php` o `index.php`), WordPress lo detectará automáticamente en la sección **Plugins** del panel de administración (`/wp-admin/plugins.php`).
