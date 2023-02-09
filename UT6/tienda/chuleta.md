##Comandos

- Ejecutar migraciones
    php artisan migrate

- Borrar las migraciones 
    php artisan migrate:reset

- Crear campo en tabla
    php artisan make:migration %add_profile_to_users%

- Crear tabla y generar modelo
    php artisan make:model %Project% -m

- Crear tabla y generar modelo, factorias y seeder
    php artisan make:model %Project% -a

- Llenar las tablas
    php artisan db:seed

- Reiniciar todo
     php artisan migrate:fresh --seed 

- Borrar una migracion
    php artisan migrate:rollback  
    
- Borrar tablas
    php artisan db:wipe

- Compilar hojas de estilos
    npm run dev

-Crear Links simbolicos
    php artisan storage:link


##Carpetas

- Vistas
    resources/views

- Modelos
    app/Models/

- Factorias
    database/factories



equivalente a vardump
dd($algo)
