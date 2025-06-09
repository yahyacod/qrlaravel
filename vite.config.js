import { defineConfig } from 'vite'
import tailwindcss from 'tailwindcss'

// Kalau proyek Laravel:
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css'],
      refresh: true,
    }),
  ],
})
