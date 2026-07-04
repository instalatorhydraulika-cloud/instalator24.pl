import PlayerChip from './PlayerChip'

// Panel rotacji: „Skład na boisku" (6) + „Ławka" (4) z szybkimi przyciskami.
export default function RotationPanel({
  onFieldList, // [{ slot, player }]
  benchList, // [player]
  onGrab,
  draggingId,
  onSendToBench,
  onSendToField,
  fieldFull,
}) {
  return (
    <div className="grid gap-4 sm:grid-cols-2">
      {/* SKŁAD NA BOISKU */}
      <section className="rounded-2xl bg-slate-800/70 p-3 ring-1 ring-white/10">
        <div className="mb-2 flex items-center justify-between">
          <h3 className="font-bold text-emerald-300">🟢 Na boisku</h3>
          <span className="rounded-full bg-emerald-500/20 px-2 py-0.5 text-xs font-bold text-emerald-300">
            {onFieldList.length}/6
          </span>
        </div>
        <ul className="flex flex-col gap-2">
          {onFieldList.map(({ slot, player }) => (
            <li
              key={player.id}
              className="flex items-center gap-2 rounded-xl bg-slate-900/60 p-1.5"
            >
              <PlayerChip
                player={player}
                onGrab={onGrab}
                dragging={draggingId === player.id}
                size="sm"
                showName={false}
              />
              <div className="min-w-0 flex-1">
                <p className="truncate font-semibold text-white">{player.name}</p>
                <p className="text-xs text-white/50">{slot.line}</p>
              </div>
              <button
                onClick={() => onSendToBench(player.id)}
                className="shrink-0 rounded-lg bg-rose-600/90 px-3 py-2 text-sm font-bold text-white active:scale-95"
              >
                Zejdź ↓
              </button>
            </li>
          ))}
        </ul>
      </section>

      {/* ŁAWKA */}
      <section
        data-zone="bench"
        className="rounded-2xl bg-slate-800/70 p-3 ring-1 ring-white/10"
      >
        <div className="mb-2 flex items-center justify-between">
          <h3 className="font-bold text-amber-300">🪑 Ławka</h3>
          <span className="rounded-full bg-amber-500/20 px-2 py-0.5 text-xs font-bold text-amber-300">
            {benchList.length}
          </span>
        </div>
        {benchList.length === 0 ? (
          <p className="py-6 text-center text-sm text-white/40">
            Wszyscy na boisku 💪
          </p>
        ) : (
          <ul className="flex flex-col gap-2">
            {benchList.map((player) => (
              <li
                key={player.id}
                className="flex items-center gap-2 rounded-xl bg-slate-900/60 p-1.5"
              >
                <PlayerChip
                  player={player}
                  onGrab={onGrab}
                  dragging={draggingId === player.id}
                  size="sm"
                  showName={false}
                />
                <div className="min-w-0 flex-1">
                  <p className="truncate font-semibold text-white">{player.name}</p>
                  <p className="text-xs text-white/50">
                    {player.role === 'BR' ? 'Bramkarz' : 'Rezerwowy'}
                  </p>
                </div>
                <button
                  onClick={() => onSendToField(player.id)}
                  disabled={fieldFull}
                  className="shrink-0 rounded-lg bg-emerald-600 px-3 py-2 text-sm font-bold text-white active:scale-95 disabled:cursor-not-allowed disabled:opacity-40"
                >
                  Wejdź ↑
                </button>
              </li>
            ))}
          </ul>
        )}
        {fieldFull && benchList.length > 0 && (
          <p className="mt-2 text-center text-[11px] text-white/40">
            Boisko pełne — najpierw ściągnij kogoś z boiska.
          </p>
        )}
      </section>
    </div>
  )
}
