export default function (value) {
  if (value === 0) return ''

  return Number(value)
    .toLocaleString('en-US', {
      maximumFractionDigits: 0,
    })
    // На самом деле здесь &thinsp;, а не пробел
    .replace(/,/g, ' ')
}
