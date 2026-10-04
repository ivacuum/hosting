document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.js-timeline').forEach((timeline) => {
    const current = timeline.querySelector('mark')

    if (current === null || timeline.scrollWidth <= timeline.clientWidth) {
      return
    }

    const timelineRect = timeline.getBoundingClientRect()
    const currentRect = current.getBoundingClientRect()

    timeline.scrollLeft += currentRect.left - timelineRect.left
      + currentRect.width / 2 - timeline.clientWidth / 2
  })
})
