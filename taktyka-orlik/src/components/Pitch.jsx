import PlayerChip from './PlayerChip'

// Widok boiska z góry + sloty pozycji. Sloty są strefami upuszczenia.
export default function Pitch({ formation, assignments, players, onGrab, draggingId }) {
  return (
    <div className="relative mx-auto w-full max-w-md">
      <div
        className="pitch-turf relative w-full overflow-hidden rounded-2xl border-2 border-white/25 shadow-2xl"
        style={{ aspectRatio: '3 / 4' }}
      >
        {/* Linie boiska */}
        <div className="pointer-events-none absolute inset-3 rounded-lg border-2 border-white/45" />
        {/* Linia środkowa */}
        <div className="pointer-events-none absolute left-3 right-3 top-1/2 h-0.5 -translate-y-1/2 bg-white/45" />
        {/* Koło środkowe */}
        <div className="pointer-events-none absolute left-1/2 top-1/2 h-20 w-20 -translate-x-1/2 -translate-y-1/2 rounded-full border-2 border-white/45" />
        {/* Pole bramkowe (nasze, na dole) */}
        <div className="pointer-events-none absolute bottom-3 left-1/2 h-14 w-40 -translate-x-1/2 border-2 border-b-0 border-white/45" />
        {/* Pole bramkowe (rywala, na górze) */}
        <div className="pointer-events-none absolute left-1/2 top-3 h-14 w-40 -translate-x-1/2 border-2 border-t-0 border-white/45" />

        {formation.slots.map((slot) => {
          const pid = assignments[slot.id]
          const player = pid ? players[pid] : null
          return (
            <div
              key={slot.id}
              data-zone={`slot:${slot.id}`}
              className="absolute -translate-x-1/2 -translate-y-1/2 transition-all duration-200"
              style={{ left: `${slot.x}%`, top: `${slot.y}%` }}
            >
              {player ? (
                <PlayerChip
                  player={player}
                  onGrab={onGrab}
                  dragging={draggingId === player.id}
                  size="sm"
                />
              ) : (
                <div className="flex flex-col items-center gap-1">
                  <div className="grid h-11 w-11 place-items-center rounded-full border-2 border-dashed border-white/60 bg-white/10 text-[10px] font-bold text-white/80">
                    {slot.label}
                  </div>
                </div>
              )}
            </div>
          )
        })}
      </div>
      <p className="mt-2 text-center text-xs text-white/50">
        Przeciągnij zawodnika na pozycję • góra = atak, dół = nasza bramka
      </p>
    </div>
  )
}
