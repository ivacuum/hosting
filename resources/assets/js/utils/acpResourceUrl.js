import locale from '../i18n/locale'

export default function acpResourceUrl(path, id = false) {
  let count = 3
  if (locale) count += 1
  if (id) count += 1

  return path.split('/').splice(0, count).join('/')
}
