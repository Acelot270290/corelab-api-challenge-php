#!/bin/sh

echo "Iniciando o script entrypoint.sh..."

# Instala as dependências do Composer
if [ ! -d "/var/www/vendor" ]; then
    echo "Instalando dependências do Composer..."
    composer install
    if [ $? -eq 0 ]; then
        echo "Composer install concluído com sucesso."
    else
        echo "Erro ao executar composer install."
        exit 1
    fi
else
    echo "Dependências do Composer já instaladas."
fi

# Verifica se o arquivo .env não existe
if [ ! -f /var/www/.env ]; then
    echo "Criando arquivo .env a partir de .env.example..."
    cp /var/www/.env.example /var/www/.env
    echo "Gerando chave da aplicação..."
    php artisan key:generate
    if [ $? -eq 0 ]; then
        echo "Chave da aplicação gerada com sucesso."
    else
   
