/* global notie */

export default function acpRequestErrorNotification(error) {
  const { message, file, line } = error.response.data
  const debugInfo = message && file && line
    ? `<div class="small"><div>${message}</div><div>${file}:${line}</div></div>`
    : ''

  notie.alert({
    type: 'error',
    text: `${error.response.status} ${error.response.statusText}${debugInfo}`,
    stay: true,
  })
}
