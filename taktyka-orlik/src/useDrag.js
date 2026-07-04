import { useCallback, useEffect, useRef, useState } from 'react'

// Prosty menedżer przeciągania oparty o Pointer Events —
// działa tak samo pod myszką jak i pod palcem (dotyk) na telefonie.
// Wykrywanie strefy upuszczenia: element pod kursorem z atrybutem [data-zone].
export function useDrag(onDrop) {
  const [drag, setDrag] = useState(null) // { playerId, x, y } | null
  const state = useRef({ playerId: null, moved: false, lastZone: null })

  const clearHover = () => {
    document
      .querySelectorAll('[data-zone].zone-hover')
      .forEach((el) => el.classList.remove('zone-hover'))
  }

  const zoneAt = (x, y) => {
    const el = document.elementFromPoint(x, y)
    const zoneEl = el && el.closest('[data-zone]')
    return zoneEl ? { zone: zoneEl.getAttribute('data-zone'), el: zoneEl } : null
  }

  const onMove = useCallback((e) => {
    const point = e.touches ? e.touches[0] : e
    const x = point.clientX
    const y = point.clientY
    state.current.moved = true
    setDrag((d) => (d ? { ...d, x, y } : d))

    clearHover()
    const hit = zoneAt(x, y)
    if (hit) hit.el.classList.add('zone-hover')
    state.current.lastZone = hit ? hit.zone : null
  }, [])

  const end = useCallback(
    (e) => {
      window.removeEventListener('pointermove', onMove)
      window.removeEventListener('pointerup', end)
      window.removeEventListener('pointercancel', end)

      let zone = state.current.lastZone
      // ostatnia weryfikacja pozycji przy puszczeniu
      if (e && (e.clientX || e.clientY)) {
        const hit = zoneAt(e.clientX, e.clientY)
        zone = hit ? hit.zone : zone
      }
      clearHover()

      if (state.current.moved && zone && state.current.playerId) {
        onDrop(state.current.playerId, zone)
      }
      state.current = { playerId: null, moved: false, lastZone: null }
      setDrag(null)
    },
    [onMove, onDrop],
  )

  const startDrag = useCallback(
    (playerId, e) => {
      e.preventDefault()
      const point = e.touches ? e.touches[0] : e
      state.current = { playerId, moved: false, lastZone: null }
      setDrag({ playerId, x: point.clientX, y: point.clientY })
      window.addEventListener('pointermove', onMove, { passive: false })
      window.addEventListener('pointerup', end)
      window.addEventListener('pointercancel', end)
    },
    [onMove, end],
  )

  useEffect(() => {
    return () => {
      window.removeEventListener('pointermove', onMove)
      window.removeEventListener('pointerup', end)
      window.removeEventListener('pointercancel', end)
    }
  }, [onMove, end])

  return { drag, startDrag }
}
