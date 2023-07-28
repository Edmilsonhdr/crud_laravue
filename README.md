

1. **Instalar as dependências do Laravel:** Navegue para o diretório do projeto Laravel (back-end) e instale as dependências do Composer:

   ```
   composer install
   ```

2. **Configurar o arquivo .env:** Renomeie o arquivo `.env.example` para `.env` e defina as configurações de banco de dados e outras configurações necessárias para o Laravel funcionar corretamente:

3. **Migrar o banco de dados:** Execute as migrações para criar as tabelas do banco de dados:

   ```
   php artisan migrate
   ```

4. **Instalar as dependências do Vue.js:** Navegue para o diretório do projeto Vue.js (front-end) e instale as dependências do npm:

   ```
   npm install
   ```

5. **Compilar os assets do Vue.js:** Use o comando npm para compilar os assets do Vue.js (gerar os arquivos JS e CSS compilados):

   ```
   npm run dev
   ```

   Ou, se quiser que os assets sejam recompilados automaticamente sempre que houver alterações nos arquivos:

   ```
   npm run watch
   ```

6. **Iniciar o servidor do Laravel:** Execute o servidor do Laravel para que o back-end esteja em execução:

   ```
   php artisan serve
   ```

7. **Acessar o projeto:** Agora, você pode acessar o projeto em seu navegador digitando o endereço fornecido pelo servidor do Laravel (geralmente http://localhost:8000/).


