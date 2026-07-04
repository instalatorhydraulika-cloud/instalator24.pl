# ⚽ Taktyka Orlik 5+1

Responsywna aplikacja webowa (**React + Tailwind CSS**) do zarządzania taktyką
drużyny piłkarskiej **5+1** na orliku. Szybkie narzędzie dla kapitana przed
meczem — pokaż zawodnikom, kto gra i na jakiej pozycji.

## ✨ Funkcje

- **Panel taktyczny (drag & drop)** — wizualne boisko z góry. Przeciągnij kółko
  z imieniem zawodnika na wybraną pozycję. Działa **myszką i palcem** (dotyk na
  telefonie).
- **Dwie formacje** — `1-2-2` oraz `1-2-1-1`, z automatycznym przełożeniem
  składu przy zmianie ustawienia.
- **Panel rotacji** — sekcje **„Na boisku" (6)** i **„Ławka" (4)** z dużymi
  przyciskami `Zejdź ↓` / `Wejdź ↑` do błyskawicznych zmian.
- **Minutnik zmian** — odlicza interwał (1:00 / 1:30 / 2:00 / 3:00), piszczy i
  wibruje przy rotacji, zlicza liczbę zmian. Idealny do „szybkie zmiany co 2 min".
- **Notatki taktyczne** — pole na uwagi + gotowe podpowiedzi jednym kliknięciem
  (Wysoki pressing, Krycie 1 na 1, Kontry po odbiorze…).
- **Zapis w przeglądarce (localStorage)** — po odświeżeniu strony ustawienie,
  formacja i notatki nie znikają.
- **Dark mode** (domyślnie), duże przyciski, czytelność na telefonie.
- **Dodatki:** losowanie składu 🎲 oraz udostępnianie/kopiowanie składu 📤
  (Web Share API + schowek).

## 👥 Zawodnicy

Rewka (BR — bramkarz), Kmieciu, Barti, Bax, Bartek, Tomek, Marcin, Paweł,
Messi, Mateusz.

## 🚀 Uruchomienie

```bash
cd taktyka-orlik
npm install
npm run dev      # tryb deweloperski (http://localhost:5173)
npm run build    # produkcyjny build do folderu dist/
npm run preview  # podgląd zbudowanej wersji
```

Zbudowana aplikacja (`dist/`) jest w pełni statyczna (`base: './'`) — można ją
otworzyć lokalnie lub wrzucić na dowolny hosting / GitHub Pages.

## 🛠️ Technologie

React 18 · Vite 5 · Tailwind CSS 3 · Pointer Events (drag & drop dotykowy) ·
Web Audio API (sygnał zmian) · localStorage.
