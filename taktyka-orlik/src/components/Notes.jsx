import { NOTE_PRESETS } from '../data'

// Panel notatek taktycznych + gotowe podpowiedzi do szybkiego wstawiania.
export default function Notes({ notes, setNotes }) {
  const addPreset = (text) => {
    setNotes((prev) => {
      const lines = prev
        .split('\n')
        .map((l) => l.trim())
        .filter(Boolean)
      if (lines.includes(text)) return prev
      return [...lines, text].join('\n')
    })
  }

  return (
    <section className="rounded-2xl bg-slate-800/70 p-4 ring-1 ring-white/10">
      <div className="mb-2 flex items-center justify-between">
        <h3 className="font-bold text-violet-300">📝 Notatki na mecz</h3>
        {notes && (
          <button
            onClick={() => setNotes('')}
            className="text-xs font-semibold text-white/40 hover:text-white/70"
          >
            Wyczyść
          </button>
        )}
      </div>

      <textarea
        value={notes}
        onChange={(e) => setNotes(e.target.value)}
        rows={4}
        placeholder="Np. Wysoki pressing, krycie 1 na 1, szybkie zmiany co 2 min…"
        className="w-full resize-y rounded-xl border border-white/10 bg-slate-900/70 p-3 text-base text-white placeholder-white/30 outline-none focus:border-violet-400"
      />

      <div className="mt-3 flex flex-wrap gap-2">
        {NOTE_PRESETS.map((preset) => (
          <button
            key={preset}
            onClick={() => addPreset(preset)}
            className="rounded-full bg-slate-700 px-3 py-1.5 text-sm font-semibold text-white/85 active:scale-95 hover:bg-violet-600"
          >
            + {preset}
          </button>
        ))}
      </div>
    </section>
  )
}
