#!/usr/bin/env bash

set -e

PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

echo "🔎 Verificando Docker..."

# 1. Verifica se o Docker CLI existe
if ! command -v docker &> /dev/null; then
    echo "❌ Docker não está instalado. Instale o Docker e tente novamente."
    exit 1
fi

# 2. Verifica se o Docker daemon está rodando
if ! docker info &> /dev/null; then
    echo "❌ Docker está instalado, mas o daemon não está rodando."
    echo "   ➜ No Linux:  sudo systemctl start docker"
    echo "   ➜ No WSL2:   abra o Docker Desktop"
    exit 1
fi

cd "$PROJECT_DIR"

# 3. Garante que o Sail existe
if [ ! -f "vendor/bin/sail" ]; then
    echo "⚠️  Laravel Sail não encontrado em vendor/bin/sail."
    echo "   Tentando instalar o Sail via Composer..."
    composer require laravel/sail --dev

    echo "⚠️  Agora você deve rodar manualmente:"
    echo "   php artisan sail:install"
    echo "   E escolher os serviços (mysql, redis, etc.) que você quiser."
    exit 0
fi

Sail="./vendor/bin/sail"

echo "🚧 Fazendo build dos containers (forçando rebuild)..."
$Sail build --no-cache

echo "🚀 Subindo containers em background..."
$Sail up -d

echo "✅ Ambiente do Laravel Sail está no ar!"
echo "   ➜ Para ver os containers: $Sail ps"
echo "   ➜ Para ver logs:          $Sail logs -f"
echo "   ➜ Para rodar testes:      $Sail test --testSuite=Feature"
