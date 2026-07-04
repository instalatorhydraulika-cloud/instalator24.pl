import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// base: './' → zbudowana aplikacja działa też po otwarciu pliku (file://)
// oraz z dowolnego podkatalogu (np. GitHub Pages).
export default defineConfig({
  plugins: [react()],
  base: './',
})
