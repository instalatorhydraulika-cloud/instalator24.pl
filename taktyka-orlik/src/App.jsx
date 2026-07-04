import { useCallback, useEffect, useMemo, useState } from 'react'
import { FORMATIONS, PLAYERS, PLAYER_BY_ID, STORAGE_KEY } from './data'
import { useDrag } from './useDrag'
import Pitch from './components/Pitch'
import PlayerChip from './components/PlayerChip'
import RotationPanel from './components/RotationPanel'
import SubTimer from './components/SubTimer'
import Notes from './components/Notes'

const DEFAULT_STATE = {
  formation: '1-2-2',
  assignments: {
    gk: 'rewka',
    d1: 'kmieciu',
    m1: 'barti',
    m2: 'bax',
    f1: 'bartek',
    f2: 'tomek',
  },
  notes: '',
}

function loadState() {
  try {
    const raw = localStorage.getItem(STORAGE_KEY)
    if (!raw) return DEFAULT_STATE
    const parsed = JSON.parse(raw)
    if (!FORMATIONS[parsed.formation]) return DEFAULT_STATE
    return {
      formation: parsed.formation,
      assignments: parsed.assignments && typeof parsed.assignments === 'object' ? parsed.assignments : {},
      notes: typeof parsed.notes === 'string' ? parsed.notes : '',
    }
  } catch {
    return DEFAULT_STATE
  }
}

function shuffle(arr) {
  const a = [...arr]
  for (let i = a.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1))
    ;[a[i], a[j]] = [a[j], a[i]]
  }
  return a
}

export default function App() {
  const [state, setState] = useState(loadState)
  const [dark, setDark] = useState(() => localStorage.getItem('taktyka-orlik-theme') !== 'light')
  const [toast, setToast] = useState(null)

  const { formation: formationKey, assignments, notes } = state
  const formation = FORMATIONS[formationKey]

  // Zapis stanu do pamięci przeglądarki (localStorage).
  useEffect(() => {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(state))
    } catch {
      /* brak miejsca / tryb prywatny — pomijamy */
    }
  }, [state])

  useEffect(() => {
    document.documentElement.classList.toggle('dark', dark)
    localStorage.setItem('taktyka-orlik-theme', dark ? 'dark' : 'light')
  }, [dark])

  const flash = (msg) => {
    setToast(msg)
    window.setTimeout(() => setToast(null), 1800)
  }

  // ——— Logika ustawiania ———
  const assignToSlot = useCallback((playerId, slotId) => {
    setState((prev) => {
      const a = { ...prev.assignments }
      const fromSlot = Object.keys(a).find((s) => a[s] === playerId)
      const occupant = a[slotId]
      if (fromSlot) delete a[fromSlot]
      // zamiana miejscami, jeśli gracz przyszedł z innego slotu
      if (occupant && fromSlot) a[fromSlot] = occupant
      a[slotId] = playerId
      return { ...prev, assignments: a }
    })
  }, [])

  const sendToBench = useCallback((playerId) => {
    setState((prev) => {
      const a = { ...prev.assignments }
      const fromSlot = Object.keys(a).find((s) => a[s] === playerId)
      if (fromSlot) delete a[fromSlot]
      return { ...prev, assignments: a }
    })
  }, [])

  const sendToField = useCallback(
    (playerId) => {
      setState((prev) => {
        const slots = FORMATIONS[prev.formation].slots
        const empty = slots.find((s) => !prev.assignments[s.id])
        if (!empty) {
          flash('Boisko pełne — ściągnij najpierw kogoś.')
          return prev
        }
        return { ...prev, assignments: { ...prev.assignments, [empty.id]: playerId } }
      })
    },
    [],
  )

  const onDrop = useCallback(
    (playerId, zone) => {
      if (zone === 'bench') sendToBench(playerId)
      else if (zone.startsWith('slot:')) assignToSlot(playerId, zone.slice(5))
    },
    [assignToSlot, sendToBench],
  )

  const { drag, startDrag } = useDrag(onDrop)

  const changeFormation = (newKey) => {
    setState((prev) => {
      if (newKey === prev.formation) return prev
      const oldSlots = FORMATIONS[prev.formation].slots
      const newSlots = FORMATIONS[newKey].slots
      const gkPlayer = prev.assignments.gk
      const others = oldSlots
        .filter((s) => s.id !== 'gk')
        .map((s) => prev.assignments[s.id])
        .filter(Boolean)
      const a = {}
      if (gkPlayer) a.gk = gkPlayer
      newSlots
        .filter((s) => s.id !== 'gk')
        .forEach((slot, i) => {
          if (others[i]) a[slot.id] = others[i]
        })
      return { ...prev, formation: newKey, assignments: a }
    })
  }

  const resetLineup = () => {
    if (window.confirm('Przywrócić domyślne ustawienie składu?')) {
      setState((prev) => ({ ...DEFAULT_STATE, notes: prev.notes }))
      flash('Skład zresetowany')
    }
  }

  const randomLineup = () => {
    setState((prev) => {
      const slots = FORMATIONS[prev.formation].slots
      const others = shuffle(PLAYERS.filter((p) => p.id !== 'rewka')).map((p) => p.id)
      const a = { gk: 'rewka' }
      slots
        .filter((s) => s.id !== 'gk')
        .forEach((slot, i) => {
          if (others[i]) a[slot.id] = others[i]
        })
      return { ...prev, assignments: a }
    })
    flash('Wylosowano skład')
  }

  const setNotes = (updater) =>
    setState((prev) => ({
      ...prev,
      notes: typeof updater === 'function' ? updater(prev.notes) : updater,
    }))

  // ——— Dane pochodne ———
  const onFieldList = useMemo(
    () =>
      formation.slots
        .map((slot) => ({ slot, player: PLAYER_BY_ID[assignments[slot.id]] }))
        .filter((x) => x.player),
    [formation, assignments],
  )

  const benchList = useMemo(() => {
    const onField = new Set(Object.values(assignments))
    return PLAYERS.filter((p) => !onField.has(p.id))
  }, [assignments])

  const fieldFull = onFieldList.length >= formation.slots.length

  const shareLineup = async () => {
    const lines = ['⚽ SKŁAD — ' + formation.label]
    formation.slots.forEach((slot) => {
      const p = PLAYER_BY_ID[assignments[slot.id]]
      lines.push(`${slot.line}: ${p ? p.name : '—'}`)
    })
    if (benchList.length) lines.push('Ławka: ' + benchList.map((p) => p.name).join(', '))
    if (notes.trim()) lines.push('\nNotatki:\n' + notes.trim())
    const text = lines.join('\n')
    try {
      if (navigator.share) {
        await navigator.share({ title: 'Taktyka Orlik', text })
        return
      }
      await navigator.clipboard.writeText(text)
      flash('Skopiowano skład do schowka')
    } catch {
      flash('Nie udało się udostępnić')
    }
  }

  const dragPlayer = drag ? PLAYER_BY_ID[drag.playerId] : null

  return (
    <div className="min-h-full bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white">
      <div className="mx-auto max-w-5xl px-3 pb-16 pt-[max(0.75rem,env(safe-area-inset-top))]">
        {/* Nagłówek */}
        <header className="mb-4 flex items-center justify-between gap-2">
          <div>
            <h1 className="text-2xl font-black tracking-tight sm:text-3xl">
              ⚽ Taktyka <span className="text-emerald-400">Orlik</span>
            </h1>
            <p className="text-xs text-white/50">Narzędzie kapitana • skład 5+1</p>
          </div>
          <button
            onClick={() => setDark((d) => !d)}
            className="rounded-xl bg-slate-800 px-3 py-2 text-lg ring-1 ring-white/10 active:scale-95"
            aria-label="Przełącz motyw"
          >
            {dark ? '☀️' : '🌙'}
          </button>
        </header>

        {/* Wybór formacji */}
        <div className="mb-4 flex flex-wrap items-center gap-2">
          {Object.entries(FORMATIONS).map(([key, f]) => (
            <button
              key={key}
              onClick={() => changeFormation(key)}
              className={`rounded-xl px-4 py-2.5 text-base font-bold ring-1 transition active:scale-95 ${
                formationKey === key
                  ? 'bg-emerald-500 text-emerald-950 ring-emerald-300'
                  : 'bg-slate-800 text-white/80 ring-white/10'
              }`}
            >
              {f.label}
            </button>
          ))}
          <span className="ml-1 hidden text-sm text-white/50 sm:inline">{formation.desc}</span>
        </div>

        <div className="grid gap-4 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.05fr)]">
          {/* Lewa kolumna: boisko */}
          <div>
            <Pitch
              formation={formation}
              assignments={assignments}
              players={PLAYER_BY_ID}
              onGrab={startDrag}
              draggingId={drag?.playerId}
            />
            <div className="mt-3 flex gap-2">
              <button
                onClick={randomLineup}
                className="flex-1 rounded-xl bg-slate-800 py-3 text-sm font-bold text-white ring-1 ring-white/10 active:scale-95"
              >
                🎲 Losuj
              </button>
              <button
                onClick={shareLineup}
                className="flex-1 rounded-xl bg-slate-800 py-3 text-sm font-bold text-white ring-1 ring-white/10 active:scale-95"
              >
                📤 Udostępnij
              </button>
              <button
                onClick={resetLineup}
                className="flex-1 rounded-xl bg-slate-800 py-3 text-sm font-bold text-white ring-1 ring-white/10 active:scale-95"
              >
                ⟲ Reset
              </button>
            </div>
          </div>

          {/* Prawa kolumna: rotacja, minutnik, notatki */}
          <div className="flex flex-col gap-4">
            <RotationPanel
              onFieldList={onFieldList}
              benchList={benchList}
              onGrab={startDrag}
              draggingId={drag?.playerId}
              onSendToBench={sendToBench}
              onSendToField={sendToField}
              fieldFull={fieldFull}
            />
            <SubTimer />
            <Notes notes={notes} setNotes={setNotes} />
          </div>
        </div>

        <footer className="mt-8 text-center text-xs text-white/30">
          Ustawienie zapisuje się automatycznie w tej przeglądarce.
        </footer>
      </div>

      {/* „Duch" przeciąganego zawodnika */}
      {drag && dragPlayer && (
        <div className="drag-ghost" style={{ left: drag.x, top: drag.y }}>
          <PlayerChip player={dragPlayer} size="md" showName={false} />
        </div>
      )}

      {/* Komunikat */}
      {toast && (
        <div className="fixed bottom-5 left-1/2 z-40 -translate-x-1/2 rounded-full bg-black/85 px-5 py-2.5 text-sm font-semibold text-white shadow-xl ring-1 ring-white/10">
          {toast}
        </div>
      )}
    </div>
  )
}
