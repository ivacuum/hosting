export default class Beacon {
  constructor(csrfToken, endpoint = '/js/beacon') {
    this.data = []
    this.endpoint = endpoint
    this.csrfToken = csrfToken
    this.threshold = 100
  }

  bind() {
    if (!navigator.sendBeacon) return

    document.addEventListener('visibilitychange', () => {
      // При standalone может быть false?
      if (document.visibilityState === 'hidden') {
        this.send()
      }
    })

    window.addEventListener('pagehide', () => this.send())
  }

  push(payload = {}) {
    this.data.push(payload)

    if (this.data.length % this.threshold === 0) {
      this.send()
    }
  }

  send() {
    if (!navigator.sendBeacon) return
    if (this.data.length === 0) return

    const data = new FormData()

    data.append('events', JSON.stringify(this.data))
    data.append('_token', this.csrfToken)

    this.data = []

    navigator.sendBeacon(this.endpoint, data)
  }
}
