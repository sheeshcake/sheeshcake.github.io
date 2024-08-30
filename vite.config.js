import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import path from 'path'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  base: "/sheeshcake.github.io",
  resolve: {
      alias: {
          process: "process/browser",
          stream: "stream-browserify",
          zlib: "browserify-zlib",
          util: 'util',
          '@': path.resolve(__dirname, "./src")
      },
  },
})
