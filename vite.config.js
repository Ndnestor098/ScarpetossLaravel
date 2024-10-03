import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        historyApiFallback: true, 
        host: '192.168.1.117',  // Permite conexiones desde cualquier IP
        port: 3000,       // Asegúrate de que el puerto sea el correcto
      },
});
