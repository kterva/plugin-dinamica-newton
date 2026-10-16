#!/usr/bin/env bash
set -e

DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$DIR"

if [ -f .env ]; then
  set -a
  source .env
  set +a
fi

echo "Iniciando contenedores Docker..."
docker compose up -d

echo "Esperando que WordPress y MariaDB estén disponibles..."
for i in {1..30}; do
  if docker compose exec -T wordpress php -r "echo 'ok';" >/dev/null 2>&1; then
    break
  fi
  echo -n "."
  sleep 2
done
echo ""

echo "Comprobando estado de la instalación de WordPress..."
if docker compose run --rm wpcli wp core is-installed >/dev/null 2>&1; then
  echo "WordPress ya está instalado."
else
  echo "Ejecutando instalación inicial automática..."
  docker compose run --rm wpcli wp core install \
    --url="http://localhost:${WP_PORT:-8080}" \
    --title="${WP_SITE_TITLE:-Segunda Ley - Pruebas Plugin}" \
    --admin_user="${WP_ADMIN_USER:-admin}" \
    --admin_password="${WP_ADMIN_PASSWORD:-admin}" \
    --admin_email="${WP_ADMIN_EMAIL:-admin@example.local}" \
    --skip-email
  echo "¡Instalación completada exitosamente!"
fi

echo ""
echo "======================================================="
echo " Entorno WordPress Local Listo"
echo "======================================================="
echo " Sitio Web:     http://localhost:${WP_PORT:-8080}"
echo " Admin:         http://localhost:${WP_PORT:-8080}/wp-admin"
echo " Usuario:       ${WP_ADMIN_USER:-admin}"
echo " Contraseña:    ${WP_ADMIN_PASSWORD:-admin}"
echo " phpMyAdmin:    http://localhost:${PMA_PORT:-8081}"
echo " Base de datos: 127.0.0.1:${DB_PORT:-3306}"
echo "======================================================="
