// Kółko zawodnika — inicjały + imię. Można je złapać i przeciągnąć.
const COLORS = {
  BR: 'from-amber-400 to-amber-600 text-amber-950',
  ZAW: 'from-emerald-400 to-emerald-600 text-emerald-950',
}

function initials(name) {
  return name.slice(0, 2).toUpperCase()
}

export default function PlayerChip({ player, onGrab, dragging, size = 'md', showName = true }) {
  const dims = size === 'sm' ? 'h-11 w-11 text-sm' : 'h-14 w-14 text-base'
  const color = COLORS[player.role] || COLORS.ZAW

  return (
    <div
      className={`flex select-none flex-col items-center gap-1 ${dragging ? 'opacity-30' : ''}`}
      onPointerDown={(e) => onGrab && onGrab(player.id, e)}
      style={{ touchAction: 'none', cursor: 'grab' }}
      role="button"
      aria-label={`Zawodnik ${player.name}`}
    >
      <div
        className={`grid ${dims} place-items-center rounded-full bg-gradient-to-br ${color} font-extrabold shadow-lg ring-2 ring-white/70`}
      >
        {initials(player.name)}
      </div>
      {showName && (
        <span className="max-w-[4.5rem] truncate rounded bg-black/45 px-1.5 py-0.5 text-center text-[11px] font-semibold leading-tight text-white">
          {player.name}
        </span>
      )}
    </div>
  )
}
