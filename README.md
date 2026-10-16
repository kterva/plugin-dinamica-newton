# Dinámica y 2.ª Ley de Newton — plugin de WordPress

Plugin de WordPress con un entorno interactivo para estudiar **Dinámica** (Leyes de Newton) en **5.º año de Bachillerato** (Plan 94 / 2.° EMS, Uruguay). Está pensado para que cada estudiante practique de forma autónoma: manipula simuladores, ve cómo cambian los vectores y las fuerzas, resuelve problemas y recibe retroalimentación.

## Para qué sirve

- Ayudar a **construir el diagrama de cuerpo libre (DCL)** y a **plantear la 2.ª Ley de Newton por ejes** (ΣFₓ = m·aₓ, ΣFᵧ = m·aᵧ), sin versores: se trabaja en el plano con eje x y eje y.
- Mostrar de forma visual y manipulable qué pasa con la normal, el rozamiento y la aceleración al cambiar masas, ángulos, fuerzas y coeficientes.
- Ofrecer problemas para resolver (con tolerancia en las respuestas numéricas) y una evaluación escrita para imprimir.

Los números se muestran con **coma decimal y punto como separador de miles** (convención local), y las respuestas se aceptan con coma o con punto.

## Contenido

| Módulo | Qué trabaja |
|---|---|
| 1. Vectores y DCL | Magnitudes vectoriales, proyección en ejes, normal con fuerza oblicua (simulador interactivo) |
| 2. Rozamiento | Estático vs. cinético, gráfica f_roz(F) con salto de ruptura (simulador) |
| 3. Plano inclinado | Componentes Pₓ y Pᵧ, normal, rozamiento y aceleración al variar el ángulo (simulador) |
| 4. Cuerpos vinculados | Bloque sobre mesa unido por cuerda y polea a una masa colgante, DCL separados, cuerda cortable |
| 5. Dinámica y cinemática | Frenado en zona rugosa: coeficiente de rozamiento a partir del movimiento, gráfica v(t) |
| 6. Taller de problemas | Problemas con respuestas numéricas y resolución paso a paso |
| 7. Banco de resueltos | Preguntas conceptuales con retroalimentación |
| 8. Evaluación escrita | Hoja imprimible, sin soluciones en pantalla |

Los esquemas son SVG generados en el navegador, y las fórmulas se muestran con [KaTeX](https://katex.org/).

## Uso

1. Copiar la carpeta del plugin a `wp-content/plugins/` (el archivo principal es `plugin-segundaley.php`) y activarlo desde **Plugins** en el panel de WordPress.
2. Insertar el shortcode en una página o entrada:

   ```
   [dinamica_newton]
   ```

   También funciona `[segunda_ley]`.

Requisitos: un sitio WordPress. KaTeX se carga desde jsDelivr, así que el sitio necesita acceso a internet.

El progreso de problemas resueltos se guarda únicamente en el navegador de cada estudiante (`localStorage`); el plugin no guarda datos en el servidor ni usa servicios de terceros más allá de KaTeX.

## Estructura

```
plugin-segundaley.php     Archivo principal: registra los shortcodes y carga los assets
templates/app.php         Contenido de la página (módulos 1 a 8)
assets/js/dinamica.js     Simuladores, problemas, banco de resueltos y corrección
assets/css/dinamica.css   Estilos
assets/images/            Figuras de la evaluación escrita
bin/                      Scripts de desarrollo y despliegue
docker-compose.yml        WordPress + MariaDB + phpMyAdmin + WP-CLI para probar en local
```

## Despliegue

`bin/deploy` sube solo los archivos del plugin a un servidor por SSH, hace una copia de seguridad previa, verifica los archivos por hash y limpia la caché de Varnish. Los datos del servidor se configuran con variables de entorno (`DEPLOY_SSH_HOST`, `DEPLOY_SITE_USER`, `DEPLOY_SITE_URL`, `DEPLOY_SITE_DOMAIN`, `DEPLOY_REMOTE_DIR`, `DEPLOY_CACHE_TAG`). `./bin/deploy --dry-run` muestra qué cambiaría sin subir nada.

## Desarrollo local

Este entorno levanta una instancia local completa de WordPress utilizando Docker Compose, pensada específicamente para el desarrollo y prueba de plugins.

### Características

- **WordPress:** Versión oficial con PHP moderno y Apache.
- **MariaDB 10.11:** Base de datos persistente.
- **phpMyAdmin:** Interfaz gráfica para gestionar la base de datos en `http://localhost:8081`.
- **WP-CLI:** Herramienta de línea de comandos de WordPress integrada.
- **Live-Reload del Plugin:** La raíz de este repositorio está montada directamente en `/var/www/html/wp-content/plugins/plugin_segundaley/`. Cualquier cambio en el código se refleja de inmediato.
- **Configuración de depuración activa:** `WP_DEBUG`, `WP_DEBUG_LOG` y `SCRIPT_DEBUG` preconfigurados.
- **Límites de subida extendidos:** PHP configurado a 128MB de subida y 512MB de memoria.

---

### Inicio Rápido

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

### Accesos por defecto

| Servicio | URL / Host | Usuario | Contraseña |
|---|---|---|---|
| **WordPress (Frontend)** | [http://localhost:8080](http://localhost:8080) | - | - |
| **WordPress Admin** | [http://localhost:8080/wp-admin](http://localhost:8080/wp-admin) | `admin` | `admin` |
| **phpMyAdmin** | [http://localhost:8081](http://localhost:8081) | `wordpress` | `wordpress_pass` |
| **MySQL / MariaDB** | `127.0.0.1:3306` | `wordpress` | `wordpress_pass` |

> *Nota: Puedes personalizar puertos y contraseñas en el archivo `.env`.*

---

### Comandos Útiles

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

### Estructura para tu Plugin

Coloca los archivos de tu plugin directamente en este directorio. Por ejemplo, al crear tu archivo principal (ej. `plugin-segundaley.php` o `index.php`), WordPress lo detectará automáticamente en la sección **Plugins** del panel de administración (`/wp-admin/plugins.php`).
