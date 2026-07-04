// Lista zawodników. „BR" = bramkarz (Rewka gra na bramce).
export const PLAYERS = [
  { id: 'rewka', name: 'Rewka', role: 'BR', gk: true },
  { id: 'kmieciu', name: 'Kmieciu', role: 'ZAW' },
  { id: 'barti', name: 'Barti', role: 'ZAW' },
  { id: 'bax', name: 'Bax', role: 'ZAW' },
  { id: 'bartek', name: 'Bartek', role: 'ZAW' },
  { id: 'tomek', name: 'Tomek', role: 'ZAW' },
  { id: 'marcin', name: 'Marcin', role: 'ZAW' },
  { id: 'pawel', name: 'Paweł', role: 'ZAW' },
  { id: 'messi', name: 'Messi', role: 'ZAW' },
  { id: 'mateusz', name: 'Mateusz', role: 'ZAW' },
]

export const PLAYER_BY_ID = Object.fromEntries(PLAYERS.map((p) => [p.id, p]))

// Formacje dla Orlika 5+1 (bramkarz + 5 zawodników w polu).
// Współrzędne w % boiska (x: 0=lewa, 100=prawa | y: 0=góra/atak, 100=dół/nasza bramka).
export const FORMATIONS = {
  '1-2-2': {
    label: '1-2-2',
    desc: 'Obrońca • 2 pomocników • 2 napastników',
    slots: [
      { id: 'gk', label: 'BR', line: 'Bramka', x: 50, y: 90 },
      { id: 'd1', label: 'OBR', line: 'Obrona', x: 50, y: 68 },
      { id: 'm1', label: 'POM', line: 'Pomoc', x: 27, y: 45 },
      { id: 'm2', label: 'POM', line: 'Pomoc', x: 73, y: 45 },
      { id: 'f1', label: 'NAP', line: 'Atak', x: 32, y: 20 },
      { id: 'f2', label: 'NAP', line: 'Atak', x: 68, y: 20 },
    ],
  },
  '1-2-1-1': {
    label: '1-2-1-1',
    desc: 'Obrońca • 2 pomocników • rozgrywający • napastnik',
    slots: [
      { id: 'gk', label: 'BR', line: 'Bramka', x: 50, y: 90 },
      { id: 'd1', label: 'OBR', line: 'Obrona', x: 50, y: 70 },
      { id: 'm1', label: 'POM', line: 'Pomoc', x: 26, y: 52 },
      { id: 'm2', label: 'POM', line: 'Pomoc', x: 74, y: 52 },
      { id: 'a1', label: 'ROZ', line: 'Rozgrywający', x: 50, y: 33 },
      { id: 'f1', label: 'NAP', line: 'Atak', x: 50, y: 13 },
    ],
  },
}

// Gotowe podpowiedzi taktyczne (szybkie wstawianie do notatek).
export const NOTE_PRESETS = [
  'Wysoki pressing',
  'Szybkie zmiany co 2 min',
  'Gra na zero z tyłu',
  'Kontry po odbiorze',
  'Krycie 1 na 1',
  'Spokój przy rozegraniu',
  'Ostre wejścia — bez fauli',
  'Strzały z dystansu',
]

export const STORAGE_KEY = 'taktyka-orlik-v1'
