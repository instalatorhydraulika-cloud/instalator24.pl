import { useEffect, useRef, useState } from 'react'

// Minutnik zmian — odlicza interwał (np. 2 min) i sygnalizuje rotację.
// Po dojściu do zera piszczy i sam startuje od nowa (zliczając zmiany).
const PRESETS = [60, 90, 120, 180]

function fmt(total) {
  const m = Math.floor(total / 60)
  const s = total % 60
  return `${m}:${String(s).padStart(2, '0')}`
}

export default function SubTimer() {
  const [interval, setIntervalSec] = useState(120)
  const [left, setLeft] = useState(120)
  const [running, setRunning] = useState(false)
  const [changes, setChanges] = useState(0)
  const audioRef = useRef(null)

  const beep = () => {
    try {
      const Ctx = window.AudioContext || window.webkitAudioContext
      if (!Ctx) return
      if (!audioRef.current) audioRef.current = new Ctx()
      const ctx = audioRef.current
      if (ctx.state === 'suspended') ctx.resume()
      ;[0, 0.2, 0.4].forEach((t) => {
        const osc = ctx.createOscillator()
        const gain = ctx.createGain()
        osc.frequency.value = 880
        osc.connect(gain)
        gain.connect(ctx.destination)
        gain.gain.setValueAtTime(0.0001, ctx.currentTime + t)
        gain.gain.exponentialRampToValueAtTime(0.5, ctx.currentTime + t + 0.02)
        gain.gain.exponentialRampToValueAtTime(0.0001, ctx.currentTime + t + 0.15)
        osc.start(ctx.currentTime + t)
        osc.stop(ctx.currentTime + t + 0.16)
      })
    } catch {
      /* dźwięk niedostępny — trudno */
    }
    if (navigator.vibrate) navigator.vibrate([200, 80, 200])
  }

  useEffect(() => {
    if (!running) return
    const id = window.setInterval(() => {
      setLeft((prev) => {
        if (prev <= 1) {
          beep()
          setChanges((c) => c + 1)
          return interval
        }
        return prev - 1
      })
    }, 1000)
    return () => window.clearInterval(id)
  }, [running, interval])

  const pickInterval = (sec) => {
    setIntervalSec(sec)
    setLeft(sec)
    setRunning(false)
  }

  const reset = () => {
    setLeft(interval)
    setRunning(false)
    setChanges(0)
  }

  const low = left <= 5 && running
  const pct = Math.round((left / interval) * 100)

  return (
    <section className="rounded-2xl bg-slate-800/70 p-4 ring-1 ring-white/10">
      <div className="mb-2 flex items-center justify-between">
        <h3 className="font-bold text-sky-300">⏱️ Minutnik zmian</h3>
        <span className="text-xs text-white/50">Zmiany: {changes}</span>
      </div>

      <div
        className={`mb-3 grid place-items-center rounded-xl py-4 font-mono text-5xl font-black tabular-nums ${
          low ? 'bg-rose-600/30 text-rose-300 pulse-ring' : 'bg-slate-900/60 text-white'
        }`}
      >
        {fmt(left)}
      </div>
      <div className="mb-3 h-2 w-full overflow-hidden rounded-full bg-slate-900/60">
        <div
          className="h-full rounded-full bg-sky-400 transition-all duration-1000 ease-linear"
          style={{ width: `${pct}%` }}
        />
      </div>

      <div className="mb-3 flex gap-2">
        <button
          onClick={() => setRunning((r) => !r)}
          className={`flex-1 rounded-xl py-3 text-base font-bold text-white active:scale-95 ${
            running ? 'bg-amber-600' : 'bg-emerald-600'
          }`}
        >
          {running ? '⏸ Pauza' : '▶ Start'}
        </button>
        <button
          onClick={reset}
          className="rounded-xl bg-slate-600 px-4 py-3 text-base font-bold text-white active:scale-95"
        >
          ⟲ Reset
        </button>
      </div>

      <div className="flex flex-wrap gap-2">
        {PRESETS.map((sec) => (
          <button
            key={sec}
            onClick={() => pickInterval(sec)}
            className={`flex-1 rounded-lg px-2 py-2 text-sm font-bold active:scale-95 ${
              interval === sec
                ? 'bg-sky-500 text-white'
                : 'bg-slate-700 text-white/80'
            }`}
          >
            {fmt(sec)}
          </button>
        ))}
      </div>
    </section>
  )
}
