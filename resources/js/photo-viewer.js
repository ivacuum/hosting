export default class PhotoViewer {
  bind() {
    document
      .querySelectorAll('img')
      .forEach((el) => {
        const url = new URL(el.currentSrc)

        if (el.hidden || this.shouldSkipImage(url)) {
          return
        }

        el.addEventListener('load', (e) => this.handleLoaded(e.target.currentSrc))
      })
  }

  handleLoaded(src) {
    const url = new URL(src)

    if (url.pathname.startsWith('/-/500x375/')) {
      this.push('Photo500Viewed', url.pathname)
    } else if (url.pathname.startsWith('/-/1000x750/')) {
      this.push('Photo1000Viewed', url.pathname)
    } else {
      this.push('Photo2000Viewed', url.pathname)
    }
  }

  shouldSkipImage(url) {
    return url.host !== 'life.ivacuum.org'
      || url.pathname.startsWith('/gigs/');
  }

  push(event, slug) {
    App.beacon.push({ event, slug })
  }
}
